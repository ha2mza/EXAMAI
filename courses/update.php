<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\CourseController;

if (is_method('POST')) {
    $home = new CourseController();
    $home->update();
} else
    notfound_request('');
