<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\ExamController;

if (is_method('GET')) {
    $home = new ExamController();
    $home->indexView();
} elseif (is_method('POST')) {
    $home = new ExamController();
    $home->index();
}

