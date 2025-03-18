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

    // Fonction qui retourne la liste des livres en fonction de leur titre et leur genre
    function getLivresByTitreAndGenre($unObjPDO, $titre, $genre){
        if ($genre == "") {
            $requete = "SELECT * FROM Livres WHERE titre LIKE :titre";
            $stmt = $unObjPDO->prepare($requete);
            $titre2 = "%".$titre."%";
            $stmt->bindParam(':titre', $titre2 ,PDO::PARAM_STR);
        }elseif ($titre == "") {
            $requete = "SELECT * FROM Livres WHERE genre = :genre JOIN Genres ON Livres.id_genre = Genres.id;";
            $stmt = $unObjPDO->prepare($requete);
            $stmt->bindParam(':genre', $genre ,PDO::PARAM_STR);
        }else{
            $requete = "SELECT * FROM Livres WHERE titre LIKE :titre AND genre = :genre JOIN Genres ON Livres.id_genre = Genres.id;";
            $stmt = $unObjPDO->prepare($requete);
            $titre2 = "%".$titre."%";
            $stmt->bindParam(':titre', $titre2 ,PDO::PARAM_STR);
            $stmt->bindParam(':genre', $genre ,PDO::PARAM_STR);
        }
        $stmt->execute();
        $lesLivres = $stmt->fetchAll();
        return $lesLivres;
    }

    // Fonction qui retourne la liste des genres
    function getGenres($unObjPDO){
        $requete = "SELECT DISTINCT titre FROM Genres";
        $stmt = $unObjPDO->prepare($requete);
        $stmt->execute();
        $lesGenres = $stmt->fetchAll();
        return $lesGenres;
    }


?>