<div class="position-relative m-5" style="z-index: 20;">
    <h1 class="mx-5">Comment pouvons-nous vous aider ?</h1><br>
    <div class="search-box" style="border-radius: 40px; min-width: 360px;">
            <form method="post" class="search-form">
                <input type="text" name="search" id="search" class="search w-75" style="border-radius: 20px; min-width: 340px;" placeholder="  Ecris ta question ici 🤓">
                <input type="image" src="/assets/images/search.svg" alt="Search" class="m-3" style="width: 40px">
                <!-- <input type="submit" value="RECHERCHER" class="send" src=""> -->
            </form><br>
            <p>Exemple de recherche : <a href="/" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Qui est le président de la république ? </a>  <a href="#scrollto" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Qui est le meilleur footballeur en France ?</a>  <a href="#scrollto" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Quelles sont les gestes de premiers secours ? </a> 
        </div>
    <div class="text-center w-50" style="margin-left: auto; margin-right: auto;">
    <h2><u><?= $scount ?></u> résultats pour la recherche "<?= str_replace('%20', ' ', urldecode($params['search'])); ?>"</h2>
        <?php foreach($s as $v){ ?>
        <div class="accordion accordion-flush" id="accordionFlushExample"><br>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?= $v['id'] ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $v['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $v['id'] ?>">
                        <p style="font-size: 1.5rem;"><?= $v['titre'] ?></p> 
                    </button>
                </h2>
                <div id="collapse<?= $v['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $v['id'] ?>" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <?= substr($v['reponse'], 0, 200).'...' ?>
                        <a href="question-<?= $v['id'] ?>" class="btn btn-primary">Voir la réponse complète</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <hr>
    <div class="text-center">
        <h2>Vous ne trouvez pas votre réponse ?</h2><br>
        <a href="/ask-question" class="btn btn-primary">Posez-nous votre question</a>        
    </div>
    
</div>