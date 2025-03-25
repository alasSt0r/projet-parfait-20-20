<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once __DIR__ . '/../modele/mesFonctionsAccesBDD.php';

// Recupartion du form de login.php
$login = htmlspecialchars(trim($_POST['login']));
$password = htmlspecialchars(trim($_POST['password']));


// Appel de la fonction qui vérifie les identifiants
if (connectionBibli( $login, $password)) {
    // Si les identifiants sont corrects, on enregistre le login en session
    $_SESSION['bibliothecaire'] = $login;
    // On redirige vers le menu du bibliothécaire
    header("Location: ../index.php?action=menu");
    exit();
} else {
    // Sinon, on affiche un message d'erreur et on propose de revenir à la page de connexion
    echo "Identifiants incorrects. <a href='../vue/vueLogin.php'>Réessayer</a>";
}
include "vue/vueLogin.php";
?>