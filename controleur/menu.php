<?php 
session_start();
if (!isset($_SESSION['bibliothecaire'])) {
    header("Location: index.php?action=connexion");
    exit();
}

include "vue/vueMenu.php";
?>