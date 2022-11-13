<div class="modal fade" id="CreateExamDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('exam.create-exam-dialog') ?></h5>
                <button type="button" class="close" onclick="closeCreateExam()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="CreateExamLoader" class="d-flex align-items-center">
                    <strong><?= trans('exam.wait-exam-creating') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="CreateExamForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="create-exam-classes"><?= trans('exam.classes') ?></label>
                                <select id="create-exam-classes" class="form-control p-0"
                                        name="id_classes[]" multiple></select>
                            </div>

                            <div class="form-group">
                                <label for="create-exam-type"><?= trans('exam.type') ?></label>
                                <select id="create-exam-type" class="form-control p-0" name="type">
                                    <option value="normal"><?= trans('exam.normal') ?></option>
                                    <option value="catch-up"><?= trans('exam.catch-up') ?></option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="create-exam-duration" class="col-sm-3 col-form-label">
                                    <?= trans('exam.dureation-min') ?>:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="duration" id="create-exam-duration"
                                           value="90"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="create-exam-start-in"
                                       class="col-sm-3 col-form-label"><?= trans('exam.start-in') ?>: </label>
                                <div class="col-sm-9">
                                    <input type="datetime-local" class="form-control" name="start-in"
                                           id="create-exam-start-in"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="create-exam-cours"><?= trans('exam.cours') ?></label>
                                <select id="create-exam-cours" class="form-control p-0"
                                        name="cour_id"></select>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="create-exam-status"><?= trans('exam.status') ?></label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="radio" name="status" id="exam-opened" value="opened" checked
                                               class="d-none">
                                        <label for="exam-opened"
                                               class="btn btn-light w-100"><?= trans('exam.opened') ?></label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="status" id="exam-closed" value="closed"
                                               class="d-none">
                                        <label for="exam-closed"
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
                                        <input type="checkbox" name="strict-date" checked>
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
                                                    <input type="checkbox" name="order-question" >
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
                                                    <input type="checkbox" name="order-choice" >
                                                    <i></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="form-group">
                                <label for="create-exam-number-version"><?= trans('exam.number-version') ?></label>
                                <input type="text" class="form-control" name="number-version"
                                       id="create-exam-number-version" value="1"/>
                            </div>


                            <div class="form-group">
                                <label for="create-exam-nature"><?= trans('exam.nature') ?></label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="radio" name="nature" id="exam-online" value="online" checked
                                               class="d-none">
                                        <label for="exam-online"
                                               class="btn btn-light w-100"><?= trans('exam.online') ?></label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="nature" id="exam-offline" value="offline"
                                               class="d-none">
                                        <label for="exam-offline"
                                               class="btn btn-light w-100"><?= trans('exam.offline') ?></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light mr-2"
                        onclick="closeCreateExam()"><?= trans('exam.close') ?></button>
                <button type="button" class="btn btn-dark"
                        onclick="createExam()"><?= trans('exam.create-exam') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function create_exam_script_init()
{
    ?>
    <script>
        var loadingCreateExam = false;
        $('#CreateExamDialog').on('show.bs.modal', function () {
            loadingCreateExam = true;

            $("#create-exam-type").select2({
                width: '100%'
            });
            $('#CreateExamLoader').removeClass('d-none').addClass('d-flex');
            $('#CreateExamForm').addClass('d-none').removeClass('d-block');
            $.post("<?= DOMAIN . '/exams/create.php' ?>")
                .done(function (response) {
                    response = jQuery.parseJSON(response);
                    $("#create-exam-classes").select2({
                        data: response.classes,
                        width: '100%'
                    });
                    $("#create-exam-cours").select2({
                        data: response.courses,
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
                    loadingCreateExam = false;
                    $('#CreateExamLoader').removeClass('d-flex').addClass('d-none');
                    $('#CreateExamForm').addClass('d-block').removeClass('d-none');

                });
        });

        function closeCreateExam() {
            if (!loadingCreateExam)
                $('#CreateExamDialog').modal('hide');
        }

        function createExam() {
            loadingCreateExam = true;
            $('#CreateExamLoader').addClass('d-flex').removeClass('d-none');
            $('#CreateExamForm').removeClass('d-block').addClass('d-none');
            $.post("<?= DOMAIN . '/exams/store.php' ?>", $("#CreateExamForm").serialize()).done(function (response) {
                $("#CreateExamForm").trigger("reset");
                response = jQuery.parseJSON(response);
                examsDatatable.ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                })

                $('#CreateExamDialog').modal('hide');

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
                loadingCreateExam = false;
                $('#CreateExamLoader').removeClass('d-flex').addClass('d-none');
                $('#CreateExamForm').addClass('d-block').removeClass('d-none');

            });
        }
    </script>
    <?php
}
