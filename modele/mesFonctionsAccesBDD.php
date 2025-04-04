<?php

/**
 * Fonction de connexion à la base de données avec user et password en parametre
 * @return PDO
 * Fonction de connexion à la base de données
 * @return PDO objet de connexion à la base de données
 */
function dbConnection($user = 'userBiblio', $passwd = 'y2gKnyq>he*4&JY')
{
    try {
        $unObjPDO = new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8', $user, $passwd);
    } catch (PDOException $e) {
        $unObjPDO = null;
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        exit();
    }
    return $unObjPDO;
}

/**
 * Fonction qui ferme la connexion à la base de données
 * @param PDO $unObjPDO objet de connexion à la base de données
 */
function dbDisconnect(&$unObjPDO)
{
    $unObjPDO = null;
}

/**
 * Fonction qui retourne la liste des livres en fonction du titre et du genre
 * @param PDO $unObjPDO objet de connexion à la base de données 
 * @param string $titre titre a rechercher
 * @param string $genre genre a rechercher
 * @return array tableau de livres
 */
function getLivresByTitreAndGenre($unObjPDO, $titre, $genre)
{
    if ($genre == "") {
        $requete = "SELECT * FROM Livres WHERE titre LIKE :titre";
        $stmt = $unObjPDO->prepare($requete);
        $titre2 = "%" . $titre . "%";
        $stmt->bindParam(':titre', $titre2, PDO::PARAM_STR);
    } elseif ($titre == "") {
        $requete = "SELECT Livres.id, Livres.titre, Livres.photo FROM Livres JOIN Genres ON Livres.id_genre = Genres.id  WHERE Genres.genre= :genre;";
        $stmt = $unObjPDO->prepare($requete);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    } else {
        $requete = "SELECT Livres.id, Livres.titre, Livres.photo FROM Livres JOIN Genres ON Livres.id_genre = Genres.id  WHERE Genres.genre= :genre AND Livres.titre LIKE :titre;";
        $stmt = $unObjPDO->prepare($requete);
        $titre2 = "%" . $titre . "%";
        $stmt->bindParam(':titre', $titre2, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
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
function getGenres($unObjPDO)
{
    $requete = "SELECT genre, chemin FROM Genres";
    $stmt = $unObjPDO->prepare($requete);
    $stmt->execute();
    $lesGenres = $stmt->fetchAll();
    return $lesGenres;
}

/**
 * Fonction qui retourne la liste des auteurs
 * @param PDO $unObjPDO objet de connexion à la base de données
 * @return array tableau d'auteurs
 */
function getAuteurs($unObjPDO)
{
    $requete = "SELECT id,nom,prenom FROM Auteurs";
    $stmt = $unObjPDO->prepare($requete);
    $stmt->execute();
    $lesAuteurs = $stmt->fetchAll();
    return $lesAuteurs;
}

/** 
 * Fonction qui retourne la liste des livres
 * @param PDO $unObjPDO objet de connexion à la base de données
 * @return array tableau de livres
 */
function getLivres($pdo)
{
    $sql = "SELECT 
                    Livres.id, 
                    Livres.titre, 
                    Livres.photo,
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
                'photo'=> $row['photo'],
                'nom' => $row['auteur_nom'],   // Correction de l'accès au champ
                'prenom' => $row['auteur_prenom'], // Correction de l'accès au champ
                'resume' => mb_substr($row['resume'], 0, 50, 'UTF-8') . '...' // Meilleure gestion des caractères UTF-8
            ];
        }
        return $livres;
    }
    /**
     * Fonction qui retourne les détails d’un livre en fonction de son ID
     * @param PDO $unObjPDO Objet de connexion à la base de données
     * @param int $idLivre L'identifiant du livre à récupérer
     * @return array|null Tableau contenant les infos du livre ou null si non trouvé
     */
    function getLivreById($unObjPDO, $idLivre) {
        $requete = "SELECT
                        Livres.id, 
                        Livres.titre, 
                        Livres.photo,
                        Livres.resume,
                        Livres.datesortie,
                        Auteurs.nom, 
                        Auteurs.prenom,
                        Auteurs.date_naissance,
                        Genres.id,
                        Genres.genre
                    FROM `Livres`
                    JOIN Auteurs ON Auteurs.id = Livres.id_auteur
                    JOIN Genres ON Genres.id = Livres.id_genre
                    WHERE Livres.id = :id";
        
        
        $stmt = $unObjPDO->prepare($requete);
        $stmt->bindParam(':id', $idLivre, PDO::PARAM_INT);
        $stmt->execute();
        $livre = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch a single row as an associative array
        return $livre;
    }

/**
 * Fonction qui ajoute un livre
 * @param PDO $unObjPDO objet de connexion à la base de données
 * @param string $titre titre du livre
 * @param string $photo photo du livre
 * @param string $genre genre du livre
 * @param string $auteur auteur du livre
 * @param string $datesortie date de sortie du livre
 * @param string $resume resume du livre
 */
function addLivre($unObjPDO, $titre, $photo, $genre, $auteur, $datesortie, $resume)
{
    $requete = "INSERT INTO Livres (titre, photo, id_genre, id_auteur, datesortie, resume) VALUES ( :titre, :photo, (SELECT id FROM Genres WHERE genre = :genre), :auteur, :datesortie, :resume)";
    $stmt = $unObjPDO->prepare($requete);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':photo', $photo);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':auteur', $auteur);
    $stmt->bindParam(':datesortie', $datesortie);
    $stmt->bindParam(':resume', $resume);
    $stmt->execute();
}

/**
 * Fonction qui ajoute un auteur
 * @param PDO $unObjPDO objet de connexion à la base de données
 * @param string $nom nom de l'auteur
 * @param string $prenom prenom de l'auteur
 * @param string $date date de naissance de l'auteur
 */
function addAuteur($unObjPDO, $nom, $prenom, $date)
{
    try {
        $requete = "INSERT INTO Auteurs (nom, prenom, date_naissance) VALUES (:nom, :prenom, :date)";
        $stmt = $unObjPDO->prepare($requete);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':date', $date);
        if ($stmt->execute()) {
            echo "Auteur ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout de l'auteur.";
            print_r($stmt->errorInfo()); // Affiche les erreurs SQL
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'auteur : " . $e->getMessage();
        exit();
    }
}