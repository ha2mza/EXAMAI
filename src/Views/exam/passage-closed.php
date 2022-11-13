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
        <h1 class="slider-title">ExamAI - Actuellement non autorisé <i class="fas fa-exclamation"></i></h1>
        <p class="slider-text">
            Bonjour, <b><?= $candidat->NOM ?> <?= $candidat->PRENOM ?></b> votre exam <b><?= $cour->NOM_COUR ?></b> maintenant n'est pas
            disponible
        </p>
        <nav>
            <button class="btn btn-lg btn-dark">
                Ops! Vous pouvez réessayer plus tard
            </button>
        </nav>
    </div>

    <?php
}