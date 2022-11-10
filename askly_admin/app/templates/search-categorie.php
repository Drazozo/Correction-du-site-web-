<div class="text-center">
    <div class="text-center w-25 m-auto">
        <form method="post" class="d-flex justify-content-center">
            <input type="search" name="search" id="search" placeholder="Rechercher" class="form-control" value="<?= str_replace('%20', ' ', $params['search']); ?>">
            <input type="submit" name="submitsearch" value="Valider" class="btn btn-primary">            
        </form>
    </div><br><br>

    <table class="table table-bordered position-relative" style="z-index: 10000;">
    <?php if(\askly\permissions::grade() == "admin"){ ?>
            <tr>
                <th scope="row">ID catégorie</td>
                <td>Nom</td>
                <td>Image</td>
                <td>Description</td>
                <td>Sous-catégories</td>
                <td>Questions posées</td>
                <td>Vues de la catégorie</td>
                <td>Total des vues</td>
                <td>Modifier</td>
                <td>Supprimer</td>
            </tr>
            <?php } elseif(\askly\permissions::grade() == "assistant") { ?>
            <tr>
                <th scope="row">ID catégorie</td>
                <td>Nom</td>
                <td>Image</td>
                <td>Description</td>
                <td>Sous-catégories</td>
                <td>Questions posées</td>
                <td>Vues de la catégorie</td>
                <td>Total des vues</td>
            </tr>
            <?php } elseif(\askly\permissions::grade() == "stagiaire") { ?>
            <tr>
                <th scope="row">ID catégorie</td>
                <td>Nom</td>
                <td>Sous-catégories</td>
                <td>Vues de la catégorie</td>
                <td>Total des vues</td>
            </tr>
            <?php }
            foreach($s as $v){ 

                $vues = $v['vues'];

                $subcat = $db->prepare('SELECT id FROM sous_categories WHERE cat_id = :cat_id');
                $subcat->execute(['cat_id'=>$v['id']]);
                $nbrsubcat = $subcat->rowCount();

                $ask_questions = $db->prepare('SELECT id,SUM(vues) AS total FROM questions WHERE categorie_id = :categorie_id');
                $ask_questions->execute(['categorie_id'=>$v['id']]);
                $aq = $ask_questions->fetch();
                $nbrq = $ask_questions->rowCount();

                $subcat = $db->prepare('SELECT * FROM sous_categories WHERE cat_id = :cat_id');
                $subcat->execute(['cat_id'=>$v['id']]);
                $sc = $subcat->fetchAll();

                $total = $aq['total'];

            if(\askly\permissions::grade() == "admin"){ ?>
            <tr>
                <th scope="row"><?= $v['id'] ?></td>
                <td><?= $v['titre'] ?></td>
                <td><?php if($v['img'] === NULL or $v['img'] === ""){ echo "<p class=\"text-danger\">Non</p>"; } else { echo "<p class=\"text-success\">Oui</p>"; } ?></td>
                <td><?php if($v['description'] == NULL or $v['description'] == ""){ echo "<p class=\"text-danger\">Non</p>"; } else { echo "<p class=\"text-success\">Oui</p>"; } ?></td>
                <td><?= $nbrsubcat ?> <br> (<?php foreach($sc as $v){ echo $v['titre'].", "; } ?>)</td>
                <td><?= $nbrq ?></td>
                <td><?= $vues  ?></td>
                <td><?= $total ?></td>
                <td><a href="/edit-categorie-<?= $v['id'] ?>">Modifier</td>
                <td><a href="">Supprimer</a></td>
            </tr>
            <?php } elseif(\askly\permissions::grade() == "assistant") { ?>
            <tr>
                <th scope="row"><?= $v['id'] ?></td>
                <td><?= $v['titre'] ?></td>
                <td><?php if($v['img'] != NULL or $v['img'] == ""){ echo "<p class=\"text-success\">Oui</p>"; } else { echo "<p class=\"text-danger\">Non</p>";  } ?></td>
                <td><?php if($v['description'] == NULL or $v['description'] == ""){ echo "true"; } ?></td>
                <td><?= $nbrsubcat ?> <br> (<?php foreach($sc as $v){ echo $v['titre'].", "; } ?>)</td>
                <td><?= $nbrq ?></td>
                <td><?= $vues ?></td>
                <td><?= $total ?></td>
            </tr>
            <?php } elseif(\askly\permissions::grade() == "stagiaire") { ?>
            <tr>
                <th scope="row"><?= $v['id'] ?></td>
                <td><?= $v['titre'] ?></td>
                <td><?= $nbrsubcat ?> <br> (<?php foreach($sc as $v){ echo $v['titre'].", "; } ?>)</td>
                <td><?= $vues ?></td>
                <td><?= $total ?></td>
            </tr>
            <?php } ?>

        <?php } ?>
    </table>
    <div class="d-flex justify-content-center">
        <?php if($params['current'] > 1){ ?>

        <a href="/categories-<?= $params['current'] - 1 ?>" class="btn btn-primary">&laquo; Précedent</a>
        
        <?php

        } 
            if($params['current'] < $pages){ ?>
                <a href="/categorie-<?= $params['current'] + 1 ?>" class="btn btn-primary">Suivant &raquo;</a>
            <?php 
            }
        ?>
    </div>
</div>