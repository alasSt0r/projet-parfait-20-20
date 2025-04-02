<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//  Partie d'appel au modèle si besoin 
include "../modele/mesFonctionsAccesBDD.php";

// Partie de traitement des données récupérées si besoin pour mise à disposition de la vue

//Instanciation de la connexion
$pdo = dbConnection("bibliothecaire", "2b6X2zp@wqCz*WT[");

// Recupération des chemins d'accès
$lesGenres = getGenres($pdo);

// Ajout d'un livre
$titre = htmlspecialchars($_POST['titre']);
$nom_origine_complet = $_FILES['photo']['tmp_name'];
$genre = htmlspecialchars($_POST['genre']);
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
$titreDestination = strtolower($titreDestination);
$nom_destination = '../img/' .$chemin . '/' .$titreDestination.'.jpg';
$auteur = htmlspecialchars($_POST['auteur']);
$datesortie = htmlspecialchars($_POST['datesortie']);
$resume = htmlspecialchars($_POST['resume']);
if(move_uploaded_file($nom_origine_complet, $nom_destination)) {
    echo "Le fichier a été téléchargé avec succès.";
} else {
    echo "Erreur lors du téléchargement du fichier.";
}
try {

    $photo = $nom_destination;
    addLivre($pdo, $titre, $photo, $genre, $auteur, $datesortie, $resume);

} catch (Exception $e) {
    echo "Erreur lors de l'ajout du livre : " . $e->getMessage();
} finally {
    dbDisconnect($pdo); // Ferme la connexion à la base de données
}
exit();

// appel du script de vue qui permet de gerer l'affichage des donnees
header("Location: ../index.php?action=ajouterLivre");
exit();
?>