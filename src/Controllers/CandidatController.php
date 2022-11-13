<?php

namespace Examai\Examai\Controllers;

use Examai\Examai\Middleware\AuthMiddleware;
use Examai\Examai\Models\Candidat;
use Examai\Examai\Models\Candidat_classe;
use Examai\Examai\Models\Classe;
use Examai\Examai\Services\CandidatService;

class CandidatController
{

    // check if user not connected
    // if user not connected redirect to login page
    // because all this method of controller required authentification
    public function __construct()
    {
        AuthMiddleware::check();
    }

    /* get method display list of candidats with pagination */
    public function indexView()
    {
        require_once ROOT . '/src/Views/candidat/index.php';
    }

    /* all candidats with pagination this request called via datatable.js */
    /* list of candidats is given by connected user  */
    public function index()
    {
        ## Read value
        ## $draw = request_data('draw');
        $row = request_data('start');
        $rowperpage = request_data('length');
        $columnIndex = request_input('order.0.column');
        $columnName = request_input("columns.$columnIndex.data");
        $columnSortOrder = strtolower(request_input("order.0.dir")) === "asc";
        $searchValue = request_input("search.value");
        $filters = [];
        $filters['NOM'] = request_input('filterByLastName');
        $filters['PRENOM'] = request_input('filterByFirstName');
        $filters['EMAIL'] = request_input('filterByEmail');
        $filters['CLASSES_ID'] = request_input('filterByClass');
        ok_request(CandidatService::paginate_candidats($row, $rowperpage, $columnName, $columnSortOrder, $searchValue, $filters));
    }


    /* create candidat for a connected user */
    public function store()
    {
        $prenom = request_data('PRENOM');
        $nom = request_data('NOM');
        $email = request_data('EMAIL');
        $id_classes = request_data('ID_CLASSE');
        if (!is_array($id_classes))
            bad_request(trans('candidat.id-classe-is-not-array-given'));

        if (!empty($prenom) && !empty($nom) && !empty($email) && count($id_classes) > 0) {
            \Connection::instance()->beginTransaction();
            foreach ($id_classes as $id_classe) {
                try {
                    $classe = Classe::firstBy('ID_CLASSE', $id_classe);
                    if (empty($classe))
                        bad_request(trans('candidat.verify-id-classe'));

                    $candidat = Candidat::firstBy('email', $email);
                    if (!empty($candidat)) {
                        CandidatService::update_candidat($candidat, $prenom, $nom, $email);
                        $candidat_classe = Candidat_classe::find($candidat->ID_CANDIDAT, $id_classe);
                        if (!empty($candidat_classe))
                            bad_request(trans('candidat.email-already-exists-for-this-class') . ': ' . $classe->NOM_CLASSE);
                    } else
                        $candidat = CandidatService::create_candidat($prenom, $nom, $email);
                    CandidatService::candidat_attach_class($candidat, $id_classe);
                } catch (\Exception $e) {
                    \Connection::instance()->rollBack();
                    bad_request($e->getMessage());
                }
            }

            \Connection::instance()->commit();
            ok_request(['message' => trans('candidat.create-candidat-success')]);
        }

        bad_request(trans('candidat.all-field-required'));

    }

