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
            $requete = "SELECT * FROM Livres JOIN Genres ON Livres.id_genre = Genres.id  WHERE Genres.genre= :genre;";
            $stmt = $unObjPDO->prepare($requete);
            $stmt->bindParam(':genre', $genre ,PDO::PARAM_STR);
        }else{
            $requete = "SELECT * FROM Livres JOIN Genres ON Livres.id_genre = Genres.id  WHERE Genres.genre= :genre AND Livres.titre LIKE :titre;";
            $stmt = $unObjPDO->prepare($requete);
            $titre2 = "%".$titre."%";
            $stmt->bindParam(':titre', $titre2 ,PDO::PARAM_STR);
            $stmt->bindParam(':genre', $genre ,PDO::PARAM_STR);
        }
        $stmt->execute();
        $lesLivres = $stmt->fetchAll();
        return $lesLivres;
    }

    function getLivresByFiveParametre($unObjPDO, $titre, $auteur, $genre, $datesortie, $cotation) {
        $requete = "SELECT * FROM livres JOIN genres ON livres.id_genre = genres.id JOIN auteurs ON livres.id_auteur = auteurs.id WHERE 1=1" ;
        $params = [];
    
        if ($titre !== "") {
            $requete .= " AND livres.titre LIKE :titre";
            $params[':titre'] = "%".$titre."%";
        }
        if ($auteur !== "") {
            $requete .= " AND auteurs.nom LIKE :auteur";
            $params[':auteur'] = "%".$auteur."%";
        }
        if ($genre !== "") {
            $requete .= " AND genres.genre = :genre";
            $params[':genre'] = $genre;
        }

        if ($datesortie !== "") {
            $requete .= " AND livres.datesortie = :datesortie";
            $params[':datesortie'] = $datesortie;
        }
        if ($cotation !== "") {
            $requete .= " AND livres.cotation = :cotation";
            $params[':cotation'] = $cotation;
        }
    
        $stmt = $unObjPDO->prepare($requete);
    
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        $AllLivres = $stmt->fetchAll();
    
        return $AllLivres;
    }
    

    // Fonction qui retourne la liste des genres
    function getGenres($unObjPDO){
        $requete = "SELECT DISTINCT genre FROM Genres";
        $stmt = $unObjPDO->prepare($requete);
        $stmt->execute();
        $lesGenres = $stmt->fetchAll();
        return $lesGenres;
    }

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

    function getLivres($pdo) {
        $pdo = dbConnection();
        $sql = 
        "SELECT Livres.id, titre, id_auteur, Auteurs.nom, genre,datesortie, cotation, LEFT(resume, 1000) AS resume
        FROM Livres 
        JOIN Auteurs ON Auteurs.id = Livres.id_auteur
        JOIN genres ON genres.id = livres.id_genre";
        $stmt = $pdo->query($sql);
            $livres = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $livres[] = [
                    'id' => $row['id'],
                    'titre' => $row['titre'],
                    'auteur' => $row['nom'],
                    'genre' => $row['genre'],
                    'resume' => $row['resume'] . '...',
                    'datesortie' => $row['datesortie'],
                    'cotation' => $row['cotation'],
                ];
                if (!isset($row['nom'])) {
                    echo "Clé 'nom' absente !";
                    print_r($row); // Affiche le tableau pour voir les clés disponibles
                }
            }
            return $livres;

    }


?>