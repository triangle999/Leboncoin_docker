<?php

namespace App\Controllers;

use App\Models\Favoris;

class FavorisController
{

    public function index(): void
    {
        if (isset($_SESSION['user'])) {
            $objet = new Favoris;
            $userFav = $objet->findByUser($_SESSION['user']['id']);
            
        } else if (empty($_SESSION['user'])) {
            header("Location : index.php?url=page404");
        }
        require_once __DIR__ . '/../Views/favoris.php';
    }

    public function add(int $annonceId): void
    {

        $objet = new Favoris;
        $addFav = $objet->addFavoris($_SESSION['user']['id'], $annonceId);
        require_once __DIR__ . '/../Views/favoris.php';
    }

    public function remove(int $annonceId): void
    {
        $objet = new Favoris;
        $removeFav = $objet->removeFavoris($_SESSION['user']['id'], $annonceId);
        require_once __DIR__ . '/../Views/favoris.php';
    }
}
