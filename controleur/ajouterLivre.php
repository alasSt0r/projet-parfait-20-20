<?php

//  Partie d'appel au modèle si besoin 
session_start();
if (!isset($_SESSION['bibliothecaire'])) {
    header("Location: index.php?action=connexion");
    exit();
}
include_once "modele/mesFonctionsAccesBDD.php";

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