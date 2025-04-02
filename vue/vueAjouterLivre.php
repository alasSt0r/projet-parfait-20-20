<div class="menucontact">
    <h1>Ajouter un livre</h1>
    <form method="post" action="controleur/scriptAjoutLivre.php" enctype="multipart/form-data">
        <label>Titre :</label>
        <input type="text" name="titre" required>
        <br><br>
        <label>Photo :</label>
        <input type="file" name="photo" required>
        <br><br>
        <label>Genre :</label>
        <select name="genre" required>
            <option value="">Genre</option>
            <?php
            foreach ($lesGenres as $unGenre) {
                echo "<option value='" . $unGenre['genre'] . "'>" . $unGenre['genre'] . "</option>";
            }
            ?>
        </select>
        <label>Auteur :</label>
        <select name="auteur" required>
            <option value="">Auteur</option>
            <?php
            foreach ($lesAuteurs as $unAuteur) {
                echo "<option value='" . $unAuteur['id'] . "'>" . $unAuteur['nom'] . " " . $unAuteur['prenom'] . "</option>";
            }

            ?>
        </select>
        <br><br>
        <label>Date de sortie :</label>
        <input type="date" name="datesortie" required>
        <br><br>
        <label>Résumé :</label>
        <textarea name="resume" rows="4" cols="50" required></textarea>
        <br><br>
        <button type="submit">Ajouter</button>
    </form>
</div>
