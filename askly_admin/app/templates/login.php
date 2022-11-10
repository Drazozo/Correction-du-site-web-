<?php if(!isset($_SESSION['id']) && empty($_SESSION['id'])){ ?>
<div class="w-50 m-5 login-box">
    <h1>Se connecter</h1>
    <p>Pour vous connecter ou vous inscrire, merci d'indiquer une adresse mail. Vous allez recevoir un code unique qui vous permettra de vous connecter</p>$
        <?php if(isset($_SESSION['error'])){ ?>
                <div class="alert alert-dismissible alert-danger w-25 m-auto">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $_SESSION['error'] ?>
                </div>
                <?php
                unset($_SESSION['error']);
            } ?>
    <form method="post">
        <h2>Email</h2>
        <input type="text" name="lemail" id="lemail"><br><br>
        <!-- <button type="submit" formmethod="post" name="formlogin" id="formlogin" class="g-recaptcha btn btn-primary" data-sitekey="6LdJCTceAAAAAHY-kTn6iEl0AXdtD84NklA11b56" data-callback='onSubmit' data-action='submit'>Se connecter</button> -->
        <input type="submit" value="Se connecter" name="formlogin" id="formlogin" class="btn btn-primary">
    </form>
</div>
<?php } else { ?>
    <h1 class="text-center">Vous êtes déjà connectés : <a href="/">Retourner à l\'accueil</a></h1><br>
        <form method="post" class="text-center">
        <input type="submit" name="disconnect" class="btn btn-primary" value="Se déconnecter">
    </form>
<?php } ?>