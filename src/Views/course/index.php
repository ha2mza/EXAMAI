<?php
$title = 'ExamAI - Courses';
require_once ROOT . '/src/Views/layouts/home.php';

function render_actions()
{
    ?>
    <div class="btn-group">
        <button type="button" class="btn btn-dark btn-icon-text" data-backdrop="static" data-toggle="modal"
                data-target="#EditCourseDialog">
            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend" fill="white" viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M480.1 160.1L316.3 325.7L186.3 195.7L302.1 80L288.1 66.91C279.6 57.54 264.4 57.54 255 66.91L168.1 152.1C159.6 162.3 144.4 162.3 135 152.1C125.7 143.6 125.7 128.4 135 119L221.1 32.97C249.2 4.853 294.8 4.853 322.9 32.97L336 46.06L351 31.03C386.9-4.849 445.1-4.849 480.1 31.03C516.9 66.91 516.9 125.1 480.1 160.1V160.1zM229.5 412.5C181.5 460.5 120.3 493.2 53.7 506.5L28.71 511.5C20.84 513.1 12.7 510.6 7.03 504.1C1.356 499.3-1.107 491.2 .4662 483.3L5.465 458.3C18.78 391.7 51.52 330.5 99.54 282.5L163.7 218.3L293.7 348.3L229.5 412.5z"/>
            </svg>
            <?= trans('course.edit') ?>
        </button>
        <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <span class="sr-only"></span>
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item btn-icon-text" onclick="DeleteCourse(event)">
                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/>
                </svg>
                <?= trans('course.delete') ?>
            </button>
            <button class="dropdown-item btn-icon-text" data-backdrop="static" data-toggle="modal"
                    data-target="#QuestionCourseDialog">
                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1" viewBox="0 0 512 512">
                    <path d="M231.1 344V280H167.1C154.7 280 143.1 269.3 143.1 256C143.1 242.7 154.7 232 167.1 232H231.1V168C231.1 154.7 242.7 144 255.1 144C269.3 144 280 154.7 280 168V232H344C357.3 232 368 242.7 368 256C368 269.3 357.3 280 344 280H280V344C280 357.3 269.3 368 255.1 368C242.7 368 231.1 357.3 231.1 344zM15.96 218.6L108.5 66.56C121.5 45.1 144.9 32 169.1 32H342C367.1 32 390.5 45.1 403.5 66.56L496 218.6C510 241.6 510 270.4 496 293.4L403.5 445.4C390.5 466.9 367.1 480 342 480H169.1C144.9 480 121.5 466.9 108.5 445.4L15.96 293.4C1.962 270.4 1.962 241.6 15.96 218.6V218.6zM56.96 243.5C52.29 251.2 52.29 260.8 56.96 268.5L149.5 420.5C153.8 427.6 161.6 432 169.1 432H342C350.4 432 358.2 427.6 362.5 420.5L455 268.5C459.7 260.8 459.7 251.2 455 243.5L362.5 91.52C358.2 84.37 350.4 80 342 80H169.1C161.6 80 153.8 84.37 149.5 91.52L56.96 243.5zM403.5 66.56L362.5 91.52L403.5 66.56zM15.96 293.4L56.96 268.5z"/>
                </svg>
                <?= trans('course.create-question') ?>
            </button>
            <button class="dropdown-item btn-icon-text" data-backdrop="static" data-toggle="modal"
                    data-target="#CreateExamDialog">
                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1" viewBox="0 0 448 512">
                    <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"/>
                </svg>
                <?= trans('course.create-exam') ?>
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
        var loadingDeleteCourse = false;
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });

        var coursesDatatable = null;
        $(function () {
            'use strict';

            coursesDatatable = $('#dataTableCourses').DataTable({

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
                    url: '<?=DOMAIN?>/courses/index.php',
                    type: 'POST',
                },
                columns: [
                    {data: 'ID_COUR'},
                    {data: 'NOM_COUR'},
                    {data: 'NB_QST'},
                    {data: 'LAST_DATE'},
                    {
                        data: null,
                        defaultContent: `<?= render_actions() ?>`
                    }
                ],
            });

            $('#dataTableCourses').each(function () {
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

        function EditCourseDialog(e) {
            $('#EditCourseDialog').modal('show');
        }

        function DeleteCourse(e) {

            if (loadingDeleteCourse)
                return;

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: "<?=trans('course.alert-message')?>",
                text: "<?=trans('course.are-you-sure-you-went-delete-that')?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'mr-2',
                confirmButtonText: "<?=trans('course.yes-delete-it')?>",
                cancelButtonText: "<?=trans('course.no-cancel')?>",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    loadingDeleteCourse = true;
                    const course = coursesDatatable.row($(e.target).parents('tr')).data();
                    $.post("<?= DOMAIN . '/courses/delete.php' ?>", course).done(function (response) {
                        response = jQuery.parseJSON(response);
                        coursesDatatable.ajax.reload();
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
                        loadingDeleteCourse = false;
                    });
                }
            })
        }

    </script>
    <?php
    create_course_script_init();
    edit_course_script_init();
    question_course_script_init();
    create_exam_script_init();
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
                    <h6 class="card-title"><?= trans('course.list-courses') ?></h6>
                    <p class="card-description"></p>
                    <div class="row align-items-center mb-2">
                        <div class="col-12 text-right">
                            <button class="btn btn-dark  btn-icon-text" data-toggle="modal" data-backdrop="static"
                                    data-target="#CreateCourseDialog">
                                <svg fill="white" class="btn-icon-prepend" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 448 512">
                                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM224 368C237.3 368 248 357.3 248 344V280H312C325.3 280 336 269.3 336 256C336 242.7 325.3 232 312 232H248V168C248 154.7 237.3 144 224 144C210.7 144 200 154.7 200 168V232H136C122.7 232 112 242.7 112 256C112 269.3 122.7 280 136 280H200V344C200 357.3 210.7 368 224 368z"/>
                                </svg>
                                <?= trans('course.create') ?>
                            </button>
                        </div>
                    </div>

                    <?php include_once 'create_course.php' ?>
                    <?php include_once 'edit_course.php' ?>
                    <?php include_once 'question_course.php' ?>
                    <?php include_once 'create_exam.php' ?>

                    <div class="table-responsive">
                        <table id="dataTableCourses" class="table w-100">
                            <thead>
                            <tr>
                                <th><?= trans('course.id') ?></th>
                                <th><?= trans('course.name') ?></th>
                                <th><?= trans('course.number-question') ?></th>
                                <th><?= trans('course.last-started-exam') ?></th>
                                <th data-priority="1"><?= trans('course.actions') ?></th>
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