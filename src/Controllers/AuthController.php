<?php

namespace Examai\Examai\Controllers;

use Examai\Examai\Models\Enseignant;
use Examai\Examai\Middleware\ConnectedMiddleware;

class AuthController
{
    // we cannot do checking if user already connected here because we have a logout method  not need that
    // the solution need to define checking middleware in every method except logout
    public function __construct()
    {
        // check if user not connected
        // if user not connected redirect to login page
        // if all this method of controller required authentification call this method in __construct
        // ConnectedMiddleware::check();
    }

    // interface of login page
    // if user login incorrect i use session login_erreur for tell to the user password or email incorrect
    public function loginView()
    {
        ConnectedMiddleware::check();

        require_once ROOT . '/src/Views/auth/login.php';

        if (isset($_SESSION['login_erreur']))
            unset($_SESSION['login_erreur']);
    }

    // a pseudo algorithm for making a success login
    // get user by email , checking the password, telling user what algo said :)
    // case of success authentification : stored connected user to session with key has a connected_user
    // case if check remember me: stored id of connected user in authentification cookie
    public function login()
    {
        ConnectedMiddleware::check();

        $email = request_data('email');
        $password = request_data('password');
        $remember = request_data('remember');
        $enseignant = Enseignant::getEnseignantByEmail($email);
        if (empty($enseignant) || !($enseignant->MOT_DE_PASSE === $password)) {
            $_SESSION['login_erreur'] = 'Email or  password incorrect!';
            header('Location: /login.php');
            exit;
        }

        if ($remember) {
            $cookie_name = "authentification";
            $cookie_value = $enseignant->getID();
            setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
        }

        $_SESSION['connected_user'] = serialize($enseignant);
        header('Location: /index.php');

    }


    // interface of register page
    // if user login put invalide data i use session register_erreur for tell to the user what data is not valide
    public function registerView()
    {
        ConnectedMiddleware::check();

        require_once ROOT . '/src/Views/auth/register.php';

        if (isset($_SESSION['register_erreur']))
            unset($_SESSION['register_erreur']);
    }


    // a pseudo algorithm for making a success inscription
    // get data , checking the data, redirect user to login :)
    // case if data is not valid: redirect to register page with a register_erreur session
    public function register()
    {
        ConnectedMiddleware::check();

        $first_name = request_data('first_name');
        $last_name = request_data('last_name');
        $email = request_data('email');
        $password = request_data('password');


        try {
            $enseignant = new Enseignant();
            if (empty($first_name))
                throw new \Exception('Firstname required!');
            if (!preg_match('/^[a-zA-Z]+$/', $first_name))
                throw new \Exception('Firstname must be only letters!');

            if (!preg_match('/^[a-zA-Z]{3,}$/', $first_name))
                throw new \Exception('Firstname must be great then 2 caractere!');


            if (empty($last_name))
                throw new \Exception('Lastname required!');

            if (!preg_match('/^[a-zA-Z]+$/', $last_name))
                throw new \Exception('Lastname must be only letters!');

            if (!preg_match('/^[a-zA-Z]{3,}$/', $last_name))
                throw new \Exception('Lastname must be great then 2 caractere!');


            if (empty($email))
                throw new \Exception('Email required!');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                throw new \Exception('Email Field must be email!');

            if (empty($password))
                throw new \Exception('Password required!');

            if (strlen($password) < 6)
                throw new \Exception('Password Must be great then or equal 5 caractere!');

            $enseignant->PRENOM_ENSEIGNANT = $first_name;
            $enseignant->NOM_ENSEIGNANT = $last_name;
            $enseignant->EMAIL = $email;
            $enseignant->MOT_DE_PASSE = $password;
        } catch (\Exception $e) {
            $_SESSION['register_erreur'] = $e->getMessage();
            header('Location: /register.php');
            exit;
        }

        $bd_teacher = Enseignant::getEnseignantByEmail($email);
        if (!empty($bd_teacher)) {
            $_SESSION['register_erreur'] = 'Email already exists!';
            header('Location: /register.php');
            exit;
        }

        $valide = $enseignant->create();
        if ($valide) {
            header('Location: /login.php');
        } else {
            $_SESSION['register_erreur'] = 'Teacher Not Inserted!';
            header('Location: /register.php');
            exit;
        }
    }

    // a pseudo algorithm for logout
    // concept of logout:
    // first of all when know a user login i need an exists connected_user session or an authentification  cookie
    // so for logout i need only delete this keys (connected_user session) and (authentification  cookie)
    public function logout()
    {
        session_start();
        if (request_cookie('authentification')) {
            setcookie("authentification", "", time() - 10, "/");
        }

        if (request_session('connected_user')) {
            unset($_SESSION['connected_user']);
        }

        header('Location: /login.php');
    }
}