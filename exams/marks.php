<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\ExamController;

$home = new ExamController();
if (is_method('GET')) {
    $home->viewMarks();
}