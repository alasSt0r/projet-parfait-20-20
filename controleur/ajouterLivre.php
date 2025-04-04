<?php

 // Verification de la session
// Si la session n'est pas démarrée, rediriger vers la page de connexion
session_start();
if (!isset($_SESSION['bibliothecaire'])) {
    header("Location: index.php?action=connexion");
    exit();
}

//  Partie d'appel au modèle si besoin
include_once "modele/mesFonctionsAccesBDD.php";

// Message de succès si le livre a été ajouté avec succès
if (isset($_GET['message'])) {  
    $message = $_GET['message'];
    if ($message == 'success') {
        echo "<script type='text/javascript'>alert('Livre ajouté avec succès !');</script>";
    } elseif ($message == 'error') {
        echo '<script type="text/javascript">alert("Le fichier n\'est pas une image valide. Seules les images au format .jpg, .jpeg ou .png sont acceptées.");</script>';
    }
} 
    
// Partie de traitement des données récupérées si besoin pour mise à disposition de la vue

//Instanciation de la connexion 
$unObjPDO = dbConnection();

//Appel de la fonction getGenres
$lesGenres = getGenres($unObjPDO);

//Appel de la fonction getAuteurs
$lesAuteurs = getAuteurs($unObjPDO);

// appel du script de vue qui permet de gerer l'affichage des donnees
include "vue/vueAjouterLivre.php";
?>