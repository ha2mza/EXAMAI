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
    global $candidat, $exam, $cour;
    ?>

    <div class="slider-item">
        <h1 class="slider-title">ExamAI - EXAMEN DE <?= $cour->NOM_COUR ?> <i class="fas fa-exclamation"></i></h1>
        <p class="slider-text">
            Bonjour, <b><?= $candidat->NOM ?> <?= $candidat->PRENOM ?></b> votre exam est verrouillé
            <b class="text-danger d-block">Contacter votre enseignement</b>
        </p>
    </div>

    <?php
}