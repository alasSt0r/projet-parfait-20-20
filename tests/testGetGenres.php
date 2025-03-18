<?php
    // Test de la fonction getGenres
    include "../modele/mesFonctionsAccesBDD.php";
    $unObjPDO = dbConnection();
    $lesGenres = getGenres($unObjPDO);
    var_dump($lesGenres);
    dbDisconnect($unObjPDO);
    var_dump($lesGenres);
?>