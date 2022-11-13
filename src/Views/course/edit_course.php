<div class="modal fade" id="EditCourseDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('course.update-course-dialog') ?></h5>
                <button type="button" class="close" onclick="closeUpdateCourse()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="EditCourseLoader" class="d-flex align-items-center">
                    <strong><?= trans('course.wait-data-course-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <div id="UpdateCourseLoader" class="d-flex align-items-center">
                    <strong><?= trans('course.wait-course-upadting') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="UpdateCourseForm">
                    <input type="hidden" id="edit-course-id" name="ID_COUR">
                    <div class="form-group">
                        <label for="edit-course-name"><?= trans('course.name') ?></label>
                        <input type="text" class="form-control" id="edit-course-name" name="NOM_COUR"
                               autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2" onclick="closeUpdateCourse()"><?= trans('course.close') ?></button>
                <button class="btn btn-dark" onclick="UpdateCourse()"><?= trans('course.update-course') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function edit_course_script_init()
{
    ?>
    <script>
        var loadingEditCourse = false;
        var courseEdit = null;
        $('#EditCourseDialog').on('show.bs.modal', function (event) {
            loadingEditCourse = true;
            var button = $(event.relatedTarget)
            const ID_COUR = coursesDatatable.row(button.parents('tr')).data().ID_COUR;
            $('#EditCourseLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateCourseLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateCourseForm').addClass('d-none').removeClass('d-block');
            $.post("<?= DOMAIN . '/courses/edit.php' ?>", {ID_COUR})
                .done(function (response) {
                    $("#CreateCourseForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    courseEdit = response.course;
                    $('#EditCourseDialog').find('#edit-course-name').val(response.course.NOM_COUR);
                    $('#EditCourseDialog').find('#edit-course-id').val(response.course.ID_COUR);
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
                    loadingEditCourse = false;
                    $('#EditCourseLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateCourseLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateCourseForm').removeClass('d-none').addClass('d-block');

                });
        })

        function UpdateCourse() {
            $('#EditCourseLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateCourseLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateCourseForm').addClass('d-none').removeClass('d-block');
            loadingEditCourse = true;
            $.post("<?= DOMAIN . '/courses/update.php' ?>", $("#UpdateCourseForm").serialize())
                .done(function (response) {
                    $("#UpdateCourseForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    coursesDatatable.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })

                    $('#EditCourseDialog').modal('hide');

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
                loadingEditCourse = false;
                $('#EditCourseLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateCourseLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateCourseForm').removeClass('d-none').addClass('d-block');

            });
        }

        function closeUpdateCourse() {
            if (!loadingEditCourse)
                $('#EditCourseDialog').modal('hide');
        }
    </script>
    <?php
}