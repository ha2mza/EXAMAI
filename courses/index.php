<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\CourseController;

if (is_method('GET')) {
    $home = new CourseController();
    $home->indexView();
} elseif (is_method('POST')) {
    $home = new CourseController();
    $home->index();
}

