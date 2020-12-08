<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="src/css/navbar.css">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/styleListeEnchere.css"> 

    <title>Modifier une enchère</title>
</head>
<body>
    <!--HEADER-->
    
    <?php include 'src/includes/header.php';?>

    <!--Modifier ENCHERE-->
    
    <div id="articles" class="container-fluid mt-5">
    <h2 class="text-center mb-5 font-weight-bold">ARTICLES AJOUTES</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="align-middle text-center" scope="col">Image</th>
                    <th class="align-middle text-center" scope="col">Description</th>
                    <th class="align-middle text-center" scope="col">Etat</th>
                    <th class="align-middle text-center" scope="col">Prix de lancement</th>
                    <th class="align-middle text-center" scope="col">Durée de l'enchère</th>
                    <th class="align-middle text-center" scope="col">Prix du clic</th>
                    <th class="align-middle text-center" scope="col">Augmentation du prix</th>
                    <th class="align-middle text-center" scope="col">Augmentation durée</th>
                    <th class="align-middle text-center" scope="col">Activer / Desactiver</th>
                    
                </tr>
            </thead>
            <?php include 'src/includes/listeEnchereManager.php';?>
            <!-- INCLURE LA PAGE LISTE ENCHERE MANAGER QUI PERMET DE MODIFIER LES ENCHERES --> 
    <button onclick="topFunction()" id="myBtn" title="Go to top">&#10148</button>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <script src="src\js\scroll.js"></script>
    </body>
</html>
