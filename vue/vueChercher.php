<div class="menuchercher">
    <form class="formchercher" method="GET">
        <input class="invisible" type="text" name="action" value="chercher">
        <input class="barrerecherche" type="text" name="titre" placeholder="Rechercher">
        <select class="genreselect" name="genre">
            <option value="">Genre</option>
            <?php
            foreach ($lesGenres as $unGenre) {
                echo "<option value='" . $unGenre['genre'] . "'>" . $unGenre['genre'] . "</option>";
            }
            ?>
        </select>
        <button class="boutonrecherche" type="submit" name="submit"><img class="loupe" src="./img/loupe.png" /></button>
    </form>

    <div class="resultatrecherche">

        <?php
        if (isset($lesLivres)) {
            foreach ($lesLivres as $unLivre) {
                echo "<div class='livrecard'>";
                echo "<p>" . htmlspecialchars($unLivre['titre']) . "</p>";
                echo "<img class='imglivre' src='".htmlspecialchars($unLivre['photo'])."'/>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>