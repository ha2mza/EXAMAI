<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\ClasseController;

if (is_method('POST')) {
    $home = new ClasseController();
    $home->delete();
} else
    notfound_request('');
