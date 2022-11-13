<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\CourseController;

$home = new CourseController();
if (is_method('GET')) {
    $home->questions();
} else
    $home->change_questions();
