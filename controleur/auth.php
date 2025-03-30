<?php
session_start();
require_once __DIR__ . '/../modele/mesFonctionsAccesBDD.php';

<<<<<<< HEAD
// Vérifie que le formulaire a bien été soumis
if (!isset($_POST['login']) || !isset($_POST['password'])) {
    header("Location: ../index.php?action=connexion");
    exit();
}

// Récupération des identifiants du formulaire
$login = htmlspecialchars($_POST['login']);
$password = $_POST['password'];

// Tente de se connecter avec ces identifiants
try {
    $pdo = dbConnection($login, $password);
=======
// Recupartion du form de login.php
$login = htmlspecialchars(trim($_POST['login']));
$password = htmlspecialchars(trim($_POST['password']));


// Appel de la fonction qui vérifie les identifiants
if (connectionBibli( $login, $password)) {
    // Si les identifiants sont corrects, on enregistre le login en session
>>>>>>> refs/remotes/origin/main
    $_SESSION['bibliothecaire'] = $login;
    header("Location: ../index.php?action=menu");
    exit();
} catch (PDOException $e) {
    $_SESSION['error'] = "Identifiants incorrects.";
    header("Location: ../index.php?action=connexion");
    exit();
}
?>
