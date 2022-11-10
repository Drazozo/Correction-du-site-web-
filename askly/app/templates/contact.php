<div class="d-flex justify-content-left m-5 flex-wrap position-relative" style="z-index: 50;">
    <div class="w-25" style="min-width: 10rem;">
        <p>Notre équipe de professionels s’engage pour vous apporter une réponse sous 48 heures. Pour les demandes de recrutement, un délai supplémentaire peut s’ajouter. Merci de votre compréhension.</p><br>
        <img class="w-75" src="assets/images/contact-envelope.svg" alt="" style="min-width: 15rem;">        
    </div><br><br>
    <?php if(isset($_SESSION['id'])){ ?>
    <div class="w-50 m-5">
        <h1 style="font-size: 2.5rem;"><b>Contacter-nous</b></h1>
        <form method="post">
            <h1>Prénom</h1>
            <input type="text" name="name" id="name"  class="form-control">
            <h1>Nom</h1>
            <input type="text" name="surname" id="surname"  class="form-control">
            <h1>Adresse email</h1>
            <input type="text" name="email" id="email" class="form-control">
            <h1>Sujet</h1>
            <input type="text" name="sujet" id="sujet" class="form-control">
            <h1>Mesage</h1>
            <textarea name="msg" id="msg"  class="form-control"></textarea><br>
            <div class="g-recaptcha" data-sitekey="6LfdNHMhAAAAADVJ84FnBMyp_3gF7giKLr_okOyj"></div><br>
            <input type="submit" name="send" value="Envoyer" class="btn btn-info">
        </form>
    </div>
    <?php } else { ?>
    <div class="w-50 m-5">
        <div class="alert alert-dismissible alert-warning mt-4">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="mb-0">Tu n'es pas connectés</a>.</p>
        </div>
        <a href="login" class="btn btn-primary">Se connecter</a>            
    </div>    

    <?php } ?>
</div>