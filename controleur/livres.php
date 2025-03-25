<?php

//  Partie d'appel au modèle si besoin 

include "./modele/mesFonctionsAccesBDD.php";

$unObjPDO = dbConnection();
$ToutLivres = getLivres($unObjPDO);
// Partie de traitement des données récupérées si besoin pour mise à disposition de la vue




// appel du script de vue qui permet de gerer l'affichage des donnees
include "vue/vueLivres.php";
?>