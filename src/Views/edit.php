<!DOCTYPE html>
<html lang="fr">
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
    <link rel="shortcut icon" href="assets/img/lebon.png" type="image/x-icon">
</head>
<body>
    <div class="container">

        <nav class="navbar navbar-expand-lg mb-3 px-5 p-3 border-bottom">

            <div class="container-fluid">
                <a class="navbar-brand font" href="index.php?url=home">Leboncoin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item border rounded-4 mx-2 bg-annonce">
                            <a class="nav-link active text-light" aria-current="page" href="#"><i class="bi bi-plus-square"></i> Déposer une annonce</a>
                        </li>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Rechercher sur leboncoin" aria-label="Search"/>
                            <button class="btn text-light bg-annonce rounded-4 larg-search" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                        <div class="d-flex flex-column text-center navHeight"> 
                            <i class="bi bi-bell"></i>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Mes recherches</a>
                            </li>
                        </div>
                        <div class="d-flex flex-column text-center navHeight">
                            <li class="nav-item">
                                <i class="bi bi-heart"></i>
                                <a class="nav-link active" aria-current="page" href="#">Favoris</a>
                            </li>
                        </div>
                        <div class="d-flex flex-column text-center navHeight">
                            <i class="bi bi-chat-dots"></i>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="profil.php">Messages</a>
                            </li>
                        </div>
                        <div class="d-flex flex-column text-center navHeight">
                            <i class="bi bi-person"></i>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= isset($_SESSION['user']['pseudo']) ? 'index.php?url=profil' : 'index.php?url=login' ?>"><?= isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : 'Se connecter' ?></a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>

        </nav>

        <div class="row px-5">

            <div class="col-lg-7 mt-4">
                <div class="border rounded px-5 d-flex flex-column">
                    <div>
                        <h3><?= $_SESSION['user']['pseudo'] ?></h3>
                    </div>    
                    <div>
                        <p><?= $_SESSION['user']['email'] ?></p>
                    </div>
                    <div>
                       <p><?= $_SESSION['user']['inscription'] ?></p> 
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4 border rounded">
                <div class="text-center">
                    <h5 class="m-0">Porte-monnaie</h5><br>
                    <p class="m-0">0 €</p><br>
                </div>
            </div>

        </div>

        <div class="row px-5 my-3 mx-1">
            <div class="col-6 border p-3">
                <form action="index.php?url=edit/<?= $annonce['a_id'] ?>" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Titre de l'article*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["titre"] ?? '' ?></span>
                        <input type="text" class="form-control" id="titre" name="titre" value="<?= $annonce['a_title'] ?? $_POST['titre'] ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description de l'article*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["descriptionArticle"] ?? '' ?></span>
                        <textarea class="form-control" id="descriptionArticle" rows="3" name="descriptionArticle"><?= $annonce['a_description'] ?? $_POST['descriptionArticle'] ?></textarea>
                    </div>
                    <div>
                        <label for="exampleFormControlTextarea1" class="form-label">Prix*</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["prix"] ?? '' ?></span>
                        <div class="input-group mb-3">
                            <span class="input-group-text">€*</span>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="prix" id="prix" value="<?= $annonce['a_price'] ?? $_POST['prix'] ?>">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image de l'article</label><span class="ms-2 text-danger fst-italic fw-light"><?= $errors["imgArticle"] ?? '' ?></span>
                        <input class="form-control" type="file" id="imgArticle" name="imgArticle" value="<?= $_POST['imgArticle'] ?? $annonce['a_picture'] ?>">
                    </div>

                    <button type="submit" class="btn btn-primary bg-annonce">Modifier</button>
                </form>
            </div>

            <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="mb-1">
                        <img class="img-fluid rounded" src="uploads/<?= $_SESSION['user']['id'] . '/' . $annonce['a_picture'] ?>" alt="blabla">
                    </div>
                </div>
            </div>
            
        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>