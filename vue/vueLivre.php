<div class="menu-livre">
    <h1 class="titre-livre"><?php echo htmlspecialchars($livre['titre']); ?></h1>
    <div class="contenu-livre">
        <div class="details-livre">
            <p><strong>Auteur :</strong> 
                <?php 
                echo htmlspecialchars($livre['prenom']) . " " . htmlspecialchars($livre['nom']); 
                if ($livre['date_naissance'] === '0000-00-00') {
                    echo " (naissance : inconnue)";
                } else {
                    $dateNaissance = DateTime::createFromFormat('Y-m-d', $livre['date_naissance']);
                    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                    echo " (naissance : " . $formatter->format($dateNaissance) . ")";
                }
                ?>
            </p>
            <p><strong>Résumé :</strong> <?php echo htmlspecialchars($livre['resume']); ?></p>
            <p><strong>Date de sortie :</strong> 
                <?php 
                $dateSortie = DateTime::createFromFormat('Y-m-d', $livre['datesortie']);
                $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                echo $formatter->format($dateSortie); 
                ?>
            </p>
            <p><strong>Genre :</strong> <?php echo htmlspecialchars($livre['genre']); ?></p>
        </div>
        <div class="image-livre">
            <img src="<?php echo htmlspecialchars($livre['photo']); ?>" alt="Couverture du livre">
        </div>
    </div>
    <div class="actions-livre">
        <form method="post" action="autre/pdf.php">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="bouttonmenu">Télécharger le PDF</button>
        </form>
        <a href="index.php" class="bouttonmenu">Retour à la liste des livres</a>
    </div>
</div>
<br>