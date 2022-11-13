<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

use Examai\Examai\Controllers\AuthController;

if (is_method('GET')) {
	$auth = new AuthController();
	$auth->registerView();
} elseif (is_method('POST')) {
	$auth = new AuthController();
	$auth->register();
}