    /* update candidat for a connected user */
    public function update()
    {

        $id = request_data('id');
        $prenom = request_data('PRENOM');
        $nom = request_data('NOM');
        $email = request_data('EMAIL');
        $id_classe = request_data('ID_CLASSE');
        if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($id_classe)) {
            try {
                $candidat_classe = Candidat_classe::firstBy('id', $id);
                if (empty($candidat_classe))
                    notfound_request(trans('candidat.candidat-not-found'));

                $classe = Classe::firstBy('ID_CLASSE', $id_classe);
                if (empty($classe))
                    bad_request(trans('candidat.verify-id-classe'));

                $candidat = Candidat::firstBy('email', $email);

                if (!empty($candidat)) {

                    if ($candidat->ID_CANDIDAT != $candidat_classe->ID_CANDIDAT) {
                        bad_request(trans('candidat.email-already-exists-for-other-candidat'));
                    }

                    if ($classe->ID_CLASSE != $candidat_classe->ID_CLASSE) {
                        $other_candidat_classe = Candidat_classe::find($candidat->ID_CANDIDAT, $classe->ID_CLASSE);
                        if (!empty($other_candidat_classe))
                            notfound_request(trans('candidat.email-already-exists-for-this-class'));
                    }
                }


                CandidatService::update_candidat($candidat, $prenom, $nom, $email);
                CandidatService::candidat_sync_class($candidat_classe, $id_classe);
                ok_request(['message' => trans('candidat.update-candidat-success')]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('candidat.all-field-required'));
    }

    /* delete candidat for a connected user */
    public function delete()
    {
        $id = request_data('id');
        if (!empty($id)) {
            try {

                $candidat_classe = Candidat_classe::firstBy('id', $id);
                if (empty($candidat_classe))
                    notfound_request(trans('candidat.candidat-not-found'));
                $candidat_classe->delete();

                ok_request(['message' => trans('candidat.delete-candidat-success')]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('candidat.all-field-required'));
    }

    /* the principe of this function is  only return information that necessary for editing candidat */
    public function edit()
    {
        $id = request_data('id');
        if (!empty($id)) {
            try {
                $classes = Classe::select2format(auth_user()->ID_ENSEIGNANT);

                $candidat_classe = Candidat_classe::firstBy('id', $id);
                if ($candidat_classe) {
                    $candidat = Candidat::firstBy('ID_CANDIDAT', $candidat_classe->ID_CANDIDAT);

                    ok_request(['candidat' => $candidat, 'classes' => $classes, 'candidat_classe' => $candidat_classe]);
                }

                notfound_request(trans('candidat.candidat-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }
        bad_request(trans('candidat.all-field-required'));
    }

    /* get necessary data for creating candidat in CreateCandidatDialog (View Part) */
    /* also we use this method in ImportCandidatDialog but is not good practice, just for this situation is not creating a critical something */
    public function create()
    {
        try {
            $classes = Classe::select2format(auth_user()->ID_ENSEIGNANT);
            ok_request(['classes' => $classes]);
        } catch (\Exception $e) {
            bad_request($e->getMessage());
        }
        exit;
    }

    /* this method for importing candidates coming via csv file */
    public function import()
    {
        try {
            // checking file if exists
            if (!isset($_FILES['file']))
                bad_request(trans('candidat.file-not-exists'));

            // check class if exists in database
            $classe = Classe::firstBy('ID_CLASSE', request_input('ID_CLASSE'));
            if (empty($classe))
                bad_request(trans('candidat.verify-id-classe'));

            $candidates = [];
            // read uploaded file , if cannot reading file => fopen return false
            if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
                // get data from csv file
                while (($data = fgetcsv($handle, null, ",")) !== FALSE)
                    // escape empty line
                    if ((!empty($data[0])) || (!empty($data[1])) || (!empty($data[2])))
                        $candidates[] = $data; // add value to array

                fclose($handle);
                // closing file
            }
            // importing candidat
            CandidatService::import_candidat(request_input('ID_CLASSE'), $candidates);
            ok_request(['message' => trans('candidat.import-candidat-success')]);
        } catch (\Exception $e) {
            bad_request($e->getMessage());
        }
    }

    /* this method for validating candidates before importing via csv file */
    public function check_import()
    {
        try {
            // checking file if exists
            if (!isset($_FILES['file']))
                bad_request(trans('candidat.file-not-exists'));

            // check class if exists in database
            $classe = Classe::firstBy('ID_CLASSE', request_input('ID_CLASSE'));
            if (empty($classe))
                bad_request(trans('candidat.verify-id-classe'));

            $candidates = [];
            // read uploaded file , if cannot reading file => fopen return false
            if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
                // get data from csv file
                while (($data = fgetcsv($handle, null, ",")) !== FALSE)
                    // escape empty line
                    if ((!empty($data[0])) || (!empty($data[1])) || (!empty($data[2])))
                        $candidates[] = $data; // add value to array

                fclose($handle);
                // closing file
            }
            // verify candidates
            $results = CandidatService::verify_candidates(request_input('ID_CLASSE'), $candidates);
            // checking candidates
            $can_import = CandidatService::check_candidates($results);
            // difference between verify and checking , verify giving exactly error field, checking giving only true or false

            ok_request(['candidates' => $candidates, 'results' => $results, 'can_import' => $can_import]);
        } catch (\Exception $e) {
            bad_request($e->getMessage());
        }
    }
}