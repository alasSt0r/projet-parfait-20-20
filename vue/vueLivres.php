<h1 class = "title_color">Ensemble de livres</h1>
<p class = "title_color"> Voici une partie des livres que l'on possède</p>

<div class="livres-container">
    <?php
    
    foreach ($ToutLivres as $livre) {
        echo "<div class='livre'>";
        echo "<p><strong>N° :</strong> " . $livre["id"] . "</p>";
        echo "<p><strong>Titre :</strong> " . $livre["titre"] . "</p>";
        echo "<p><strong>Auteur :</strong> " . $livre["auteur"] . "</p>";
        echo "<p><strong>Genre :</strong> " . $livre["genre"] . "</p>";
        echo "<p><strong>Résumé :</strong> " . $livre["resume"] . "</p>";
        echo "</div>";
    }

    dbDisconnect($unObjPDO);
    ?>
</div>