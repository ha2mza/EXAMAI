<?php
$title = 'ExamAI - Exams';
require_once ROOT . '/src/Views/layouts/home.php';

function render_actions()
{
    ?>
    <div class="btn-group">
        <button type="button" class="btn btn-dark btn-icon-text" data-backdrop="static" data-toggle="modal"
                data-target="#EditExamDialog">
            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend" fill="white" viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M480.1 160.1L316.3 325.7L186.3 195.7L302.1 80L288.1 66.91C279.6 57.54 264.4 57.54 255 66.91L168.1 152.1C159.6 162.3 144.4 162.3 135 152.1C125.7 143.6 125.7 128.4 135 119L221.1 32.97C249.2 4.853 294.8 4.853 322.9 32.97L336 46.06L351 31.03C386.9-4.849 445.1-4.849 480.1 31.03C516.9 66.91 516.9 125.1 480.1 160.1V160.1zM229.5 412.5C181.5 460.5 120.3 493.2 53.7 506.5L28.71 511.5C20.84 513.1 12.7 510.6 7.03 504.1C1.356 499.3-1.107 491.2 .4662 483.3L5.465 458.3C18.78 391.7 51.52 330.5 99.54 282.5L163.7 218.3L293.7 348.3L229.5 412.5z"/>
            </svg>
            <?= trans('exam.edit') ?>
        </button>
        <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <span class="sr-only"></span>
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item btn-icon-text" onclick="!loadingDeleteExam && DeleteExam(event)">
                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/>
                </svg>
                <?= trans('exam.delete') ?>
            </button>
            <button class="dropdown-item btn-icon-text" data-backdrop="static" data-toggle="modal"
                    data-target="#QuestionExamDialog">
                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1" viewBox="0 0 576 512">
                    <path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/>
                </svg>
                <?= trans('exam.view-question') ?>
            </button>
            <button class="dropdown-item btn-icon-text" data-backdrop="static" data-toggle="modal"
                    data-target="#MarkExamDialog">
                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1" viewBox="0 0 640 512">
                    <path d="M623.1 136.9l-282.7-101.2c-13.73-4.91-28.7-4.91-42.43 0L16.05 136.9C6.438 140.4 0 149.6 0 160s6.438 19.65 16.05 23.09L76.07 204.6c-11.89 15.8-20.26 34.16-24.55 53.95C40.05 263.4 32 274.8 32 288c0 9.953 4.814 18.49 11.94 24.36l-24.83 149C17.48 471.1 25 480 34.89 480H93.11c9.887 0 17.41-8.879 15.78-18.63l-24.83-149C91.19 306.5 96 297.1 96 288c0-10.29-5.174-19.03-12.72-24.89c4.252-17.76 12.88-33.82 24.94-47.03l190.6 68.23c13.73 4.91 28.7 4.91 42.43 0l282.7-101.2C633.6 179.6 640 170.4 640 160S633.6 140.4 623.1 136.9zM351.1 314.4C341.7 318.1 330.9 320 320 320c-10.92 0-21.69-1.867-32-5.555L142.8 262.5L128 405.3C128 446.6 213.1 480 320 480c105.1 0 192-33.4 192-74.67l-14.78-142.9L351.1 314.4z"/>
                </svg>
                <?= trans('exam.view-marks') ?>
            </button>
            <button class="dropdown-item btn-icon-text" data-backdrop="static" data-toggle="modal"
                    data-target="#MonitoringExamDialog">
                <svg class="btn-icon-prepend mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <defs>
                        <style>.fa-secondary {
                                opacity: .4
                            }</style>
                    </defs>
                    <path class="fa-primary"
                          d="M400.9 438.6l-49.12-30.75C409.9 367.4 448 300.3 448 224c0-123.8-100.4-224-224-224c-123.8 0-224 100.3-224 224c0 76.25 38.13 143.4 96.13 183.9L47 438.6C37.63 444.5 32 454.8 32 465.8v14.25c0 17.62 14.48 31.1 32.11 31.1L384 512c17.62 0 32-14.38 32-32V465.8C416 454.8 410.3 444.5 400.9 438.6zM224 384c-88.37 0-160.1-71.62-160.1-159.1s71.63-160 159.1-160s160 71.62 160 160S312.3 384 224 384z"/>
                    <path class="fa-secondary"
                          d="M224 96C153.4 96 95.92 153.3 95.92 224s57.38 128 128 128c70.75 0 128-57.25 128-128C351.9 153.4 294.6 96 224 96zM223.9 176c-26.5 0-47.88 21.5-48 48c0 8.875-7.125 16-16 16c-8.75 0-16-7.125-16-16c.125-44.13 35.92-80 80.04-80c8.875 0 15.96 7.125 15.96 16S232.8 176 223.9 176z"/>
                </svg>
                <?= trans('exam.monitoring') ?>
            </button>
            <button class="dropdown-item btn-icon-text" onclick="!loadingDeleteExam && SendEmailExam(event)">
                <svg class="btn-icon-prepend mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z"/>
                </svg>
                <?= trans('exam.send-exam-via-email') ?>
            </button>
        </div>
    </div>
    <?php
}

