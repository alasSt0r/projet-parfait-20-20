<?php
    // Test de la fonction getGenres
    include "../modele/mesFonctionsAccesBDD.php";
    $unObjPDO = dbConnection();
    updateLivre($unObjPDO, 7, "ffjhg", "./img/Roman/Etranger.jpg", "sdgfdgdfgdg", "1945-02-12", 1, 19) ;
    dbDisconnect($unObjPDO);
?>