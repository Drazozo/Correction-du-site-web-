<div>
    <div class="text-center">
        <h1>Nous vous avons envoyé un mail</h1><br>      
    </div>
    <div class="text-center">
        <?php if(isset($_SESSION['error'])){ ?>
            <div class="alert alert-dismissible alert-danger w-25 m-auto">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= $_SESSION['error'] ?>
            </div>
            <?php
            unset($_SESSION['error']);
        } ?>
        <form method="post">
            <h2>Veuillez entrer le code que vous avez reçu par mail</h2>
            <p>Attention : il est valable seulement <b> 15 minutes </b></p>
            <input type="number" name="code" id="code" class="form-control w-25 m-auto"><br><br>
            <input type="submit" name="formconfirm" value="Confirmer" class="btn btn-primary">
        </form>        
    </div>
</div>