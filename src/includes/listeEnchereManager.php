<?php 
require_once "src/libs/functions.php";
$data_file = "src/js/data.json";
$json_array = json_decode(file_get_contents($data_file), true); ?>

<?php foreach (array_reverse($json_array)as $key => $value) :?> 
    <thead>
        <tr>
                <td class="align-middle text-center" id="<?= $value['id'] ?>" scope="col">
                <img src="<?= $value['image'] ?>"class="card-img-top img-fluid" style="width: 70%;"></td>
                <td class="align-middle text-center" scope="col"><?=$value['titre'] ?></td>
                <td class="align-middle text-center" scope="col"><?=$value['etat']?></td>
                <td class="align-middle text-center" scope="col"><?= $value['Prixdulancement'] ?> €</td>
                <td class="align-middle text-center" scope="col"><?= $value['Duree']?></td>
                <td class="align-middle text-center p-0" scope="col"><?= $value['Prixduclic'] ?> cts</td>
                <td class="align-middle text-center" scope="col"><?= $value['AugmentationduPrix'] ?> cts/clic</td>
                <td class="align-middle text-center" scope="col"><?= $value['Augmentationduree'] ?></td>
                <td class="align-middle text-center" scope="col">
                <form method="POST" enctype="multipart/form-data" action="#<?= $value['id']?> ">
                    <input name="indice" value="<?= $value['id'] ?>" style="display: none;">
                    <input class="btn-sm btn-primary mb-2" type="submit" value="Activer" name="submit_activer">
                    <input class="btn-sm btn-primary mb-2" type="submit" value="Désactiver" name="submit_desactiver">
                    <input class="btn-sm btn-primary" type="submit" value="Modifier" name="">
                </td>
                </form>
        </tr>
   
    </thead>
            

    <?php endforeach; ?>