<div class="modal fade" id="ImportCandidatDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('candidat.import-candidat-dialog') ?></h5>
                <button type="button" class="close" onclick="closeImportCandidat()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="ImportCandidatLoader" class="d-flex align-items-center">
                    <strong><?= trans('candidat.wait-data-candidat-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="ImportCandidatForm">
                    <input type="file" class="d-none" accept=".csv" id="import-candidat-file" name="file"
                           onchange="FileLoaded(this)">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="import-candidat-file-name"><?= trans('candidat.file-name') ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="import-candidat-file-name" name="filename"
                                       autocomplete="off">

                                <button type="button" class="bt btn-dark btn-icon input-group-addon"
                                        onclick="uploadDialogFile()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" class="btn-icon-prepend"
                                         viewBox="0 0 448 512">
                                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M424 320C437.3 320 448 330.7 448 344V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V344C0 330.7 10.74 320 24 320C37.25 320 48 330.7 48 344V416C48 442.4 69.6 464 96 464H352C378.4 464 400 442.4 400 416V344C400 330.7 410.7 320 424 320zM224.5 0C231.4 0 237.9 2.938 242.4 8.062L375.5 160.5C381.1 166.7 383.1 174.7 383.1 182.7C383.1 187.4 383 192.2 381 196.6C375.7 208.4 364 216 351.3 216H295.1V336C295.1 358.1 278 376 255.1 376H191.1C169.9 376 151.1 358.1 151.1 336V216H96.67C83.92 216 72.27 208.4 66.95 196.6C61.55 184.5 63.67 170.3 72.42 160.5L206.6 8.062C211.1 2.937 217.6 0 224.5 0V0zM224.5 60.16L129.1 168H199.1V328H247.1V168H318L224.5 60.16z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-5">
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="table-candidates">
                            <thead>
                            <tr>
                                <th>
                                    <?= trans('candidat.first-name') ?>
                                </th>
                                <th>
                                    <?= trans('candidat.last-name') ?>
                                </th>
                                <th>
                                    <?= trans('candidat.email') ?>
                                </th>
                                <th>
                                    <?= trans('candidat.actions') ?>
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2"
                        onclick="closeImportCandidat()"><?= trans('candidat.close') ?></button>
                <button class="btn btn-light mr-2"
                        onclick="verifyImportCandidat()"><?= trans('candidat.verify') ?></button>
                <button class="btn btn-dark d-none" id="btn-import-candidat"
                        onclick="ImportCandidat()"><?= trans('candidat.import-candidat') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function import_candidat_script_init()
{
    ?>
    <script>
        var loadingImportCandidat = false;
        let ID_CLASSE = null;
        $('#ImportCandidatDialog').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            const id = classesDatatable.row(button.parents('tr')).data().ID_CLASSE;
            ID_CLASSE = id;
            loadingImportCandidat = false;
            $('#ImportCandidatLoader').addClass('d-none').removeClass('d-flex');
            $('#ImportCandidatForm').removeClass('d-none').addClass('d-block');
        });

        function closeImportCandidat() {
            if (!loadingImportCandidat)
                $('#ImportCandidatDialog').modal('hide');
        }

        function verifyImportCandidat() {
            const data = new FormData();
            data.append('file', $('#import-candidat-file').get(0).files[0]);
            data.append('ID_CLASSE', ID_CLASSE);

            loadingImportCandidat = true;
            $('#ImportCandidatLoader').removeClass('d-none').addClass('d-flex');
            $('#ImportCandidatForm').addClass('d-none').removeClass('d-block');

            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: data,
                enctype: 'multipart/form-data',
                url: "<?= DOMAIN . '/candidates/verify_import.php' ?>",
            }).done(function (response) {
                response = jQuery.parseJSON(response);
                $('#table-candidates tbody').html('');

                for (let i = 0; i < response.candidates.length; i++) {
                    const candidat = response.candidates[i];
                    const result = response.results[i];
                    const tr = `<tr>
                                <td>
                                    ${candidat[0]}
                                    <span class="text-danger"> ${!result[0]['valide'] ? '(' + result[0]['message'] + ')' : ''}</span>
                                </td>
                                <td>
                                   ${candidat[1]}
                                    <span class="text-danger"> ${!result[1]['valide'] ? '(' + result[1]['message'] + ')' : ''}</span>
                                </td>
                                <td>
                                    ${candidat[2]}
                                    <span class="text-danger"> ${!result[2]['valide'] ? '(' + result[2]['message'] + ')' : ''}</span>
                                </td>
                                <td>
                                    <span class="text-warning"> ${!result[3]['valide'] ? '(' + result[3]['message'] + ')' : ''}</span>
                                </td>
                            </tr>`;
                    $('#table-candidates tbody').append(tr);

                }
                if (response.can_import)
                    $('#btn-import-candidat').removeClass('d-none');
                else {
                    $("#ImportCandidatForm").trigger("reset");
                    $('#btn-import-candidat').addClass('d-none');
                }

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
            })
                .always(function () {
                    loadingImportCandidat = false;
                    $('#ImportCandidatLoader').addClass('d-none').removeClass('d-flex');
                    $('#ImportCandidatForm').removeClass('d-none').addClass('d-block');
                });
        }


        function ImportCandidat() {
            const data = new FormData();
            data.append('file', $('#import-candidat-file').get(0).files[0]);
            data.append('ID_CLASSE', ID_CLASSE);

            loadingImportCandidat = true;
            $('#ImportCandidatLoader').removeClass('d-none').addClass('d-flex');
            $('#ImportCandidatForm').addClass('d-none').removeClass('d-block');

            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: data,
                enctype: 'multipart/form-data',
                url: "<?= DOMAIN . '/candidates/import.php' ?>",
            }).done(function (response) {
                response = jQuery.parseJSON(response);
                classesDatatable.ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                })
                $('#table-candidates tbody').html('');
                $("#ImportCandidatForm").trigger("reset");
                $('#btn-import-candidat').addClass('d-none');
                $('#ImportCandidatDialog').modal('hide');
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
            })
                .always(function () {
                    loadingImportCandidat = false;
                    $('#ImportCandidatLoader').addClass('d-none').removeClass('d-flex');
                    $('#ImportCandidatForm').removeClass('d-none').addClass('d-block');
                });
        }

        function uploadDialogFile() {
            $('#import-candidat-file').trigger('click');
        }

        function FileLoaded(e) {
            $('#import-candidat-file-name').val(e.files[0].name)
        }
    </script>
    <?php
}