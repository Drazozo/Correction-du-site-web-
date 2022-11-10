<div class="d-flex justify-content-left flex-wrap">
    <h1 style="color: #009CD1;" class="text-center m-5 w-75">Vous n’avez pas trouvé réponse à votre question...                                              On est désolé ! </h1>
    <div class="search-box" style="border-radius: 40px;">
        <form method="post" class="search-form">
            <input type="text" name="search" id="search" class="search" style="border-radius: 20px;" placeholder="  Exemple: Qui est le président de la république française ?">
            <input type="image" src="/assets/images/search.svg" alt="Search" class="m-3" style="width: 40px">
            <!-- <input type="submit" value="RECHERCHER" class="send" src=""> -->
        </form><br>
    <p>Exemple de recherche : <?= htmlentities("<président>, <argent>, <football>")?>..</p>
</div>
    <?php if(isset($_SESSION['id'])){ ?>
    <div>
        <div class="alert alert-dismissible alert-info w-100 mt-2">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            Tu es bien enregistré <?= $_SESSION['surname'] ?>, dès qu’une réponse sera apporté à ta question, on te notifiera de l’avancé du traitement de ta demande sur ton e-mail qui est <strong><?= $_SESSION['email'] ?></strong>
        </div>
        <p class="w-50"></p>
    </div>
    <?php } ?>
    <div><br><br>
        <img src="assets/images/illustration-banner.svg" alt="" style="width: 80%; min-width: 15rem;">    
    </div>
    <?php if(isset($_SESSION['id'])){ ?>

    <div class="m-2 w-50">
        <form action="" method="post">
            <p>Aidez-nous à nous améliorer en proposant l’ajout de votre question à notre base de connaissance.</p><br>
            <h1>Quel est ta question,  <strong><?= $_SESSION['surname'] ?></strong> ?</h1>
            <input type="text" name="question" id="question" class="form-control" <?php if(isset($_SESSION['ask_question']) && !empty($_SESSION['ask_question'])){ echo 'value="'. urldecode($_SESSION['ask_question'] .'"'); } ?>><br><br>
            <h1>Pour toi, dans quel catégorie, pourions-nous affiliez votre question ? </h1><br>
            <select name="categorie" id="categorie" class="form-control">
                <?php foreach($cat as $v){ ?> <option value="<?= $v['id'] ?>"><?= $v['titre'] ?></option> <?php } ?>
            </select><br><br>
            <h1>Aurais-tu une réponse à apporter ?</h1><br><br>
            <textarea name="reponse" id="reponse" cols="30" rows="10" class="form-control"></textarea><br><br>
            <input type="submit" value="Poser ma question" class="btn btn-primary" name="send">
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