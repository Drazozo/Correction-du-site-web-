<div class="position-relative" style="z-index: 50;">
    <h1 class="text-center" style="z-index: 50;">Choisissez votre thématique <?= $_SESSION['surname'] ?>:</h1>
    <div class="d-flex justify-content-center flex-wrap">
        <?php foreach($q as $v){ ?>
       
            <div class="categorie-home m-5 text-center p-2" style="min-width: 18rem;"> 
                <a href="categorie-<?= $v['id'] ?>-1" style="text-decoration: none; color: black;">
                    <img src="assets/images/categories/<?= $v['img'] ?>" alt="" class="w-50"><br><br>
                    <p><?= $v['titre'] ?></p>
                </a>
            </div>
        
        <?php } ?>

    </div>
    <div class="d-flex justify-content-center">
        <?php if($params['current'] > 1){ ?>

        <a href="/categories-<?= $params['current'] - 1 ?>" class="btn btn-primary">&laquo; Précedent</a>
        
        <?php 

        } 

        if($params['current'] < $return['pages']){ ?>
            <a href="/categorie-<?= $params['current'] + 1 ?>" class="btn btn-primary">Suivant &raquo;</a>
        <?php 
        }
        ?>
    </div>
</div>