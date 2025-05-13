<div class="menuchercher">
    <h1>Modifier la Bibliothèque</h1>
    <form class="formchercher" method="GET">
        <input type="hidden" name="action" value="modifierLivre">
        <input class="barrerecherche" type="text" name="titre" placeholder="Rechercher un livre">
        <select class="genreselect" name="genre">
            <option value="">Genre</option>
            <?php foreach ($lesGenres as $unGenre): ?>
                <option value="<?= htmlspecialchars($unGenre['id']) ?>"><?= htmlspecialchars($unGenre['genre']) ?></option>
            <?php endforeach; ?>
        </select>
        <button class="boutonrechercher" type="submit">
            <img class="loupe" src="./img/loupe.png" alt="Rechercher">
        </button>
    </form>
    <?php if (!empty($lesLivres)): ?>
        <div class="resultatrecherche">
            <?php foreach ($lesLivres as $livre): ?>
                <div class="livrecard">
                    <img src="<?= htmlspecialchars($livre['photo'] ?: './img/default-book.png') ?>" alt="Image du livre">
                    <p><strong><?= htmlspecialchars($livre['titre']) ?></strong></p>
                    <p>Cotation : <?= isset($livre['cotation']) ? htmlspecialchars($livre['cotation']) : 'N/A' ?></p>
                    <a href="./index.php?action=modifierLivre&id=<?= htmlspecialchars($livre['id']) ?>" class="bouton-supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</a>
                    <a href="./index.php?action=modifierLivreForm&id=<?= htmlspecialchars($livre['id']) ?>" class="bouton-modifier">Modifier</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
    <?php if (isset($_GET['message'])): ?>
        <?php if ($_GET['message'] == 'deleted'): ?>
            <p class="success-messageD">Le livre a été supprimé avec succès.</p>
        <?php elseif ($_GET['message'] == 'updated'): ?>
            <p class="success-messageM">Le livre a été modifié avec succès.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>