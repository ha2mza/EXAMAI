<div class="modal fade" id="FilterCandidatDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('candidat.filter-candidat-dialog') ?></h5>
                <button type="button" class="close" onclick="closeFilterCandidat()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="FilterCandidatLoader" class="d-flex align-items-center">
                    <strong><?= trans('candidat.wait-data-candidat-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="FilterCandidatForm">
                    <div class="form-group">
                        <label for="filter-candidat-first-name"><?= trans('candidat.first-name') ?></label>
                        <input type="text" class="form-control" id="filter-candidat-first-name" name="PRENOM"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="filter-candidat-last-name"><?= trans('candidat.last-name') ?></label>
                        <input type="text" class="form-control" id="filter-candidat-last-name" name="NOM"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="filter-candidat-email"><?= trans('candidat.email') ?></label>
                        <input type="text" class="form-control" id="filter-candidat-email" name="EMAIL"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="filter-candidat-class"><?= trans('candidat.class') ?></label>
                        <select id="filter-candidat-class" class="w-100" name="ID_CLASSE[]"
                                multiple="multiple"></select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2"
                        onclick="closeFilterCandidat()"><?= trans('candidat.close') ?></button>
                <button class="btn btn-light mr-2"
                        onclick="resetFilterCandidat()"><?= trans('candidat.reset') ?></button>
                <button class="btn btn-dark"
                        onclick="filterCandidat()"><?= trans('candidat.filter-candidat') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function filter_candidat_script_init()
{
    ?>
    <script>
        var loadingFilterCandidat = false;
        $('#FilterCandidatDialog').on('show.bs.modal', function () {
            loadingFilterCandidat = true;
            $('#FilterCandidatLoader').removeClass('d-none').addClass('d-flex');
            $('#FilterCandidatForm').addClass('d-none').removeClass('d-block');
            $.post("<?= DOMAIN . '/candidates/create.php' ?>")
                .done(function (response) {
                    response = jQuery.parseJSON(response);
                    $("#filter-candidat-class").select2({
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
                    loadingFilterCandidat = false;
                    $('#FilterCandidatLoader').addClass('d-none').removeClass('d-flex');
                    $('#FilterCandidatForm').removeClass('d-none').addClass('d-block');

                });
        });

        function closeFilterCandidat() {
            if (!loadingFilterCandidat)
                $('#FilterCandidatDialog').modal('hide');
        }

        function resetFilterCandidat() {
            if (!loadingFilterCandidat) {
                $("#FilterCandidatForm").trigger("reset");
                candidatesDatatable.ajax.reload();
                $('#FilterCandidatDialog').modal('hide');
            }
        }

        function filterCandidat() {
            loadingFilterCandidat = true;
            candidatesDatatable.ajax.reload();
            $('#FilterCandidatDialog').modal('hide');
        }
    </script>
    <?php
}