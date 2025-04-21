<?php
include "../modele/mesFonctionsAccesBDD.php";
error_reporting(E_ALL); 
ini_set("display_errors", 1);
$unObjPDO = dbConnection();

// Récupération directe de l'ID
$idLivre = $_POST['id'];
$livre = getLivreById($unObjPDO, $idLivre);

dbDisconnect($unObjPDO);
use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();

$dompdf->setPaper('A4', 'portrait');

$dompdf->loadHtml('
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1> Information sur le livre</h1>
    <table>
        <tr>
            <th>Titre</th>
            <td>' . $livre['titre'] . '</td>
        </tr>
        <tr>
            <th>Auteur</th>
            <td>' . $livre['nom'] . ' ' . $livre['prenom'] . '</td>
        </tr>
        <tr>
            <th>Genre</th>
            <td>' . $livre['genre'] . '</td>
        </tr>
        <tr>
            <th>Date de sortie</th>
            <td>' . $livre['datesortie'] . '</td>
        </tr>
        <tr>
            <th>Résumé</th>
            <td>' . $livre['resume'] . '</td>
        </tr>
    </table>
</body>
</html>
');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream('livre.pdf');