<?php

use Examai\Examai\Models\Candidat;
use Examai\Examai\Models\Candidat_classe;
use Examai\Examai\Models\Candidat_passage;
use Examai\Examai\Models\Candidat_repondre;
use Examai\Examai\Models\Classe;
use Examai\Examai\Models\Cour;
use Examai\Examai\Models\Enseignant;
use Examai\Examai\Models\Examen;
use Examai\Examai\Models\Question;
use Examai\Examai\Models\Question_type;

require_once dirname(__FILE__) . '/../vendor/autoload.php';


echo ($unique_id);
exit;
//Connection::$db = 'examai_1';
//Connection::instance()->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
$candidates = [];

try {

    /* create candidat */
    $candidates[0] = new Candidat();
    $candidates[0]->NOM = 'Test';
    $candidates[0]->PRENOM = 'test';
    $candidates[0]->EMAIL = 'test-' . random_int(1, 99) . '@gmail.com';
    $candidates[0]->MOT_DE_PASSE = '123456';
    $candidates[0]->create();

    /* create candidat */
    $candidates[1] = new Candidat();
    $candidates[1]->NOM = 'Khadija';
    $candidates[1]->PRENOM = 'El aouni';
    $candidates[1]->EMAIL = 'elaounikhadija28-' . random_int(1, 99) . '@gmail.com';
    $candidates[1]->MOT_DE_PASSE = '123456';
    $candidates[1]->create();

    /* create candidat */
    $candidates[2] = new Candidat();
    $candidates[2]->NOM = 'Mouad';
    $candidates[2]->PRENOM = 'Makboul';
    $candidates[2]->EMAIL = 'mouadmakboul8-' . random_int(1, 99) . '@gmail.com';
    $candidates[2]->MOT_DE_PASSE = '123456';
    $candidates[2]->create();

    /* create candidat */
    $candidates[3] = new Candidat();
    $candidates[3]->NOM = 'Hamza';
    $candidates[3]->PRENOM = 'Moukhlis';
    $candidates[3]->EMAIL = 'hamz.moukhlis-' . random_int(1, 99) . '@gmail.com';
    $candidates[3]->MOT_DE_PASSE = '123456';
    $candidates[3]->create();

    echo "Candidat Success Creation \n";

} catch (Exception $e) {
    echo "Candidat Failed Creating \n";
}

try {
    /* update candidat */
    $candidates[3]->PRENOM = 'Test';
    $candidates[3]->update();

    echo "Candidat Updated Success \n";
} catch (Exception $e) {
    echo "Candidat Failed Updating \n";
}


try {
    /* list candidat */

    $candidates = Candidat::get();
    echo "Candidat matched a " . count($candidates) . "\n";
} catch (Exception $e) {
    echo "Candidat failed matching \n";
}


/* Inscription Enseignant */
$enseignant = Enseignant::getEnseignantByEmail('chbihi@outlook.com');
if ($enseignant) {
    $enseignant->NOM_ENSEIGNANT = 'Reda';
    $enseignant->update();
    echo "Enseignant Success Updating \n";
} else {
    $enseignant = new Enseignant();
    $enseignant->NOM_ENSEIGNANT = 'Redaa';
    $enseignant->PRENOM_ENSEIGNANT = 'Chbihi';
    $enseignant->MOT_DE_PASSE = '123456';
    $enseignant->EMAIL = 'chbihi@outlook.com';
    $enseignant->create();
    echo "Enseignant Success Creating \n";
}


/* Creation Classe */
$classe = Classe::getClasseByCode('FSACSID2022');
if (!$classe) {
    $classe = new Classe();
    $classe->ID_ENSEIGNANT = $enseignant->getID();
    $classe->NOM_CLASSE = 'FSAC SID 2022';
    $classe->ANNEE = 2022;
    $classe->CODE = 'FSACSID2022';
    $classe->create();
    echo "Classe Fsac SID 2022 Success Creating \n";
} else
    echo "Classe Fsac SID 2022 already creating \n";


$classe = Classe::getClasseByCode('FSACRES2022');
if (!$classe) {
    $classe = new Classe();
    $classe->ID_ENSEIGNANT = $enseignant->getID();
    $classe->NOM_CLASSE = 'FSAC RES 2022';
    $classe->ANNEE = 2022;
    $classe->CODE = 'FSACRES2022';
    $classe->create();
    echo "Classe Fsac RES 2022 Success Creating \n";
} else
    echo "Classe Fsac RES 2022 already creating \n";


$classe = Classe::getClasseByCode('FSACBDD2022');
if (!$classe) {
    $classe = new Classe();
    $classe->ID_ENSEIGNANT = $enseignant->getID();
    $classe->NOM_CLASSE = 'FSAC BDD 2022';
    $classe->ANNEE = 2022;
    $classe->CODE = 'FSACBDD2022';
    $classe->create();
    echo "Classe Fsac BDD 2022 Success Creating \n";
} else
    echo "Classe Fsac BDD 2022 already creating \n";


$cour = new Cour();
$cour->ID_ENSEIGNANT = $enseignant->getID();
$cour->NOM_COUR = 'JAVA';
$cour->create();
echo "Cour JAVA create \n";

$cour = new Cour();
$cour->ID_ENSEIGNANT = $enseignant->getID();
$cour->NOM_COUR = 'C#';
$cour->create();
echo "Cour C# create \n";

$cour->NOM_COUR = 'C';
$cour->update();
echo "Cour C# change to c \n";


$cour = new Cour();
$cour->ID_ENSEIGNANT = $enseignant->getID();
$cour->NOM_COUR = 'PHP';
$cour->create();
echo "Cour PHP create \n";


$courses = Cour::get();
echo "Courses matched a " . count($courses) . "\n";

foreach ($courses as $cours) {
    $question = new Question();
    $question->ID_COUR = $cours->getID();
    $question->ID_QUESTION_TYPE = Question_type::ONECHOICE;
    $question->TITRE = 'Anne De Creation ' . $cours->NOM_COUR . '?';
    $choices = [
        ['titre' => 1997, 'correct' => false],
        ['titre' => 1996, 'correct' => false],
        ['titre' => 1993, 'correct' => false],
        ['titre' => 1992, 'correct' => true]
    ];
    $question->CHOIX = json_encode($choices);
    $question->POSITION = 1;
    $question->create();

    $question = new Question();
    $question->ID_COUR = $cours->getID();
    $question->ID_QUESTION_TYPE = Question_type::MULTICHOICE;
    $question->TITRE = 'Select correct keyword ' . $cours->NOM_COUR . '?';
    $choices = [
        ['titre' => 'programmation oriente objet', 'correct' => true],
        ['titre' => 'mécatronique', 'correct' => false],
        ['titre' => 'réseaux', 'correct' => false],
        ['titre' => 'language', 'correct' => true]
    ];
    $question->CHOIX = json_encode($choices);
    $question->POSITION = 2;
    $question->create();

    $question = new Question();
    $question->ID_COUR = $cours->getID();
    $question->ID_QUESTION_TYPE = Question_type::SWITCH;
    $question->TITRE = $cours->NOM_COUR . ' is a library?';
    $choices = [
        ['titre' => 'Yes', 'correct' => false],
        ['titre' => 'No', 'correct' => true]
    ];
    $question->CHOIX = json_encode($choices);
    $question->POSITION = 3;
    $question->create();
    echo "questions attached to course " . $cours->NOM_COUR . PHP_EOL;
}

