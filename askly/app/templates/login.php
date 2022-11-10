<?php if(!isset($_SESSION['id']) && empty($_SESSION['id'])){ ?>
<div class="d-flex justify-content-center flex-wrap position-relative m-auto" style="z-index: 50;">
    <div class="login-border w-25 m-5 p-5" style="min-width: 20rem;">
        <h1>Se connecter</h1>
        <p>Pour vous connecter ou vous inscrire, merci d'indiquer une adresse mail. Vous allez recevoir un code unique qui vous permettra de vous connecter</p>
        
        <?php if(isset($_SESSION['error'])){ ?>
            <div class="alert alert-dismissible alert-danger m-auto">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= $_SESSION['error'] ?>
            </div>
            <?php
            unset($_SESSION['error']);
        } ?>
       
        <form method="post">
            <h2>Email</h2>
            <input type="email" name="lemail" id="lemail" class="form-control"><br><br>
            <input type="submit" value="Se connecter ✈️" name="formlogin" id="formlogin" class="btn btn-primary">
        </form>
    </div>
    <div class="m-5 p-5">
        <h1>S'inscrire</h1>
        <form method="post">
            <h2>Email</h2>
            <input type="email" name="semail" id="semail" class="form-control" <?php if(isset($_SESSION['formemail'])) { 
                echo 'value="' . $_SESSION['formemail'] . '"'; 
                unset($_SESSION['formemail']);
            } ?>>
            <h2>Nom</h2>
            <input type="text" name="name" id="name" class="form-control">
            <h2>Prénom</h2>
            <input type="text" name="surname" id="surname" class="form-control"><br><br>
            <!-- <button name="formsignin" type="submit" formmethod="post" id="formlogin" class="g-recaptcha btn btn-primary" data-sitekey="6LdJCTceAAAAAHY-kTn6iEl0AXdtD84NklA11b56" data-callback='onSubmit' data-action='submit'>S'inscrire</button> -->
            <input type="submit" value="S'inscrire 🚀" name="formsignin" id="formlogin" class="btn btn-primary">
        </form>
    </div>
</div>
<?php } else { ?>
    <h1 class="text-center">Vous êtes déjà connectés : <a href="/">Retourner à l'accueil</a></h1><br>
    <form method="post" class="text-center">
        <input type="submit" name="disconnect" class="btn btn-primary" value="Se déconnecter">
    </form>
<?php } ?>
