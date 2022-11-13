<div class="modal fade" id="CreateCandidatDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('candidat.create-candidat-dialog') ?></h5>
                <button type="button" class="close" onclick="closeCreateCandidat()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="CreateCandidatLoader" class="d-flex align-items-center">
                    <strong><?= trans('candidat.wait-data-candidat-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <div id="StoreCandidatLoader" class="d-flex align-items-center">
                    <strong><?= trans('candidat.wait-candidat-creating') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="CreateCandidatForm">
                    <div class="form-group">
                        <label for="create-candidat-first-name"><?= trans('candidat.first-name') ?></label>
                        <input type="text" class="form-control" id="create-candidat-first-name" name="PRENOM"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="create-candidat-last-name"><?= trans('candidat.last-name') ?></label>
                        <input type="text" class="form-control" id="create-candidat-last-name" name="NOM"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="create-candidat-email"><?= trans('candidat.email') ?></label>
                        <input type="text" class="form-control" id="create-candidat-email" name="EMAIL"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="create-candidat-class"><?= trans('candidat.class') ?></label>
                        <select id="create-candidat-class" class="w-100" name="ID_CLASSE[]" multiple="multiple"></select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2"
                        onclick="closeCreateCandidat()"><?= trans('candidat.close') ?></button>
                <button class="btn btn-dark"
                        onclick="createCandidat()"><?= trans('candidat.create-candidat') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function create_candidat_script_init()
{
    ?>
    <script>
        var loadingCreateCandidat = false;
        $('#CreateCandidatDialog').on('show.bs.modal', function () {
            loadingCreateCandidat = true;
            $('#CreateCandidatLoader').removeClass('d-none').addClass('d-flex');
            $('#StoreCandidatLoader').addClass('d-none').removeClass('d-flex');
            $('#CreateCandidatForm').addClass('d-none').removeClass('d-block');
            $.post("<?= DOMAIN . '/candidates/create.php' ?>")
                .done(function (response) {
                    $("#CreateCandidatForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    $("#create-candidat-class").select2({
                        data: response.classes,
                        width: '100%'
                    });
                })
                .fail(function (event) {
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
                    loadingCreateCandidat = false;
                    $('#CreateCandidatLoader').addClass('d-none').removeClass('d-flex');
                    $('#StoreCandidatLoader').addClass('d-none').removeClass('d-flex');
                    $('#CreateCandidatForm').removeClass('d-none').addClass('d-block');

                });
        });

        function closeCreateCandidat() {
            if (!loadingCreateCandidat)
                $('#CreateCandidatDialog').modal('hide');
        }

        function createCandidat() {
            loadingCreateCandidat = true;
            $('#CreateCandidatLoader').addClass('d-flex').removeClass('d-none');
            $('#CreateCandidatForm').removeClass('d-block').addClass('d-none');
            $.post("<?= DOMAIN . '/candidates/store.php' ?>", $("#CreateCandidatForm").serialize()).done(function (response) {
                $("#CreateCandidatForm").trigger("reset");
                response = jQuery.parseJSON(response);
                candidatesDatatable.ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                })

                $('#CreateCandidatDialog').modal('hide');

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
                loadingCreateCandidat = false;
                $('#CreateCandidatLoader').addClass('d-none').removeClass('d-flex');
                $('#StoreCandidatLoader').addClass('d-none').removeClass('d-flex');
                $('#CreateCandidatForm').removeClass('d-none').addClass('d-block');
            });
        }
    </script>
    <?php
}