<div>
    <table class="table table-bordered position-relative" style="z-index: 10000;">
        <tr>
            <td>ID</td>
            <td>Auteur</td>
            <td>Raison</td>
            <td>Question</td>
            <td>Date</td>
            <td>Modifier</td>
            <td>Supprimé</td>
        </tr>
        <?php foreach($s as $v) { 
            
            $q = $db->prepare('SELECT * FROM questions WHERE id = :id');
            $q->execute(['id'=>$v['question']]);
            $q = $q->fetch();

            $owner = $db->prepare('SELECT * FROM users WHERE id = :id');
            $owner->execute(['id'=>$v['owner']]);
            $owner = $owner->fetch();

            ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><a href="/edit-user-<?= $v['owner'] ?>"><?= $owner['nom'] . " " .$owner['prenom'] ?></a></td>
            <td><?= $v['raison'] ?></td>
            <td><a href="https://askly.fr/question-<?= $q['id'] ?>" target="_BLANK" class="text-info">Voir</a></td>
            <td><?= $v['date'] ?></td>
            <td><a href="/edit-question-<?= $q['id'] ?>" class="text-warning">Modifier</a></td>
            <td><a href="/delete-question-<?= $q['id'] ?>" class="text-danger">Supprimer</a></td>
        </tr>
        <?php } ?>
    </table>
</div>