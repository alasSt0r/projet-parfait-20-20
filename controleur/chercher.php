<?php

//  Partie d'appel au modèle si besoin 


// Partie de traitement des données récupérées si besoin pour mise à disposition de la vue

if (isset($_GET['titre'])) {
    $recherche = $_GET['titre'];

    //Instanciation de la connexion 
    $unObjPDO = dbConnection();

    //Appel de la fonction getLivresByTitre
    $lesLivres = getLivresByTitre($unObjPDO, $recherche);
}

// appel du script de vue qui permet de gerer l'affichage des donnees
include "vue/vueChercher.php";
?>