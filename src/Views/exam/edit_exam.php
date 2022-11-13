<div class="modal fade" id="EditExamDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('exam.update-exam-dialog') ?></h5>
                <button type="button" class="close" onclick="closeUpdateExam()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="EditExamLoader" class="d-flex align-items-center">
                    <strong><?= trans('exam.wait-data-exam-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <div id="UpdateExamLoader" class="d-flex align-items-center">
                    <strong><?= trans('exam.wait-exam-upadting') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="UpdateExamForm">
                    <input type="hidden" id="edit-exam-id" name="ID_EXAMEN">
                    <div class="form-group">
                        <label for="edit-exam-type"><?= trans('exam.type') ?></label>
                        <select id="edit-exam-type" class="form-control p-0" name="type">
                            <option value="normal"><?= trans('exam.normal') ?></option>
                            <option value="catch-up"><?= trans('exam.catch-up') ?></option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="edit-exam-duration" class="col-sm-3 col-form-label">
                            <?= trans('exam.dureation-min') ?>:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="duration" id="edit-exam-duration"
                                   value="90"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="edit-exam-start-in"
                               class="col-sm-3 col-form-label"><?= trans('exam.start-in') ?>: </label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control" name="start-in"
                                   id="edit-exam-start-in"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit-exam-status"><?= trans('exam.status') ?></label>
                        <div class="row">
                            <div class="col-6">
                                <input type="radio" name="status" id="edit-exam-opened" value="opened" checked
                                       class="d-none">
                                <label for="edit-exam-opened"
                                       class="btn btn-light w-100"><?= trans('exam.opened') ?></label>
                            </div>
                            <div class="col-6">
                                <input type="radio" name="status" id="edit-exam-closed" value="closed"
                                       class="d-none">
                                <label for="edit-exam-closed"
                                       class="btn btn-light w-100"><?= trans('exam.closing') ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between ">
                            <label>
                                <?= trans('exam.strict-date') ?>:
                            </label>

                            <label class="form-switch">
                                <input type="checkbox" name="strict-date" id="edit-exam-strict-date">
                                <i></i>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <fieldset>
                            <legend><?= trans('exam.change-order') ?></legend>
                            <div class="row mx-0 no-gutters">
                                <div class="col-6">
                                    <div class="d-flex align-items-center justify-content-around  pr-2">
                                        <label>
                                            <?= trans('exam.questions') ?>:
                                        </label>

                                        <label class="form-switch">
                                            <input type="checkbox" name="order-question"
                                                   id="edit-exam-order-questions">
                                            <i></i>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="d-flex align-items-center justify-content-around ">
                                        <label>
                                            <?= trans('exam.choices') ?>:
                                        </label>

                                        <label class="form-switch">
                                            <input type="checkbox" name="order-choice"
                                                   id="edit-exam-order-choices">
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="form-group">
                        <label for="edit-exam-number-version"><?= trans('exam.number-version') ?></label>
                        <input type="text" class="form-control" name="number-version"
                               id="edit-exam-number-version" value="1"/>
                    </div>


                    <div class="form-group">
                        <label for="edit-exam-nature"><?= trans('exam.nature') ?></label>
                        <div class="row">
                            <div class="col-6">
                                <input type="radio" name="nature" id="edit-exam-online" value="online" checked
                                       class="d-none">
                                <label for="edit-exam-online"
                                       class="btn btn-light w-100"><?= trans('exam.online') ?></label>
                            </div>
                            <div class="col-6">
                                <input type="radio" name="nature" id="edit-exam-offline" value="offline"
                                       class="d-none">
                                <label for="edit-exam-offline"
                                       class="btn btn-light w-100"><?= trans('exam.offline') ?></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2" onclick="closeUpdateExam()"><?= trans('exam.close') ?></button>
                <button class="btn btn-dark" onclick="UpdateExam()"><?= trans('exam.update-exam') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function edit_exam_script_init()
{
    ?>
    <script>
        var loadingEditExam = false;
        var examEdit = null;
        $('#EditExamDialog').on('show.bs.modal', function (event) {
            loadingEditExam = true;
            var button = $(event.relatedTarget)

            $("#edit-exam-type").select2({
                width: '100%'
            });
            const ID_EXAMEN = examsDatatable.row(button.parents('tr')).data().ID_EXAMEN;
            $('#EditExamLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateExamLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateExamForm').addClass('d-none').removeClass('d-block');
            $.post("<?= DOMAIN . '/exams/edit.php' ?>", {ID_EXAMEN})
                .done(function (response) {
                    $("#CreateExamForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    examEdit = response.exam;
                    $('#EditExamDialog').find('#edit-exam-status').val(response.exam.STATUT);
                    $('#EditExamDialog').find('#edit-exam-start-in').val(response.exam.COMMENCE_A.replace(' ' , 'T'));
                    $('#EditExamDialog').find('#edit-exam-strict-date').attr('checked', response.exam.DATE_STRICTE === 1);
                    $('#EditExamDialog').find('#edit-exam-order-questions').attr('checked', response.exam.ORDRE_QUESTION === 1);
                    $('#EditExamDialog').find('#edit-exam-order-choices').attr('checked', response.exam.ORDRE_CHOIX === 1);
                    $('#EditExamDialog').find('#edit-exam-duration').val(response.exam.DUREE);
                    $('#EditExamDialog').find('#edit-exam-number-version').val(response.exam.NB_DE_VERSION);
                    switch (response.exam.NATURE?.toLowerCase()) {
                        case 'online':
                            $('#EditExamDialog').find('#edit-exam-online').attr('checked', true);
                            break;
                        case 'offline':
                            $('#EditExamDialog').find('#edit-exam-offline').attr('checked', true);
                            break;
                    }

                    switch (response.exam.STATUT?.toLowerCase()) {
                        case 'opened':
                            $('#EditExamDialog').find('#edit-exam-opened').attr('checked', true);
                            break;
                        case 'closed':
                            $('#EditExamDialog').find('#edit-exam-closed').attr('checked', true);
                            break;
                    }
                    $('#EditExamDialog').find('#edit-exam-type').val(response.exam.TYPE).trigger('change');
                    $('#EditExamDialog').find('#edit-exam-id').val(response.exam.ID_EXAMEN);
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
                    loadingEditExam = false;
                    $('#EditExamLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateExamLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateExamForm').removeClass('d-none').addClass('d-block');

                });
        })

        function UpdateExam() {
            $('#EditExamLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateExamLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateExamForm').addClass('d-none').removeClass('d-block');
            loadingEditExam = true;
            $.post("<?= DOMAIN . '/exams/update.php' ?>", $("#UpdateExamForm").serialize())
                .done(function (response) {
                    $("#UpdateExamForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    examsDatatable.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })

                    $('#EditExamDialog').modal('hide');

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
                loadingEditExam = false;
                $('#EditExamLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateExamLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateExamForm').removeClass('d-none').addClass('d-block');

            });
        }

        function closeUpdateExam() {
            if (!loadingEditExam)
                $('#EditExamDialog').modal('hide');
        }
    </script>
    <?php
}