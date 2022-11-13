<?php

namespace Examai\Examai\Services;

use Examai\Examai\Models\Candidat;
use Examai\Examai\Models\Candidat_classe;
use Examai\Examai\Models\Classe;
use PDO;

abstract class CandidatService
{
    static function paginate_candidats($start, $size, $column_sort, $sort_asc, $search, $filters)
    {
        $columns = ['ID_CANDIDAT', 'NOM', 'PRENOM', 'EMAIL', 'NOM_CLASSE', 'ANNEE'];
        if (in_array($column_sort, $columns)) {
            $column_sort = 'ID_CANDIDAT';
        }

        $sort = ($sort_asc ? 'ASC' : 'DESC');

        $pdo = \Connection::instance();
        $candidat_with_class_query = "select candidat.ID_CANDIDAT,candidat_classe.id,classe.ID_CLASSE, NOM,PRENOM, EMAIL, NOM_CLASSE, ANNEE from candidat ";
        $candidat_with_class_query .= "inner join candidat_classe on candidat_classe.ID_CANDIDAT = candidat.ID_CANDIDAT ";
        $candidat_with_class_query .= "inner join classe on classe.ID_CLASSE = candidat_classe.ID_CLASSE ";
        $candidat_with_class_query .= "where classe.ID_ENSEIGNANT= :ID_ENSEIGNANT ";

        $filter_query = "where (" . join(" like :SEARCH or ", $columns) . " like :SEARCH) ";
        if ($filters['NOM'])
            $filter_query .= 'and NOM = :NOM ';
        if ($filters['PRENOM'])
            $filter_query .= 'and PRENOM = :PRENOM ';
        if ($filters['EMAIL'])
            $filter_query .= 'and EMAIL = :EMAIL ';

        $filter_classes = [];
        if ($filters['CLASSES_ID']) {
            $class_params = '';
            foreach ($filters['CLASSES_ID'] as $index => $class_id) {
                $filter_classes[':CLASSES_ID_' . $index] = $class_id;
                if ($index === 0)
                    $class_params .= ':CLASSES_ID_' . $index;
                else
                    $class_params .= ', :CLASSES_ID_' . $index;
            }

            $filter_query .= "and ID_CLASSE in ($class_params) ";
        }


        $filter_query .= "ORDER BY $column_sort $sort ";
        $limit_query = "LIMIT :START, :LENGTH ";

        if (empty($search))
            $search = '';
        $search = '%' . $search . '%';

        $connecteduser_id = auth_user()->ID_ENSEIGNANT;
        $query = "select * from($candidat_with_class_query) view_cour $filter_query $limit_query";

        $statement = $pdo->prepare($query);
        $statement->bindParam(':SEARCH', $search);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->bindParam(':START', $start, PDO::PARAM_INT);
        $statement->bindParam(':LENGTH', $size, PDO::PARAM_INT);

        if ($filters['NOM'])
            $statement->bindParam(':NOM', $filters['NOM']);
        if ($filters['PRENOM'])
            $statement->bindParam(':PRENOM', $filters['PRENOM']);
        if ($filters['EMAIL'])
            $statement->bindParam(':EMAIL', $filters['EMAIL']);

        foreach ($filter_classes as $param_class => $value_class) {
            $statement->bindValue($param_class, $value_class);
        }

        $statement->execute();
        $data = $statement->fetchAll();

        $statement = $pdo->prepare("select count(*) from($candidat_with_class_query) view_cour ");
        $statement->bindValue(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->execute();
        $count_all_data = $statement->fetchColumn();

        $query = "select count(ID_CANDIDAT) from($candidat_with_class_query) view_cour $filter_query";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':SEARCH', $search);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->bindParam(':START', $start, PDO::PARAM_INT);
        $statement->bindParam(':LENGTH', $size, PDO::PARAM_INT);

        if ($filters['NOM'])
            $statement->bindParam(':NOM', $filters['NOM']);
        if ($filters['PRENOM'])
            $statement->bindParam(':PRENOM', $filters['PRENOM']);
        if ($filters['EMAIL'])
            $statement->bindParam(':EMAIL', $filters['EMAIL']);

        foreach ($filter_classes as $param_class => $value_class) {
            $statement->bindValue($param_class, $value_class);
        }

        $statement->execute();
        $count_filtred_data = $statement->fetchColumn();

        return ["iTotalRecords" => $count_all_data, "iTotalDisplayRecords" => $count_filtred_data, "aaData" => $data];
    }


    static function create_candidat($prenom, $nom, $email)
    {
        $candidat = new Candidat();
        $candidat->PRENOM = $prenom;
        $candidat->NOM = $nom;
        $candidat->EMAIL = $email;
        $candidat->MOT_DE_PASSE = generateRandomString();
        if ($candidat->create()) {
            return $candidat;
        }

        throw  new \Exception(trans('candidat.could-not-create-this-candidat'));
    }

