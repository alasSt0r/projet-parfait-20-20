<?php

session_start();
if (!isset($_SESSION['bibliothecaire'])) {
    header("Location: index.php?action=connexion");
    exit();
}

include "modele/mesFonctionsAccesBDD.php";

$unObjPDO = dbConnection("bibliothecaire", "2b6X2zp@wqCz*WT[");

// Suppression du livre avec l'id
if (isset($_GET['id'])) {
    $idLivre = intval($_GET['id']);
    try {
        $requete = "DELETE FROM Livres WHERE id = :id";
        $stmt = $unObjPDO->prepare($requete);
        $stmt->bindParam(':id', $idLivre, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: index.php?action=modifierLivre&message=deleted");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la suppression du livre : " . $e->getMessage();
    }
}

// Récupération des genres
$lesGenres = getGenres($unObjPDO);

// Récupération des critères de recherche
if (isset($_GET['titre'])) {
    $titre = htmlspecialchars(trim($_GET['titre']));
} else {
    $titre = "";
}

if (isset($_GET['genre'])) {
    $genre = htmlspecialchars(trim($_GET['genre']));
} else {
    $genre = "";
}

// Recherche des livres si des critères sont fournis
if (isset($_GET['titre']) || isset($_GET['genre'])) {
    $lesLivres = getLivresByTitreAndGenre($unObjPDO, $titre, $genre);
}

// Fermeture de la connexion
dbDisconnect($unObjPDO);

// Appel de la vue
include "vue/vueModifierLivre.php";
?>