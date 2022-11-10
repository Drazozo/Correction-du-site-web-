<div class="text-center position-relative" style="z-index:80;">
    
    <?php if(\askly\permissions::grade() == "admin"){ ?>
    <div class="d-flex flex-wrap justify-content-center text-white">
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $q ?></p>
            <h2>Nombre questions posées au total</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $tq ?></p>
            <h2>Nombre questions posées aujourd'hui</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $rq ?></p>
            <h2>Nombre questions à répondre</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $trq ?></p>
            <h2>Nombre questions répondues aujourd'hui</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $qrt ?></p>
            <h2>Nombre question répondues au total</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $yu ?></p>
            <h2>Nombre visiteurs hier</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $tu ?></p>
            <h2>Nombre visiteurs aujourd'hui</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <a href="/sous-categories-1">    
                <p><?= $nsc ?></p>
                <h2>Nombre sous catégories</h2>
            </a>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <a href="/categories-1">       
                <p><?= $nc ?></p>
                <h2>Nombre de catégories</h2>
            </a>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <a href="/signalement">
                <p><?= $srt ?></p>
                <h2>Nombre de signalements à traiter</h2>
        </a>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <a href="/confirm-questions">
                <p><?= $vq ?><br></p>
                <h2>Nombre questions stagiaire à vérifier</h2>
            </a>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <a href="/utilisateurs-1">
                <p><?= $u ?></p>
                <h2>Nombre de membres</h2>
            </a>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $ast ?></p>
            <h2>Nombre helper assistant</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $sg ?></p>
            <h2>Nombre helper stagiaire</h2>
        </div>
    </div>
    <?php } elseif(\askly\permissions::grade() == "assistant") { ?>
    <div class="d-flex flex-wrap justify-content-center">
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <a href="/confirm-questions"><p><?= $vq ?><br></p>
            <h2>Nombre questions stagiaire à vérifier</h2></a>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $rq ?></p>
            <h2>Nombre questions à répondre</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $trq ?></p>
            <h2>Nombre questions répondues aujourd'hui</h2>
        </div>
    </div>
    <?php } else { ?>
    <div class="d-flex flex-wrap justify-content-center">
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $trq ?></p>
            <h2>Nombre questions répondues aujourd'hui</h2>
        </div>
        <div class="bg-secondary m-4 p-4" style="width: 20%; min-width: 15rem;">
            <p><?= $rq ?></p>
            <h2>Nombre questions à répondre</h2>
        </div>
    </div>
    <?php } ?>

    </div>
    <div class="text-center">   
        <widgetbot server="936283959594201088" channel="936357916561248256" style="width: 60%; height: 500px; z-index: 30; position: relative;"></widgetbot>
        <script src="https://cdn.jsdelivr.net/npm/@widgetbot/html-embed"></script>
    </div>
</div>