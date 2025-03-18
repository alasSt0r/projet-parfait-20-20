<?php
    // Test de la fonction getLivresByTitreAndGenre
    include "../modele/mesFonctionsAccesBDD.php";
    $unObjPDO = dbConnection();
    $lesLivres = getLivresByTitreAndGenre($unObjPDO, "Le", "Roman");
    var_dump($lesLivres);
    dbDisconnect($unObjPDO);
    var_dump($lesLivres);
?>