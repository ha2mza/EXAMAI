<?php
$title = 'ExamAI - Calendar';
require_once ROOT . '/src/Views/layouts/home.php';

function script_init()
{
    global $events;
    ?>

    <script src="<?= DOMAIN ?>/assets/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= DOMAIN ?>/assets/vendors/moment/moment.min.js"></script>
    <script src="<?= DOMAIN ?>/assets/vendors/fullcalendar/fullcalendar.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#calendar').fullCalendar({
                    initialView: 'dayGridMonth',
                    initialDate: '2022-04-07',
                    header: {
                        left: 'prev,today,next',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listMonth'
                    },
                    events: <?= json_encode($events) ?>

                }
            );
        });
    </script>
    <?php
}

function style_init()
{
    ?>

    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/vendors/fullcalendar/fullcalendar.min.css">
    <style>
        .fc-time, .fc-title {
            padding: 0 1px;
            white-space: normal;
        }
    </style>
    <?php
}

function content_init()
{
    ?>
    <div class="wd-lg-1000 m-auto">
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    <?php
}