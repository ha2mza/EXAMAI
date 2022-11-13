<?php
$title = 'ExamAI - Candidats';
require_once ROOT . '/src/Views/layouts/home.php';

function render_actions()
{
    ?>
    <div class="btn-group">
        <button type="button" class="btn btn-dark btn-icon-text" data-backdrop="static" data-toggle="modal"
                data-target="#EditCandidatDialog">
            <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend" fill="white" viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M480.1 160.1L316.3 325.7L186.3 195.7L302.1 80L288.1 66.91C279.6 57.54 264.4 57.54 255 66.91L168.1 152.1C159.6 162.3 144.4 162.3 135 152.1C125.7 143.6 125.7 128.4 135 119L221.1 32.97C249.2 4.853 294.8 4.853 322.9 32.97L336 46.06L351 31.03C386.9-4.849 445.1-4.849 480.1 31.03C516.9 66.91 516.9 125.1 480.1 160.1V160.1zM229.5 412.5C181.5 460.5 120.3 493.2 53.7 506.5L28.71 511.5C20.84 513.1 12.7 510.6 7.03 504.1C1.356 499.3-1.107 491.2 .4662 483.3L5.465 458.3C18.78 391.7 51.52 330.5 99.54 282.5L163.7 218.3L293.7 348.3L229.5 412.5z"/>
            </svg>
            <?= trans('candidat.edit') ?>
        </button>
        <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <span class="sr-only"></span>
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item btn-icon-text" onclick="DeleteCandidat(event)">
                <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/>
                </svg>
                <?= trans('candidat.delete') ?>
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
        var loadingDeleteCandidat = false;
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });

        var candidatesDatatable = null;
        $(function () {
            'use strict';
            candidatesDatatable = $('#dataTableCandidats').DataTable({
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
                    url: '<?=DOMAIN?>/candidates/index.php',
                    type: 'POST',
                    data: function (data) {
                        // Read values
                        var candidatFirstName = $('#filter-candidat-first-name').val();
                        var candidatLastName = $('#filter-candidat-last-name').val();
                        var candidatEmail = $('#filter-candidat-email').val();
                        var candidatClass = $('#filter-candidat-class').val();


                        // Append to data
                        data.filterByFirstName = candidatFirstName;
                        data.filterByLastName = candidatLastName;
                        data.filterByEmail = candidatEmail;
                        data.filterByClass = candidatClass;
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'ID_CANDIDAT', visible: false},
                    {data: 'ID_CLASSE', visible: false},
                    {data: 'NOM'},
                    {data: 'PRENOM'},
                    {data: 'EMAIL'},
                    {data: 'NOM_CLASSE'},
                    {data: 'ANNEE'},
                    {
                        data: null,
                        defaultContent: `<?= render_actions() ?>`
                    }
                ],
                columnDefs: [
                    {visible: false, targets: [1], searchable: false}
                ]
            });

            $('#dataTableCandidats').each(function () {
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

        function EditCandidatDialog(e) {
            $('#EditCandidatDialog').modal('show');
        }

        function DeleteCandidat(e) {

            if (loadingDeleteCandidat)
                return;

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: "<?=trans('candidat.alert-message')?>",
                text: "<?=trans('candidat.are-you-sure-you-went-delete-that')?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'mr-2',
                confirmButtonText: "<?=trans('candidat.yes-delete-it')?>",
                cancelButtonText: "<?=trans('candidat.no-cancel')?>",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    loadingDeleteCandidat = true;
                    const candidat = candidatesDatatable.row($(e.target).parents('tr')).data();
                    $.post("<?= DOMAIN . '/candidates/delete.php' ?>", candidat).done(function (response) {
                        response = jQuery.parseJSON(response);
                        candidatesDatatable.ajax.reload();
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
                        loadingDeleteCandidat = false;
                    });
                }
            })
        }

    </script>
    <?php
    create_candidat_script_init();
    edit_candidat_script_init();
    filter_candidat_script_init();
    import_candidat_script_init();
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
                    <h6 class="card-title"><?= trans('candidat.list-candidates') ?></h6>
                    <p class="card-description"></p>
                    <div class="row align-items-center mb-2">
                        <div class="col-12 text-right">

                            <div class="btn-group">
                                <button type="button" class="btn btn-dark btn-icon-text" data-toggle="modal"
                                        data-backdrop="static"
                                        data-target="#CreateCandidatDialog">
                                    <svg fill="white" class="btn-icon-prepend" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 448 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM224 368C237.3 368 248 357.3 248 344V280H312C325.3 280 336 269.3 336 256C336 242.7 325.3 232 312 232H248V168C248 154.7 237.3 144 224 144C210.7 144 200 154.7 200 168V232H136C122.7 232 112 242.7 112 256C112 269.3 122.7 280 136 280H200V344C200 357.3 210.7 368 224 368z"/>
                                    </svg>
                                    <?= trans('candidat.create') ?>
                                </button>
                                <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only"></span>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item btn-icon-text" data-toggle="modal"
                                            data-backdrop="static"
                                            data-target="#FilterCandidatDialog">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1"
                                             viewBox="0 0 512 512">
                                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/>
                                        </svg>

                                        <?= trans('candidat.filter') ?>
                                    </button>
                                    <button class="dropdown-item btn-icon-text" data-toggle="modal" data-backdrop="static" data-target="#ImportCandidatDialog">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend mr-1"
                                             viewBox="0 0 448 512">
                                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path d="M424 320C437.3 320 448 330.7 448 344V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V344C0 330.7 10.74 320 24 320C37.25 320 48 330.7 48 344V416C48 442.4 69.6 464 96 464H352C378.4 464 400 442.4 400 416V344C400 330.7 410.7 320 424 320zM224.5 0C231.4 0 237.9 2.938 242.4 8.062L375.5 160.5C381.1 166.7 383.1 174.7 383.1 182.7C383.1 187.4 383 192.2 381 196.6C375.7 208.4 364 216 351.3 216H295.1V336C295.1 358.1 278 376 255.1 376H191.1C169.9 376 151.1 358.1 151.1 336V216H96.67C83.92 216 72.27 208.4 66.95 196.6C61.55 184.5 63.67 170.3 72.42 160.5L206.6 8.062C211.1 2.937 217.6 0 224.5 0V0zM224.5 60.16L129.1 168H199.1V328H247.1V168H318L224.5 60.16z"/>
                                        </svg>
                                        <?= trans('candidat.import') ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include_once 'create_candidat.php' ?>
                    <?php include_once 'edit_candidat.php' ?>
                    <?php include_once 'filter_candidat.php' ?>
                    <?php include_once 'import_candidat.php' ?>

                    <div class="table-responsive">
                        <table id="dataTableCandidats" class="table w-100">
                            <thead>
                            <tr>
                                <th><?= trans('candidat.id') ?></th>
                                <th><?= trans('candidat.id-candidat') ?></th>
                                <th><?= trans('candidat.id-classe') ?></th>
                                <th><?= trans('candidat.first-name') ?></th>
                                <th><?= trans('candidat.last-name') ?></th>
                                <th><?= trans('candidat.email') ?></th>
                                <th><?= trans('candidat.class-name') ?></th>
                                <th><?= trans('candidat.year') ?></th>
                                <th data-priority="1"><?= trans('candidat.actions') ?></th>
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