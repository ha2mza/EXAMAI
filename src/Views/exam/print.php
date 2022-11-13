<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ExamAI N: <?= $GLOBALS['exam']->ID_EXAMEN ?> / <?= $GLOBALS['cour']->NOM_COUR ?></title>
    <style>
        .option-icon img {
            width: 100%;
            height: 100%;
        }

        .option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
        }

        .option-icon {
            width: 15px;
            height: 15px;
            float: right;
            text-align: right;
            margin-top: -20px;
        }

        .clear {
            clear: both;
        }

        * {
            font-family: sans-serif;
        }

        h1 {
            margin: 10px 0;
            font-size: 1.5em;
        }

        .candidat-info {
            margin-bottom: 25px;
        }

        .candidat-info table {
            border-collapse: collapse;
            width: 100%;
        }

        .candidat-info table td, .candidat-info table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>
<body>
<h1 style="text-align: center;"><?= $GLOBALS['cour']->NOM_COUR ?></h1>
<div class="candidat-info">
    <table>
        <thead>
        <tr>
            <th width="33%">Nom:</th>
            <th width="33%">Prénom:</th>
            <th width="33%">Note:</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td width="33%" style="height: 50px"></td>
            <td width="33%" style="height: 50px"></td>
            <td width="33%" style="height: 50px"></td>
        </tr>
        </tbody>
    </table>
</div>

<?php foreach ($GLOBALS['questions'] as $index => $question) {
    $options = json_decode($question->CHOIX);
    ?>
    <p><b><?= ($index + 1) . '. ' . $question->TITRE ?></b></p>

    <?php foreach ($options as $option) {
        ?>
        <div class="option">
            <div class="option-text">
                <?= $option->titre ?>
            </div>
            <div class="option-icon">
                <img src='data:image/png;base64,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'/>
            </div>
        </div>

        <div class="clear"></div>
        <?php
    } ?>
    <?php
} ?>

</body>
</html>