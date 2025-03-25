<h1>Ensemble de livres</h1>
<p> Voici une partie des livres que l'on possède</p>

<?php
    // Test de la fonction getLivresByTitreAndGenre
    include "../modele/mesFonctionsAccesBDD.php";
    $unObjPDO = dbConnection();
    $ToutLivres = getLivres($unObjPDO);

    foreach ($ToutLivres as $livre) {
        echo "<strong>ID :</strong> " . $livre["id"] . "<br>";
        echo "<strong>Titre :</strong> " . $livre["titre"] . "<br>";
        echo "<strong>ID Auteur :</strong> " . $livre["id_auteur"] . "<br>";
        echo "<strong>Résumé :</strong> " . $livre["resume"] . "<br><br>";
    }

    dbDisconnect($unObjPDO);
?>