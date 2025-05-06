<div class="menuchercher">
    <form class="formorder" method="GET">
        <input type="hidden" name="action" value="livres">
        <button type="submit" name="sort" value="titre_asc">Trier par Titre (A-Z)</button>
        <button type="submit" name="sort" value="titre_desc">Trier par Titre (Z-A)</button>
        <button type="submit" name="sort" value="auteur_asc">Trier par Auteur (A-Z)</button>
        <button type="submit" name="sort" value="auteur_desc">Trier par Auteur (Z-A)</button>
</div>
<div class="livres-container">
    <?php
    foreach ($ToutLivres as $livre) {
        echo "<a href='./index.php?action=livre&id=" . htmlspecialchars($livre["id"]) . "' class='livre-link-vueLivres'>";
        echo "<div class='livrecard-vueLivres'>";
        echo "<p><strong>Titre : </strong> " . htmlspecialchars($livre["titre"]) . "</p>";
        echo "<p><strong>Auteur :</strong> " . htmlspecialchars($livre["prenom"]) . " " . htmlspecialchars($livre["nom"]) . "</p>";
        echo "<p><strong>Résumé : </strong>" . htmlspecialchars($livre["resume"]) . "</p>";
        echo "<img class='imglivre' src='" . htmlspecialchars($livre["photo"]) . "'/>";
        echo "</div>";
        echo "</a>";
    }
    ?>
</div>
