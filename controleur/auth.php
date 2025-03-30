<?php
session_start();
require_once __DIR__ . '/../modele/mesFonctionsAccesBDD.php';

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
    $_SESSION['bibliothecaire'] = $login;
    header("Location: ../index.php?action=menu");
    exit();
} catch (PDOException $e) {
    $_SESSION['error'] = "Identifiants incorrects.";
    header("Location: ../index.php?action=connexion");
    exit();
}
?>
