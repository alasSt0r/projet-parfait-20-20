<?php

/**
 * Fonction pour vérifier si un fichier est bien en .jpg, .jpeg ou .png
 * @param string $fileName Le nom du fichier à vérifier
 * @return bool True si le fichier est valide, sinon false
 */
function isValidImage($fileName) {
    $validExtensions = ["jpg", "jpeg", "png"];
    $valeurDeRetour = false;
    for ($i = 0; $i < count($validExtensions); $i++) {
        if ($fileName == $validExtensions[$i]) {
            return true;
       
        }
    }
    return $valeurDeRetour;
}