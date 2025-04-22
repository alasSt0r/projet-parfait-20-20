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

// Chemin absolu vers l'image locale
$imagePath = dirname(__DIR__) . ltrim($livre['photo'], '.'); // Correction pour remonter d'un niveau

// Vérifiez si le fichier image existe
if (file_exists($imagePath)) {
    // Encodez l'image en base64
    $imageData = base64_encode(file_get_contents($imagePath));
    // Déterminez le type MIME de l'image
    $imageMimeType = mime_content_type($imagePath);
    // Préparez l'image encodée pour l'inclure dans le HTML
    $imageBase64 = 'data:' . $imageMimeType . ';base64,' . $imageData;
} else {
    $imageBase64 = ''; // Si l'image n'existe pas, laissez vide ou utilisez une image par défaut
    echo "L'image n'existe pas.";
    echo "<br>";
    echo $imagePath;
    exit;
}

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

        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-container img {
            width: auto;
            max-height: 100%;
        }
    </style>
</head>
<body>
    <h1> Information sur le livre</h1>
    <table>
        <tr>
            <th>Titre</th>
            <td>' . htmlspecialchars($livre['titre']) . '</td>
        </tr>
        <tr>
            <th>Auteur</th>
            <td>' . htmlspecialchars($livre['nom']) . ' ' . htmlspecialchars($livre['prenom']) . '</td>
        </tr>
        <tr>
            <th>Genre</th>
            <td>' . htmlspecialchars($livre['genre']) . '</td>
        </tr>
        <tr>
            <th>Date de sortie</th>
            <td>' . htmlspecialchars($livre['datesortie']) . '</td>
        </tr>
        <tr>
            <th>Résumé</th>
            <td>' . htmlspecialchars($livre['resume']) . '</td>
        </tr>
    </table>
    <br>
    <div class="image-container">
        <img src="' . $imageBase64 . '" alt="Couverture du livre">
    </div>
</body>
</html>
');

// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream('livre.pdf');