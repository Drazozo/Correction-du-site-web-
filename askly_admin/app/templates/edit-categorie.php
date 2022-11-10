<div class="text-center">
    <h1>Modification de la catégorie-<?= $c['id'] ?></h1>
    <form method="post" class="position-relative w-25 m-auto" style="z-index: 30;" enctype="multipart/form-data">
        <input type="text" name="titre" id="titre" value="<?= $c['titre'] ?>" class="form-control"><br><br>
        <input type="file" name="image" id="image" class="form-control"><br><br>
        <?php if($c['img'] !== NULL){
            echo 'Image : <img class="height: 40px;" src="assets/images/categories/"'. $c['img'] . '>';
        }  ?>
        <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"><?= $c['description'] ?></textarea><br><br>
        <p>Nombre de sous catégories : <?= $nbrsubcat ?></p><br><br>
        <p><?php foreach($sc as $v){ echo $v['titre'].", "; } ?></p>
        <p>Nombre de question reliées à cette catégorie : <?= $nbrq ?></p><br><br>
        <input type="submit" name="edit" class="btn btn-danger form-control" value="Attention, cette modification peut avoir un lourd impact">
    </form>
</div>