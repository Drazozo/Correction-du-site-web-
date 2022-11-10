<div class="w-50 m-auto text-left">
    <h1>Confirmer la suppression de la question n°<?= $params['id'] ?></h1>
    <div>
        <p><u>ID:</u> <?= $q['id'] ?></p>
        <p><u>Titre:</u> <?= $q['titre'] ?></p>
        <p><u>Reponse:</u> <?= $q['reponse'] ?></p>
        <p><u>Par:</u> <?= $responser ?></p>
        <p><u>Le:</u> <?= $q['date'] ?><br>Par: <?= $a['prenom']." ".$a['nom'] ?></p>
        <p><u>Date de la réponse:</u> <?= $q['response_date'] ?><br><?= $a['prenom']." ".$a['nom'] ?></p>
        <p><u>Etat:</u> <?= $state ?></p>
        <p><u>Vues:</u> <?= $q['vues'] ?></P>
    </div>
    <form method="post">
        <input type="submit" value="Confirmer la suppression" class="btn btn-danger" name="confirm">
    </form>
</div>