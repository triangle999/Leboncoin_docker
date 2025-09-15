<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>leboncoin, site de petites annonces</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <div class="border shadow mt-5 p-5">

                    <form action="index.php?url=login" method="POST">

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse mail*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $_SESSION["errors"]["email"] ?? '' ?></span>
                            <input type="email" class="form-control" id="email" name="email" value="<? $_POST['email'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="inputPassword5" class="form-label">Mot de passe*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $_SESSION["errors"]["password"] ?? '' ?></span>
                            <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" name="password" value="<? $_POST['password'] ?? '' ?>">
                        </div> 

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Rester connecter</label>
                        </div>

                        <div class="d-flex gap-5 justify-content-center">
                            <div>
                                <button class="color1 a-none" type="submit">Connexion</button>
                            </div>
                            <div>
                                <a href="index.php?url=register" class="color1 a-none">S'inscrire</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <div class="col-lg d-flex flex-wrap gap-3">
                    <div class="imgWidth">
                        <img src="https://i.pinimg.com/736x/ee/75/0f/ee750febf578b8728413b31c2e292862.jpg" class="img-fluid rounded" alt="une_chaise">
                    </div>
                    <div class="imgWidth">
                        <img src="https://i.pinimg.com/736x/da/37/7b/da377bc2e189d3256e95024f2ff48bc0.jpg" class="img-fluid rounded" alt="un_manteau">
                    </div>
                    <div class="imgWidth">
                        <img src="https://i.pinimg.com/736x/2a/3e/1c/2a3e1c9def86e17dd18b1d98769975d5.jpg" class="img-fluid rounded" alt="une_voiture">
                    </div>
                    <div class="imgWidth">
                        <img src="https://i.pinimg.com/1200x/60/63/e4/6063e4e63bbc09da9b70caa49aef05c5.jpg" class="img-fluid rounded" alt="une_tente">
                    </div>
                </div>
            </div>
            
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>