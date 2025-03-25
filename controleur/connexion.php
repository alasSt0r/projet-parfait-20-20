<?php
session_start();
// Si l'utilisateur est déjà connecté, il est redirigé vers le menu.
if (isset($_SESSION['bibliothecaire'])) {
    header("Location: index.php?action=menu");
    exit();
}
include "vue/vueLogin.php";
?>
