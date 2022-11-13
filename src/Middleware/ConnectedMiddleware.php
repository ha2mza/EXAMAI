<?php

namespace Examai\Examai\Middleware;
session_start();

use Examai\Examai\Models\Enseignant;

abstract class ConnectedMiddleware
{
    static function check()
    {
        if (request_cookie('authentification')) {
            $enseignant = Enseignant::getEnseignantById(request_cookie('authentification'));
            $_SESSION['connected_user'] = serialize($enseignant);
        }

        if (request_session('connected_user')) {
            header('Location: /index.php');
            exit;
        }
    }
}

