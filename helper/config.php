<?php
/*  a global definition needed in exam-ai app
case 1: when require some file need a ROOT define
case 2: when need load a spécifique file or a spécifique url need  DOMAIN define
*/

if (!defined('DOMAIN')) {
    // Get the server's IP address
    $serverIp = $_SERVER['SERVER_ADDR'];
    // Define the domain constant with the current IP address and port
    define('DOMAIN', 'http://' . $serverIp . ':3500');
}

if (!defined('ROOT'))
    define('ROOT', $_SERVER['DOCUMENT_ROOT']);


/* get form data with detection if exist or not */
function request_data($key)
{
    return isset($_POST[$key]) ? $_POST[$key] : null;
}

/* get form data with detection if exist or not */
function request_input($key, $default = null)
{
    $target = array_merge($_GET, $_POST);
    if (!is_array($key))
        $key = explode('.', $key);

    foreach ($key as $i => $segment) {
        unset($key[$i]);
        if (isset($target[$segment])) {
            $target = $target[$segment];
        } else {
            return $default;
        }
    }

    return $target;
}

/* get cookie with detection if exist or not */
function request_cookie($key)
{
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
}

/* get session with detection if exist or not */

function request_session($key)
{
    return $_SESSION[$key] ?? null;
}

/* get query params with detection if exist or not */
function request_param($key)
{
    return isset($_GET[$key]) ? $_GET[$key] : null;
}

/* for testing method get or post */
function is_method($method)
{
    return strtolower($_SERVER['REQUEST_METHOD']) === strtolower($method);
}

/* connected user function return a  user connected for this app */
function auth_user()
{
    return unserialize(request_session('connected_user'));
}

/* get the current lang if user  give me a fake key or the cookie lang not exists this function give me default key (en) */
function current_lang()
{
    $translator = request_cookie('lang');
    if (!in_array($translator, array('ar', 'en', 'fr'))) {
        $translator = 'en';
    }
    return $translator;
}

/* flag lang return a flag for current lang */
function flag_lang()
{
    $lang = current_lang();
    $flags = ['en' => 'us', 'ar' => 'ma', 'fr' => 'fr'];

    return $flags[$lang];
}

/* flag name return a name of flag for current lang */
function flag_name()
{
    $lang = current_lang();
    $flags = ['en' => 'English', 'ar' => 'العربية', 'fr' => 'Francais'];

    return $flags[$lang];
}


function ok_request($data)
{
    header('ContentType: Application/json');
    http_response_code(200);
    echo json_encode($data, JSON_NUMERIC_CHECK);
    exit;
}

function bad_request($message)
{
    header('ContentType: Application/json');
    http_response_code(403);
    if (!empty($message))
        echo json_encode(['message' => $message]);
    exit;
}

function notfound_request($message)
{
    header('ContentType: Application/json');
    http_response_code(404);
    if (!empty($message))
        echo json_encode(['message' => $message]);
    exit;
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
