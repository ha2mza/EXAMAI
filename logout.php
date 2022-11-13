<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

use Examai\Examai\Controllers\AuthController;

$auth = new AuthController();
$auth->logout();
exit;