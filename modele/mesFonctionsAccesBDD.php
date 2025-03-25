<?php 

    // Fonction de connexion à la base de données
    function dbConnection()
    {try{
        $unObjPDO = new PDO(
        'mysql:host=localhost;
        dbname=bibliotheque;
        charset=utf8',
        'root',
        ''
        );

        }catch(PDOException $e){
            die('Erreur : '.$e->getMessage());
        }
        return $unObjPDO;
    }

    // Fonction qui ferme la connexion à la base de données
    function dbDisconnect($unObjPDO){
        $unObjPDO = null;
    }


    function dbConnection2()
    {try {
        $pdo = new PDO('mysql:host=localhost; dbname=bibliotheque;charset=utf8','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
    }
    

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