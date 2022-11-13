<?php

namespace Examai\Examai\Services;

use Examai\Examai\Models\Classe;
use PDO;

abstract class ClasseService
{
    static function paginate_classes($start, $size, $column_sort, $sort_asc, $search)
    {
        $columns = ['ID_CLASSE', 'NOM_CLASSE', 'ANNEE', 'CODE', 'TOTAL_CANDIDAT', 'AVG_NOTE', 'TOP_1'];
        if (in_array($column_sort, $columns)) {
            $column_sort = 'ID_CLASSE';
        }

        $sort = ($sort_asc ? 'ASC' : 'DESC');

        $pdo = \Connection::instance();
        $avgnote_byclass_query = "select avg(COALESCE(cp.NOTE, 0)) from candidat_classe cc ";
        $avgnote_byclass_query .= "inner join candidat_passage cp on cc.ID_CANDIDAT = cp.ID_CANDIDAT ";
        $avgnote_byclass_query .= "inner join examen on examen.ID_EXAMEN = cp.ID_EXAMEN and examen.ID_CLASSE = cc.ID_CLASSE ";
        $avgnote_byclass_query .= "where cc.ID_CLASSE = classe.ID_CLASSE and cp.NOTE is not null ";

        $class_query = " SELECT classe.ID_CLASSE,NOM_CLASSE,ANNEE,classe.CODE ";
        $class_query .= ",count(candidat_classe.ID_CANDIDAT) as TOTAL_CANDIDAT,  ($avgnote_byclass_query) as AVG_NOTE FROM classe ";
        $class_query .= "left join candidat_classe on candidat_classe.ID_CLASSE = classe.ID_CLASSE ";
        $class_query .= "where classe.ID_ENSEIGNANT= :ID_ENSEIGNANT ";
        $class_query .= "group by classe.ID_CLASSE,NOM_CLASSE,ANNEE,classe.CODE ";


        $avgnote_byclass_bycandidat_query = "select avg(COALESCE(NOTE, 0)) from candidat_classe cc ";
        $avgnote_byclass_bycandidat_query .= "inner join candidat_passage cp on cc.ID_CANDIDAT = cp.ID_CANDIDAT ";
        $avgnote_byclass_bycandidat_query .= "inner join examen on examen.ID_EXAMEN = cp.ID_EXAMEN and examen.ID_CLASSE = cc.ID_CLASSE ";
        $avgnote_byclass_bycandidat_query .= "where cc.ID_CLASSE = cce.ID_CLASSE and cp.NOTE is not null ";
        $avgnote_byclass_bycandidat_query .= "group by cc.ID_CLASSE, cp.ID_CANDIDAT ";

        $candidat_having_top_note = "select cce.ID_CLASSE, cce.ID_CANDIDAT from candidat_classe cce ";
        $candidat_having_top_note .= "inner join candidat_passage on cce.ID_CANDIDAT = candidat_passage.ID_CANDIDAT ";
        $candidat_having_top_note .= "inner join examen on examen.ID_EXAMEN = candidat_passage.ID_EXAMEN and examen.ID_CLASSE = cce.ID_CLASSE ";
        $candidat_having_top_note .= "where  candidat_passage.NOTE is not null ";
        $candidat_having_top_note .= "group by cce.ID_CLASSE, cce.ID_CANDIDAT ";
        $candidat_having_top_note .= "having  avg(COALESCE(NOTE, 0)) > 0 and avg(COALESCE(NOTE, 0)) >= all($avgnote_byclass_bycandidat_query) ";


        $principal_query = "select AVGCLASS.*, candidat.NOM as TOP_1 from ($class_query) AVGCLASS ";
        $principal_query .= "left  join ($candidat_having_top_note) TOPCANDIDAT on  TOPCANDIDAT.ID_CLASSE = AVGCLASS.ID_CLASSE ";
        $principal_query .= "left join candidat on candidat.ID_CANDIDAT = TOPCANDIDAT.ID_CANDIDAT ";


        $filter_query = "where " . join(" like :SEARCH or ", $columns) . " ";
        $filter_query .= "ORDER BY $column_sort $sort ";
        $limit_query = "LIMIT :START, :LENGTH ";

        if (empty($search))
            $search = '';
        $search = '%' . $search . '%';

        $connecteduser_id = auth_user()->ID_ENSEIGNANT;
        $query = "select * from($principal_query) view_cour $filter_query $limit_query";

        $statement = $pdo->prepare($query);
        $statement->bindParam(':SEARCH', $search);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->bindParam(':START', $start, PDO::PARAM_INT);
        $statement->bindParam(':LENGTH', $size, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetchAll();

        $statement = $pdo->prepare("select count(*) from($principal_query) view_cour ");
        $statement->bindValue(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->execute();
        $count_all_data = $statement->fetchColumn();

        $query = "select count(ID_CLASSE) from($principal_query) view_cour $filter_query";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':SEARCH', $search);
        $statement->bindParam(':ID_ENSEIGNANT', $connecteduser_id);
        $statement->bindParam(':START', $start, PDO::PARAM_INT);
        $statement->bindParam(':LENGTH', $size, PDO::PARAM_INT);
        $statement->execute();
        $count_filtred_data = $statement->fetchColumn();

        return ["iTotalRecords" => $count_all_data, "iTotalDisplayRecords" => $count_filtred_data, "aaData" => $data];
    }


    static function create_classe($name, $year, $code)
    {
        $classe = new Classe();
        $classe->NOM_CLASSE = $name;
        $classe->ANNEE = $year;
        $classe->CODE = $code;
        $classe->ID_ENSEIGNANT = auth_user()->ID_ENSEIGNANT;
        if ($classe->create())
            return $classe;
        else
            throw  new \Exception(trans('classe.could-not-create-this-classe'));
    }

    static function update_classe($id, $name, $year, $code)
    {
        $classe = Classe::firstBy('ID_CLASSE', $id);
        if ($classe) {
            $classe->NOM_CLASSE = $name;
            $classe->ANNEE = $year;
            $classe->CODE = $code;
            $classe->ID_ENSEIGNANT = auth_user()->ID_ENSEIGNANT;
            if (!$classe->update())
                throw  new \Exception(trans('classe.could-not-update-this-classe'));
        }

        return $classe;
    }

    public static function delete_classe($id)
    {
        $classe = Classe::firstBy('ID_CLASSE', $id);
        if ($classe) {
            $classe->delete();
            return true;
        }

        return false;
    }
}