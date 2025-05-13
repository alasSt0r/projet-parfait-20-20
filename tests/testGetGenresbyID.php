<?php
    // Test de la fonction getGenres
    include "../modele/mesFonctionsAccesBDD.php";
    $unObjPDO = dbConnection();
    $leGenre = getGenreById($unObjPDO, 2);
    var_dump($leGenre);
    dbDisconnect($unObjPDO);
?>