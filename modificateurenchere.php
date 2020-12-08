<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
     <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     <!-- CSS -->
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/navbar.css">
<head> 

<!--page formulaire de modification d'un ou des enchére ramené par le boutton modifier-->
<body>

<?php include 'src/includes/header.php'; ?>
<div class="d-flex justify-content-center">
    <h2 class="mb-5 text-uppercase font-weight-bold">MODIFIER VOTRE ENCHERE</h2>   
</div>

<?php if(isset($_POST['submit_parametre'])):?>
   <!---->
   <?php 
        $data_file = "src/js/data.json";
        $json_array = json_decode(file_get_contents($data_file), true);
        $id = $_GET['id'];
        foreach($json_array as $key => $value){
            if($value['id'] == $id){
                $json_array[$key]['titre'] =  $_POST['titre'];
                $json_array[$key]['Prixdulancement'] =  $_POST['Prixdulancement'];
                $json_array[$key]['Duree'] = $_POST['Duree'];
                $json_array[$key]['Prixduclic'] = $_POST['Prixduclic'];
                $json_array[$key]['Augmentationduree'] = $_POST['Augmentationduree'];
                $json_array[$key]['AugmentationduPrix'] = $_POST['AugmentationduPrix'];
                file_put_contents($data_file, json_encode($json_array));
            }
        }
   ?>

<?php endif ?>
<!-- Récupere les données dans le fichier JSON -->
<?php 
$data_file = "src/js/data.json";
$json_array = json_decode(file_get_contents($data_file), true); ?>

<!-- Lance une boucle foreach pour pouvoir récuperer l'ID de l'enchere a modifier -->
<?php foreach ($json_array as $key => $value) :?>
    <?php if ($value['id'] == $_GET['id']) : ?> 

<!-- Formulaire pour pouvoir modifier les encheres -->
<form class="container-fluid w-100 d-flex justify-content-center align-items-center flex-column" method="POST" enctype="multipart/form-data" action="">
    <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
        <label class="labelForm" for="#description">Description :</label>
        <input  value="<?= $value['titre']?>" type="text" class="form-control" id="description" maxlength="24" placeholder="24 caractères maximum" name="titre" required>
    </div>
    <div class="d-flex justify-content-center align-items-center">
    <label class="fileUpload d-flex justify-content-center align-items-center bg-light">
        Image upload 
        <input type="file" value="<?=$value['image']?>" name="image" id="image_upload" >

    </label>
</div>
    <h3 class="mb-5 mt-4 d-flex justify-content-center text-center text-uppercase">Paramètres de l'enchère</h3>
    <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
        <label class="labelForm" for="#prix_lancement">Prix de lancement (€):</label>
        <input type="number" class="form-control" aria-label="Prix de lancement" placeholder="En euros" name="Prixdulancement" id="Prixdulancement" min="0" value="<?= $value['Prixdulancement']?>" required aria-describedby="basic-addon1">
    </div>  
    <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
        <label class="labelForm" for="#duree">Durée (h):</label>
        <input type="number" class="form-control" aria-label="duree" placeholder="En heures" id="duree" name="Duree" min="0" value="<?= $value['Duree']?>" required aria-describedby="basic-addon1">
    </div>
    <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
        <label class="labelForm" for="#prix_clic">Prix du clic (cts):</label>
        <input type="number" class="form-control" placeholder="En centimes" aria-label="prix_clic" name="Prixduclic" id="prix_clic" value="<?= $value['Prixduclic']?>" required aria-describedby="basic-addon1" max="0.99" min="0" step="0.01">
    </div>
    <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
        <label class="labelForm" for="#augmentation_prix">Augmentation du prix (cts):</label>
        <input type="number" class="form-control" aria-label="augmentation_prix" placeholder="En centimes" name="AugmentationduPrix" value="<?= $value['AugmentationduPrix']?>" required id="augmentation_prix" aria-describedby="basic-addon1" max="0.99" min="0.00" step="0.01">
    </div>
    <div class="d-flex justify-content-center align-items-center mb-3 items bg-light">
        <label class="labelForm" for="#augmentation_duree">Augmentation durée (s):</label>
        <input type="number" class="form-control" aria-label="augmentation_duree" placeholder="En secondes" name="Augmentationduree" value="<?= $value['Augmentationduree']?>" required id="augmentation_duree" min="0" aria-describedby="basic-addon1">
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <button type="submit" name="submit_parametre" class="btn btn-warning text-uppercase text-white font-weight-bold btn AjoutEnchere mb-5" style="width:220px; height:80px;">Enregistrer modification</button>
    </div>
</form>
<?php endif ?>
<?php endforeach ?>


 <!-- jQuery and JS bundle w/ Popper.js -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>   
</body>
</html>