    static function update_candidat($candidat, $prenom, $nom, $email)
    {
        $candidat->PRENOM = $prenom;
        $candidat->NOM = $nom;
        $candidat->EMAIL = $email;
        if (!$candidat->update())
            throw  new \Exception(trans('candidat.could-not-update-information-candidat'));


        /*
        if ($candidat_classe) {
            $candidat_classe->ID_CLASSE = $idclasse;
            if (!$candidat_classe->update())
                throw  new \Exception(trans('candidat.could-not-update-class-candidat'));
        }*/

        return $candidat;
    }

    public static function delete_candidat($id)
    {
        $candidat = Candidat::firstBy('ID_CANDIDAT', $id);
        if ($candidat) {
            $candidat->delete();
            return true;
        }

        return false;
    }

    public static function candidat_attach_class($candidat, $class_id)
    {
        $candidat_classe = new Candidat_classe();
        $candidat_classe->ID_CANDIDAT = $candidat->ID_CANDIDAT;
        $candidat_classe->ID_CLASSE = $class_id;
        if ($candidat_classe->create()) {
            return $candidat_classe;
        }
        throw  new \Exception(trans('candidat.could-not-create-class-candidat'));
    }

    public static function candidat_sync_class($candidat_classe, $class_id)
    {
        $candidat_classe->ID_CLASSE = $class_id;
        if ($candidat_classe->update()) {
            return $candidat_classe;
        }
        throw  new \Exception(trans('candidat.could-not-update-class-candidat'));
    }


    public static function verify_candidates($class_id, $candidates)
    {
        $verfied_candidates = [];
        foreach ($candidates as $candidat) {
            $verfied_candidates[] = CandidatService::verify_candidat($class_id, $candidat);
        }

        return $verfied_candidates;
    }

    public static function check_candidates($candidates)
    {
        foreach ($candidates as $v_candidat) {
            if ($v_candidat[0]['valide'] == false && $v_candidat[1]['valide'] == false && $v_candidat[2]['valide'] == false) {
                return false;
            }
        }
        return true;
    }

    static function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function verify_candidat($class_id, $candidat)
    {

        $v_candidat[0] = $v_candidat[1] = $v_candidat[2] = $v_candidat[3] = ['valide' => true, 'message' => ''];

        if (empty($candidat[0])) {
            $v_candidat[0] = ['valide' => false, 'message' => trans('candidat.required')];
        }

        if (empty($candidat[1])) {
            $v_candidat[1] = ['valide' => false, 'message' => trans('candidat.required')];
        }

        if (empty($candidat[2])) {
            $v_candidat[2] = ['valide' => false, 'message' => trans('candidat.required')];
        }

        if (!filter_var($candidat[2], FILTER_VALIDATE_EMAIL)) {
            $v_candidat[2] = ['valide' => false, 'message' => trans('candidat.email-must-be-valide')];
        }
        $candidat = Candidat::firstBy('EMAIL', $candidat[2]);
        $class = Classe::firstBy('ID_CLASSE', $class_id);

        if ($candidat && $class && Candidat_classe::find($candidat->ID_CANDIDAT, $class->ID_CLASSE))
            $v_candidat[3] = ['valide' => false, 'message' => trans('candidat.candidat-already-exists')];
        return $v_candidat;
    }

    public static function import_candidat($class_id, $candidates)
    {
        $results = CandidatService::verify_candidates($class_id, $candidates);
        if (CandidatService::check_candidates($results)) {
            try {
                $classe = Classe::firstBy('ID_CLASSE', $class_id);
                \Connection::instance()->beginTransaction();
                foreach ($candidates as $key => $candidat) {
                    if ($results[$key][3]['valide'] === false)
                        continue;
                    $v_candidat = Candidat::firstBy('email', $candidat[2]);
                    if (!empty($v_candidat)) {
                        CandidatService::update_candidat($v_candidat, $candidat[1], $candidat[0], $candidat[2]);
                        $candidat_classe = Candidat_classe::find($v_candidat->ID_CANDIDAT, $class_id);
                        if (!empty($candidat_classe))
                            bad_request(trans('candidat.email-already-exists-for-this-class') . ': ' . $classe->NOM_CLASSE);
                    } else
                        $v_candidat = CandidatService::create_candidat($candidat[1], $candidat[0], $candidat[2]);
                    CandidatService::candidat_attach_class($v_candidat, $class_id);
                }
                \Connection::instance()->commit();
            } catch
            (\Exception $e) {
                \Connection::instance()->rollBack();
                bad_request($e->getMessage());

            }
        } else
            throw new \Exception(trans('candidat.must-be-valide'));

    }
}








