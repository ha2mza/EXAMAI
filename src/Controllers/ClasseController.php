<?php

namespace Examai\Examai\Controllers;

use Examai\Examai\Middleware\AuthMiddleware;
use Examai\Examai\Models\Classe;
use Examai\Examai\Services\ClasseService;

class ClasseController
{

    // check if user not connected
    // if user not connected redirect to login page
    // because all this method of controller required authentification
    public function __construct()
    {
        AuthMiddleware::check();
    }

    /* get method display list of classes with pagination */
    public function indexView()
    {
        require_once ROOT . '/src/Views/classe/index.php';
    }

    /* all classes with pagination this request called via datatable.js */
    /* list of classes is given by connected user  */
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
        ok_request(ClasseService::paginate_classes($row, $rowperpage, $columnName, $columnSortOrder, $searchValue));
    }


    /* create classe for a connected user */
    public function store()
    {
        $name = request_data('NOM_CLASSE');
        $year = request_data('ANNEE');
        $code = request_data('CODE');
        if (!empty($name) && !empty($code) && !empty($year)) {
            try {

                if (!is_numeric($year))
                    bad_request(trans('classe.year-is-not-number'));

                $classe = Classe::firstBy('CODE', $code);
                if (!empty($classe))
                    bad_request(trans('classe.code-already-exists'));

                $classe = ClasseService::create_classe($name, $year, $code);
                ok_request(['message' => trans('classe.create-classe-success'), 'data' => $classe]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('classe.all-field-required'));

    }

    /* update classe for a connected user */
    public function update()
    {

        $name = request_data('NOM_CLASSE');
        $year = request_data('ANNEE');
        $code = request_data('CODE');
        $id = request_data('ID_CLASSE');
        if (!empty($id) && !empty($name) && !empty($code) && !empty($year)) {
            try {

                if (!is_numeric($year))
                    bad_request(trans('classe.year-is-not-number'));

                $classe = Classe::firstBy('CODE', $code);
                if (!empty($classe) && $id != $classe->ID_CLASSE)
                    bad_request(trans('classe.code-already-exists'));

                $classe = ClasseService::update_classe($id, $name, $year, $code);
                ok_request(['message' => trans('classe.update-classe-success'), 'data' => $classe]);
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('classe.all-field-required'));
    }

    /* delete classe for a connected user */
    public function delete()
    {
        $id = request_data('ID_CLASSE');
        if (!empty($id)) {
            try {
                $classe = Classe::firstBy('ID_CLASSE', $id);
                if ($classe) {
                    $classe->delete();
                    ok_request(['message' => trans('classe.delete-classe-success')]);
                } else
                    notfound_request(trans('classe.classe-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }

        bad_request(trans('classe.all-field-required'));
    }

    /* the principe of this function is  only return information that necessary for editing classe */
    public function edit()
    {
        $id = request_data('ID_CLASSE');
        if (!empty($id)) {
            try {
                $classe = Classe::firstBy('ID_CLASSE', $id);
                if ($classe) {
                    ok_request(['classe' => $classe]);
                } else
                    notfound_request(trans('classe.classe-not-found'));
            } catch (\Exception $e) {
                bad_request($e->getMessage());
            }
            exit;
        }
        bad_request(trans('classe.all-field-required'));
    }
}