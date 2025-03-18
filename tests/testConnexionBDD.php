<?php
    // Test de connexion à la base de données
    include "../modele/mesFonctionsAccesBDD.php";
    $unObjPDO = dbConnection();
    var_dump($unObjPDO);
    dbDisconnect($unObjPDO);
    var_dump($unObjPDO);

    //test
?>