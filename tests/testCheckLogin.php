<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../modele/mesFonctionsAccesBDD.php';

// Connexion à la base de données
$pdo = conDBbibliothecaire();

// Définition des identifiants de test
$login_test = "bibliothecaire"; 
$password_test = "2b6X2zp@wqCz*WT["; 

// Appel de la fonction pour tester la connexion
if (connectionBibli($pdo, $login_test, $password_test)) {
    echo "Connexion réussie pour l'utilisateur : $login_test";
} else {
    echo "Échec de la connexion : Identifiants incorrects.";
}
?>
