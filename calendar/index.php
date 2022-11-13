<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Examai\Examai\Controllers\HomeController;

$home = new HomeController();
$home->calendarView();