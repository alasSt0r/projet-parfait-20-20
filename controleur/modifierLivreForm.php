<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['bibliothecaire'])) {
    header("Location: index.php?action=connexion");
    exit();
}

include "modele/mesFonctionsAccesBDD.php";
include "autre/mesFonctionsDivers.php";

$unObjPDO = dbConnection("bibliothecaire", "2b6X2zp@wqCz*WT[");

// Récupération des informations du livre à modifier
if (isset($_GET['id'])) {
    $idLivre = intval($_GET['id']);
    $livre = getLivreById($unObjPDO, $idLivre);
    if (!$livre) {
        echo "Livre introuvable.";
        exit();
    }
} else {
    echo "ID du livre manquant.";
    exit();
}

// Récupération des genres et auteurs
$lesGenres = getGenres($unObjPDO);
$lesAuteurs = getAuteurs($unObjPDO);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = htmlspecialchars(trim($_POST['titre']));
    $resume = htmlspecialchars(trim($_POST['resume']));
    $datesortie = htmlspecialchars(trim($_POST['datesortie']));
    $idGenre = intval($_POST['id_genre']);
    $idAuteur = intval($_POST['id_auteur']);
    $cotation = htmlspecialchars(trim($_POST['cotation']));

    $chemin = getGenreById($unObjPDO, $idGenre); 

    // Vérification de l'extension du fichier
    if (!empty($_FILES['photo']['name'])) {
        // Tout le traitement de l’image
        $mots = explode(".", $_FILES['photo']['name']);
        $extension = strtolower(end($mots));
        if (!isValidImage($extension)) {
            header("Location: ../index.php?action=ajouterLivre&message=error");
            exit();
        }

        // On prédeterine le chemin d'accès de la photo

        $titreDestination = "";
        for ($i = 0; $i < strlen($titre); $i++) {
            if ($titre[$i] != ' ') {
                $titreDestination .= $titre[$i];
            }
        }
        $nom_origine_complet = $_FILES['photo']['tmp_name'];
        $titreDestination = strtolower($titreDestination);
        $nom_destination = './img/' .$chemin . '/' .$titreDestination.'.jpg';
        // On déplace le fichier téléchargé vers le répertoire de destination

        if (!is_dir('./img/' .$chemin)) {
            mkdir('./img/' .$chemin, 0755, true); // Crée le répertoire si nécessaire
        }
        if(move_uploaded_file($nom_origine_complet, $nom_destination)) {
            echo "Le fichier a été téléchargé avec succès.<br><br>";
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
        $photo = './img/' .$chemin . '/' .$titreDestination.'.jpg';

    } else {
        $photo = $livre['photo']; // On garde l’ancienne photo
    }

    
    try {
        updateLivre($unObjPDO, $idLivre, $titre, $photo, $resume, $datesortie, $idGenre, $idAuteur, $cotation);

        header("Location: index.php?action=modifierLivre&message=updated");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la mise à jour du livre : " . $e->getMessage();
    }
}
else{




// Appel de la vue
include "vue/vueModifierLivreForm.php";
}
?>