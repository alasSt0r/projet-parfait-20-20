<div class="menuchercher">




    <div class="menuchercherChamps">
        <form method="POST" action="index.php?action=chercher" class="formchercher">
        
            
            <input class="barrerecherche" type="text" name="titre" placeholder="Titre">

            <input class="barrerecherche" type="text" name="auteur" placeholder="Auteur">
            

            <p>
            <select class="menu-deroulant" name="genre" id="chercher">
            <option value="">Genre</option>
                <option value="1">Roman</option>
                <option value="2">Science Fiction</option>
                <option value="3">BD</option>
                <option value="4">Manga</option>
                <option value="5">Documentaire</option>
        </select>
            </p>

           
            <input class="barrerecherche" type="Date" name="datesortie" placeholder="Date">

            <input class="barrerecherche" type="text" name="cotation" placeholder="Cotation">
            
            <div class="menuchercherChamps">
            <form class = "formerchercher">

            <button type="submit">Recherche</button>

    </form>
    </div>




    <div class="resultatrecherche">
        <?php
            if (isset($AllLivres)) {
                foreach ($AllLivres as $unLivre) {
                echo "<div class='livrecard'>";
                    echo "<p>Titre: " . htmlspecialchars($unLivre['titre']) . "</p>";
                    echo "<p>Auteur : " . htmlspecialchars($unLivre['auteur']) . "</p>";
                    echo "<p>Genre: " . htmlspecialchars($unLivre['genre']) . "</p>";
                    echo "<p>Date Sortie: " . htmlspecialchars($unLivre['datesortie']) . "</p>";
                    echo "<p>Cotation:" . htmlspecialchars($unLivre['cotation']) . "</p>";
                echo "</div>";
                
            }
        }
        ?>
    
    </div>
    <!--
    echo "<img class='imglivre' src='".htmlspecialchars($unLivre['photo'])."'/>";
    -->

</div>