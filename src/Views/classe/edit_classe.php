<div class="modal fade" id="EditClasseDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('classe.update-classe-dialog') ?></h5>
                <button type="button" class="close" onclick="closeUpdateClasse()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="EditClasseLoader" class="d-flex align-items-center">
                    <strong><?= trans('classe.wait-data-classe-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <div id="UpdateClasseLoader" class="d-flex align-items-center">
                    <strong><?= trans('classe.wait-classe-upadting') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="UpdateClasseForm">
                    <input type="hidden" id="edit-classe-id" name="ID_CLASSE">
                    <div class="form-group">
                        <label for="edit-classe-name"><?= trans('classe.name') ?></label>
                        <input type="text" class="form-control" id="edit-classe-name" name="NOM_CLASSE"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="edit-classe-year"><?= trans('classe.year') ?></label>
                        <input type="text" class="form-control" id="edit-classe-year" name="ANNEE" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="edit-classe-code"><?= trans('classe.code') ?></label>
                        <input type="text" class="form-control" id="edit-classe-code" name="CODE" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2" onclick="closeUpdateClasse()"><?= trans('classe.close') ?></button>
                <button class="btn btn-dark" onclick="UpdateClasse()"><?= trans('classe.update-classe') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function edit_classe_script_init()
{
    ?>
    <script>
        var loadingEditClasse = false;
        var classeEdit = null;
        $('#EditClasseDialog').on('show.bs.modal', function (event) {
            loadingEditClasse = true;
            var button = $(event.relatedTarget)
            const ID_CLASSE = classesDatatable.row(button.parents('tr')).data().ID_CLASSE;
            $('#EditClasseLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateClasseLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateClasseForm').addClass('d-none').removeClass('d-block');
            $.post("<?= DOMAIN . '/classes/edit.php' ?>", {ID_CLASSE})
                .done(function (response) {
                    $("#CreateClasseForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    classeEdit = response.classe;
                    $('#EditClasseDialog').find('#edit-classe-name').val(response.classe.NOM_CLASSE);
                    $('#EditClasseDialog').find('#edit-classe-year').val(response.classe.ANNEE);
                    $('#EditClasseDialog').find('#edit-classe-code').val(response.classe.CODE);
                    $('#EditClasseDialog').find('#edit-classe-id').val(response.classe.ID_CLASSE);
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
                    loadingEditClasse = false;
                    $('#EditClasseLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateClasseLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateClasseForm').removeClass('d-none').addClass('d-block');

                });
        })

        function UpdateClasse() {
            $('#EditClasseLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateClasseLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateClasseForm').addClass('d-none').removeClass('d-block');
            loadingEditClasse = true;
            $.post("<?= DOMAIN . '/classes/update.php' ?>", $("#UpdateClasseForm").serialize())
                .done(function (response) {
                    $("#UpdateClasseForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    classesDatatable.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })

                    $('#EditClasseDialog').modal('hide');

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
                loadingEditClasse = false;
                $('#EditClasseLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateClasseLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateClasseForm').removeClass('d-none').addClass('d-block');

            });
        }

        function closeUpdateClasse() {
            if (!loadingEditClasse)
                $('#EditClasseDialog').modal('hide');
        }
    </script>
    <?php
}