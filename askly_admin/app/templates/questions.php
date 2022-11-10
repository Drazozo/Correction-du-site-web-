<div class="position-relative" style="z-index: 10000;">
    <div class="text-center w-25 m-auto">
        <form method="post" class="d-flex justify-content-center">
            <input type="search" name="search" id="search" placeholder="Rechercher" class="form-control">
            <input type="submit" name="submitsearch" value="Valider" class="btn btn-primary">            
        </form><br>
        <a href="/create-question" class="btn btn-primary">Créer une question</a>        
        <a href="/signalement" class="btn btn-primary">Les signalements</a>     
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
                <td>Modifiers</td>
                <td>Supprimer</td>
            </tr>
            <?php

            foreach($q as $v){ 

                $asker = $db->prepare('SELECT prenom,nom FROM users WHERE id = :id');
                $asker->execute(['id'=>$v['owner_id']]);
                $a = $asker->fetch();

                if($asker->rowCount() == 0){
                    $a = "Aucun";
                } else {
                    $a = $a['prenom']." ".$a['nom'];
                }

                if(($v['reponse'] == NULL or $v['reponse'] == "") && $v['reponse_state'] !== "valided"){

                    $response = "<p class=\"text-danger\">Non</p>";
                    $rs = "Aucun";

                } 
                else {

                    $resp = $db->prepare('SELECT * FROM users WHERE id = :id');
                    $resp->execute(['id'=>$v['responser']]);
                    $rs = $resp->fetch();

                    if($resp->rowCount() == 0){
                        $rs = "Aucun";
                    } else {
                        $rs = $rs['prenom'] . " " . $rs['nom'];
                    }

                    if($v['reponse_state'] == "valid"){

                        if(\askly\permissions::grade() == "admin" or  \askly\permissions::grade() == "assistant"){
                            $response = "<p class=\"text-warning\"><a class=\"text-warning\" href=\"confirm-reponse-".$v['id']."\">A valider</a></p>";
                            $responser = "<p>".$v['response_date']."".$rs."</p>";                              
                        } else {
                            $response = "<p class=\"text-warning\">A valider</p>";
                            $responser = "<p>".$v['response_date']."".$rs."</p>";          
                        }

                    } 
                    else {

                        $response = "<p class=\"text-success\">Oui</p>";
                        $responser = "<p>".$rs."</p>";  

                    }
                
                }

                if($v['state'] == 'publie'){ 
                    $state = "<p class=\"text-success\">Publié</p>";
                } elseif($v['state'] == 'deleted') {
                    $state = "<p class=\"text-danger\">Supprimé</p>";
                } elseif($v['state'] == 'programme') {
                    $state = "<p class=\"text-info\">Programmé</p>";
                } else {
                    $state = "<p class=\"text-warning\">Brouillon</p>"; 
                }

            ?>

            <tr>
                <th scope="row"><p><?= $v['id'] ?></p></td>
                <td><a href="https://askly.fr/question-<?= $v['id'] ?>" target="_BLANK"><p><?= $v['titre'] ?></p></a></td>
                <td><?= $response ?></td>
                <td><p><?= $v['date'] ?><br><?= $a ?></p></td>
                <td><p><?= $v['response_date'] ?><br><?= $rs ?></p></td>
                <td><?= $state ?></td>
                <td><?= $v['vues'] ?></td>
                <td><p><a href="/edit-question-<?= $v['id'] ?>">Modifier</a></p></td>               
                <td><p><a href="/delete-question-<?= $v['id'] ?>">Supprimer</a></p></td>
            </tr>
        <?php } ?>
    </table>
    <?php if($params['current'] > 1){ ?>

    <a href="/questions-<?= $params['current'] - 1 ?>" class="btn btn-primary">&laquo; Précedent</a>

    <?php 

    }

    if($params['current'] < $pages){ ?>
        <a href="/questions-<?= $params['current'] + 1 ?>" class="btn btn-primary">Suivant &raquo;</a>
    <?php 
    }
    ?>
    
</div>