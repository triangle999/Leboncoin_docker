<?php

namespace App\Models;

use PDO;
use PDOException;

class Favoris
{

    public function addFavoris(int $userId, int $annonceId): bool
    {
        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                // pas de connexion
                return false;
            }
            $sql = 'INSERT INTO `favoris` (`user_id`, `annonce_id`) VALUES (:userId, :annonceId)';

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
            $stmt->bindValue(':annonceId', $annonceId, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error : ' . $e->getMessage();
            // return false
        }
    }

    public function removeFavoris(int $userId, int $annonceId): bool
    {
        try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                return false;
            }

            $sql = 'DELETE FROM favoris WHERE user_id = :userId AND annonce_id = :annonceId';

            // on prépare la requête avant de l'executer 
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
            $stmt->bindValue(':id', $annonceId, PDO::PARAM_STR);

            // on execute la requête
            $stmt->execute();

            // on récupère les données via un fetch !!!! ici ça sera un objet
            return true;
        } catch (PDOException) {
            return false;
            echo 'pas supprimé';
        }
    }

    public function findByUser(int $userId): array {
               try {
            $pdo = Database::getConnection();

            if (!$pdo) {
                false;
            }

            $sql = 'SELECT `f_id`, `user_id`, `annonce_id`, `a_id`, `a_title`, `a_description`, `a_price`, `a_picture`, `a_publication` FROM `favoris` NATURAL JOIN `users` NATURAL JOIN `annonces` WHERE u_id = :userId';
            // on prépare la requête avant de l'executer 
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);

            // on execute la requête
            $stmt->execute();

            // on récupère les données via un fetch !!!! ici ça sera un tableau 
            $userFavoris = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['userFavoris'] = $userFavoris;
            var_dump($_SESSION['userFavoris']);
    
            return  $_SESSION['userFavoris'];
        } catch (PDOException) {
            false;
        }
    }
}
