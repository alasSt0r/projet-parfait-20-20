<?php

//  Partie d'appel au modèle si besoin 
include "modele/mesFonctionsAccesBDD.php";

// Partie de traitement des données récupérées si besoin pour mise à disposition de la vue

//Instanciation de la connexion 
$unObjPDO = dbConnection();

//Appel de la fonction getGenres
$lesGenres = getGenres($unObjPDO);

if (isset($_GET['titre'])) {
    $titre = $_GET['titre'];
}else{
    $titre = "";
}

if (isset($_GET['genre'])) {
    $genre = $_GET['genre'];
}else{
    $genre = "";
}

if (isset($_GET['titre']) || isset($_GET['genre'])) {
    $lesLivres = getLivresByTitreAndGenre($unObjPDO, $titre, $genre);
}

//Fermeture de la connexion
dbDisconnect($unObjPDO);

// appel du script de vue qui permet de gerer l'affichage des donnees
include "vue/vueChercher.php";
?>