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

    // Fonction qui retourne la liste des livres en fonction de leur titre
    function getLivresByTitre($unObjPDO, $titre){
        $requete = "SELECT * FROM Livres WHERE titre LIKE :titre";
        $stmt = $unObjPDO->prepare($requete);
        $titre2 = "%".$titre."%";
        $stmt->bindParam(':titre', $titre2 ,PDO::PARAM_STR);
        $stmt->execute();
        $lesLivres = $stmt->fetchAll();
        return $lesLivres;
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

?>