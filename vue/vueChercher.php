<div class="menuchercher">
    <form class="formchercher" method="POST">
        <input type="hidden" name="action" value="chercher">

        <input class="barrerecherche" type="text" name="titre" placeholder="Titre">

        <input class="barrerecherche" type="text" name="auteur" placeholder="Auteur">


        <select class="genreselect" name="genre">
            <option value="">Genre</option>
            <?php foreach ($lesGenres as $unGenre): ?>
                <option value="<?= htmlspecialchars($unGenre['genre']) ?>"><?= htmlspecialchars($unGenre['genre']) ?></option>
            <?php endforeach; ?>
        </select>

        <input class="barrerecherche" type="Date" name="datesortie" placeholder="Date">

        <input class="barrerecherche" type="text" name="cotation" placeholder="Cotation">



        <button class="boutonrechercher" type="submit">
            <img class="loupe" src="./img/loupe.png" alt="Rechercher">
        </button>



    </form>




<?php /*
    <?php if (!empty($AllLivres)): ?>
        <div class="resultatrecherche">
            <?php
                if (isset($AllLivres)) {
                    foreach ($AllLivres as $unLivre) {
                        echo "<div class='livrecard'>"; 
                        ?>

                        <a href="./index.php?action=livre&id=<?= htmlspecialchars($unLivre['id']) ?>" class="livre-link">
                        <img src="<?= htmlspecialchars($unLivre['photo'] ?: './img/default-book.png') ?>" alt="Image du livre">
                        <p><strong><?= htmlspecialchars($unLivre['titre']) ?></strong></p>
                        </a>

                    <?php

                
                    }   
                }
            ?>
        </div>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
*/ ?>




    <?php  if (!empty($AllLivres)): ?>
        <div class="resultatrecherche">
            <?php foreach ($AllLivres as $unLivre ): ?>
                <div class="livrecard">
                    <a href="./index.php?action=livre&id=<?= htmlspecialchars($unLivre['id']) ?>" class="unLivre-link">
                        <img src="<?= htmlspecialchars($unLivre['photo'] ?: './img/default-book.png') ?>" alt="Image du unLivre">
                        <p><strong><?= htmlspecialchars($unLivre['titre']) ?></strong></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>










    <?php /*




    
    <?php  if (!empty($lesLivres)): ?>
        <div class="resultatrecherche">
            <?php foreach ($lesLivres as $livre ): ?>
                <div class="livrecard">
                    <a href="./index.php?action=livre&id=<?= htmlspecialchars($livre['id']) ?>" class="livre-link">
                        <img src="<?= htmlspecialchars($livre['photo'] ?: './img/default-book.png') ?>" alt="Image du livre">
                        <p><strong><?= htmlspecialchars($livre['titre']) ?></strong></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
    */ ?>

</div>

