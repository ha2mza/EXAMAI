<?php
$title = 'ExamAI - Home';
require_once ROOT . '/src/Views/layouts/home.php';

function script_init()
{
//    global $note_exam_overview, $avg_note_by_class, $avg_note_by_course, $total_question_by_type, $rating_question;
//    ?>
<!--    <script src="--><?//= DOMAIN ?><!--/assets/vendors/apexcharts/apexcharts.min.js"></script>-->
<!--    <script>-->
<!--        $(function () {-->
<!--            'use strict';-->
<!--            var colors = {-->
<!--                primary: "#6571ff",-->
<!--                secondary: "#7987a1",-->
<!--                success: "#05a34a",-->
<!--                info: "#66d1d1",-->
<!--                warning: "#fbbc06",-->
<!--                danger: "#ff3366",-->
<!--                light: "#e9ecef",-->
<!--                dark: "#060c17",-->
<!--                muted: "#7987a1",-->
<!--                gridBorder: "rgba(77, 138, 240, .15)",-->
<!--                bodyColor: "#000",-->
<!--                cardBg: "#fff"-->
<!--            }-->
<!---->
<!--            // Apex Area chart start-->
<!--            var options = {-->
<!--                chart: {-->
<!--                    type: "area",-->
<!--                    height: 300,-->
<!--                    parentHeightOffset: 0,-->
<!--                    foreColor: "#999",-->
<!--                    stacked: true,-->
<!--                    dropShadow: {-->
<!--                        enabled: true,-->
<!--                        enabledSeries: [0],-->
<!--                        top: -2,-->
<!--                        left: 2,-->
<!--                        blur: 5,-->
<!--                        opacity: 0.06-->
<!--                    }-->
<!--                },-->
<!--                colors: ["#f77eb9", "#7ee5e5"],-->
<!--                stroke: {-->
<!--                    curve: "smooth",-->
<!--                    width: 3-->
<!--                },-->
<!--                dataLabels: {-->
<!--                    enabled: false-->
<!--                },-->
<!--                series: [{-->
<!--                    name: 'Total Views',-->
<!--                    data: generateDayWiseTimeSeries(0, 18)-->
<!--                }, {-->
<!--                    name: 'Unique Views',-->
<!--                    data: generateDayWiseTimeSeries(1, 18)-->
<!--                }],-->
<!--                markers: {-->
<!--                    size: 0,-->
<!--                    strokeColor: "#fff",-->
<!--                    strokeWidth: 3,-->
<!--                    strokeOpacity: 1,-->
<!--                    fillOpacity: 1,-->
<!--                    hover: {-->
<!--                        size: 6-->
<!--                    }-->
<!--                },-->
<!--                xaxis: {-->
<!--                    type: "datetime",-->
<!--                    axisBorder: {-->
<!--                        show: false-->
<!--                    },-->
<!--                    axisTicks: {-->
<!--                        show: false-->
<!--                    }-->
<!--                },-->
<!--                yaxis: {-->
<!--                    tickAmount: 4,-->
<!--                    min: 0,-->
<!--                    labels: {-->
<!--                        offsetX: 24,-->
<!--                        offsetY: -5-->
<!--                    },-->
<!--                    tooltip: {-->
<!--                        enabled: true-->
<!--                    }-->
<!--                },-->
<!--                grid: {-->
<!--                    borderColor: "rgba(77, 138, 240, .1)",-->
<!--                    padding: {-->
<!--                        left: -5,-->
<!--                        right: 5,-->
<!--                        bottom: -15-->
<!--                    }-->
<!--                },-->
<!--                tooltip: {-->
<!--                    x: {-->
<!--                        format: "dd MMM yyyy"-->
<!--                    },-->
<!--                },-->
<!--                legend: {-->
<!--                    position: 'top',-->
<!--                    horizontalAlign: 'left'-->
<!--                },-->
<!--                fill: {-->
<!--                    type: "solid",-->
<!--                    fillOpacity: 0.7-->
<!--                }-->
<!--            };-->
<!---->
<!--            var chart = new ApexCharts(document.querySelector("#apexArea"), options);-->
<!---->
<!--            chart.render();-->
<!---->
<!--            function generateDayWiseTimeSeries(s, count) {-->
<!--                var values = [[-->
<!--                    4, 3, 10, 9, 29, 19, 25, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5-->
<!--                ], [-->
<!--                    2, 3, 8, 7, 22, 16, 23, 7, 11, 5, 12, 5, 10, 4, 15, 2, 6, 2-->
<!--                ]];-->
<!--                var i = 0;-->
<!--                var series = [];-->
<!--                var x = new Date("11 Nov 2012").getTime();-->
<!--                while (i < count) {-->
<!--                    series.push([x, values[s][i]]);-->
<!--                    x += 86400000;-->
<!--                    i++;-->
<!--                }-->
<!--                return series;-->
<!--            }-->
<!---->
<!--            // Apex Area chart end-->
<!---->
<!--            // Apex Donut chart start-->
<!--            var options = {-->
<!--                chart: {-->
<!--                    height: 300,-->
<!--                    type: "donut"-->
<!--                },-->
<!--                stroke: {-->
<!--                    colors: ['rgba(0,0,0,0)']-->
<!--                },-->
<!--                colors: [colors.primary, colors.warning, colors.danger, colors.info],-->
<!--                legend: {-->
<!--                    position: 'top',-->
<!--                    horizontalAlign: 'center'-->
<!--                },-->
<!--                series: --><?//= json_encode(array_map(fn($e) => $e['avg_note'], $avg_note_by_class), JSON_NUMERIC_CHECK)?>//,
//                labels: <?//= json_encode(array_map(fn($e) => $e['NOM_CLASSE'], $avg_note_by_class))?>
//            };
//
//            var chart = new ApexCharts(document.querySelector("#apexDonut"), options);
//
//            chart.render();
//            // Apex Donut chart start
//
//            // Apex Pie chart end
//            var options = {
//                chart: {
//                    height: 300,
//                    type: "pie"
//                },
//                colors: [colors.dark, colors.primary, colors.light, colors.danger, colors.info],
//                legend: {
//                    position: 'top',
//                    horizontalAlign: 'center'
//                },
//                stroke: {
//                    colors: ['rgba(0,0,0,0)']
//                },
//                dataLabels: {
//                    enabled: true
//                },
//                series: <?//= json_encode(array_map(fn($e) => $e['avg_note'], $avg_note_by_course), JSON_NUMERIC_CHECK)?>//,
//                labels: <?//= json_encode(array_map(fn($e) => $e['NOM_COUR'], $avg_note_by_course))?>
//
//            };
//
//            var chart = new ApexCharts(document.querySelector("#apexPie"), options);
//
//            chart.render();
//            // Apex Pie chart end
//
//            // Apex Mixed chart start
//            var options = {
//                chart: {
//                    height: 300,
//                    type: 'line',
//                    stacked: false,
//                    parentHeightOffset: 0
//                },
//                grid: {
//                    borderColor: "rgba(77, 138, 240, .1)",
//                    padding: {
//                        bottom: -15
//                    }
//                },
//                stroke: {
//                    width: [0, 2, 5],
//                    curve: 'smooth'
//                },
//                plotOptions: {
//                    bar: {
//                        columnWidth: '50%'
//                    }
//                },
//                series: [{
//                    name: 'TEAM A',
//                    type: 'column',
//                    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
//                }, {
//                    name: 'TEAM B',
//                    type: 'area',
//                    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
//                }],
//                legend: {
//                    position: 'top',
//                    horizontalAlign: 'left'
//                },
//                fill: {
//                    opacity: [0.85, 0.25, 1],
//                    gradient: {
//                        inverseColors: false,
//                        shade: 'light',
//                        type: "vertical",
//                        opacityFrom: 0.85,
//                        opacityTo: 0.55,
//                        stops: [0, 100, 100, 100]
//                    }
//                },
//                labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003', '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'],
//                markers: {
//                    size: 0
//                },
//                xaxis: {
//                    type: 'datetime'
//                },
//                yaxis: {
//                    title: {
//                        text: 'Points',
//                    },
//                },
//                tooltip: {
//                    shared: true,
//                    intersect: false,
//                    y: [{
//                        formatter: function (y) {
//                            if (typeof y !== "undefined") {
//                                return y.toFixed(0) + " points";
//                            }
//                            return y;
//                        }
//                    }, {
//                        formatter: function (y) {
//                            if (typeof y !== "undefined") {
//                                return y.toFixed(2) + " $";
//                            }
//                            return y;
//                        }
//                    }]
//                }
//            }
//            var chart = new ApexCharts(
//                document.querySelector("#apexMixed"),
//                options
//            );
//            chart.render();
//            // Apex Mixed chart end
//
//            // Apex Radar chart start
//            var options = {
//                chart: {
//                    height: 300,
//                    type: 'radar',
//                    parentHeightOffset: 0,
//                },
//                colors: ["#f77eb9", "#7ee5e5", "#4d8af0"],
//                grid: {
//                    borderColor: "rgba(77, 138, 240, .1)",
//                    padding: {
//                        bottom: -15
//                    }
//                },
//                legend: {
//                    position: 'top',
//                    horizontalAlign: 'left'
//                },
//                series: <?//= json_encode($total_question_by_type[1], JSON_NUMERIC_CHECK) ?>//,
//                stroke: {
//                    width: 0
//                },
//                fill: {
//                    opacity: 0.4
//                },
//                markers: {
//                    size: 0
//                },
//                labels: <?//= json_encode($total_question_by_type[0], JSON_NUMERIC_CHECK) ?>
//            }
//
//            var chart = new ApexCharts(
//                document.querySelector("#apexRadar"),
//                options
//            );
//
//            chart.render();
//            // Apex Radar chart end
//
//            // Apex Radialbar chart start
//            var options = {
//                chart: {
//                    height: 300,
//                    type: "pie",
//                    parentHeightOffset: 0
//                },
//                colors: [colors.danger, colors.success],
//                series: [<?//= $rating_question[0] ?>//, <?//= $rating_question[1] ?>//],
//                labels: ["Mauvaise réponse", "Bonne réponse"]
//            };
//
//            var chart = new ApexCharts(document.querySelector("#apexRadialBar"), options);
//
//            chart.render();
//
//            var chartAreaBounds = chart.w.globals.dom.baseEl.querySelector('.apexcharts-inner').getBoundingClientRect();
//            // Apex Radialbar chart end
//
//            // Apex Scatter chart start
//            var options = {
//                chart: {
//                    height: 300,
//                    type: 'scatter',
//                    parentHeightOffset: 0,
//                    zoom: {
//                        enabled: true,
//                        type: 'xy'
//                    }
//                },
//                colors: ["#f77eb9", "#7ee5e5", "#4d8af0"],
//                grid: {
//                    borderColor: "rgba(77, 138, 240, .1)",
//                    padding: {
//                        bottom: -15
//                    }
//                },
//                stroke: {
//                    colors: ['rgba(0,0,0,0)']
//                },
//                legend: {
//                    position: 'top',
//                    horizontalAlign: 'left'
//                },
//                series: [{
//                    name: "NOTE EXAM",
//                    data: <?//= json_encode($note_exam_overview, JSON_NUMERIC_CHECK) ?>
//                }],
//                xaxis: {
//                    tickAmount: 10,
//                    labels: {
//                        formatter: function (val) {
//                            return parseFloat(val).toFixed(1)
//                        }
//                    }
//                },
//                yaxis: {
//                    tickAmount: 7
//                }
//            }
//
//            var chart = new ApexCharts(
//                document.querySelector("#apexScatter"),
//                options
//            );
//
//            chart.render();
//            // Apex Scatter chart end
//
//
//        });
//    </script>
//    <?php
}

function style_init()
{
    ?>
    <?php
}

function content_init()
{
//    global $total_candidat, $total_exam, $total_classe, $total_question, $last_exam_passed, $total_exam_passage, $total_exam_passed, $total_exam_not_passed, $total_course;
//    ?>
<!--    <div class="form-group">-->
<!--        <div class="row">-->
<!--            <div class="col-md-3">-->
<!--                <div class="card">-->
<!--                    <div class="card-body">-->
<!--                        <h2 class="card-title mb-0">--><?//= trans('dashboard.total-exam') ?><!--</h2>-->
<!--                        <h4 class="card-subtitle mt-1 mb-0">--><?//= $total_exam ?><!--</h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!---->
<!--                <div class="card">-->
<!--                    <div class="card-body">-->
<!--                        <h2 class="card-title mb-0">--><?//= trans('dashboard.total-class') ?><!--</h2>-->
<!--                        <h4 class="card-subtitle mt-1 mb-0">--><?//= $total_classe ?><!--</h4>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--                <div class="card">-->
<!--                    <div class="card-body">-->
<!--                        <h2 class="card-title mb-0">--><?//= trans('dashboard.total-question') ?><!--</h2>-->
<!--                        <h4 class="card-subtitle mt-1 mb-0">--><?//= $total_question ?><!--</h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--                <div class="card">-->
<!--                    <div class="card-body">-->
<!--                        <h2 class="card-title mb-0">--><?//= trans('dashboard.last-passed-exam') ?><!--</h2>-->
<!--                        <h4 class="card-subtitle mt-1 mb-0">--><?//= $last_exam_passed ?><!--</h4>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="row flex-grow">-->
<!--        <div class="col-md-6 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <div class="d-flex justify-content-between align-items-baseline">-->
<!--                        <h6 class="card-title mb-0">--><?//= trans('dashboard.total-exam-passage') ?><!--</h6>-->
<!--                    </div>-->
<!--                    <div class="mt-2">-->
<!--                        <h3 class="mb-2">--><?//= $total_exam_passage ?><!--</h3>-->
<!--                        <div class="d-flex align-items-baseline w-100">-->
<!--                            <p class="text-success" style="flex:1">-->
<!--                                <span>--><?//= trans('dashboard.exam-passed') ?><!--: --><?//= $total_exam_passage > 0 ? round($total_exam_passed / $total_exam_passage * 100, 2) : 0 ?><!--%</span>-->
<!--                            </p>-->
<!--                            <p class="text-danger" style="flex:1">-->
<!--                                <span>--><?//= trans('dashboard.exam-not-passed') ?><!--: --><?//= $total_exam_passage > 0 ? round($total_exam_not_passed / $total_exam_passage * 100, 2) : 0 ?><!--%</span>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-md-3 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <div class="d-flex justify-content-between align-items-baseline">-->
<!--                        <h6 class="card-title mb-0">--><?//= trans('dashboard.total-candidat') ?><!--</h6>-->
<!--                    </div>-->
<!--                    <div class="mt-2">-->
<!--                        <h3 class="mb-2">--><?//= $total_candidat ?><!--</h3>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-md-3 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <div class="d-flex justify-content-between align-items-baseline">-->
<!--                        <h6 class="card-title mb-0">--><?//= trans('dashboard.total-course') ?><!--</h6>-->
<!--                    </div>-->
<!--                    <div class="mt-2">-->
<!--                        <h3 class="mb-2">--><?//= $total_course ?><!--</h3>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-xl-12 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <h6 class="card-title">--><?//= trans('dashboard.note-exam-overview') ?><!--</h6>-->
<!--                    <div id="apexScatter"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-xl-6 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <h6 class="card-title">--><?//= trans('dashboard.avg-note-by-class') ?><!--</h6>-->
<!--                    <div id="apexDonut"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-xl-6 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <h6 class="card-title">--><?//= trans('dashboard.avg-note-by-course') ?><!--</h6>-->
<!--                    <div id="apexPie"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-xl-6 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <h6 class="card-title">--><?//= trans('dashboard.rating-question') ?><!--</h6>-->
<!--                    <div id="apexRadialBar"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-xl-6 grid-margin stretch-card">-->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!--                    <h6 class="card-title">--><?//= trans('dashboard.total-question-by-type-in-course') ?><!--</h6>-->
<!--                    <div id="apexRadar"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    --><?php
}
