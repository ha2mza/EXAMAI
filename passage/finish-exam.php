<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\ExamPassController;

if (is_method('POST')) {
    $home = new ExamPassController();
    $home->CloseExam();
}
