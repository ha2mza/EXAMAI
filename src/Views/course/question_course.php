<div class="modal fade" id="QuestionCourseDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= trans('course.question-course-dialog') ?></h5>
                <button type="button" class="close" onclick="closeUpdateQuestionCourse()">
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
                <div id="QuestionCourseLoader" class="d-flex align-items-center">
                    <strong><?= trans('course.wait-data-course-loading') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <div id="UpdateQuestionCourseLoader" class="d-flex align-items-center">
                    <strong><?= trans('course.wait-course-upadting') ?></strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                </div>
                <form id="UpdateQuestionCourseForm">
                    <input type="hidden" id="question-course-id" name="ID_COUR">
                    <div class="form-group">
                        <label for="question-course-title"><?= trans('course.question.title') ?></label>
                        <input type="text" class="form-control" id="question-course-title"
                               oninput="SetQuestionTitle(this.value)"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="question-course-type"><?= trans('course.question.type') ?></label>
                        <select id="question-course-type" class="form-control" name="ID_CLASSE"
                                onchange="SetQuestionType(this.value)"></select>
                    </div>
                    <div class="form-group">
                        <label for="question-course-options"><?= trans('course.question.options') ?></label>

                        <div class="form-group float-right">
                            <button id="btn-question-add-option" type="button" class="btn btn-dark"
                                    onclick="CreateOption()"><?= trans('course.question-add-option') ?></button>
                        </div>

                        <div id="question-course-options">
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer justify-content-around">

                <button class="btn w-100 btn-danger btn-icon-text" onclick="DeleteQuestion()">
                    <svg class="btn-icon-prepend" fill="white" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512 512">
                        <path d="M480 416C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H150.6C133.7 480 117.4 473.3 105.4 461.3L25.37 381.3C.3786 356.3 .3786 315.7 25.37 290.7L258.7 57.37C283.7 32.38 324.3 32.38 349.3 57.37L486.6 194.7C511.6 219.7 511.6 260.3 486.6 285.3L355.9 416H480zM265.4 416L332.7 348.7L195.3 211.3L70.63 336L150.6 416L265.4 416z"/>
                    </svg>
                    <?= trans('course.question.delete') ?>
                </button>

                <button class="btn btn-lg btn-light btn-icon"
                        onclick="PreviousQuestion()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend" viewBox="0 0 512 512">
                        <path d="M289.6 138c-8.719-3.812-18.91-2.094-25.91 4.375l-104 96C154.8 242.9 152 249.3 152 256s2.812 13.09 7.719 17.62l104 96c7 6.469 17.19 8.188 25.91 4.375C298.3 370.2 304 361.5 304 352V160C304 150.5 298.3 141.8 289.6 138zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/>
                    </svg>
                </button>

                <input type="text" class="wd-75 form-control form-control-lg text-center" id="question-current-page"
                       oninput="SetCurrentPage(this.value)"
                       autocomplete="off">

                <input type="text" class="wd-45 form-control form-control-lg text-center" readonly value="/">

                <input type="text" class="wd-75 form-control form-control-lg text-center" disabled readonly
                       id="question-total-page">

                <button class="btn btn-lg btn-light btn-icon"
                        onclick="NextQuestion()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-prepend" viewBox="0 0 512 512">
                        <path d="M248.3 142.4C241.3 135.9 231.1 134.2 222.4 138C213.7 141.8 208 150.5 208 160v192c0 9.531 5.656 18.16 14.38 22c8.719 3.812 18.91 2.094 25.91-4.375l104-96C357.2 269.1 360 262.7 360 256s-2.812-13.09-7.719-17.62L248.3 142.4zM256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464z"/>
                    </svg>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark mr-auto ml-0"
                        onclick="CreateQuestion()"><?= trans('course.add-question') ?></button>
                <button class="btn btn-light mr-2"
                        onclick="closeUpdateQuestionCourse()"><?= trans('course.close') ?></button>
                <button class="btn btn-dark"
                        onclick="UpdateQuestionCourse()"><?= trans('course.save-changes') ?></button>
            </div>
        </div>
    </div>
</div>


<?php


