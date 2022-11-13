<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\ExamPassController;

if (is_method('GET')) {
    $home = new ExamPassController();
    $home->indexView();
}
