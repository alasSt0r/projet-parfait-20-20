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

    // Fonction qui execute la requete $requete passée en paramètre et renvoie le tableau de résultat
    function dbRequest($unobjPDO, $requete){
        $unObjPDOStatement = $unobjPDO->prepare($requete);
        $unObjPDOStatement->execute();
        $unObjPDOQuery = $unObjPDOStatement->fetchAll;
        return $unObjPDOQuery;
    }

    // Fonction qui ferme la connexion à la base de données
    function dbDisconnect($unObjPDO){
        $unObjPDO = null;
    }

    

?>