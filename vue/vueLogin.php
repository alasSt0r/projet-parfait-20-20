<?php if (isset($_SESSION['error'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<div class="menucontact">
    <h1>Connexion Bibliothécaire</h1>
    <form method="post" action="controleur/auth.php">
        <label>Login :</label>
        <input type="text" name="login" required>
        <br><br>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
</div>