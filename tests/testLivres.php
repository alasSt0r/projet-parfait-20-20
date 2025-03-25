<?php
    // Test de la fonction getLivresByTitreAndGenre
    include "../modele/mesFonctionsAccesBDD.php";
    $unObjPDO = dbConnection();
    $ToutLivres = getLivres($unObjPDO,$pdo);
    var_dump($Tout_Livres);
    dbDisconnect($unObjPDO);
    var_dump($ToutLivres);
?>