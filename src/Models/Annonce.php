<?php 

namespace App\Models;

use PDO;
use PDOException;

class Annonce {

    public int $aId;
    public string $titre;
    public string $description;
    public float $prix;
    public string $photo;
    public int $userId;
    public string $inscription;

    public function createAnnonce(string $titre, string $description, float $prix, ?string $photo, int $userId): bool {

        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                // pas de connexion
                return false;
            }
            $sql = 'INSERT INTO `annonces` (`a_title`, `a_description`, `a_price`, `a_picture`, `u_id`) VALUES (:titre, :description, :prix, :photo, :userId)';

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);

            return $stmt->execute();

        } catch (PDOException $e) {
            return 'Error : ' . $e->getMessage();
            // return false
        }

    }

    public function findAll(): array {

        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                false;
            }

            $sql = 'SELECT * FROM `annonces`';

            // on prépare la requête avant de l'executer
            $stmt = $pdo->prepare($sql);

            // on execute la requête
            $stmt->execute();

            // on récupère les données via un fetch !!! IMPORTANT : ça sera un talbeau ici
            $annonce = $stmt->fetchall(PDO::FETCH_ASSOC);

            $_SESSION['annonce'] = $annonce;
            return $_SESSION['annonce'];

        } catch (PDOException) {
            false;
        }
    }

    public function findById(int $id): ?array {
        
        
        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                false;
            }

            $sql = 'SELECT `u_id`, `a_id`, `a_title`, `a_description`, `a_price`, `a_picture`, `a_publication`, `u_username`, `u_inscription` FROM `annonces` NATURAL JOIN `users` WHERE `a_id` = :id LIMIT 1';
            // on prépare la requête avant de l'executer 
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            // on execute la requête
            $stmt->execute();

            // on récupère les données via un fetch !!!! ici ça sera un tableau 
            $idAnnonce = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return  $idAnnonce;


        } catch (PDOException) {
            false;
        }
    }

    public function findByUser(int $userId): array {

        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                false;
            }

            $sql = 'SELECT `u_id`, `a_id`, `a_title`, `a_description`, `a_price`, `a_picture`, `a_publication`, `u_username`, `u_inscription` FROM `annonces` NATURAL JOIN `users` WHERE u_id = :userId';
            // on prépare la requête avant de l'executer 
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);

            // on execute la requête
            $stmt->execute();

            // on récupère les données via un fetch !!!! ici ça sera un tableau 
            $userAnnonce = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['userAnnonce'] = $userAnnonce;
            return  $_SESSION['userAnnonce'];


        } catch (PDOException) {
            false;
        }
    }

    public function delete (int $id) {

        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                false;
            }
            
            $sql = 'DELETE FROM annonces WHERE u_id = :userId AND a_id = :id';

            // on prépare la requête avant de l'executer 
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':userId', $_SESSION['user']['id'], PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_STR);

            // on execute la requête
            $stmt->execute();

            // on récupère les données via un fetch !!!! ici ça sera un objet
            return true;


        } catch (PDOException) {
            false;
            echo 'pas supprimé';
        }
    }
}


