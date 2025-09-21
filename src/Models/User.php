<?php 

namespace App\Models;

use App\Models\Database;

use PDO;
use PDOException;

class User {

    public int $id;
    public string $email;
    public string $password;
    public string $pseudo;
    public string $inscription;

    public function createUser( string $email, string $password, string $pseudo): bool {
        // error_log("createUser appelé"); vérifie si on entre bien dans la fonction
        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                // si pas de connexion 
                return false;
            }

            $sql = 'INSERT INTO `users` (`u_email`, `u_password`, `u_username`) VALUES (:email, :password, :pseudo)';

            // on prépare la requête avant de l'éxecuter 
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password',password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

            // on exécute la requête
            return $stmt->execute();

        } catch (PDOException $e) {
            return 'Error : ' . $e->getMessage();
            // return false;
        }
    }

    public static function checkMail(string $email): bool {

        try {
            $pdo = Database::getConnection();   

            if (!$pdo) {
                // pour flex retourne si pas de connexion
                return false;
            } 
            
            $sql = 'SELECT 1 FROM `users` WHERE `u_email` = :u_email LIMIT 1';

            // on prépare une requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':u_email', $email, PDO::PARAM_STR);

            // on exécute la requête
            $stmt->execute();

            $result = $stmt->fetchColumn();

            if ($result !== false) {
                // une ligne a été trouvé -> le username existe déjà
                return true;
            } else {
                // aucune ligne trouvée -> le username n'existe pas
                return false;
            }
            

        } catch (PDOException $e) {
            return 'Error : ' . $e->getMessage();
            // return false;
        }
    }

    public static function checkUsername(string $pseudo): bool {

        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                // pour flex retourne si pas de connexion
                return false;
            } 

            $sql = 'SELECT 1 FROM `users` WHERE `u_username` = :username LIMIT 1';

            // on prépare une requête avant de l'exécuter
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':username', $pseudo, PDO::PARAM_STR);

            // on exécute la requête
            $stmt->execute();

            $result = $stmt->fetchColumn();

            if ($result !== false) {
                // une ligne a été trouvé -> le username existe déjà
                return true;
            } else {
                // aucune ligne trouvée -> le username n'existe pas
                return false;
            }
            

        } catch (PDOException $e) {
            return 'Error : ' . $e->getMessage();
        }
    }

    public function findByEmail(string $email): bool {

        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                // si pas de connexion 
                return false;
            }

            $sql = 'SELECT *  FROM `users` WHERE `u_email` = :email';

            // on prépare la requête avant de l'éxecuter 
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);

            // on exécute la requête
            $stmt->execute();

            // On recupère les données via un fetch() : se sera un objet
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            // On hydrate notre objet avec les valeurs de User
            $this->id = $user->u_id;
            $this->email = $user->u_email;
            $this->password = $user->u_password;
            $this->pseudo = $user->u_username;
            $this->inscription = $user->u_inscription;

            return true;

        } catch (PDOException $e) {
            return 'Error : ' . $e->getMessage();
            // return false
        }
    }

    public function findById(int $id): ?array {

        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                false;
            }

            $sql = 'SELECT * FROM `users` WHERE `u_id` = :id LIMIT 1';
            // on prépare la requête avant de l'executer 
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            // on execute la requête
            $stmt->execute();

            // on récupère les données via un fetch !!!! ici ça sera un tableau 
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $userById = $resultat; 
            return $userById;


        } catch (PDOException) {
            false;
        }

    }
    public function createFav ()
}