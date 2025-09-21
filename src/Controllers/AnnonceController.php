<?php 

namespace App\Controllers;

use App\Models\Annonce;

class AnnonceController {
    
    public function index(): void {

        $annonceInfo = new Annonce;
        $annonceInfo->findAll();
        
        require_once __DIR__ . '/../Views/annonces.php';
    } 

    public function create(): void {

        // vue create.php + upload + insertion
        // move_uploaded_file()
        // Création de regeX
        $regName = "/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]+$/";

        // Je ne lance qu'uniquement lorsqu'il y a un formulaire validée via la méthod POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // je créé un tableau d'erreurs vide car pas d'erreur
            // $errors = [];
            $_SESSION['errors'] = [];

            if (isset($_POST["titre"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["titre"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $_SESSION['errors']['titre'] = 'Titre obligatoire';
                } else if (!preg_match($regName, $_POST["titre"])) {
                    // si mail non valide, on créé une erreur
                    $_SESSION['errors']['titre'] = 'Caractère(s) non autorisé(s)';
                }
            }

            if (isset($_POST["descriptionArticle"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["descriptionArticle"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $_SESSION['errors']['descriptionArticle'] = 'Veuillez saisir une description';
                } else if (strlen($_POST['descriptionArticle']) < 15) {
                    // si l'article inf à 15 alors on créé une erreur
                    $_SESSION['errors']['descriptionArticle'] = 'La description est inférieur au minimum requis'; 
                } else if (!preg_match($regName, $_POST["descriptionArticle"])) {
                    // si ça ne respecte pas la regeX
                    $_SESSION['errors']['descriptionArticle'] = 'Caractère(s) non autorisé(s)';
                }
            }

            if (isset($_POST["prix"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["prix"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $_SESSION['errors']['prix'] = 'Veuillez saisir un prix';
                }
            }

            if (isset($_FILES['imgArticle'])) {
                
                $regFile = "/\.(jpg|jpeg|gif|png)$/i";

                // On vérifie le MIME de l'image
                if (!preg_match($regFile, $_FILES['imgArticle']['name'])) {
                    // si ça ne respecte pas on ne récupère pas le fichier et on créé un message d'erreur
                    unset($_FILES['imgArticle']);
                    $_SESSION['errors']['imgArticle'] = "Le format utilisé n'est pas accepté";
                } elseif (is_uploaded_file($_FILES['imgArticle']['tmp_name'])) {
                    // on créé des lettres randoms pour changer le nom de l'image et la rendre unique (en cours...)
                    $randByt = bin2hex(random_bytes(2));

                    // vérifie est déjà existant
                    if (!is_dir('uploads/' . $_SESSION['user']['id'] . '/')) { 
                        // si il l'est pas alors on va le créer
                        mkdir('uploads/' . $_SESSION['user']['id'] . '/');
                    }

                    $origine = $_FILES['imgArticle']['tmp_name']; 
                    // on change le nom de l'image (en tout cas j'essaye)
                    $changeName = $randByt . '_' .  $_FILES['imgArticle']['name'];
                    $destination = 'uploads/' . $_SESSION['user']['id'] . '/' . $changeName ;
                    // je déplace mon fichier dans le dossier uploads 
                    move_uploaded_file($origine, $destination);

                }
                
            }

            if(empty($_SESSION['errors'])){
                $nullImage = 'default.png';

                $newArticle = new Annonce;
                $newArticle->createAnnonce($_POST['titre'], $_POST['descriptionArticle'], $_POST['prix'], $_FILES['imgArticle'] ? $changeName : $nullImage , $_SESSION['user']['id']);

            }
                
        }
        require_once __DIR__ . '/../Views/create.php';
    }
    
    public function show(?int $id): void {
        // vue details.php 
        $objet = new Annonce;
        $annonceDetail = $objet->findById($id);

        require_once __DIR__ . '/../Views/details.php';
    }
}