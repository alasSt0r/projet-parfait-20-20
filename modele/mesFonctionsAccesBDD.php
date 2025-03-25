<?php

    /**
     * Fonction de connexion à la base de données
     * @return PDO
     */
    function dbConnection()
    {try{
        $unObjPDO = new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8','userBiblio','y2gKnyq>he*4&JY');
        }catch(PDOException $e){
            die('Erreur : '.$e->getMessage());
        }
        return $unObjPDO;
    }

    /**
     * Fonction qui ferme la connexion à la base de données
     * @param PDO $unObjPDO
     */
    function dbDisconnect(& $unObjPDO){
        $unObjPDO = null;
    }

    /**
     * Fonction qui retourne la liste des livres en fonction du titre et du genre
     * @param PDO $unObjPDO
     * @param string $titre
     * @param string $genre
     * @return array
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
     * @param PDO $unObjPDO
     * @return array
     */
    function getGenres($unObjPDO){
        $requete = "SELECT DISTINCT genre FROM Genres";
        $stmt = $unObjPDO->prepare($requete);
        $stmt->execute();
        $lesGenres = $stmt->fetchAll();
        return $lesGenres;
    }

    //INSTABLE ---------------------------------------------------
    function connectionBibli($unObjPDO, $login, $passwd) {
        $requete = "SELECT login, password FROM utilisateurs WHERE login = ? AND password = ?";
        $stmt = $unObjPDO->prepare($requete);
        $stmt->execute([$login, $passwd]);
    
        // Récupération de l'utilisateur
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Vérification des identifiants
        if ($user) {
            return true;
        } else {
            return false;
        }
    }
    function conDBbibliothecaire()
    {try{
        $unObjPDO = new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8','bibliothecaire','2b6X2zp@wqCz*WT[');
        }catch(PDOException $e){
            die('Erreur : '.$e->getMessage());
        }
        return $unObjPDO;
    }
//INSTABLE FIN---------------------------------------------------

    /**
     * Fonction qui retourne la liste des livres
     * @param PDO $unObjPDO
     * @return array
     */
    function getLivres($pdo) {
        $pdo = dbConnection();
        $sql = "SELECT id, titre, id_auteur, LEFT(resume, 50) AS resume FROM Livres";
        $stmt = $pdo->query($sql);
            $livres = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $livres[] = [
                    'id' => $row['id'],
                    'titre' => $row['titre'],
                    'id_auteur' => $row['id_auteur'],
                    'resume' => $row['resume'] . '...'
                ];
            }
            return $livres;

    }


?>