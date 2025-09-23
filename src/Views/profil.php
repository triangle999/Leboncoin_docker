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
                                <a class="nav-link active" aria-current="page" href="<?= isset($_SESSION['user']['pseudo']) ? 'index.php?url=login' : 'index.php?url=profil' ?>"><?= isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : 'Se connecter' ?></a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>

        </nav>

        <div class="row px-5">

        <div class="col-2 mt-4 mx-auto">
            <img src="https://i.pinimg.com/736x/08/ba/e4/08bae4de13818316fe83f4999d0a70f0.jpg" class="img-fluid rounded-5" alt="photo-Profil">
        </div>

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
            <div class="col-lg-3 mt-4 border rounded">
                <div class="text-center">
                    <h5 class="m-0">Porte-monnaie</h5><br>
                    <p class="m-0">0 €</p><br>
                </div>
            </div>

        </div>

        <div class="row px-5 my-3 gap-3">

            <a href="index.php?url=annonces" class="col border p-3 a-none text-dark">
                <h6>
                    Voir les annonces
                </h6>
                <p>
                    Voir toutes les annonces !
                </p>
            </a>

            <div class="col border p-3">
                <h6>
                    Profil & Espaces
                </h6>
                <p>
                    Modifier mon profil public, accéder à mes avis, aux espaces candidat, locataire et bailleur
                </p>
            </div>

            <div class="col border p-3 bgIMG">
                <div class="rounded-5 p-2">
                    <div class="d-flex flex-column align-items-center">
                        <div class="my-2 font-bann">
                            C'est le moment de vendre
                        </div>
                        <div class="rounded-4 mx-2 bg-annonce bann-w p-2">
                            <a class="text-light a-none" aria-current="page" href="index.php?url=create"><i class="bi bi-plus-square"></i> Déposer une annonce</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>  
        <div class="row px-5 my-3 gap-3">
            
            <div class="col-lg-10">
                <div class="d-flex flex-column gap-3">
                    <?php foreach ($_SESSION['userAnnonce'] as $info) {?>

                        <div class="border rounded">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img  class="img-fluid" src="uploads/<?= $info['u_id'] . '/' . $info['a_picture'] ?>" alt="blabla">
                                </div>
                                <div class="col-lg-7">
                                    <div class="d-flex flex-column">
                                        <div>
                                            <h5><?= $info['a_title'] ?></h5>
                                        </div>
                                        <div>
                                            <p>
                                                <?= $info['a_description'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col border-start">
                                    <h6>Performance</h6>
                                    <div class="d-flex flex-column gap-2 p-2">
                                        <div><i class="bi bi-eye"></i> 40</div>
                                        <div><i class="bi bi-heart"></i> 6</div>
                                        <div><i class="bi bi-chat-dots"></i> 5</div>
                                        <form action="index.php?url=delete/<?= $info['a_id'] ?>" method="POST">
                                            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <? }?>
                </div>

            </div>      

            <div class="d-flex justify-content-center">
                <div class="w-25 my-2">
                    <a href="index.php?url=logout" class="btn btn-outline-secondary">Me déconnecter</a>
                </div>

                <div class="w-25 my-2">
                    <a href="index.php?url=home" class="btn btn-outline-secondary">Accueil</a>
                </div>

            </div>

            
        </div>

      
        
        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>