function script_init()
{

    ?>
    <!-- plugin js for this page -->
    <script src="<?= DOMAIN ?>/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= DOMAIN ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= DOMAIN ?>/assets/vendors/datatables.net-bs4/dataTables.responsive.min.js"></script>
    <script src="<?= DOMAIN ?>/assets/vendors/datatables.net-bs4/responsive.bootstrap4.min.js"></script>
    <script src="<?= DOMAIN ?>/assets/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= DOMAIN ?>/assets/vendors/select2/select2.min.js"></script>
    <!-- end plugin js for this page -->
    <script>

        var loadingDeleteExam = false;
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });

        var examsDatatable = null;
        $(function () {
            'use strict';

            examsDatatable = $('#dataTableExams').DataTable({

                "aLengthMenu": [
                    [10, 30, 50, -1],
                    [10, 30, 50, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    "url": "<?= DOMAIN . '/assets/vendors/datatables.net-bs4/' . current_lang() . '.json' ?>"
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?=DOMAIN?>/exams/index.php',
                    type: 'POST',
                },
                columns: [
                    {data: 'ID_EXAMEN'},
                    {data: 'INFO'},
                    {data: 'TYPE'},
                    {data: 'NATURE'},
                    {data: 'DUREE'},
                    {data: 'STATUT'},
                    {data: 'DATE_STRICTE'},
                    {data: 'NB_DE_VERSION'},
                    {
                        data: null,
                        defaultContent: `<?= render_actions() ?>`
                    }
                ],
            });

            $('#dataTableExams').each(function () {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });
        });

        function EditExamDialog(e) {
            $('#EditExamDialog').modal('show');
        }

        function SendEmailExam(e) {
            loadingDeleteExam = true;
            const exam = examsDatatable.row($(e.target).parents('tr')).data();
            $.post("<?= DOMAIN . '/exams/send.php' ?>", exam).done(function (response) {
                response = jQuery.parseJSON(response);
                Toast.fire({
                    icon: 'success',
                    title: response.message
                })
            }).fail(function (event) {
                try {
                    var response = jQuery.parseJSON(event.responseText);
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    })
                } catch (e) {
                    Toast.fire({
                        icon: 'error',
                        title: event.statusText
                    })
                }
            }).always(function () {
                loadingDeleteExam = false;
            });
        }

        function DeleteExam(e) {

            if (loadingDeleteExam)
                return;

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: "<?=trans('exam.alert-message')?>",
                text: "<?=trans('exam.are-you-sure-you-went-delete-that')?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'mr-2',
                confirmButtonText: "<?=trans('exam.yes-delete-it')?>",
                cancelButtonText: "<?=trans('exam.no-cancel')?>",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    loadingDeleteExam = true;
                    const exam = examsDatatable.row($(e.target).parents('tr')).data();
                    $.post("<?= DOMAIN . '/exams/delete.php' ?>", exam).done(function (response) {
                        response = jQuery.parseJSON(response);
                        examsDatatable.ajax.reload();
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        })
                    }).fail(function (event) {
                        try {
                            var response = jQuery.parseJSON(event.responseText);
                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        } catch (e) {
                            Toast.fire({
                                icon: 'error',
                                title: event.statusText
                            })
                        }
                    }).always(function () {
                        loadingDeleteExam = false;
                    });
                }
            })
        }

    </script>
    <?php
    create_exam_script_init();
    edit_exam_script_init();
    question_exam_script_init();
    mark_exam_script_init();
}

function style_init()
{
    ?>
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/vendors/datatables.net-bs4/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/vendors/select2/select2.min.css">
    <!-- end plugin css for this page -->
    <style>
        .btn-icon-prepend {
            width: 16px;
            height: 16px;
        }

        fieldset {
            border: 1px dashed #1a1a1a !important;
            padding: 0 15px !important;
        }

        legend {
            width: auto !important;
            /* max-width: 100%; */
            margin-bottom: 0 !important;
            font-size: 100% !important;
        }
    </style>

    <style>
        #CreateExamDialog input[type=radio]:checked + label:hover, #EditExamDialog input[type=radio]:checked + label:hover {
            color: #fff;
            background-color: #181d23;
            border-color: #13171c;
        }

        #CreateExamDialog input[type=radio]:checked + label, #EditExamDialog input[type=radio]:checked + label {
            color: #fff;
            background-color: #282f3a;
            border-color: #282f3a;
        }
    </style>
    <?php
}

function content_init()
{
    ?>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><?= trans('exam.list-exams') ?></h6>
                    <p class="card-description"></p>
                    <div class="row align-items-center mb-2">
                        <div class="col-12 text-right">
                            <button class="btn btn-dark  btn-icon-text" data-toggle="modal" data-backdrop="static"
                                    data-target="#CreateExamDialog">
                                <svg fill="white" class="btn-icon-prepend" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 448 512">
                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM224 368C237.3 368 248 357.3 248 344V280H312C325.3 280 336 269.3 336 256C336 242.7 325.3 232 312 232H248V168C248 154.7 237.3 144 224 144C210.7 144 200 154.7 200 168V232H136C122.7 232 112 242.7 112 256C112 269.3 122.7 280 136 280H200V344C200 357.3 210.7 368 224 368z"/>
                                </svg>
                                <?= trans('exam.create') ?>
                            </button>
                        </div>
                    </div>

                    <?php include_once 'create_exam.php' ?>
                    <?php include_once 'edit_exam.php' ?>
                    <?php include_once 'question_exam.php' ?>
                    <?php include_once 'mark_exam.php' ?>
                    <?php include_once 'monitoring_exam.php' ?>

                    <div class="table-responsive">
                        <table id="dataTableExams" class="table w-100">
                            <thead>
                            <tr>
                                <th></th>
                                <th><?= trans('exam.info') ?></th>
                                <th><?= trans('exam.type') ?></th>
                                <th><?= trans('exam.nature') ?></th>
                                <th><?= trans('exam.duration') ?></th>
                                <th><?= trans('exam.status') ?></th>
                                <th><?= trans('exam.strict-date') ?></th>
                                <th><?= trans('exam.versions') ?></th>
                                <th data-priority="1"><?= trans('exam.actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}