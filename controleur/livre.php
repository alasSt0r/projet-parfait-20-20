<?php
include "./modele/mesFonctionsAccesBDD.php";
error_reporting(E_ALL); 
ini_set("display_errors", 1);
$unObjPDO = dbConnection();

// Récupération directe de l'ID
$idLivre = $_GET['id'];
$livre = getLivreById($unObjPDO, $idLivre);

dbDisconnect($unObjPDO);
include "vue/vueLivre.php";
?>