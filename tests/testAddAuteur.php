<?php
    // Test de la fonction addAuteur
    include "../modele/mesFonctionsAccesBDD.php";
    $pdo = dbConnection("bibliothecaire", "2b6X2zp@wqCz*WT[");
    $result = addAuteur($pdo, "Nom Auteur", "Prenom Auteur", "2000-01-01");
    var_dump($result);
    dbDisconnect($pdo);
?>