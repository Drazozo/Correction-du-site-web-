<div class="text-center">
    <form method="post" class="w-25 m-auto" enctype="multipart/form-data">
        <h2>Titre</h2>
        <input type="text" name="titre" class="form-control"><br>
        <h2>Description</h2>
        <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"></textarea><br>
        <h2>Miniature</h2>
        <input type="file" name="img" id="img" class="form-control"><br>
        <h2>Mots clés</h2>
        <textarea name="keywords" id="keywords" cols="30" rows="10" class="form-control"></textarea><br>
        <h2>Catégorie</h2>
        <select name="cat" id="cat" class="form-select">
            <?php foreach($cat as $v){ ?> <option value="<?= $v['id'] ?>"><?= $v['titre'] ?></option> <?php } ?>
        </select>
        <br><br>
        <input type="submit" value="Créer la sous-catégorie" class="form-control" name="create">
    </form>
</div>