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
        case 'cotation_asc':
            usort($ToutLivres, function($a, $b) {
                preg_match('/[A-Z]+)-(\d+)/', $a['cotation'], $matchesA);
                preg_match('/[A-Z]+)-(\d+)/', $b['cotation'], $matchesB);
                $prefixe = strcmp($matchesA[1], $matchesB[1]);
                if ($prefixe !== 0) {
                    return $prefixe;
                }
                return intval($matchesA[2]) - intval($matchesB[2]);
            });
        case 'cotation_desc':
            usort($ToutLivres, function($a, $b) {
                preg_match('/[A-Z]+)-(\d+)/', $a['cotation'], $matchesA);
                preg_match('/[A-Z]+)-(\d+)/', $b['cotation'], $matchesB);
                $prefixe = strcmp($matchesB[1], $matchesA[1]);
                if ($prefixe !== 0) {
                    return $prefixe;
                }
                return intval($matchesB[2]) - intval($matchesA[2]);
            });
            break;
    }
}




// appel du script de vue qui permet de gerer l'affichage des donnees
include "vue/vueLivres.php";
?>