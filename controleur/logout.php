<?php
session_start();
session_destroy(); // On détruit la session
header("Location: ../index.php?action=connexion"); // On redirige vers la page de connexion
exit();
?>
