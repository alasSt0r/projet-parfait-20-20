<?php
function controleurPrincipal($action){
    $lesActions = array();
    $lesActions["defaut"] = "accueil.php";
    $lesActions["chercher"] = "chercher.php";
    $lesActions["contact"] = "contact.php";
    $lesActions["genre"] = "genre.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["menu"] = "menu.php";
    $lesActions["livres"] = "livres.php";
    $lesActions["livre"] = "livre.php";
    
    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }

}

?>