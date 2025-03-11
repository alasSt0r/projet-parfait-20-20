<?php 

    // Fonction de connexion à la base de données
    function dbConnection()
    {try{
        $unObjPDO = new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8','userBiblio','y2gKnyq>he*4&JY');
        }catch(PDOException $e){
            die('Erreur : '.$e->getMessage());
        }
        return $unObjPDO;
    }

    // Fonction qui ferme la connexion à la base de données
    function dbDisconnect($unObjPDO){
        $unObjPDO = null;
    }

    

?>