<?php if(isset($_POST['submit_modif'])) :?>

<?php
$id = $_GET['id'];
foreach($json_array as $key => $value){
    if($value['id'] == $id) {
        $json_array[$key]['titre'];
        $json_array[$key]['Augmentationduree'];
        $json_array[$key]['AugmentationduPrix'];
        $json_array[$key]['Duree'];
        $json_array[$key]['Prixdulancement'];
        $json_array[$key]['Prixduclic'];

    }
}
?>

<?php endforeach ?>