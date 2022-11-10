<div class="text-center">
    <h1>Modification de la sous-catégorie-<?= $sc['id'] ?></h1>
    <form method="post" class="position-relative w-25 m-auto" style="z-index: 30;" enctype="multipart/form-data">
        <p>Titre :</p>
        <input type="text" name="titre" id="titre" value="<?= $sc['titre'] ?>" class="form-control"><br><br>
        <p>Image :</p>
        <input type="file" name="image" id="image" class="form-control"><br><br>
        <p>Description</p>
        <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"><?= $sc['description'] ?></textarea><br><br>
        <p>Mots clés</p>
        <textarea name="keywords" id="keywords" cols="30" rows="10" class="form-control"><?= $sc['keywords'] ?></textarea><br><br>
        <p>Catégorie :</p>
        <select name="cat" id="cat" class="form-select">
            <option value="NULL">--------</option>
            <?php foreach($c as $v){ ?>
                <option value="<?= $v['id'] ?>"><?= $v['titre'] ?></option>
            <?php } ?>
        </select><br><br>
        <p>Nombre de questions reliées a cette sous-catégorie : <?= $nbrq ?></p>
        <input type="submit" name="edit" class="btn btn-danger" value="Attention, cette modification peut avoir un lourd impact">
    </form>
</div>