<?php 

// session_start();

use App\Controllers\AnnonceController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Models\Annonce;

$url = $_GET['url'] ?? 'home';
$arrayURL = explode('/', $url);
$page = $arrayURL[0];
$id = $arrayURL[1] ?? null;
$userId = $arrayURL[2] ?? null;

switch ($page) {

    case 'home':

        $controller = new HomeController; 
        $controller->index();
        break;

    case 'register':

        $controller = new UserController;
        $controller->register();
        break;

    case 'login':

        $controller = new UserController; 
        $controller->login();   
        break;

    case 'profil':

        $controller = new UserController; 
        $controller->profil();
        break;

    case 'delete':

        $controller = new AnnonceController; 
        $controller->delete($id);
        break;

    case 'logout':

        $controller = new UserController; 
        $controller->logout();
        break;

    case 'annonces':

        $controller = new AnnonceController; 
        $controller->index();
        break;

    case 'create':

        $controller = new AnnonceController; 
        $controller->create();
        break;

    case 'details':

        $controller = new AnnonceController; 
        $controller->show($id);
        break;
    
    case 'welcome':

        require_once __DIR__ . '/../src/Views/welcome.php';
        break;
        
    case 'logout':

        require_once __DIR__ . '/../src/Views/logout.php';
        break;
        
    case 'page404':

        require_once __DIR__ . '/../src/Views/page404.php';
        break;

    default:
        require_once __DIR__ . '/../src/Views/page404.php';
        break;
}