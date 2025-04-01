<h1 class = "title_color">Ensemble de livres</h1>
<p class = "title_color"> Voici une partie des livres que l'on possède</p>

<div class="livres-container">
    <?php
    
    foreach ($ToutLivres as $livre) {
        echo "<a href='livre.php?id=" . $livre["id"] . "' class='livre-link'>"; // ✅ Ajout du lien autour du div
        echo "<div class='livre'>";
        echo "<p><strong>ID :</strong> " . $livre["id"] . "</p>";
        echo "<p><strong>Titre :</strong> " . $livre["titre"] . "</p>";
        echo "<p><strong>Auteur :</strong> " . $livre["prenom"] . " " . $livre["nom"] . "</p>";
        echo "<p><strong>Résumé :</strong> " . $livre["resume"] . "</p>";
        echo "</div>";
        echo "</a>";
    }

    dbDisconnect($unObjPDO);
    ?>
</div>