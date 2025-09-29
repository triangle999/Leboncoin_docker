<?php

namespace App\Controllers;

use App\Models\Annonce;

class AnnonceController
{

    public function index(): void
    {

        $annonceInfo = new Annonce;
        $annonceInfo->findAll();

        require_once __DIR__ . '/../Views/annonces.php';
    }

    public function create(): void
    {

        if (!isset($_SESSION['user'])) {
            header("Location : index.php?url=login");
            exit;
        }

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


            // $regFile = "/\.(jpg|jpeg|gif|png)$/i";
            // $nullImage = 'default.png';

            // On vérifie que la taille du fichier ne fait pas bug l'upload
            if (!isset($_FILES['imgArticle'])) {
                $_SESSION['errors']['imgArticle'] = "Le format de l'image est trop volumineuse";
            } else if ($_FILES['imgArticle']['error'] === 0) {

                // vérifie est déjà existant
                if (!is_dir('uploads/' . $_SESSION['user']['id'] . '/')) {
                    // si il l'est pas alors on va le créer
                    mkdir('uploads/' . $_SESSION['user']['id'] . '/');
                }

                // on stock l'extension du fichier
                $fileExtension = strtolower(pathinfo($_FILES['imgArticle']['name'], PATHINFO_EXTENSION));
                // on créé un tableau des types de MIME autorisés
                $mimeOk = ['image/jpeg', 'image/webp', 'image/png', 'image/gif', 'image/jpg'];
                // création d'un ressource qui permet de récupérer le MIME type
                $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                // on récupère le type MIME 
                $mime = finfo_file($fileInfo, $_FILES['imgArticle']['tmp_name']);

                if (!in_array($mime, $mimeOk, 1)) {
                    $_SESSION['errors']['imgArticle'] = "Votre image doit être de format webp, jpeg, png ou gif ";
                } elseif ($_FILES['imgArticle']['size'] > (8 * 1024 * 1024)) {
                    $_SESSION['errors']['imgArticle'] = "L'image ne doit pas dépasser les 8 Mo";
                }
            }



            if (empty($_SESSION['errors'])) {
                $imageNull = 'default.jpg';
                $newArticle = new Annonce;

                // on créé des lettres randoms pour changer le nom de l'image et la rendre unique (en cours...)
                $origine = $_FILES['imgArticle']['tmp_name'];
                // on change le nom de l'image (en tout cas j'essaye)
                $changeName = uniqid() . '.' . $fileExtension;
                $destination = 'uploads/' . $_SESSION['user']['id'] . '/' . $changeName;

                $newArticle->createAnnonce($_POST['titre'], $_POST['descriptionArticle'], $_POST['prix'], $_FILES['imgArticle'] ? $changeName : $imageNull, $_SESSION['user']['id']);


                // je déplace mon fichier dans le dossier uploads 
                move_uploaded_file($origine, $destination);

                header('Location: index.php?url=profil');
                exit;
            }
        }
        require_once __DIR__ . '/../Views/create.php';
    }

    public function show(?int $id): void
    {
        // vue details.php 
        $objAnnonce = new Annonce;
        $detail = $objAnnonce->findById($id);


        require_once __DIR__ . '/../Views/details.php';
    }

    public function delete(int $id)
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $objet = new Annonce;
            $annonce = $objet->findById($id);
            $pictureName = $annonce['a_picture'];
            $deleete = $objet->delete($id);
            // var_dump($deleete);
            // var_dump($_SESSION['user']['id']);

            if ($deleete) {
                /* Fichier à supprimer */
                $fichier = 'uploads/' . $_SESSION['user']['id'] . '/' . $pictureName;
                @unlink($fichier);
            }

            header("Location: index.php?url=profil");
        }


        require_once __DIR__ . '/../Views/profil.php';
    }

    public function edit(?int $id): void
    {

        $objet = new Annonce;
        $annonce = $objet->findById($id);
        // var_dump($annonce);
        // $obj = new Annonce;
        // $update = $obj->updateAnnonce();

        $regName = "/^[A-Za-zÀ-ÖØ-öø-ÿ\- ]+$/";

        // Je ne lance qu'uniquement lorsqu'il y a un formulaire validée via la méthod POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // je créé un tableau d'erreurs vide car pas d'erreur
            $errors = [];
            // $_SESSION['errors'] = [];

            if (isset($_POST["titre"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["titre"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['titre'] = 'Titre obligatoire';
                } else if (!preg_match($regName, $_POST["titre"])) {
                    // si mail non valide, on créé une erreur
                    $errors['titre'] = 'Caractère(s) non autorisé(s)';
                }
            }

            if (isset($_POST["descriptionArticle"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["descriptionArticle"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['descriptionArticle'] = 'Veuillez saisir une description';
                } else if (strlen($_POST['descriptionArticle']) < 15) {
                    // si l'article inf à 15 alors on créé une erreur
                    $errors['descriptionArticle'] = 'La description est inférieur au minimum requis';
                } else if (!preg_match($regName, $_POST["descriptionArticle"])) {
                    // si ça ne respecte pas la regeX
                    $errors['descriptionArticle'] = 'Caractère(s) non autorisé(s)';
                }
            }

            if (isset($_POST["prix"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["prix"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['prix'] = 'Veuillez saisir un prix';
                }
            }


            // $regFile = "/\.(jpg|jpeg|gif|png)$/i";
            // $nullImage = 'default.png';

            // On vérifie que la taille du fichier ne fait pas bug l'upload
            if (!isset($_FILES['imgArticle'])) {
                $errors['imgArticle'] = "Le format de l'image est trop volumineuse";
            } else if ($_FILES['imgArticle']['error'] === 0) {

                // vérifie est déjà existant
                if (!is_dir('uploads/' . $_SESSION['user']['id'] . '/')) {
                    // si il l'est pas alors on va le créer
                    mkdir('uploads/' . $_SESSION['user']['id'] . '/');
                }

                // on stock l'extension du fichier
                $fileExtension = strtolower(pathinfo($_FILES['imgArticle']['name'], PATHINFO_EXTENSION));
                // on créé un tableau des types de MIME autorisés
                $mimeOk = ['image/jpeg', 'image/webp', 'image/png', 'image/gif', 'image/jpg'];
                // création d'un ressource qui permet de récupérer le MIME type
                $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                // on récupère le type MIME 
                $mime = finfo_file($fileInfo, $_FILES['imgArticle']['tmp_name']);

                if (!in_array($mime, $mimeOk, 1)) {
                    $errors['imgArticle'] = "Votre image doit être de format webp, jpeg, png ou gif ";
                } elseif ($_FILES['imgArticle']['size'] > (8 * 1024 * 1024)) {
                    $errors['imgArticle'] = "L'image ne doit pas dépasser les 8 Mo";
                }
            }



            if (empty($errors)) {

                if (!empty($_FILES['imgArticle']) && !empty($_FILES['imgArticle']['tmp_name'])) {
                    $fileExtension = strtolower(pathinfo($_FILES['imgArticle']['name'], PATHINFO_EXTENSION));
                    // on créé des lettres randoms pour changer le nom de l'image et la rendre unique (en cours...)
                    $origine = $_FILES['imgArticle']['tmp_name'];
                    // on change le nom de l'image (en tout cas j'essaye)
                    $changeName = uniqid() . '.' . $fileExtension;
                    $destination = 'uploads/' . $_SESSION['user']['id'] . '/' . $changeName;

                    // je déplace mon fichier dans le dossier uploads 
                    move_uploaded_file($origine, $destination);
                }


                // appeler la méthode edit
                $objet = new Annonce;
                $edit = $objet->edit($annonce['a_id'], $annonce['a_title'], $annonce['a_description'], $annonce['a_price'], $_FILES['imgArticle']['tmp_name'] ? $changeName : $annonce['a_picture']);

                header("Location: index.php?url=edit/$id");
                exit;
            }
        }

        require_once __DIR__ . '/../Views/edit.php';
    }
}
