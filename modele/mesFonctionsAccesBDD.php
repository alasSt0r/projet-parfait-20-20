<?php

    /**
     * Fonction de connexion à la base de données avec user et password en parametre
     * @return PDO
     * Fonction de connexion à la base de données
     * @return PDO objet de connexion à la base de données
     */
    function dbConnection($user = 'userBiblio', $passwd = 'y2gKnyq>he*4&JY'){
        try{
        $unObjPDO = new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8',$user,$passwd);
        }catch(PDOException $e){
            die('Erreur : '.$e->getMessage());
        }
        return $unObjPDO;
    }

    /**
     * Fonction qui ferme la connexion à la base de données
     * @param PDO $unObjPDO objet de connexion à la base de données
     */
    function dbDisconnect(& $unObjPDO){
        $unObjPDO = null;
    }

    /**
     * Fonction qui retourne la liste des livres en fonction du titre et du genre
     * @param PDO $unObjPDO objet de connexion à la base de données 
     * @param string $titre titre a rechercher
     * @param string $genre genre a rechercher
     * @return array tableau de livres
     */
    function getLivresByTitreAndGenre($unObjPDO, $titre, $genre){
        if ($genre == "") {
            $requete = "SELECT * FROM Livres WHERE titre LIKE :titre";
            $stmt = $unObjPDO->prepare($requete);
            $titre2 = "%".$titre."%";
            $stmt->bindParam(':titre', $titre2 ,PDO::PARAM_STR);
        }elseif ($titre == "") {
            $requete = "SELECT Livres.titre, Livres.photo FROM Livres JOIN Genres ON Livres.id_genre = Genres.id  WHERE Genres.genre= :genre;";
            $stmt = $unObjPDO->prepare($requete);
            $stmt->bindParam(':genre', $genre ,PDO::PARAM_STR);
        }else{
            $requete = "SELECT Livres.titre, Livres.photo FROM Livres JOIN Genres ON Livres.id_genre = Genres.id  WHERE Genres.genre= :genre AND Livres.titre LIKE :titre;";
            $stmt = $unObjPDO->prepare($requete);
            $titre2 = "%".$titre."%";
            $stmt->bindParam(':titre', $titre2 ,PDO::PARAM_STR);
            $stmt->bindParam(':genre', $genre ,PDO::PARAM_STR);
        }
        $stmt->execute();
        $lesLivres = $stmt->fetchAll();
        return $lesLivres;
    }

    /**
     * Fonction qui retourne la liste des genres
     * @param PDO $unObjPDO objet de connexion à la base de données
     * @return array tableau de genres 
     */
    function getGenres($unObjPDO){
        $requete = "SELECT DISTINCT genre FROM Genres";
        $stmt = $unObjPDO->prepare($requete);
        $stmt->execute();
        $lesGenres = $stmt->fetchAll();
        return $lesGenres;
    }

    /**
     * Fonction qui retourne la liste des livres
     * @param PDO $unObjPDO objet de connexion à la base de données
     * @return array tableau de livres
     */
    function getLivres($pdo) {
        $sql = "SELECT 
                    Livres.id, 
                    Livres.titre, 
                    Auteurs.nom AS auteur_nom, 
                    Auteurs.prenom AS auteur_prenom, 
                    Livres.resume 
                FROM Livres 
                JOIN Auteurs ON Auteurs.id = Livres.id_auteur";
    
        $stmt = $pdo->query($sql);
        $livres = [];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $livres[] = [
                'id' => $row['id'],
                'titre' => $row['titre'],
                'nom' => $row['auteur_nom'],   // Correction de l'accès au champ
                'prenom' => $row['auteur_prenom'], // Correction de l'accès au champ
                'resume' => mb_substr($row['resume'], 0, 50, 'UTF-8') . '...' // Meilleure gestion des caractères UTF-8
            ];
        }
    
        return $livres;
    }


?>