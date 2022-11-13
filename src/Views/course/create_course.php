<div class="modal fade" id="CreateCourseDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('course.create-course-dialog') ?></h5>
                <button type="button" class="close" onclick="closeCreateCourse()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="CreateCourseLoader" class="d-flex align-items-center">
                    <strong><?= trans('course.wait-course-creating') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="CreateCourseForm">
                    <div class="form-group">
                        <label for="create-course-name"><?= trans('course.name') ?></label>
                        <input type="text" class="form-control" id="create-course-name" name="NOM_COUR" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2" onclick="closeCreateCourse()"><?= trans('course.close') ?></button>
                <button class="btn btn-dark" onclick="createCourse()"><?= trans('course.create-course') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function create_course_script_init()
{
    ?>
    <script>
        var loadingCreateCourse = false;
        $('#CreateCourseDialog').on('show.bs.modal', function () {
            $('#CreateCourseLoader').removeClass('d-flex').addClass('d-none');
            $('#CreateCourseForm').addClass('d-block').removeClass('d-none');
        });

        function closeCreateCourse() {
            if (!loadingCreateCourse)
                $('#CreateCourseDialog').modal('hide');
        }

        function createCourse() {
            loadingCreateCourse = true;
            $('#CreateCourseLoader').addClass('d-flex').removeClass('d-none');
            $('#CreateCourseForm').removeClass('d-block').addClass('d-none');
            $.post("<?= DOMAIN . '/courses/store.php' ?>", $("#CreateCourseForm").serialize()).done(function (response) {
                $("#CreateCourseForm").trigger("reset");
                response = jQuery.parseJSON(response);
                coursesDatatable.ajax.reload();
                Toast.fire({
                    icon: 'success',
                    title: response.message
                })

                $('#CreateCourseDialog').modal('hide');

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
                loadingCreateCourse = false;
                $('#CreateCourseLoader').removeClass('d-flex').addClass('d-none');
                $('#CreateCourseForm').addClass('d-block').removeClass('d-none');

            });
        }
    </script>
    <?php
}