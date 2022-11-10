<div class="m-5 w-50 text-presentation" style="min-width: 18rem;">
    <p>Nous produisons <b>60 000 pensées par jour</b>, soit environ 1 pensée par <b>seconde</b> autant de questions auxquelles nous pouvons avoir besoin d'une réponse au cours de la journée. Nous voulons apporter une <b>réponse à tes questions</b> de façon pertinentes.</p>
    <div class="d-flex justify-content-center">
        <a href="#scrollto" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Effectuer une recherche</a>        
    </div>
</div>
<div class="text-center m-5">
    <?php if(isset($_SESSION['id'])){ echo"<h1 class=\"display-3\" id=\"scrollto\"><b>Bonjour " . $_SESSION['surname'] . ",</b></h1>"; } ?>
    <p class="h4">Comment pouvons nous vous aider ?</p>
</div>
<div class="search-box m-auto" style="border-radius: 40px;">
    <form method="post" class="search-form">
        <input type="text" name="search" id="search" class="search w-75" style="border-radius: 20px; min-width: 340px;" placeholder="  Ecris ta question ici 🤓">
        <input type="image" src="/assets/images/search.svg" alt="Search" class="m-3" style="width: 40px">
        <!-- <input type="submit" value="RECHERCHER" class="send" src=""> -->
    </form><br>
    <p>Exemple de recherche : <a href="/" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Qui est le président de la république ? </a>  <a href="#scrollto" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Qui est le meilleur footballeur en France ?</a>  <a href="#scrollto" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Quelles sont les gestes de premiers secours ? </a> 
</div>
<div class="m-5">
    <h1 class="text-center">Choisissez votre thématique :</h1>
    <div class="d-flex justify-content-center flex-wrap align-items-center">
        <?php foreach($c as $v){ ?>
            <div class="categorie-home m-5 text-center" style="min-width: 280px;">
                <a href="categorie-<?= $v['id'] ?>-1" style="text-decoration: none; color: black;">
                    <img src="assets/images/categories/<?= $v['img'] ?>" alt="" class="w-50">
                    <p><?= $v['titre'] ?></p>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
    <h2 class="text-center">Les questions les plus vues :</h2>
<div class="text-center w-75 m-auto">
    <div class="accordion accordion-flush" id="accordionFlushExample" style="min-width: 280px;"><br>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <p style="font-size: 1.5rem;"><?= $qv[0]['titre'] ?></p> 
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><?= \askly\main::remove_tags(strip_tags($qv[0]['reponse'])) ?> <a href="/question-<?= $qv[0]['id'] ?>" class="btn btn-primary">Voir la question</a></div>
            </div>
        </div>
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample" style="min-width: 280px;"><br>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <p style="font-size: 1.5rem;"><?= $qv[1]['titre'] ?></p> 
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><?= \askly\main::remove_tags(strip_tags($qv[1]['reponse'])) ?> <a href="/question-<?= $qv[1]['id'] ?>" class="btn btn-primary">Voir la question</a></div>
            </div>
        </div>
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample" style="min-width: 280px;"><br>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <p style="font-size: 1.5rem;"><?= $qv[2]['titre'] ?></p> 
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><?= \askly\main::remove_tags(strip_tags($qv[2]['reponse'])) ?> <a href="/question-<?= $qv[2]['id'] ?>" class="btn btn-primary">Voir la question</a></div>
            </div>
        </div>
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample" style="min-width: 280px;"><br>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <p style="font-size: 1.5rem;"><?= $qv[3]['titre'] ?></p> 
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><?= \askly\main::remove_tags(strip_tags($qv[3]['reponse'])) ?> <a href="/question-<?= $qv[3]['id'] ?>" class="btn btn-primary">Voir la réponse</a></div>
            </div>
        </div>
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample" style="min-width: 280px;"><br>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <p style="font-size: 1.5rem;"><?= $qv[4]['titre'] ?></p> 
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><?= \askly\main::remove_tags(strip_tags($qv[4]['reponse'])) ?> <a href="/question-<?= $qv[4]['id'] ?>" class="btn btn-primary">Voir la réponse</a></div>
            </div>
        </div>
    </div>
    
    <div class="accordion accordion-flush" id="accordionFlushExample" style="min-width: 280px;"><br>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingsix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                    <p style="font-size: 1.5rem;"><?= $qv[5]['titre'] ?></p> 
                </button>
            </h2>
            <div id="collapsesix" class="accordion-collapse collapse" aria-labelledby="headingsix" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><?= \askly\main::remove_tags(strip_tags($qv[5]['reponse'])) ?> <a href="/question-<?= $qv[5]['id'] ?>" class="btn btn-primary">Voir la réponse</a></div>
            </div>
        </div>
    </div>
</div>

<div class="text-center m-5">
    <h1>Vous ne trouvez pas votre réponse ?</h1><br>
    <a href="/ask-question" class="btn btn-dark btn-lg" style="background: #009CD1; border: none;">Posez-nous votre question</a>        
</div>