<?php

 // Verification de la session
// Si la session n'est pas démarrée, rediriger vers la page de connexion
session_start();
if (!isset($_SESSION['bibliothecaire'])) {
    header("Location: index.php?action=connexion");
    exit();
}

//  Partie d'appel au modèle si besoin 


// Message de succès si le livre a été ajouté avec succès
if (isset($_GET['message'])) {  
    $message = $_GET['message'];
    if ($message == 'success') {
        echo "<script type='text/javascript'>alert('Auteur ajouté avec succès !');</script>";
    } 
}
// Partie de traitement des données récupérées si besoin pour mise à disposition de la vue




// appel du script de vue qui permet de gerer l'affichage des donnees
include "vue/vueAjouterAuteur.php";
?>