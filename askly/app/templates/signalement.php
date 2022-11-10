<div class="text-center">
    <?php if(!isset($_SESSION['id'])) { ?>
        <div class="alert alert-dismissible alert-warning w-25 m-auto">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            Pour réaliser un signalement à nos équipes, il faut être connecté et ainsi, vous aurez un retour de votre signalement par mail.
        </div><br>
        <a href="https://askly.fr/login" class="btn btn-info">Se connecter</a>
    <?php } else { ?>
        <h1>Signaler la question #<?= $q['id'] ?></h1>
        <h2>Quel est la raison de votre signalement ?</h2>
        <form method="post">
            <textarea name="raison" id="raison" cols="30" rows="10" class="form-control w-25 m-auto mb-4"></textarea>
            <input type="submit" value="Envoyer" class="btn btn-danger">        
        </form>
    <?php } ?>
</div>