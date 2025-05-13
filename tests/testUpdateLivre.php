<?php
    // Test de la fonction addAuteur
    include "../modele/mesFonctionsAccesBDD.php";
    $pdo = dbConnection("bibliothecaire", "2b6X2zp@wqCz*WT[");
    var_dump(updateLivre($pdo, 5, "gjngd", "./img/Roman/Etranger.jpg", "sgddghjkfg", "2025-03-17", 1, 19));

    dbDisconnect($pdo);
?>