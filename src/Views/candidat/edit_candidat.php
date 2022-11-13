<div class="modal fade" id="EditCandidatDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('candidat.update-candidat-dialog') ?></h5>
                <button type="button" class="close" onclick="closeUpdateCandidat()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="EditCandidatLoader" class="d-flex align-items-center">
                    <strong><?= trans('candidat.wait-data-candidat-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <div id="UpdateCandidatLoader" class="d-flex align-items-center">
                    <strong><?= trans('candidat.wait-candidat-upadting') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="UpdateCandidatForm">
                    <input type="hidden" id="edit-candidat-id" name="id">
                    <div class="form-group">
                        <label for="edit-candidat-first-name"><?= trans('candidat.first-name') ?></label>
                        <input type="text" class="form-control" id="edit-candidat-first-name" name="PRENOM"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="edit-candidat-last-name"><?= trans('candidat.last-name') ?></label>
                        <input type="text" class="form-control" id="edit-candidat-last-name" name="NOM"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="edit-candidat-email"><?= trans('candidat.email') ?></label>
                        <input type="text" class="form-control" id="edit-candidat-email" name="EMAIL"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="edit-candidat-class"><?= trans('candidat.class') ?></label>
                        <select id="edit-candidat-class" class="form-control p-0 m-5" name="ID_CLASSE"></select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2"
                        onclick="closeUpdateCandidat()"><?= trans('candidat.close') ?></button>
                <button class="btn btn-dark"
                        onclick="UpdateCandidat()"><?= trans('candidat.update-candidat') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function edit_candidat_script_init()
{
    ?>
    <script>
        var loadingEditCandidat = false;
        var candidatEdit = null;
        $('#EditCandidatDialog').on('show.bs.modal', function (event) {
            loadingEditCandidat = true;
            var button = $(event.relatedTarget)
            const id = candidatesDatatable.row(button.parents('tr')).data().id;
            $('#EditCandidatLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateCandidatLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateCandidatForm').addClass('d-none').removeClass('d-block');
            $.post("<?= DOMAIN . '/candidates/edit.php' ?>", {id})
                .done(function (response) {
                    $("#UpdateCandidatForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    candidatEdit = response.candidat;
                    $("#edit-candidat-class").select2({
                        data: response.classes,
                        width: '100%'
                    });

                    $('#EditCandidatDialog').find('#edit-candidat-first-name').val(response.candidat.PRENOM);
                    $('#EditCandidatDialog').find('#edit-candidat-last-name').val(response.candidat.NOM);
                    $('#EditCandidatDialog').find('#edit-candidat-email').val(response.candidat.EMAIL);
                    $('#EditCandidatDialog').find('#edit-candidat-id').val(response.candidat_classe.id);
                    $('#EditCandidatDialog').find('#edit-candidat-class').val(response.candidat_classe.ID_CLASSE).trigger('change');
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
                    loadingEditCandidat = false;
                    $('#EditCandidatLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateCandidatLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateCandidatForm').removeClass('d-none').addClass('d-block');

                });
        })

        function UpdateCandidat() {
            $('#EditCandidatLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateCandidatLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateCandidatForm').addClass('d-none').removeClass('d-block');
            loadingEditCandidat = true;
            $.post("<?= DOMAIN . '/candidates/update.php' ?>", $("#UpdateCandidatForm").serialize())
                .done(function (response) {
                    $("#UpdateCandidatForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    candidatesDatatable.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })

                    $('#EditCandidatDialog').modal('hide');

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
                loadingEditCandidat = false;
                $('#EditCandidatLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateCandidatLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateCandidatForm').removeClass('d-none').addClass('d-block');

            });
        }

        function closeUpdateCandidat() {
            if (!loadingEditCandidat)
                $('#EditCandidatDialog').modal('hide');
        }
    </script>
    <?php
}