<div class="menucontact">
    <h1>Modifier un livre</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Titre :</label>
        <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>
        <br><br>
        <label>Photo :</label>
        <input type="file" name="photo">
        <?php if (!empty($livre['photo'])): ?>
            <img src="<?= htmlspecialchars($livre['photo']) ?>" alt="Photo actuelle" style="max-width: 100px;">
        <?php endif; ?>
        <br><br>
        <label>Genre :</label>
        <select name="id_genre" required>
            <option value="">Genre</option>
            <?php foreach ($lesGenres as $genre): ?>
                <option value="<?= htmlspecialchars($genre['id']) ?>" <?= $genre['id'] == $livre['id'] ? 'selected' : '' ?>><?= htmlspecialchars($genre['genre']) ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label>Auteur :</label>
        <select name="id_auteur" required>
            <option value="">Auteur</option>
            <?php foreach ($lesAuteurs as $auteur): ?>
                <option value="<?= $auteur['id'] ?>" <?= $auteur['id'] == $livre['id'] ? 'selected' : '' ?>><?= htmlspecialchars($auteur['prenom'] . ' ' . $auteur['nom']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" onclick="window.location.href='index.php?action=ajouterAuteur'">Ajouter un auteur</button>
        <br><br>
        <label>Date de sortie :</label>
        <input type="date" name="datesortie" value="<?= htmlspecialchars($livre['datesortie']) ?>" required>
        <br><br>
        <label>Résumé :</label>
        <textarea name="resume" rows="4" cols="50" required><?= htmlspecialchars($livre['resume']) ?></textarea>
        <br><br>
        <label>Cotation :</label>
        <input type="text" name="cotation" value="<?= isset($livre['cotation']) ? htmlspecialchars($livre['cotation']) : '' ?>" required>
        <br><br>
        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>

