<div class="modal fade" id="QuestionExamDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('exam.question-exam-dialog') ?></h5>
                <button type="button" class="close" onclick="closeUpdateQuestionExam()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-header d-none">
                <div class="form-group w-100 mb-0">
                    <div class="input-group">
                        <input class="form-control" type="text">
                        <span class="input-group-btn">
                              <button class="btn btn-outline-light btn-icon h-100 rounded-0 border-left-0"
                                      type="button">
                                 <svg class="btn-icon-prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 460 512">
                                     <path d="M220.6 130.3l-67.2 28.2V43.2L98.7 233.5l54.7-24.2v130.3l67.2-209.3zm-83.2-96.7l-1.3 4.7-15.2 52.9C80.6 106.7 52 145.8 52 191.5c0 52.3 34.3 95.9 83.4 105.5v53.6C57.5 340.1 0 272.4 0 191.6c0-80.5 59.8-147.2 137.4-158zm311.4 447.2c-11.2 11.2-23.1 12.3-28.6 10.5-5.4-1.8-27.1-19.9-60.4-44.4-33.3-24.6-33.6-35.7-43-56.7-9.4-20.9-30.4-42.6-57.5-52.4l-9.7-14.7c-24.7 16.9-53 26.9-81.3 28.7l2.1-6.6 15.9-49.5c46.5-11.9 80.9-54 80.9-104.2 0-54.5-38.4-102.1-96-107.1V32.3C254.4 37.4 320 106.8 320 191.6c0 33.6-11.2 64.7-29 90.4l14.6 9.6c9.8 27.1 31.5 48 52.4 57.4s32.2 9.7 56.8 43c24.6 33.2 42.7 54.9 44.5 60.3s.7 17.3-10.5 28.5zm-9.9-17.9c0-4.4-3.6-8-8-8s-8 3.6-8 8 3.6 8 8 8 8-3.6 8-8z"/></svg>
                              </button>
                            </span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div id="QuestionExamLoader" class="d-flex align-items-center">
                    <strong><?= trans('course.wait-data-course-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>

                <div id="ListQuestions" class="form-group">

                </div>

            </div>
            <div class="modal-footer">

                <a id="exportExamAsPdf" class="btn btn-dark btn-icon-text" style="flex:1">
                    <svg class="btn-icon-prepend" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M480 352h-133.5l-45.25 45.25C289.2 409.3 273.1 416 256 416s-33.16-6.656-45.25-18.75L165.5 352H32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h448c17.67 0 32-14.33 32-32v-96C512 366.3 497.7 352 480 352zM432 456c-13.2 0-24-10.8-24-24c0-13.2 10.8-24 24-24s24 10.8 24 24C456 445.2 445.2 456 432 456zM233.4 374.6C239.6 380.9 247.8 384 256 384s16.38-3.125 22.62-9.375l128-128c12.49-12.5 12.49-32.75 0-45.25c-12.5-12.5-32.76-12.5-45.25 0L288 274.8V32c0-17.67-14.33-32-32-32C238.3 0 224 14.33 224 32v242.8L150.6 201.4c-12.49-12.5-32.75-12.5-45.25 0c-12.49 12.5-12.49 32.75 0 45.25L233.4 374.6z"/>
                    </svg>
                    <?= trans('exam.export.pdf') ?>
                </a>


                <a id="exportExamAsWord" class="btn btn-dark btn-icon-text" style="flex:1">
                    <svg class="btn-icon-prepend" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M480 352h-133.5l-45.25 45.25C289.2 409.3 273.1 416 256 416s-33.16-6.656-45.25-18.75L165.5 352H32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h448c17.67 0 32-14.33 32-32v-96C512 366.3 497.7 352 480 352zM432 456c-13.2 0-24-10.8-24-24c0-13.2 10.8-24 24-24s24 10.8 24 24C456 445.2 445.2 456 432 456zM233.4 374.6C239.6 380.9 247.8 384 256 384s16.38-3.125 22.62-9.375l128-128c12.49-12.5 12.49-32.75 0-45.25c-12.5-12.5-32.76-12.5-45.25 0L288 274.8V32c0-17.67-14.33-32-32-32C238.3 0 224 14.33 224 32v242.8L150.6 201.4c-12.49-12.5-32.75-12.5-45.25 0c-12.49 12.5-12.49 32.75 0 45.25L233.4 374.6z"/>
                    </svg>
                    <?= trans('exam.export.word') ?>
                </a>


                <a id="exportExamAsHtml" class="btn btn-dark btn-icon-text" style="flex:1">
                    <svg class="btn-icon-prepend" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M480 352h-133.5l-45.25 45.25C289.2 409.3 273.1 416 256 416s-33.16-6.656-45.25-18.75L165.5 352H32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h448c17.67 0 32-14.33 32-32v-96C512 366.3 497.7 352 480 352zM432 456c-13.2 0-24-10.8-24-24c0-13.2 10.8-24 24-24s24 10.8 24 24C456 445.2 445.2 456 432 456zM233.4 374.6C239.6 380.9 247.8 384 256 384s16.38-3.125 22.62-9.375l128-128c12.49-12.5 12.49-32.75 0-45.25c-12.5-12.5-32.76-12.5-45.25 0L288 274.8V32c0-17.67-14.33-32-32-32C238.3 0 224 14.33 224 32v242.8L150.6 201.4c-12.49-12.5-32.75-12.5-45.25 0c-12.49 12.5-12.49 32.75 0 45.25L233.4 374.6z"/>
                    </svg>
                    <?= trans('exam.export.html') ?>
                </a>

            </div>
            <div class="modal-footer">
                <button class="btn btn-light mr-2"
                        onclick="closeUpdateQuestionExam()"><?= trans('exam.close') ?></button>
                <!--<button class="btn btn-dark"
                        onclick="UpdateQuestionExam()"><?= trans('exam.question-changes') ?></button> -->
            </div>
        </div>
    </div>
</div>


<?php


function question_exam_script_init()
{
    ?>
    <script>
        var questions = [];
        const QuestionType = {
            ONECHOICE: 1,
            MULTICHOICE: 2,
            SWITCH: 3
        };

        $('#QuestionExamDialog').on('show.bs.modal', function (event) {
            loadingQuestionExam = true;
            var button = $(event.relatedTarget)
            $('#QuestionExamLoader').removeClass('d-none').addClass('d-flex');

            const ID_EXAMEN = examsDatatable.row(button.parents('tr')).data().ID_EXAMEN;
            $.get("<?= DOMAIN . '/exams/questions.php' ?>", {ID_EXAMEN})
                .done(function (response) {
                    response = jQuery.parseJSON(response);
                    questions = response.questions;

                    $('#exportExamAsWord').attr('href', '<?=  DOMAIN . '/exams/export.php?type=word&ID_EXAMEN='?>' + ID_EXAMEN)
                    $('#exportExamAsHtml').attr('href', '<?=  DOMAIN . '/exams/export.php?type=html&ID_EXAMEN='?>' + ID_EXAMEN)
                    $('#exportExamAsPdf').attr('href', '<?=  DOMAIN . '/exams/export.php?type=pdf&ID_EXAMEN='?>' + ID_EXAMEN)

                    PreviewQuestion();
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
                    loadingQuestionExam = false;
                    $('#QuestionExamLoader').addClass('d-none').removeClass('d-flex');

                });
        })

        /*
        function UpdateQuestionExam() {
            $('#QuestionExamLoader').addClass('d-none').removeClass('d-flex');
            loadingQuestionExam = true;
            $.post("<?= DOMAIN . '/exams/questions.php' ?>", {ID_COUR: examQuestion.ID_COUR, questions})
                .done(function (response) {

                    response = jQuery.parseJSON(response);
                    questions = response.questions;
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })


                    PreviewQuestion();

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
                loadingQuestionExam = false;
                $('#QuestionExamLoader').addClass('d-none').removeClass('d-flex');

            });
        }
*/
        function PreviewQuestion() {

            $('#ListQuestions').html('');

            let index = 1;
            for (const question of questions) {
                const options = JSON.parse(question.CHOIX);
                const title = `<label class="d-block mb-2">${index + '. ' + question.TITRE}</label>`;
                var html_option = ``;
                if (question.ID_QUESTION_TYPE == QuestionType.MULTICHOICE) {

                    for (const option of options) {
                        html_option += `<input name="${'QSTN' + question.ID_QUESTION}"  type='checkbox' readonly ${option.correct ? 'checked' : ''} /> ${option.titre} <br/>`
                    }
                } else {
                    for (const option of options) {
                        html_option += `<input name="${'QSTN' + question.ID_QUESTION}" type='radio' readonly ${option.correct ? 'checked' : ''} /> ${option.titre} <br/>`
                    }
                }

                $('#ListQuestions').append(`<div class="form-group">${title} ${html_option}</div>`);
                index++;
            }

        }

        function closeUpdateQuestionExam() {
            if (!loadingQuestionExam)
                $('#QuestionExamDialog').modal('hide');
        }
    </script>
    <?php
}