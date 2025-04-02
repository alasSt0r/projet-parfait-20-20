<div class="menucontact">
    <h1>Ajouter un auteur</h1>
    <form method="post" action="controleur/scriptAjoutAuteur.php" enctype="multipart/form-data">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        <label>Prénom :</label>
        <input type="text" name="prenom">
        <label>Date de naissance :</label>
        <input type="date" name="datenaissance" required>
        <br><br>
        <button type="submit">Ajouter</button>
    </form>
</div>
