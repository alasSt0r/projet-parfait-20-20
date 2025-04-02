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

// Partie de traitement des données

//Instanciation de la connexion

$pdo = dbConnection("bibliothecaire", "2b6X2zp@wqCz*WT[");

// on récupère les variables du formulaire

$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$datenaissance = htmlspecialchars($_POST['datenaissance']);


// On ajoute l'auteur à la base de données

try {
    addAuteur($pdo, $nom, $prenom, $datenaissance);
    echo 'ca a marché';

} catch (Exception $e) {
    echo "Erreur lors de l'ajout de l'auteur : " . $e->getMessage();
} finally {
    dbDisconnect($pdo); // Ferme la connexion à la base de données
}
var_dump($nom, $prenom, $datenaissance);
echo "<br>";
exit();
// Redirection vers la page d'ajout d'auteur
// avec un message de succès

header("Location: ../index.php?action=ajouterAuteur&message=success");
exit();
?>