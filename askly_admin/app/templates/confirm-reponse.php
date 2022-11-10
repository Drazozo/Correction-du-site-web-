<div class="position-relative text-center">
    <form method="post" class="w-50 m-auto">
        <h2>Confirmer la question n°<?= $q['id'] ?></h2>
        <p>Question : <?= $q['titre'] ?></p>
        <p>Reponse : <?= $q['reponse'] ?></p>
        <p>Sources : <?= $q['sources'] ?></p>
        <p>Mots clés : <?= $q['keywords'] ?></p>
        <p>Catégories : <?php foreach($categories as $v) {
            $titre = $db->prepare('SELECT * FROM categories WHERE id = :id');
            $titre->execute(['id'=>$v]);
            $titre = $titre->fetch()['titre'];
            echo '<a href="https://askly.fr/categorie-' . $v . '-1">'. $titre .', </a>';  
        } ?>
        </p>
        <p>Sous-catégories : <?php foreach($souscategories as $v2) {
            $titre = $db->prepare('SELECT * FROM sous_categories WHERE id = :id');
            $titre->execute(['id'=>$v2]);
            $titre = $titre->fetch()['titre'];
            echo '<a href="https://askly.fr/souscategorie-' . $v2 . '-1">'. $titre .', </a>';  
        } ?></p>
        <a href="/edit-question-<?= $q['id'] ?>" class="btn btn-warning">Modifier la question</a><br><br>
        <a href="/delete-question-<?= $q['id'] ?>"></a>
        <input type="submit" value="Confirmer et mettre en ligne" class="form-control w-50 m-auto">
    </form>
</div>