<?php
session_start();

if($_SERVER['request'])


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ExamAI - PASSING TEST</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="all.min.css">
    <script src="all.min.js"></script>

    <style>


    </style>
</head>
<body>

<div class="slider-item">
    <h1 class="slider-title">ExamAI - {CLASS}  {COUR} , {DATE}</h1>
    <p class="slider-text">
        Saisie le mot de passe de l'examen pour vous donner l'autorisation de passer l'examen
        <i class="fa-solid fa-symbols ms-2"></i>
    </p>
    <b class="text-warning">Votre Connexion doit être support au moins <b>1G</b></b>
    <input class="form-control form-control-lg mw-300px" type="text">
    <nav>
        <button class="btn btn-lg btn-dark" onclick="NextQuestion()">
            <i class="fa-solid fa-play mr-1"></i>
            Commencer l'examen c'est facile !
        </button>
    </nav>
</div>
<div class="slider-item">
    <div class="slider-previous font-weight-bold" onclick="PreviousQuestion()">
        <i class="fa-light fa-arrow-up me-2"></i>
        Previous
    </div>
    <h1 class="slider-title">1. Lequel des éléments suivants n’est pas un concept POO en Java?</h1>
    <p class="slider-text">Question Une Seul Choix</p>

    <nav>
        <button class="btn btn-lg btn-outline-primary m-1">
            Héritage
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Encapsulation
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Polymorphisme
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Compilation
        </button>

    </nav>

    <nav>
        <button class="btn btn-primary" onclick="NextQuestion()">
            <i class="fa-light fa-arrow-down me-2"></i>
            Next Question
        </button>
    </nav>
</div>
<div class="slider-item">
    <div class="slider-previous font-weight-bold" onclick="PreviousQuestion()">
        <i class="fa-light fa-arrow-up me-2"></i>
        Previous
    </div>
    <h1 class="slider-title">2. Lequel des éléments suivants n’est pas un concept POO en Java?</h1>
    <p class="slider-text">Question Une Seul Choix</p>

    <nav>
        <button class="btn btn-lg btn-outline-primary m-1">
            Héritage
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Encapsulation
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Polymorphisme
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Compilation
        </button>

    </nav>

    <nav>
        <button class="btn btn-primary" onclick="NextQuestion()">
            <i class="fa-light fa-arrow-down me-2"></i>
            Next Question
        </button>
    </nav>
</div>
<div class="slider-item">
    <div class="slider-previous font-weight-bold" onclick="PreviousQuestion()">
        <i class="fa-light fa-arrow-up me-2"></i>
        Previous
    </div>
    <h1 class="slider-title">3. Lequel des éléments suivants n’est pas un concept POO en Java?</h1>
    <p class="slider-text">Question Une Seul Choix</p>

    <nav>
        <button class="btn btn-lg btn-outline-primary m-1">
            Héritage
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Encapsulation
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Polymorphisme
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Compilation
        </button>

    </nav>

    <nav>
        <button class="btn btn-primary" onclick="NextQuestion()">
            <i class="fa-light fa-arrow-down me-2"></i>
            Next Question
        </button>
    </nav>
</div>
<div class="slider-item">
    <div class="slider-previous font-weight-bold" onclick="PreviousQuestion()">
        <i class="fa-light fa-arrow-up me-2"></i>
        Previous
    </div>
    <h1 class="slider-title">4. Lequel des éléments suivants n’est pas un concept POO en Java?</h1>
    <p class="slider-text">Question Une Seul Choix</p>

    <nav>
        <button class="btn btn-lg btn-outline-primary m-1">
            Héritage
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Encapsulation
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Polymorphisme
        </button>

        <button class="btn btn-lg btn-outline-primary m-1">
            Compilation
        </button>

    </nav>

    <nav>
        <button class="btn btn-primary" onclick="NextQuestion()">
            <i class="fa-light fa-arrow-down me-2"></i>
            Next Question
        </button>
    </nav>
</div>

</body>
</html>