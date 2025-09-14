<?php

namespace App\Controllers;

use App\Models\User;

class UserController {
    
    public function register(): void {
        // require_once __DIR__ . '/../Views/register.php';

        // Création de regeX
        $regName = "/^[a-zA-Zàèé\-]+$/";

        // Je ne lance qu'uniquement lorsqu'il y a un formulaire validée via la méthod POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // echo 'marche';

            // je créé un tableau d'erreurs vide car pas d'erreur
            $errors = [];

            if (isset($_POST["pseudo"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["pseudo"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['pseudo'] = 'Pseudonyme obligatoire';
                } else if (!preg_match($regName, $_POST["pseudo"])) {
                    // si ça ne respecte pas la regeX
                    $errors['pseudo'] = 'Caractère(s) non autorisé(s)';
                } else if (User::checkUsername($_POST["pseudo"])) {
                    // si le pseudo est déjà utilisé on créé un message d'erreur
                    $errors['pseudo'] = 'Ce peudo est déjà utilisé';
                }
            }

            if (isset($_POST["email"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["email"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['email'] = 'Mail obligatoire';
                } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    // si mail non valide, on créé une erreur
                    $errors['email'] = 'Mail non valide';
                } elseif (User::checkMail($_POST["email"])) {
                    // si mail déjà utilisé on créé un message d'erreur
                    $errors['email'] = 'Ce mail est déjà utilisé';
                }
            }

            if (isset($_POST["password"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["password"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['password'] = 'Veuillez saisir votre mot de passe';
                } else if (strlen($_POST['password']) < 8) {
                    // si mot de passe inf à 8 alors on créé une erreur
                    $errors['password'] = 'Le mot de passe est inférieur au minimum requis'; 
                } else if (!preg_match($regName, $_POST["password"])) {
                    // si ça ne respecte pas la regeX
                    $errors['password'] = 'Caractère(s) non autorisé(s)';
                }
            }

            if (isset($_POST["verifPassword"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["verifPassword"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['verifPassword'] = 'Veuillez saisir votre mot de passe';
                } else if (($_POST['verifPassword']) != $_POST["password"] ) {
                    // si mot de passe inf à 8 alors on créé une erreur
                    $errors['verifPassword'] = "Le mot de passe saisi n'est pas identique."; 
                } 
            }
            
            if(!isset($_POST["cgu"])){
                // si cgu non présent, on créé une erreur
                    $errors['cgu'] = 'Veuillez valider les CGU';
            }

            if(empty($errors)){
                // header("Location: register.php");
                // exit;
                // on appel la fonction createUser
                $newUser = new User;
                $newUser->createUser($_POST['email'], $_POST['password'], $_POST['pseudo']);
            }
        }
        require_once __DIR__ . '/../Views/register.php';
    }

    public function login(): void {
        require_once __DIR__ . '/../Views/login.php';

        // vue login.php + traitement POST

                // Création de regeX
        $regName = "/^[a-zA-Zàèé\-]+$/";

        // Je ne lance qu'uniquement lorsqu'il y a un formulaire validée via la méthod POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // je créé un tableau d'erreurs vide car pas d'erreur
            $errors = [];

            if (isset($_POST["pseudo"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["pseudo"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['pseudo'] = 'Pseudonyme obligatoire';
                } else if (!preg_match($regName, $_POST["lastname"])) {
                    // si ça ne respecte pas la regeX
                    $errors['lastname'] = 'Caractère(s) non autorisé(s)';
                }
            }

            if (isset($_POST["email"])) {
                // on va vérifier si c'est vide
                if (empty($_POST["email"])) {
                    // si c'est vide, je créé une erreur dans mon tableau
                    $errors['email'] = 'Mail obligatoire';
                } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    // si mail non valide, on créé une erreur
                    $errors['email'] = 'Mail non valide';
                }
            }

            if(empty($errors)){
                // header("Location: recap.php");
                // exit;
            }
        }
    } 

    public function profil(): void {
        require_once __DIR__ . '/../Views/profil.php';
        // vue profil.php (besoin user connecté)
    }

    public function logout(): void {
        require_once __DIR__ . '/../Views/home.php';
        // déconnexion + redirection
    }
}