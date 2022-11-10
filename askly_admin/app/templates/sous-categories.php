<div class="position-relative" style="z-index: 10000;">
    <div class="text-center w-25 m-auto">
        <form method="post" class="d-flex justify-content-center">
            <input type="search" name="search" id="search" placeholder="Rechercher" class="form-control">
            <input type="submit" name="submitsearch" value="Valider" class="btn btn-primary">            
        </form><br>
        <?php if(\askly\permissions::grade() == "admin"){
            echo '<a href="/create-sous-categorie" class="btn btn-primary">Créer une sous-catégorie</a>';
        } ?>
    </div><br><br>

    <table class="table table-bordered position-relative" style="z-index: 100;">

        <?php if(\askly\permissions::grade() == "admin"){ ?>
            <tr>
                <th scope="row">ID catégorie</td>
                <td>Nom</td>
                <td>Image</td>
                <td>Nom de la catégorie reliée</td>
                <td>Nombre de questions posées</td>
                <td>Modifier</td>
                <td>Supprimer</td>
            </tr>
            <?php } elseif(\askly\permissions::grade() == "assistant") { ?>
            <tr>
                <th scope="row">ID catégorie</td>
                <td>Nom</td>
                <td>Image</td>
                <td>Nom de la catégorie reliée</td>
            </tr>
            <?php } elseif(\askly\permissions::grade() == "stagiaire") { ?>
            <tr>
                <th scope="row">ID catégorie</td>
                <td>Nom</td>
                <td>Image</td>
                <td>Nom de la catégorie reliée</td>
            </tr>
            <?php }
            foreach($sc as $v){ 

                $ask_questions = $db->prepare('SELECT id FROM questions WHERE subcat_id LIKE \''.$v['id'].',\' OR subcat_id LIKE \', '.$v['id'].'\' OR subcat_id = '.$v['id'].' ');
                $ask_questions->execute();
                $nbrq = $ask_questions->rowCount();

                $cat = $db->prepare('SELECT * FROM categories WHERE id = :id');
                $cat->execute(['id'=>$v['cat_id']]);
                $c = $cat->fetch();

            if(\askly\permissions::grade() == "admin"){ ?>
            <tr>
                <th scope="row"><?= $v['id'] ?></td>
                <td><a href="https://askly.fr/sous-categorie-<?= $v['id'] ?>-1" target="_BANK"><?= $v['titre'] ?></a></td>
                <td><?php if($v['img'] != NULL or $v['img'] != ""){ echo "<p class=\"text-success\">Oui</p>"; } else { echo "<p class=\"text-danger\">Non</p>";  } ?></td>
                <td><?= $c['titre'] ?></td>
                <td><?= $nbrq ?></td>
                <td><a href="/edit-sous-categorie-<?= $v['id'] ?>">Modifier</td>
                <td><a href="/delete-sous-categorie-<?= $v['id'] ?>">Supprimer</a></td>
            </tr>
            <?php } elseif(\askly\permissions::grade() == "assistant" or \askly\permissions::grade() == "stagiaire") { ?>
            <tr>
                <th scope="row"><?= $v['id'] ?></td>
                <td><a href="https://askly.fr/sous-categorie-<?= $v['id'] ?>-1" target="_BANK"><?= $v['titre'] ?></a></td>
                <td><?php if($v['img'] != NULL or $v['img'] != ""){ echo "<p class=\"text-success\">Oui</p>"; } else { echo "<p class=\"text-danger\">Non</p>";  } ?></td>
                <td><?= $nbrq ?></td>
            </tr>

            <?php } 
        } ?>
    </table>
    <div class="d-flex justify-content-center">
        <?php if($params['current'] > 1){ ?>

        <a href="/sous-categories-<?= $params['current'] - 1 ?>" class="btn btn-primary">&laquo; Précedent</a>
        
        <?php 

        } 
            if($params['current'] < $pages){ ?>
                <a href="/sous-categories-<?= $params['current'] + 1 ?>" class="btn btn-primary">Suivant &raquo;</a>
            <?php 
            }
        ?>
    </div>
</div>