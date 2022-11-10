<div class="text-center postion-relative w-50 m-auto" style="z-index: 50;">
    <form method="post">
        <h2>Titre</h2>
        <input type="text" name="titre" id="titre" class="form-control"><br>
        <textarea name="reponse" id="reponse" cols="30" rows="10" class="form-control d-none"></textarea><br><br>
        <h1>Réponse</h1>
    <hr>
    <div id="editor-container" class="bg-white">
    </div><br>

    <h1>Rendered HTML</h1>
    <hr>
    <div id="output-quill" class="bg-white"></div><br>

        <p>Catégories & sous catégories : </p>
        <div class="d-flex justify-content-left flex-wrap">
        <?php 
        foreach($c as $v2){ 
            
            $subcat = $db->prepare('SELECT * FROM sous_categories WHERE cat_id = :cat_id ORDER BY titre ASC');
            $subcat->execute(['cat_id'=>$v2['id']]);
            $sc2 = $subcat->fetchAll(); 

            ?>

            <div class="accordion accordion-flush w-50" id="accordionFlushExample" style="min-width: 300px;"><br>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $v2['id'] ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $v2['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $v2['id'] ?>">
                            <p style="font-size: 1.5rem;"><?= $v2['titre'] ?></p> 
                        </button>
                    </h2>
                    <div id="collapse<?= $v2['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $v2['id'] ?>" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body" style="text-align: left;">
                            <input type="checkbox" name="cat_<?= $v2['id'] ?>" id="cat_<?= $sv['id'] ?>" value="<?= $v2['id'] ?>">    
                            <label for="cat_<?= $v2['id'] ?>"><?= $v2['titre'] ?></label><br>
                            <hr>
                            <?php foreach($sc2 as $sv){ ?> 
                                <input type="checkbox" name="subcat_<?= $sv['id'] ?>" id="subcat_<?= $sv['id'] ?>" value="<?= $sv['id'] ?>">    
                                <label for="subcat_<?= $sv['id'] ?>"><?= $sv['titre'] ?></label><br>
                            <?php  } ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <h2>Etat</h2>
        <?php if(\askly\permissions::grade() === "admin" or \askly\permissions::grade() === "assistant"){ ?> 
            <select name="state" id="state" class="form-select">
                <option value="publie">Publié</option>
                <option value="brouillon">Brouillon</option>
                <option value="programme">Programmé</option>
            </select><br>
        <?php } ?>

        <div class="d-flex justify-content-center m-auto">
            <div class="m-2">
                <h2>Mots clés :</h2>
                <textarea name="keywords" id="keywords" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="m-2">
                <h2>Sources</h2>
                <textarea name="sources" id="sources" cols="30" rows="10" class="form-control"></textarea>         
            </div> 
        </div></div>
        <input type="submit" value="Créer" class="btn btn-primary">
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="module" src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script type="module" src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.3.2/markdown-it.min.js" integrity="sha512-TIDbN32lXOg2Mw1VcnKrQLZgfALryJogWCu/NHWtlMCR1jget+mOwMtdehBBZz2f9PKeK2AQPwVxkbl4u/1H5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/12.3.2/markdown-it.js" integrity="sha512-D9Tm1Ka4uHM/rVls3BMcbRImlmERZBm1893Yljz60eI3kdc2k0BWL+MWZt8zd8/Vpcjuq9hxEAAoT+Y1W4iFIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/to-markdown/3.1.1/to-markdown.min.js" integrity="sha512-0L6lub8yE59v4EebBVEAV9AjIwS6rx3PtUCKt0OPPco8FrIK+QAhiFnYyudO04Q+iDcyGxoE9XMyqYeOZGPOPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/to-markdown/3.1.1/to-markdown.js" integrity="sha512-0oqCSNfUv2A8jbZEYRXDmLLF4Zw6HcUXL9MmPxujc6tXNt0D9G2AfYXcD3zX1RViD7pT0So1NdEHRRlT3CvP9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="assets/app.js"></script>