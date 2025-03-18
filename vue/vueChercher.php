<div class="menuchercher">
    <form method="GET">
        <input class="invisible" type="text" name="action" value="chercher">
        <input class="barrerecherche" type="text" name="titre" placeholder="Rechercher">
        <select name="genre">
            <option value="">--genre--</option>
            <?php
            foreach ($lesGenres as $unGenre) {
                echo "<option value='" . $unGenre['genre'] . "'>" . $unGenre['genre'] . "</option>";
            }
            ?>
        </select>
        <button class="boutonrecherche" type="submit" name="submit"><img class="loupe" src="./img/loupe.png" /></button>
    </form>

    <div class="resultatrecherche">
        <ul>
            <?php
            if (isset($lesLivres)) {
                foreach ($lesLivres as $unLivre) {
                    echo "<li>" . $unLivre['titre'] . "</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</div>