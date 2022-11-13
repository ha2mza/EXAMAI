<?php

require_once ROOT . '/src/Views/layouts/passage.php';

function script_init()
{

}

function style_init()
{

}

function content_init()
{
    global $candidat, $exam, $cour, $id;
    ?>


    <div class="slider-item">
        <h1 class="slider-title">ExamAI - <?= $cour->NOM_COUR ?> , <?= $exam->COMMENCE_A ?></h1>
        <p class="slider-text">
            Bonjour, <b><?= $candidat->NOM ?> <?= $candidat->PRENOM ?></b> Saisie la cle de l'examen pour vous
            donner l'autorisation de passer l'examen
            <i class="fa-solid fa-symbols ms-2"></i>
        </p>
        <b class="text-warning">Votre Connexion doit être support au moins <b>1G</b></b>
        <input class="form-control form-control-lg mw-300px" type="text" form="candidat-auth-exam" name="CODE">
        <nav>
            <form id="candidat-auth-exam" action="<?= DOMAIN . '/passage/' ?>" method="get">
                <input type="hidden" name="LINK" value="<?= $id ?>">
            </form>
            <button type="submit" form="candidat-auth-exam" class="btn btn-lg btn-dark">
                <i class="fa-solid fa-play mr-1"></i>
                Commencer l'examen c'est facile !
            </button>
        </nav>
    </div>

    <?php
}