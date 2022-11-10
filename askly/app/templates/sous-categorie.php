<div class="text-center position-relative" style="z-index:50;">
    <h1 class="text-center w-50 m-auto">Questions dans la sous-catégorie "<?= $sc['titre'] ?>"</h1>
    <p class="text-center w-50" style="margin-right: auto; margin-left: auto;"><?= $sc['description'] ?></p>
    <div class="text-center w-50" style="margin-left: auto; margin-right: auto;">
        <?php foreach($q as $v){ ?>
            <div class="accordion accordion-flush" id="accordionFlushExample" style="margin-left: auto; margin-right: auto;"><br>
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
    <div class="text-center w-50" style="margin-left:auto; margin-right: auto; margin-top: 10%;">
        <hr><br>
        <h1>Vous ne trouvez pas votre réponse ?</h1><br>
        <a href="/ask-question" class="btn btn-dark btn-lg" style="background: #009CD1; border: none;">Posez-nous votre question</a><br>
        <hr><br>
    </div>
    <div class="d-flex justify-content-center">
        <?php if($params['current'] > 1){ ?>

        <a href="/categorie-<?= $params['id'].'-'.$params['current']-1 ?>" class="btn btn-primary">&laquo; Précedent</a>
        
        <?php 

        } 
            if($params['current'] < $return['pages']){ ?>
                <a href="/categorie-<?= $params['id'].'-'.$params['current']+1 ?>" class="btn btn-primary">Suivant &raquo;</a>
            <?php 
            }
        ?>
    </div>
</div>