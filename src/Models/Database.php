<?php 

namespace App\Models;

use PDO;
use PDOException;

class Database {

    public static function getConnection(): ?PDO {

        $BASE = "leboncoin";
        $SERVER = "db";
        $USER = "root";
        $PASSWD ="root";
        
        try {

            $dsn = "mysql:dbname=" .$BASE. ";host=" .$SERVER . ';charset=utf8';

            $connexion = new PDO ($dsn, $USER, $PASSWD);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "Connexion réussi";
            return $connexion;
            
        } catch (PDOException $e) {
            // echo 'Error : ' . $e->getMessage();
            return null;
        }
    }
}