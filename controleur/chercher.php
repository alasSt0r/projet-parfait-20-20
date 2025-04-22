<?php

//  Partie d'appel au modèle si besoin 
include "modele/mesFonctionsAccesBDD.php";

// Partie de traitement des données récupérées si besoin pour mise à disposition de la vue

//Instanciation de la connexion 
$unObjPDO = dbConnection();

$lesGenres = getGenres($unObjPDO);




// Récupération des paramètres de l'URL ou initialisation à vide
if (isset($_POST['titre'])) {
    $titre = $_POST['titre'];
}else{
    $titre = "";
}

if (isset($_POST['genre'])) {
    $genre = $_POST['genre'];
}else{
    $genre = "";
}

if (isset($_POST['auteur'])) {
    $auteur = $_POST['auteur'];
}else{
    $auteur = "";
}

if (isset($_POST['datesortie'])) {
    $datesortie = $_POST['datesortie'];
}else{
    $datesortie = "";
}

if (isset($_POST['cotation'])) {
    $cotation = $_POST['cotation'];
}else{
    $cotation = "";
}

if (isset($_POST['titre']) || isset($_POST['genre']) || isset($_POST['auteur']) || isset($_POST['datesortie']) || isset($_POST['cotation'])) {
    $AllLivres = getLivresByFiveParametre($unObjPDO, $titre, $auteur, $genre, $datesortie, $cotation);
}
else {
    $AllLivres = getLivres($unObjPDO);
}

/*

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
else {
    $lesLivres = getLivres($unObjPDO);
}

*/



//Fermeture de la connexion
dbDisconnect($unObjPDO);

// appel du script de vue qui permet de gerer l'affichage des donnees
include "vue/vueChercher.php";
?>


