<?php

 // Verification de la session
// Si la session n'est pas démarrée, rediriger vers la page de connexion
session_start();
if (!isset($_SESSION['bibliothecaire'])) {
    header("Location: index.php?action=connexion");
    exit();
}

//Affichage des erreurs(ne sse voit pas car cette page n'est pas affichée à cause du header à la fin)

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//  Partie d'appel au modèle si besoin 

include "../modele/mesFonctionsAccesBDD.php";
include "../autre/mesFonctionsDivers.php";

// Partie de traitement des données

//Instanciation de la connexion

$pdo = dbConnection("bibliothecaire", "2b6X2zp@wqCz*WT[");

// Recupération des genres

$lesGenres = getGenres($pdo);

// on récupère les variables du formulaire

$titre = htmlspecialchars($_POST['titre']);
$genre = htmlspecialchars($_POST['genre']);
$auteur = htmlspecialchars($_POST['auteur']);
$datesortie = htmlspecialchars($_POST['datesortie']);
$resume = htmlspecialchars($_POST['resume']);

// Vérification de l'extension du fichier

$mots = explode(".", $_FILES['photo']['name']);
$extension = strtolower(end($mots));
if (!isValidImage($extension)) {
    header("Location: ../index.php?action=ajouterLivre&message=error");
    exit();
}

// On prédeterine le chemin d'accès de la photo

$chemin = "";
foreach ($lesGenres as $unGenre) {
    if ($unGenre['genre'] == $genre) {
        $chemin = $unGenre['chemin'];
    }
}
$titreDestination = "";
for ($i = 0; $i < strlen($titre); $i++) {
    if ($titre[$i] != ' ') {
        $titreDestination .= $titre[$i];
    }
}
$nom_origine_complet = $_FILES['photo']['tmp_name'];
$titreDestination = strtolower($titreDestination);
$nom_destination = '../img/' .$chemin . '/' .$titreDestination.'.jpg';

// On déplace le fichier téléchargé vers le répertoire de destination

if (!is_dir('../img/' .$chemin)) {
    mkdir('../img/' .$chemin, 0755, true); // Crée le répertoire si nécessaire
}
if(move_uploaded_file($nom_origine_complet, $nom_destination)) {
    echo "Le fichier a été téléchargé avec succès.<br><br>";
} else {
    echo "Erreur lors du téléchargement du fichier.";
}

// On ajoute le livre à la base de données

try {

    $photo = './img/' .$chemin . '/' .$titreDestination.'.jpg';
    addLivre($pdo, $titre, $photo, $genre, $auteur, $datesortie, $resume);

} catch (Exception $e) {
    echo "Erreur lors de l'ajout du livre : " . $e->getMessage();
} finally {
    dbDisconnect($pdo); // Ferme la connexion à la base de données
}


// Redirection vers la page d'ajout de livre
// avec un message de succès

header("Location: ../index.php?action=ajouterLivre&message=success");
exit();
?>