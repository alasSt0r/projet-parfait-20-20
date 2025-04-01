<?php
    // Test de la fonction getLivresByTitreAndGenre
    include "../modele/mesFonctionsAccesBDD.php";
    $unObjPDO = dbConnection();
    $livres = getLivres($unObjPDO);
    var_dump($livres);
    dbDisconnect($unObjPDO);
    var_dump($livres);
?>