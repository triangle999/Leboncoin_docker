<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulaire</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <h1 class="text-center py-4 bg-warning">Inscription </h1>

    <main class="container py-4">

        <div class="row justify-content-center">

            <div class="col-6">

                <form action="index.php?url=register" method="POST" novalidate>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Pseudo*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["pseudo"] ?? '' ?></span>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" value="<? $_POST['pseudo'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse mail*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["email"] ?? '' ?></span>
                        <input type="email" class="form-control" id="email" name="email" value="<? $_POST['email'] ?? '' ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="inputPassword5" class="form-label">Mot de passe*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["password"] ?? '' ?></span>
                            <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" name="password" value="<? $_POST['password'] ?? '' ?>">
                            <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-14 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                    </div>             
                    <div class="mb-3">
                        <label for="inputPassword5" class="form-label">Vérification du mot de passe*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["verifPassword"] ?? '' ?></span>
                            <input type="password" id="verifPassword" class="form-control" aria-describedby="passwordHelpBlock" name="verifPassword" value="<? $_POST['verifPassword'] ?? '' ?>">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="cgu" name="cgu">
                        <label class="form-check-label" for="cgu">J'ai lu et j'accepte les CGU*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["cgu"] ?? '' ?></span>
                    </div>
                    
                    <div class="d-flex gap-5 justify-content-center">
                        <div>
                            <a href="index.php?url=login" class="color1 a-none">Déjà inscrit ?</a>
                        </div>
                        <div>
                            <button type="submit" class="color1 a-none">S'inscrire</button> 
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>