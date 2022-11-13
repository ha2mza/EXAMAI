<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\CandidatController;

if (is_method('POST')) {
    $home = new CandidatController();
    $home->delete();
} else
    notfound_request('');
