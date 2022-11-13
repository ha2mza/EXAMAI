<?php

if (in_array($_GET['lang'], array('en', 'fr', 'ar')))
    setcookie('lang', $_GET['lang'], time() + (86400 * 120 * 365), "/"); // 86400 = 1 day


if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else
    header('Location: /index.php');
