<div class="text-center">
    <div class="text-center w-25 m-auto">
        <form method="post" class="d-flex justify-content-center">
            <input type="search" name="search" id="search" placeholder="Rechercher" class="form-control">
            <input type="submit" name="submitsearch" value="Valider" class="btn btn-primary">            
        </form>
    </div><br><br>

    <table class="table table-bordered position-relative" style="z-index: 10000;">
        <tr>
            <th scope="row">ID</td>
            <td>Titre</td>
            <td>Réponse faite ?</td>
            <td>Date question et par qui ?</td>
            <td>Date réponse et par qui ?</td>
            <td>État</td>
            <td>Vues</td>
            <td>Modifier</td>
            <td>Supprimer</td>
        </tr>
            <?php   

            foreach($s as $v) {

                $asker = $db->prepare('SELECT prenom,nom FROM users WHERE id = :id');
                $asker->execute(['id'=>$v['owner_id']]);
                $a = $asker->fetch();

                if($v['reponse'] == NULL or $v['reponse'] == ""){

                    $response = "<p class=\"text-danger\">Non</p>";

                } 
                else {

                    $resp = $db->prepare('SELECT * FROM users WHERE id = :id');
                    $resp->execute(['id'=>$v['responser']]);
                    $rs = $resp->fetch();

                    if(\askly\permissions::get_grade($v['responser']) == "stagiaire" or \askly\permissions::get_grade($v['responser']) == "user"){

                        if(\askly\permissions::grade() == "admin" or  \askly\permissions::grade() == "assistant"){
                            $response = "<p class=\"text-warning\"><a class=\"text-warning\" href=\"valid-reponse\">A valider</a></p>";
                            $responser = "<p>".$v['response_date']."".$rs['prenom']." ".$rs['nom']."</p>";                              
                        } else {
                            $response = "<p class=\"text-warning\">A valider</p>";
                            $responser = "<p>".$v['response_date']."".$rs['prenom']." ".$rs['nom']."</p>";          
                        }

                    } 
                    else {

                        $response = "<p class=\"text-success\">Oui</p>";
                        $responser = "<p>".$rs['prenom']." ".$rs['nom']."</p>";  

                    }
                
                }

                if($v['state'] == 'publie'){ 
                    $state = "<p class=\"text-success\">Publié</p>";
                } elseif($v['state'] == 'deleted') {
                    $state = "<p class=\"text-danger\">Supprimé</p>";
                } else {
                    $state = "<p class=\"text-warning\">Brouillon</p>"; 
                }

            ?>

            <tr>
                <th scope="row"><p><?= $v['id'] ?></p></td>
                <td><p><?= $v['titre'] ?></p></td>
                <td><?= $response ?></td>
                <td><p><?= $v['date'] ?><br><?= $a['prenom']." ".$a['nom'] ?></p></td>
                <td><p><?= $v['response_date'] ?><br><?= $a['prenom']." ".$a['nom'] ?></p></td>
                <td><?= $state ?></td>
                <td><?= $v['vues'] ?></td>
                <td><p><a href="/edit-question-<?= $v['id'] ?>">Modifier</a></p></td>               
                <td><p><a href="/delete-question-<?= $v['id'] ?>">Supprimer</a></p></td>
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