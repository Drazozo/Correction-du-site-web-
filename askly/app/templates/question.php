<div>
    <div class="m-5">
        <h1 class="text-left">Comment pouvons-nous vous aider ?</h1><br>
        <div class="search-box" style="border-radius: 40px; min-width: 330px;">
            <form method="post" class="search-form">
                <input type="text" name="search" id="search" class="search w-75" style="border-radius: 20px; min-width: 310px;" placeholder="  Ecris ta question ici 🤓">
                <input type="image" src="/assets/images/search.svg" alt="Search" class="m-3" style="width: 40px">
                <!-- <input type="submit" value="RECHERCHER" class="send" src=""> -->
            </form><br>
            <p>Exemple de recherche : <a href="/" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Qui est le président de la république ? </a>  <a href="#scrollto" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Qui est le meilleur footballeur en France ?</a>  <a href="#scrollto" class="btn btn-dark btn-lg home-search" style="background: #5956E9; border: none;">Quelles sont les gestes de premiers secours ? </a> 
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <?php if($team){ echo '<a class="btn btn-info" href="https://teams.askly.fr/edit-question-'. $q['id'] . '" target="_BLANK">Modifier question (team)</a>'; } ?>      
    </div>
    <?php if(isset($_SESSION['error'])){ ?>
        <div class="alert alert-dismissible alert-success w-25 m-auto mt-4">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?= $_SESSION['error'] ?>
        </div>
        <?php
        unset($_SESSION['error']);
    } ?>
    <div class="d-flex justify-content-center flex-wrap" style="align-items: first baseline;">
        <div class="w-50 p-5 text-left <?php if($_COOKIE['theme'] == "light") { echo "text-dark"; } else { echo "text-light"; } ?>" style="width: 50% !important; min-width: 370px; margin: 0 auto;">
            <h1><?= $q['titre'] ?></h1><br>
            <p><?= html_entity_decode($q['reponse']) ?></p>
            <div class="w-50 d-flex justify-content-left align-items-start flex-wrap" style="font-size: 18px !important; ">
                <img src="/assets/images/time.png" alt="" style="height: 40px; margin-right: 10px;">
                <p>Publié le : <?= $q['response_date'] ?></p>
                <a href="/signalement-<?= $q['id'] ?>" class="btn btn-danger" style="margin-left: 10px;">Signaler</a></div><br>
                <div>
                    <?php if($next != NULL) {
                        echo '<h2>Prochaine question : <a href="/question-'. $next['id'].'">'. $next['titre'] .'</a></h2>';
                        } else {
                        echo '<h3>Pas de question à proposer dans le même thème...<br><br><a href="/ask-question" class="btn btn-info">Poser une question</a></h3>';
                        } ?>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center">
                        <div class="share-button sharer" style="display: block;">
                            <button type="button" class="btn btn-success share-btn">Partager la réponse</button>
                            <div class="social networks-5 ">
                            <!-- Facebook Share Button -->
                                <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://askly.fr/question-<?= $q['id'] ?>" target="_BLANK"><i class="fa fa-facebook"></i></a> 
                                <!-- Twitter Share Button -->
                                <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=title&amp;url=https://askly.fr/question-<?= $q['id'] ?>&amp;via=creativedevs" target="_BLANK"><i class="fa fa-twitter"></i></a> 
                                <!-- LinkedIn Share Button -->
                                <a class="fbtn share linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://askly.fr/question-<?= $q['id'] ?>&amp;title=title&amp;source=https://askly.fr/question-<?= $q['id'] ?>/" target="_BLANK"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="w-25 p-3" style="min-width: 350px; background-color: #D7ECFF; border-radius: 30px;">
                <h2>Categories : </h2><br>
                <?php foreach($cats as $c){
                    $cat = $db->prepare('SELECT * FROM categories WHERE id = :id');
                    $cat->execute(['id'=>$c]);
                    $ca = $cat->fetch();
                    echo "<a href=\"https://askly.fr/categorie-".$ca['id']."\" class=\"bg-primary p-3 w-50 text-white\" style=\"border-radius: 25px; min-width: 50px;\"> ".$ca['titre']."</a><br><br><br>";
                } ?>
                <h2>Sous-categories :</h2><br>
                <?php foreach($subcats as $sc){
                    $subcat = $db->prepare('SELECT * FROM sous_categories WHERE id = :id');
                    $subcat->execute(['id'=>$sc]);
                    $sc = $subcat->fetch();
                    echo "<a href=\"https://askly.fr/sous-categorie-".$sc['id']."\" class=\"bg-primary p-3 w-50 text-white\" style=\"border-radius: 25px; min-width: 100px;\"> ".$sc['titre']."</a><br><br><br>";
                } ?>
                <h2>Mots clés :</h2>
                <p><?= $q['keywords'] ?></p>
            </div>
        </div> 
    </div>

</div>

<script src="/assets/app.js"></script>