<?php
require_once ROOT . '/src/Views/layouts/passage.php';

function script_init()
{
    global $questions, $exam, $exam_candidat, $code, $id;
    ?>
    <script src="<?= DOMAIN ?>/assets/js/jquery.jqcam.js"></script>
    <script>
        const CODE = `<?= $code ?>`;
        const LIEN = `<?= $id ?>`;
        const total_duration = <?= intval($exam->DUREE * 60) ?>;
        <?php if($exam->DATE_STRICTE): ?>
        let passed_duration = <?= time() - strtotime($exam->COMMENCE_A) ?>;
        <?php else: ?>
        let passed_duration = <?= time() - strtotime($exam_candidat->COMMENCE_A) ?>;
        <?php endif; ?>
        let reste_duration = total_duration - passed_duration;
        const total_question = <?= count($questions) ?>;
        const QuestionType = {
            ONECHOICE: 1,
            MULTICHOICE: 2,
            SWITCH: 3
        };

        const responses = {};

        $(document).ready(function () {

            $('.nav-questions').removeClass('d-none');
            $('.nav-questions #question-response-total').text('0 sur ' + total_question + ' a répondu');
            $('.nav-questions #question-progress-percent').css('width', '0%');
            $(`.time-reste`).text(secondsTimeSpanToHMS(reste_duration));

            setInterval(() => {
                passed_duration += 1;
                reste_duration = total_duration - passed_duration;
                $(`.time-reste`).text(secondsTimeSpanToHMS(reste_duration));
                if (reste_duration <= 0) {
                    CloseExam();
                }
            }, 1000);

            Webcam.set({
                width: 75,
                height: 75,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#cam');

            Webcam.on('live', function (data) {
                // camera is live, showing preview image
                // (and user has allowed access)
                console.dir(data);
            });
            Webcam.on('error', function (err) {
                console.dir(err);
            });

        });

        function secondsTimeSpanToHMS(s) {
            var h = Math.floor(s / 3600); //Get whole hours
            s -= h * 3600;
            var m = Math.floor(s / 60); //Get remaining minutes
            s -= m * 60;
            return h + ":" + (m < 10 ? '0' + m : m) + ":" + (s < 10 ? '0' + s : s); //zero padding on minutes and seconds
        }


        function CloseExam() {
            var count_response = 0

            for (let r in responses) {
                if (Array.isArray(responses[r])) {
                    count_response += responses[r].length > 0;
                } else {
                    count_response++;
                }
            }

            if (total_question === count_response || reste_duration <= 0) {
                $.post("<?= DOMAIN . '/passage/finish-exam.php' ?>", {answers: responses, CODE, LIEN})
                    .done(function (response) {

                        window.location.reload();

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
                });
            }
        }

        function OptionCheck(e) {

            let data = $(e.target).data();

            if (data.type === QuestionType.MULTICHOICE) {
                if (!responses[data.question]) {
                    responses[data.question] = [];
                }
                const index = responses[data.question].findIndex(e => e === data.value);
                if (index === -1) {
                    responses[data.question].push(data.value);
                    $(e.target).removeClass('btn-outline-primary').removeClass('btn-lg').addClass('btn-primary');
                } else {
                    responses[data.question].splice(index, 1);
                    $(e.target).addClass('btn-outline-primary').addClass('btn-lg').removeClass('btn-primary');
                }
            } else {
                $(e.target).parent().children().removeClass('btn-primary').addClass('btn-lg').addClass('btn-outline-primary');
                responses[data.question] = data.value;
                $(e.target).removeClass('btn-outline-primary').removeClass('btn-lg').addClass('btn-primary');
                NextQuestion();
            }


            var count_response = 0

            for (let r in responses) {
                if (Array.isArray(responses[r])) {
                    count_response += responses[r].length > 0;
                } else {
                    count_response++;
                }
            }

            $('.nav-questions #question-response-total').text(count_response + ' sur ' + total_question + ' a répondu');
            $('.nav-questions #question-progress-percent').css('width', Math.round(count_response * 100 / total_question) + '%');
        }

    </script>
    <?php
}

function style_init()
{

}

function content_init()
{
    global $questions, $exam, $exam_candidat, $cour;
    $last_id = count($questions) - 1;

    $minutes_to_add = $exam->DUREE;
    if ($exam->DATE_STRICTE):
        $time = new DateTime($exam->COMMENCE_A);
    else:
        $time = new DateTime($exam_candidat->COMMENCE_A);
    endif;
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

    $exam_end = $time->format('H:i');

    foreach ($questions as $index => $question) {
        $options = json_decode($question->CHOIX);
        ?>

        <div class="slider-item">
            <?php
            if ($index > 0) {
                ?>

                <div class="slider-previous font-weight-bold" onclick="PreviousQuestion()">
                    <i class="fa-light fa-arrow-up me-2"></i>
                    Previous
                </div>

                <?php
            } ?>
            <h1 class="slider-title"><?= $index + 1 ?>. <?= $question->TITRE ?>?</h1>
            <p class="slider-text">Exam <?= $cour->NOM_COUR ?> il va terminer en <span><?= $exam_end ?></span>, reste
                <span class="time-reste"></span></p>

            <nav>
                <?php foreach ($options as $option): ?>
                    <button class="btn btn-lg btn-outline-primary m-1" data-question="<?= $question->ID_QUESTION ?>"
                            data-type="<?= $question->ID_QUESTION_TYPE ?>" data-value="<?= $option->index ?>"
                            onclick="OptionCheck(event)">
                        <?= trans($option->titre) ?>
                    </button>
                <?php endforeach; ?>

            </nav>


            <?php
            if ($index < $last_id) {
                ?>

                <nav>
                    <button class="btn btn-primary" onclick="NextQuestion()">
                        <i class="fa-light fa-arrow-down me-2"></i>
                        Next Question
                    </button>
                </nav>

                <?php
            } else {
                ?>

                <nav>
                    <button onclick="CloseExam()" class="btn btn-dark">
                        <i class="fa-solid fa-flag-checkered me-2"></i>
                        Terminer Examen
                    </button>
                </nav>

                <?php
            }


            ?>

        </div>

        <?php
    }
}