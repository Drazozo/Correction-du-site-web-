<div class="position-relative" style="z-index: 10000;">
    <form method="post" class="d-flex justify-content-center w-25 m-auto"> 
        <input type="search" name="search" id="search" placeholder="Rechercher" class="form-control">
        <input type="submit" name="submitsearch" value="Valider" class="btn btn-primary">               
    </form><br><br>
    <div class="w-25 m-auto">
        <a href="/connections" class="btn btn-primary">Historique des connexions</a>
        <a href="/ban-0" class="btn btn-danger">Bannir une ip</a>
        <a href="/ban_ips" class="btn btn-warning">IP bannies</a><br><br>
    </div>
    <table class="table table-bordered">
        <tr>
            <th scope="row">ID user</td>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Date de dernière connexion</td>
            <td>Questions posées</td>
            <td>Date création</td>
            <td>Modifier</td>
        </tr>
        <?php foreach($u as $v){ 

            $qu = $db->prepare('SELECT * FROM questions WHERE owner_id = :owner_id');
            $qu->execute(['owner_id'=>$v['id']]);
            $nbr = $qu->rowCount();

            ?>
        <tr>
            <th scope="row"><?= $v['id'] ?></td>
            <td><?= $v['nom'] ?></td>
            <td><?= $v['prenom'] ?></td>
            <td><?= $v['lastconnect'] ?></td>
            <td><?= $nbr ?></td>
            <td><?= $v['date'] ?></td>
            <td><a href="/edit-user-<?= $v['id'] ?>">Modifier</td>
        </tr>
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