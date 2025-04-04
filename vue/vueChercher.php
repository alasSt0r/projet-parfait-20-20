<div class="menuchercher">
    <form class="formchercher" method="GET">
        <input type="hidden" name="action" value="chercher">
        <input class="barrerecherche" type="text" name="titre" placeholder="Rechercher">
        <select class="genreselect" name="genre">
            <option value="">Genre</option>
            <?php foreach ($lesGenres as $unGenre): ?>
                <option value="<?= htmlspecialchars($unGenre['genre']) ?>"><?= htmlspecialchars($unGenre['genre']) ?></option>
            <?php endforeach; ?>
        </select>
        <button class="boutonrechercher" type="submit">
            <img class="loupe" src="./img/loupe.png" alt="Rechercher">
        </button>
    </form>
    <?php if (!empty($lesLivres)): ?>
        <div class="resultatrecherche">
            <?php foreach ($lesLivres as $unLivre): ?>
                <div class="livrecard">
                    <a href="./index.php?action=livre&id=<?= htmlspecialchars($unLivre['id']) ?>" class="livre-link">
                        <img src="<?= htmlspecialchars($unLivre['photo'] ?: './img/default-book.png') ?>" alt="Image du livre">
                        <p><strong><?= htmlspecialchars($unLivre['titre']) ?></strong></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
</div>