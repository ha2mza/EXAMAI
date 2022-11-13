<?php
if (!function_exists('request_session')) {
    http_response_code(404);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ExamAI - PASSING TEST</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis" media="all">
    <link href="<?= DOMAIN ?>/assets/css/bootstrap.5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/css/all.min.css">
    <script src="<?= DOMAIN ?>/assets/js/all.min.js"></script>

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/css/exam/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= DOMAIN ?>/assets/images/favicon.png"/>

    <?= style_init(); ?>

</head>
<body>

<div class="main">
    <div class="container">
        <div class="slider">
            <?= content_init() ?>
        </div>
    </div>
</div>

<div class="nav-questions d-none">
    <div>
        <div class="row m-0 w-100 h-100 align-items-center">
            <div class="col-2">
                <div id="cam"></div>
            </div>
            <div class="col-7">
                <div id="question-response-total">1 of 20 answered</div>
                <div class="progress">
                    <div id="question-progress-percent" class="progress-bar" role="progressbar" style="width: 5%"
                         aria-valuenow="20" aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-3">
                <nav class="text-end pt-2">
                    <button class="btn btn-dark" type="button">
                        Une autre question !
                    </button>
                </nav>
            </div>
        </div>
    </div>
</div>


<script src="<?= DOMAIN ?>/assets/js/jquery-3.6.0.slim.min.js?v=1.0.0"></script>
<script src="<?= DOMAIN ?>/assets/js/bootstrap.5.bundle.min.js"></script>

<?= script_init() ?>

<script>
    var marginTop = 0, MinHeight = 0;
    let WindowHeight = $(document).height();
    const BottomNavHeight = $('.nav-questions').height();
    var CurrentQuestion = 0;
    let items = [];

    function AddLocation(e) {
        console.dir(e);
    }

    function PreviewQuestion() {
        for (let i = 0; i < items.length; i++) {
            if (CurrentQuestion === i) {
                $('.slider > .slider-item').removeClass('slider-item-active');
                $('.slider > .slider-item:nth-child(' + (i + 1) + ')').addClass('slider-item-active');
                mainEl.scrollTop = items[i].y;

                if (WindowHeight - BottomNavHeight - (items[CurrentQuestion].height + 80) > 0) {
                    $('.slider').css('margin-top', WindowHeight - BottomNavHeight - (items[CurrentQuestion].height + 80));
                } else {
                    $('.slider').css('margin-top', '');
                }
                break;
            }
        }
    }

    function PreviousQuestion() {
        CurrentQuestion--;
        if (CurrentQuestion < 0)
            CurrentQuestion = 0;

        PreviewQuestion();
    }

    function NextQuestion() {
        CurrentQuestion++;
        if (CurrentQuestion >= items.length)
            CurrentQuestion = items.length - 1;

        PreviewQuestion();
    }

    $(document).ready(function () {
        $('.slider > .slider-item:nth-child(1)').addClass('slider-item-active');
        WindowHeight = $(document).height();
        GetPosParts();
        if (WindowHeight - BottomNavHeight - (items[0].height + 80) > 0) {
            $('.slider').css('margin-top', WindowHeight - BottomNavHeight - (items[0].height + 80));
        } else {
            $('.slider').css('margin-top', '');
        }

        $('.slider').css('min-height', MinHeight);
    });


    function GetPosParts() {
        MinHeight = 0;
        items = [];
        var slider = $('.slider')[0].getBoundingClientRect();
        var parts = document.querySelectorAll('.slider > .slider-item')
        const moveBy = slider.top * -1;
        for (const part of parts) {
            let info = part.getBoundingClientRect();
            info.y = info.y + moveBy;
            info.top = info.top + moveBy;
            info.bottom = info.bottom + moveBy;
            items.push(info);
            MinHeight += info.height + 80;
        }
        // setTimeout(() => {
        // const first_item = Object.assign({}, items[0]);
        // console.dir(items[0]);
        // for (const item of items) {
        //     item.top -= first_item.top;
        //     item.y -= first_item.y;
        //     item.bottom -= first_item.bottom;
        // }
        // }, 250);
    }

    window.onresize = function (event) {
        $('.slider > .slider-item').removeClass('slider-item-active');
        WindowHeight = $(document).height();
        GetPosParts();
        if (WindowHeight - BottomNavHeight - (items[0].height + 80) > 0) {
            $('.slider').css('margin-top', WindowHeight - BottomNavHeight - (items[0].height + 80));
        } else {
            $('.slider').css('margin-top', '');
        }

        $('.slider').css('min-height', MinHeight);

        PreviewQuestion();
    }

    const mainEl = document.querySelector('.main');
    /*
        $('.main').bind('mousewheel', function (e) {
            let scroll = mainEl.scrollTop;
            GetPosParts();

            if (e.originalEvent.wheelDelta / 120 > 0) {
                $('.slider > .slider-item').removeClass('slider-item-active');
                $('.slider > .slider-item:nth-child(' + items.length + ')').addClass('slider-item-active');
                for (let i = items.length - 1; i >= 0; i--) {
                    if (scroll >= items[i].top) {
                        CurrentQuestion = i;
                        $('.slider > .slider-item').removeClass('slider-item-active');
                        $('.slider > .slider-item:nth-child(' + (i + 1) + ')').addClass('slider-item-active');
                        mainEl.scrollTop = items[i].y;
                        break;
                    }
                }
            } else {

                $('.slider > .slider-item').removeClass('slider-item-active');
                $('.slider > .slider-item:nth-child(' + 0 + ')').addClass('slider-item-active');
                for (let i = items.length - 1; i >= 0; i--) {
                    items[i].top = items[i].top - (items[i].height / 2);
                    if (scroll >= items[i].top) {
                        CurrentQuestion = i;
                        $('.slider > .slider-item').removeClass('slider-item-active');
                        $('.slider > .slider-item:nth-child(' + (i + 1) + ')').addClass('slider-item-active');
                        mainEl.scrollTop = items[i].y;
                        break;
                    }
                }
            }
        });
        */

    /*
    mainEl.addEventListener('scroll', (event) => {

        console.dir(scroll);
        var find = false;
        console.dir(items);
        if (scroll <= 0) {
            $('.slider > .slider-item').removeClass('slider-item-active');
            $('.slider > .slider-item:nth-child(' + (1) + ')').addClass('slider-item-active');
        }
        // if (!find) {
        //     if (scroll > 0) {
        //         $('.slider > .slider-item:nth-child(' + (items.length) + ')').addClass('slider-item-active');
        //     } else {
        //         $('.slider > .slider-item:nth-child(' + (1) + ')').addClass('slider-item-active');
        //     }
        // }
    });
     */

</script>

</body>
</html>
