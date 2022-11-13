<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ExamAI Marks N: <?= $GLOBALS['exam']->ID_EXAMEN ?> / <?= $GLOBALS['cour']->NOM_COUR ?></title>
    <style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #000000;
            color: white;
        }
    </style>
</head>
<body>
<h1 style="text-align: center;"><?= trans('exam.marks') ?> <?= $GLOBALS['cour']->NOM_COUR ?></h1>
<table class="table table-bordered w-100">
    <thead>
    <tr>
        <th><?= trans('candidat.last-name') ?></th>
        <th><?= trans('candidat.first-name') ?></th>
        <th><?= trans('candidat.email') ?></th>
        <th><?= trans('exam.mark') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($GLOBALS['marks'] as $index => $mark) {
        ?>

        <tr>
            <td><?= $mark->candidat->NOM ?></td>
            <td><?= $mark->candidat->PRENOM ?></td>
            <td><?= $mark->candidat->EMAIL ?></td>
            <td><?= $mark->NOTE ?? '-----' ?></td>
        </tr>

        <?php
    }
    ?>
    </tbody>
</table>

</body>
</html>