function question_course_script_init()
{
    ?>
    <script>
        var loadingQuestionCourse = false;
        var courseQuestion = null;
        var questions = [];
        var currentQuestionPosition = -1;
        const QuestionType = {
            ONECHOICE: 1,
            MULTICHOICE: 2,
            SWITCH: 3
        };

        function SetCurrentPage(value) {
            if (value === '')
                return;
            value = parseInt(value);
            currentQuestionPosition = 0;
            if (!isNaN(value) && value > 0 && value <= questions.length) {
                currentQuestionPosition = value - 1;
            }

            PreviewQuestion()
        }

        $('#QuestionCourseDialog').on('show.bs.modal', function (event) {
            loadingQuestionCourse = true;
            var button = $(event.relatedTarget)
            const ID_COUR = coursesDatatable.row(button.parents('tr')).data().ID_COUR;
            $('#QuestionCourseLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateQuestionCourseLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateQuestionCourseForm').addClass('d-none').removeClass('d-block');
            $.get("<?= DOMAIN . '/courses/questions.php' ?>", {ID_COUR})
                .done(function (response) {
                    $("#CreateCourseForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    $("#question-course-type").select2({
                        data: response.question_types,
                        width: '100%'
                    });
                    courseQuestion = response.course;
                    questions = response.questions;
                    $('#QuestionCourseDialog').find('#question-total-page').val(questions.length);
                    $('#QuestionCourseDialog').find('#question-course-id').val(response.course.ID_COUR);
                    currentQuestionPosition = -1;
                    NextQuestion();
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
                    loadingQuestionCourse = false;
                    $('#QuestionCourseLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateQuestionCourseLoader').addClass('d-none').removeClass('d-flex');
                    $('#UpdateQuestionCourseForm').removeClass('d-none').addClass('d-block');

                });
        })

        function UpdateQuestionCourse() {
            $('#QuestionCourseLoader').addClass('d-none').removeClass('d-flex');
            $('#UpdateQuestionCourseLoader').removeClass('d-none').addClass('d-flex');
            $('#UpdateQuestionCourseForm').addClass('d-none').removeClass('d-block');
            loadingQuestionCourse = true;
            $.post("<?= DOMAIN . '/courses/questions.php' ?>", {ID_COUR: courseQuestion.ID_COUR, questions})
                .done(function (response) {
                    $("#UpdateQuestionCourseForm").trigger("reset");
                    response = jQuery.parseJSON(response);
                    coursesDatatable.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })

                    $('#QuestionCourseDialog').modal('hide');

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
                loadingQuestionCourse = false;
                $('#QuestionCourseLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateQuestionCourseLoader').addClass('d-none').removeClass('d-flex');
                $('#UpdateQuestionCourseForm').removeClass('d-none').addClass('d-block');

            });
        }

        function NextQuestion() {
            currentQuestionPosition++;
            if (currentQuestionPosition >= questions.length)
                currentQuestionPosition = 0;
            PreviewQuestion();
        }

        function PreviousQuestion() {
            currentQuestionPosition--;
            if (currentQuestionPosition < 0)
                currentQuestionPosition = questions.length ? questions.length - 1 : 0;

            PreviewQuestion();
        }

        function PreviewQuestion() {
            $('#question-current-page').val(currentQuestionPosition + 1);
            if (!questions[currentQuestionPosition]) {
                CreateQuestion();
            }
            const question = questions[currentQuestionPosition];
            $('#btn-question-add-option').removeClass('d-none');
            if (question.question_type_id === QuestionType.SWITCH) {
                $('#btn-question-add-option').addClass('d-none');
            }

            $('#question-course-title').val(question.title);
            $('#question-course-type').val(question.question_type_id).trigger('change');
        }

        function CreateQuestion() {
            questions.push({
                title: '',
                question_type_id: QuestionType.ONECHOICE,
                options: [{index: 0, titre: '', correct: false}, {index: 1, titre: '', correct: false}, {
                    index: 2,
                    titre: '',
                    correct: false
                }]
            });
            currentQuestionPosition = questions.length - 1;
            $('#QuestionCourseDialog').find('#question-total-page').val(questions.length);
            PreviewQuestion();
        }

        function CreateOption(titre = '', correct = false) {
            const index = questions[currentQuestionPosition].options.length;
            questions[currentQuestionPosition].options.push({
                index: index,
                titre: titre,
                correct: correct
            });
            appendOption(GenerateOption(index, titre, correct));
        }

        function DeleteQuestion() {
            questions.splice(currentQuestionPosition, 1);
            if (currentQuestionPosition + 1 > questions.length)
                currentQuestionPosition--;
            $('#QuestionCourseDialog').find('#question-total-page').val(questions.length);
            PreviewQuestion();
        }


        function RemoveOption(index) {
            if (questions[currentQuestionPosition].question_type_id !== QuestionType.SWITCH) {
                const pos = questions[currentQuestionPosition].options.findIndex(option => option.index === index);
                if (pos !== -1) {
                    questions[currentQuestionPosition].options.splice(pos, 1);
                    $('#question-course-options').children().eq(pos).detach();
                }
            }
        }

        function OptionToggleCheck(index) {
            const question = questions[currentQuestionPosition];
            const pos = question.options.findIndex(option => option.index === index);
            const correct = !question.options[pos].correct;
            if (question.question_type_id !== QuestionType.MULTICHOICE) {
                for (let i = 0; i < question.options.length; i++) {
                    setOptionCheck(i, false);
                }
            }
            setOptionCheck(pos, correct);
        }

        function setOptionCheck(index, correct) {
            questions[currentQuestionPosition].options[index].correct = correct;
            let content = `<svg class="btn-icon-prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM339.8 211.8C350.7 200.9 350.7 183.1 339.8 172.2C328.9 161.3 311.1 161.3 300.2 172.2L192 280.4L147.8 236.2C136.9 225.3 119.1 225.3 108.2 236.2C97.27 247.1 97.27 264.9 108.2 275.8L172.2 339.8C183.1 350.7 200.9 350.7 211.8 339.8L339.8 211.8z"/></svg>`;

            if (!correct)
                content = `<svg class="btn-icon-prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM384 80H64C55.16 80 48 87.16 48 96V416C48 424.8 55.16 432 64 432H384C392.8 432 400 424.8 400 416V96C400 87.16 392.8 80 384 80z"/></svg>`;

            $('#question-course-options').find('div:nth-child(' + (index + 1) + ') svg').get(0).innerHTML = (content);
        }

        function appendOption(content) {
            $('#question-course-options').append(content);
        }


        function SetQuestionTitle(value) {
            questions[currentQuestionPosition].title = value;
        }

        function SetOptionTitle(index, value) {
            const question = questions[currentQuestionPosition];
            question.options[index].titre = value;
        }

        function SetQuestionType(value) {
            const question = questions[currentQuestionPosition];
            value = parseInt(value);
            let need_new_option = question.question_type_id !== value;
            question.question_type_id = value;
            $('#question-course-options').html('');
            if (need_new_option) {
                question.options = [];
                switch (value) {
                    case QuestionType.SWITCH:
                        CreateOption('<?= trans('course.question.true')?>');
                        CreateOption('<?= trans('course.question.false')?>');
                        break;
                    case QuestionType.ONECHOICE:
                    case QuestionType.MULTICHOICE:
                        CreateOption();
                        CreateOption();
                        CreateOption();
                        break;
                }
            } else {
                switch (value) {
                    case QuestionType.SWITCH:
                        appendOption(GenerateOption(0, '<?= trans('course.question.true')?>', question.options[0].correct));
                        appendOption(GenerateOption(1, '<?= trans('course.question.false')?>', question.options[1].correct));
                        break;
                    case QuestionType.ONECHOICE:
                    case QuestionType.MULTICHOICE:
                        for (const [index, option] of question.options.entries()) {
                            appendOption(GenerateOption(index, option.titre ?? '', option.correct ?? false));
                        }
                        break;
                }
            }
        }


        function GenerateOption(index, titre, correct) {
            const question = questions[currentQuestionPosition];
            let content = '<div class="input-group  mb-3">';
            content += `<input class="form-control form-control-lg" type="text" ${QuestionType.SWITCH === question.question_type_id ? 'disabled' : ''} value="${titre}" oninput="SetOptionTitle(${index}, this.value)">`;
            content += `<span class="input-group-btn">`;
            content += `<button class="btn btn-lg btn-outline-light btn-icon h-100 rounded-0 border-left-0" type="button" onclick="OptionToggleCheck(${index})">`;
            if (!correct)
                content += `<svg class="btn-icon-prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM384 80H64C55.16 80 48 87.16 48 96V416C48 424.8 55.16 432 64 432H384C392.8 432 400 424.8 400 416V96C400 87.16 392.8 80 384 80z"/></svg>`;
            else {
                content += `<svg class="btn-icon-prepend" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <path d="M384 32C419.3 32 448 60.65 448 96V416C448 451.3 419.3 480 384 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H384zM339.8 211.8C350.7 200.9 350.7 183.1 339.8 172.2C328.9 161.3 311.1 161.3 300.2 172.2L192 280.4L147.8 236.2C136.9 225.3 119.1 225.3 108.2 236.2C97.27 247.1 97.27 264.9 108.2 275.8L172.2 339.8C183.1 350.7 200.9 350.7 211.8 339.8L339.8 211.8z"/></svg>`;
            }
            content += `</button>`;
            content += `</span>`;
            if (QuestionType.SWITCH !== question.question_type_id) {
                content += `<span class="input-group-btn">`;
                content += ` <button class="btn btn-lg btn-outline-light btn-icon h-100 rounded-0 border-left-0" type="button" onclick="RemoveOption(${index})">`;
                content += `<svg class="btn-icon-prepend" fill="red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"> <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>`;
                content += `</button>`;
                content += `</span>`;
            }
            content += `</div>`;
            return content
        }

        function closeUpdateQuestionCourse() {
            if (!loadingQuestionCourse)
                $('#QuestionCourseDialog').modal('hide');
        }
    </script>
    <?php
}