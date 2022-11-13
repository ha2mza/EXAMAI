<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\ClasseController;

if (is_method('GET')) {
    $home = new ClasseController();
    $home->indexView();
} elseif (is_method('POST')) {
    $home = new ClasseController();
    $home->index();
}

