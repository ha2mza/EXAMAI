<div class="modal fade" id="CreateClasseDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('classe.create-classe-dialog') ?></h5>
                <button type="button" class="close" onclick="closeCreateClasse()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="CreateClasseLoader" class="d-flex align-items-center">
                    <strong><?= trans('classe.wait-classe-creating') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="CreateClasseForm">
                    <div class="form-group">
                        <label for="create-classe-name"><?= trans('classe.name') ?></label>
                        <input type="text" class="form-control" id="create-classe-name" name="NOM_CLASSE" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="create-classe-year"><?= trans('classe.year') ?></label>
                        <input type="text" class="form-control" id="create-classe-year" name="ANNEE" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="create-classe-code"><?= trans('classe.code') ?></label>
                        <input type="text" class="form-control" id="create-classe-code" name="CODE" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2" onclick="closeCreateClasse()"><?= trans('classe.close') ?></button>
                <button class="btn btn-dark" onclick="createClasse()"><?= trans('classe.create-classe') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function create_classe_script_init()
{
    ?>
    <script>
        var loadingCreateClasse = false;
        $('#CreateClasseDialog').on('show.bs.modal', function () {
            $('#CreateClasseLoader').removeClass('d-flex').addClass('d-none');
            $('#CreateClasseForm').addClass('d-block').removeClass('d-none');
        });

        function closeCreateClasse() {
            if (!loadingCreateClasse)
                $('#CreateClasseDialog').modal('hide');
        }

        function createClasse() {
            loadingCreateClasse = true;
            $('#CreateClasseLoader').addClass('d-flex').removeClass('d-none');
            $('#CreateClasseForm').removeClass('d-block').addClass('d-none');
            $.post("<?= DOMAIN . '/classes/store.php' ?>", $("#CreateClasseForm").serialize()).done(function (response) {
                $("#CreateClasseForm").trigger("reset");
                response = jQuery.parseJSON(response);
                classesDatatable.ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                })

                $('#CreateClasseDialog').modal('hide');

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
                loadingCreateClasse = false;
                $('#CreateClasseLoader').removeClass('d-flex').addClass('d-none');
                $('#CreateClasseForm').addClass('d-block').removeClass('d-none');

            });
        }
    </script>
    <?php
}