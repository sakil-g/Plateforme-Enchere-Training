<!--Ajout de produit dans le fichier JSON -->
<?php 

    function ajout_produit () {
        $id_enchere = "article_" . md5(uniqid(rand(), true));
        $_POST["id"] = $id_enchere;

        $postArray = array(
                "id" => $id_enchere, 
                "titre" => $_POST["description"],
                "image" => "ressources/img/uploads/" . basename($_FILES["image_upload"]["name"]),
                "Prixdulancement" => (int)$_POST["prix_lancement"],
                "Duree" => (int)$_POST["duree"],
                "Prixduclic" => (float) $_POST["prix_clic"],
                "AugmentationduPrix" => (float)$_POST["augmentation_prix"],
                "Augmentationduree" => (float) $_POST["augmentation_duree"],
                "etat" => "inactif",
                "date_fin" => mktime(date("H")+ $_POST['duree'], date("i"), date("s"), date("m"), date("d"), date("Y"))
                
        );

        $data_file = 'src/js/data.json';
        $json_array = json_decode(file_get_contents($data_file), true);
        array_push($json_array,$postArray);
        file_put_contents($data_file, json_encode($json_array));
       
    } 
    
// <!-- VALIDATION ET FONCTION POUR ENVOYER UNE IMAGE -->


if (isset($_POST['submit']))
{
    $maxSize = 1000000;
    $validExt = array('.jpg', '.jpeg', '.gif', '.png');

    if($_FILES['image_upload']['error'] > 0 )
    {
      Echo "Erreur pas d'image séléctionner!";
      die;
    }

    $fileSize = $_FILES['image_upload']['size'];

    if ($fileSize > $maxSize)
    {
      Echo "Fichier trop volumineux";
      die;
    }


    $fileName = $_FILES['image_upload']['name'];
    $fileExt = "." . strtolower(substr(strrchr($fileName, '.'), 1));

    if(!in_array($fileExt, $validExt))
    {
      Echo "Mauvais format de fichier";
      die;
    }

    $tmpName = $_FILES['image_upload']['tmp_name'];

    $fileName = "ressources/img/uploads/" . $fileName ;

    $resultat = move_uploaded_file($tmpName, $fileName);

    if($resultat)
    {
      Echo "Transfert terminé";
      header("location:index.php");
    }
}

?>


<?php //Ici on gere la modification de l'état de l'enchere Si c'est le bouton activer ou desactiver
$data_file = "src/js/data.json";
$json_array = json_decode(file_get_contents($data_file), true); 
if(isset($_POST['submit_activer'])){
    $id = $_POST['indice'];//On stock dans l'input du nom indice l'id en valeur mais il est en display none afin de ne pas passer par l'url
    
    foreach ($json_array as $key => $value){//pour chaque enchere on va chercher quel endroit du tableau se trouve celui dont on veut modifier selon l'id
        if($value['id'] == $id){
            date_default_timezone_set("Indian/Reunion");
            $json_array[$key]['date_fin'] = mktime(date("H")+ (int)$value['Duree'], date("i"), date("s"), date("m"), date("d"), date("Y"));
            $json_array[$key]['etat'] =  'actif'; //A l'emplacement (key) du tableau on change l'etat qui est actif et la date de fin en secondes
            file_put_contents($data_file, json_encode($json_array));
        }
    }
}
if(isset($_POST['submit_desactiver'])){
    $id = $_POST['indice'];
    foreach ($json_array as $key => $value){
        if($value['id'] == $id){
          $json_array[$key]['etat'] =  'inactif'; //A l'emplacement (key) du tableau on change l'etat en inactif
          file_put_contents($data_file, json_encode($json_array));
        }
    }
}
?>

 
