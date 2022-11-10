<div class="text-left w-75 m-5">
    <h1>Modifier mes infos</h1>
    
    <p> Ici, c'est ton espace <strong>personnel</strong>, comme tu peux le voir, on connais presque rien sur toi, mais ça nous suffit pour te proposer un <strong>site gratuit</strong> 🚀.<br>
    <br></div>
    <div class="text-center">
        <?php if(isset($_SESSION['error'])){ ?>
            <div class="alert alert-dismissible alert-success w-25 m-auto">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= $_SESSION['error'] ?>
            </div>
            <?php
            unset($_SESSION['error']);
        } ?>
        <a href="/delete-account" class="btn btn-danger text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg> Supprimer mon compte</a><br><br>
        <form method="post" class="w-25 m-auto">
        <h2>Prénom</h2>
        <input type="text" name="prenom" id="prenom" <?= $u['prenom'] ?> class="form-control" value="<?= $u['prenom'] ?>"><br>
        <h2>Nom</h2>
        <input type="text" name="nom" id="nom" <?= $u['nom'] ?> class="form-control" value="<?= $u['nom'] ?>"><br>
        <h2>Email</h2>
        <input type="email" name="email" id="email" <?= $u['email'] ?> class="form-control" value="<?= $u['email'] ?>"><br>
        <h2>Biographie</h2>
        <textarea name="biographie" id="biographie" cols="30" rows="10" class="form-control"><?= $u['bio'] ?></textarea>
        <h2>Anniversaire</h2>
        <div>
        <div class="alert alert-dismissible alert-info w-150 mt-1">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?= $_SESSION['surname'] ?>, un jour, le stagiaire mettra une fonction pour te souhaiter ton anniversaire😏! <i><br>(En 2040) </i>
        </div>
        <input type="date" name="birthday" id="birthday" value="<?= $u['birthday'] ?>" class="form-control"><br><br>
        <input type="submit" value="Modifier" class="form-control" name="edit">
    </form>
</div>