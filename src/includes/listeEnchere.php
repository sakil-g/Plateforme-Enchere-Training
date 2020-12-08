        <!-- Appeler la function pour pouvoir récuperer les données dans le tableau JSON -->
<?php 
require_once "src/libs/functions.php";
$data_file = "src/js/data.json";
$json_array = json_decode(file_get_contents($data_file), true); ?>

<?php 
            //Ici on gere l'ajout du prix à augmenter
                if(isset($_POST['submit_enchere'])){
                    $id = $_POST['indice'];
                    foreach ($json_array as $key => $value){
                        if($value['id'] == $id){
                            $value['Prixdulancement'] = $value['Prixdulancement'] + $value['AugmentationduPrix'];
                            $value['date_fin'] = $value['date_fin'] + $value['Augmentationduree'];
                            $json_array[$key]['Prixdulancement'] =  $value['Prixdulancement'];
                            $json_array[$key]['date_fin'] =  $value['date_fin']; 
                            file_put_contents($data_file, json_encode($json_array));
                            
                        }
                    }
                }
?>

    <!--On commence ici à mettre le container ou il y aura les cartes-->
    <div id="articles" class="container-fluid mt-5">
    <h2 class="text-center mb-4 font-weight-bold">ARTICLES</h2>
    <div class=" d-flex justify-content-center flex-wrap">
    <!-- AFFICHE UN MESSAGE "aucun articles à afficher si toute les cartes sont inactifs" -->
        <?php 
            
            $onstate = false; // déclarer la variable onstate pour rechercher un état actif ou inactif dans le tableau
            foreach (array_reverse($json_array) as $etat => $actif ){ // rechercher dans le tableau l'état actif
            if ($actif['etat'] == 'actif'){ // si l'état est actif aucune action n'est demander
                $onstate = true; 
            }
            
            }
            if($onstate == false) { // si l'état est false donc inactif     
                echo '<div class="inactif">Aucun articles à afficher</div>'; // affiche le message aucun article à afficher
            }
        ?>
        <!-- Recherche dans le tableau les clés et les valeurs -->
        <?php foreach (array_reverse($json_array)as $key => $value) :?> <!-- Parcourir le tableau -->
            <?php if($value['etat'] == "actif"):?> <!-- affiche que les cartes actives -->
                <div class="card shadow m-lg-4 zoom" style="width: 18rem;">
                <div class="duree d-flex position-absolute w-50 justify-content-center align-items-center font-weight-bold"
                    id="<?php echo $value['id']?>"></div> <!-- Timer de l'enchere' -->
                <img src="<?= $value['image'] ?>" class="card-img-top img-fluid" style="height:230px;"
                    alt="image enchere"> <!-- Image de l'enchere -->
                <div class="card-body">
                    <h5 class="card-title font-weight-bold"><?= $value['titre'] ?></h5> 
                    <h4 class="display-6 font-weight-bold"><?= $value['Prixdulancement'] ?> €</h4>
                    <p class="card-text m-0">Prix du clic : <?= $value['Prixduclic'] ?> cts</p>
                    <p class="card-text mb-4">Prix de l'enchère : <?= $value['AugmentationduPrix'] ?> cts/clic</p>
                    <div class="text-center">
                        <form method="POST" action="#<?= $value['id']?>">
                            <input name="indice" value="<?= $value['id']?>" style="display:none;">
                            <button id="_<?= $value['id'] ?>" class="btn btn-primary btn-listEnchere p-0" name="submit_enchere">Enchérir</button>
                        </form>
                    </div>
                </div>
            </div>
           
            <script>
            //Gestion du timer 
                var timer = setInterval(function countDown() {
                    var tempAct = new Date(); //On recupere la date UNIX
                    var heure = Math.floor(tempAct.getTime() / 1000); //On transforme la date en secondes depuis la date fixe UNIX
                    var timeRemaining = <?php echo $value['date_fin']?> - heure; //On compare les secondes depuis date fixe UNIX PHP à JS
                    var hoursRemaining = parseInt(timeRemaining / 3600); // conversion en heures
                    var minutesRemaining = parseInt((timeRemaining % 3600) / 60); // conversion en minutes
                    var secondsRemaining = parseInt((timeRemaining % 3600) % 60); // conversion en secondes
                    //On attribue l'id de l'enchere dans la zone où il y a le timer et on dit que l'on souhaite afficher le timer
                    document.getElementById('<?= $value['id'] ?>').innerHTML = hoursRemaining + ' h : ' + minutesRemaining + ' m : ' + secondsRemaining + ' s ';
                    if (timeRemaining <= 0) {//Sinon on met expire et on desactive le bouton encherir
                        document.getElementById('<?= $value['id'] ?>').innerHTML = "EXPIRE";
                        document.getElementById('_<?= $value['id'] ?>').setAttribute('disabled', ''); // Bouton disabled quand temps expiré
                        document.getElementById('_<?= $value['id'] ?>').classList.remove('btn-listEnchere');
                        document.getElementById('_<?= $value['id'] ?>').classList.add('btn-listEnchere2');
                    }
                }, 1000); // répéte la fonction toutes les 1 seconde
            </script>
            <?php endif; ?>
            <?php endforeach; ?>
            
            
    </div>
    <script src="src\js\scroll.js"></script>
    <link rel="stylesheet" href="style.css">
</div>