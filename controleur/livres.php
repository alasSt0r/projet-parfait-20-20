<?php

//  Partie d'appel au modèle si besoin 

include "./modele/mesFonctionsAccesBDD.php";

$unObjPDO = dbConnection();
$ToutLivres = getLivres($unObjPDO);
// Partie de traitement des données récupérées si besoin pour mise à disposition de la vue

if(isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    switch ($sort) {
        case 'titre_asc':
            usort($ToutLivres, function($a, $b) {
                return strcmp($a['titre'], $b['titre']);
            });
            break;
        case 'titre_desc':
            usort($ToutLivres, function($a, $b) {
                return strcmp($b['titre'], $a['titre']);
            });
            break;
        case 'auteur_asc':
            usort($ToutLivres, function($a, $b) {
                return strcmp($a['nom'] . ' ' . $a['prenom'], $b['nom'] . ' ' . $b['prenom']);
            });
            break;
        case 'auteur_desc':
            usort($ToutLivres, function($a, $b) {
                return strcmp($b['nom'] . ' ' . $b['prenom'], $a['nom'] . ' ' . $a['prenom']);
            });
            break;
        case 'cotation_asc':
            usort($ToutLivres, function($a, $b) {
                $prefixeA = trim(substr($a['cotation'], 0, 1));
                $prefixeB = trim(substr($b['cotation'], 0, 1));
                $numA = trim(substr($a['cotation'], 1));
                $numB = trim(substr($b['cotation'], 1));
                $prefixe = strcmp($prefixeA, $prefixeB);
                if ($prefixe !== 0) {
                    return $prefixe;
                }
                return intval($numB) - intval($numA);
            });
            break;
        case 'cotation_desc':
            usort($ToutLivres, function($a, $b) {
                $prefixeA = trim(substr($a['cotation'], 0, 1));
                $prefixeB = trim(substr($b['cotation'], 0, 1));
                $numA = trim(substr($a['cotation'], 1));
                $numB = trim(substr($b['cotation'], 1));
                $prefixe = strcmp($prefixeB, $prefixeA);
                if ($prefixe !== 0) {
                    return $prefixe;
                }
                return intval($numA) - intval($numB);
            });
            break;
    }
}




// appel du script de vue qui permet de gerer l'affichage des donnees
include "vue/vueLivres.php";
?>