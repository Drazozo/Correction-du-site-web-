<div class="text-center">
    <h1>Modification de la question numéro <?= $q['id'] ?></h1>
    <form method="post" class="position-relative w-50 m-auto" style="z-index: 30;" enctype="multipart/form-data">
        <input type="text" name="titre" id="titre" value="<?= $q['titre'] ?>" class="form-control"><br><br>
        <textarea name="reponse" id="reponse" cols="30" rows="10" class="form-control d-none"></textarea><br><br>
        <h1>Réponse</h1>
    <hr>
    <div id="editor-container" class="bg-white">
        <?= $q['reponse'] ?>
    </div><br>

    <h1>Rendered HTML</h1>
    <hr>
    <div id="output-quill" class="bg-white"></div><br>
    <!-- <div class="d-flex justify-content-center">      
        <div class="m-2">
            <h1>Réponse</h1>
            <hr>
            <div id="editor-container" class="bg-white"></div>      
        </div>  
        <div class="m-2">   
            <h1>Rendered HTML</h1>
            <hr>
            <div id="output-quill" class="bg-white"></div><br>     
        </div>   
    </div> -->


    <!-- Create the editor container -->
<div id="editor">
</div>
        <p>Catégories & sous catégories : </p>
        <div class="d-flex justify-content-left flex-wrap">
        <?php 
            foreach($c as $v2){ 
                
                $subcat = $db->prepare('SELECT * FROM sous_categories WHERE cat_id = :cat_id ORDER BY titre ASC');
                $subcat->execute(['cat_id'=>$v2['id']]);
                $sc2 = $subcat->fetchAll(); 
                
                //dd($v2, $sc2);

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
                                <input type="checkbox" name="cat_<?= $v2['id'] ?>" id="cat_<?= $sv['id'] ?>" value="<?= $v2['id'] ?>" <?php if(str_contains($q['categorie_id'], $v2['id'] . ",") OR str_contains($q['categorie_id'], ", " . $v2['id']) OR $q['categorie_id'] == $v2['id']){ echo "checked"; } ?>>    
                                <label for="cat_<?= $v2['id'] ?>"><?= $v2['titre'] ?></label><br>
                                <hr>
                                <?php foreach($sc2 as $sv){ ?> 
                                    <input type="checkbox" name="subcat_<?= $sv['id'] ?>" id="subcat_<?= $sv['id'] ?>" value="<?= $sv['id'] ?>" <?php if(str_contains($q['subcat_id'], $sv['id'] . ",") OR str_contains($q['subcat_id'], ", " . $sv['id']) OR $q['subcat_id'] == $sv['id']){ echo "checked"; } ?>>
                                    <label for="subcat_<?= $sv['id'] ?>"><?= $sv['titre'] ?></label><br>
                                <?php  } ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if(\askly\permissions::grade() == "admin" or \askly\permissions::grade() == "assistant"){ ?>
        <p>État :</p>
        <select name="state" id="state" class="form-select w-25 text-center m-auto">
            <option value="brouillon" <?php if($q['state'] == "brouillon"){ echo "selected"; } ?>>Brouillon</option>
            <option value="publie" <?php if($q['state'] == "publie"){ echo "selected"; } ?>>Publié</option>
            <option value="programme">Programmé</option>
        </select>
        <?php } ?>
        <div class="d-flex justify-content-center">
            <div class="m-2">
                <h2>Mots clés :</h2>
                <textarea name="keywords" id="keywords" cols="30" rows="10" class="form-control"><?= $q['keywords'] ?></textarea>
                <br>
                <?php if($q['reponse_state'] == "valid"){ ?>
                <a href="/confirm-reponse-<?= $q['id'] ?>" class="btn btn-success">Valider la réponse</a>            
                <?php } ?>                
            </div>
            <div class="m-2">
                <h2>Sources</h2>
                <textarea name="sources" id="sources" cols="30" rows="10" class="form-control"><?= $q['sources'] ?></textarea><br><br>            
            </div> 
        </div>
        <input type="submit" name="edit" class="btn btn-danger" value="Attention, cette modification peut avoir un lourd impact">
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
<script>
(function() {
    function init(raw_markdown) {

        var quill = new Quill("#editor-container", {
        modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ["bold", "italic", "underline"],
        [{ 'list' : 'ordered' }, { 'list' : 'bullet' }],
        ["image", "code-block"]
        ]
        },
        placeholder: "Repondre ici à la question",
        theme: "snow" // or 'bubble'
        });        
        var md = window.markdownit();
        md.set({
        html: true
        });
        
        
        // Need to do a first pass when we're passing in initial data.
        var html = quill.container.firstChild.innerHTML;
        $("#output-quill").html(html);
        
        // text-change might not be the right event hook. Works for now though.
        quill.on("text-change", function(delta, source) {
            var html = quill.container.firstChild.innerHTML;
            var markdown = toMarkdown(html);
            var rendered_markdown = md.render(markdown);
            $("#reponse").text(html);
            $("#output-quill").html(html);
        });


    }   

    // console.log($("div.ql-qsd").html("<?= str_replace("\n", "", addslashes($q['reponse'])) ?>"))

    
    // Just some fake markdown that would come from the server.
    
    var text = "";
    text += "# Dillinger" + "\n";
    text += " " + "\n";
    text += "[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)" + "\n";
    text += " " + "\n";
    text += "Dillinger is a cloud-enabled, mobile-ready, offline-storage, AngularJS powered HTML5 Markdown editor." + "\n";
    text += " " + "\n";
    text += "  - Type some Markdown on the left" + "\n";
    text += "  - See HTML in the right" + "\n";
    text += "  - Magic" + "\n";
    text += " " + "\n";
    text += "# New Features!" + "\n";
    text += " " + "\n";
    text += "  - Import a HTML file and watch it magically convert to Markdown" + "\n";
    text += "  - Drag and drop images (requires your Dropbox account be linked)" + "\n";
    text += " " + "\n";
    text += " " + "\n";
    text += "You can also:" + "\n";
    text += "  - Import and save files from GitHub, Dropbox, Google Drive and One Drive" + "\n";
    text += "  - Drag and drop markdown and HTML files into Dillinger" + "\n";
    text += "  - Export documents as Markdown, HTML and PDF" + "\n";
    text += " " + "\n";
    text += "Markdown is a lightweight markup language based on the formatting conventions that people naturally use in email.  As [John Gruber] writes on the [Markdown site][df1]" + "\n";
    text += " " + "\n";
    text += "> The overriding design goal for Markdown's" + "\n";
    text += "> formatting syntax is to make it as readable" + "\n";
    text += "> as possible. The idea is that a" + "\n";
    text += "> Markdown-formatted document should be" + "\n";
    text += "> publishable as-is, as plain text, without" + "\n";
    text += "> looking like it's been marked up with tags" + "\n";
    text += "> or formatting instructions." + "\n";
    text += " " + "\n";
    text += "This text you see here is *actually* written in Markdown! To get a feel for Markdown's syntax, type some text into the left window and watch the results in the right." + "\n";
    text += " " + "\n";
    text += "### Tech" + "\n";
    text += " " + "\n";
    text += "Dillinger uses a number of open source projects to work properly:" + "\n";
    text += " " + "\n";
    text += "* [AngularJS] - HTML enhanced for web apps!" + "\n";
    text += "* [Ace Editor] - awesome web-based text editor" + "\n";
    text += "* [markdown-it] - Markdown parser done right. Fast and easy to extend." + "\n";
    text += "* [Twitter Bootstrap] - great UI boilerplate for modern web apps" + "\n";
    text += "* [node.js] - evented I/O for the backend" + "\n";
    text += "* [Express] - fast node.js network app framework [@tjholowaychuk]" + "\n";
    text += "* [Gulp] - the streaming build system" + "\n";
    text += "* [Breakdance](http://breakdance.io) - HTML to Markdown converter" + "\n";
    text += "* [jQuery] - duh" + "\n";
    text += " " + "\n";
    text += "And of course Dillinger itself is open source with a [public repository][dill]" + "\n";
    text += " on GitHub." + "\n";
    text += " " + "\n";
    text += "### Installation" + "\n";
    text += " " + "\n";
    text += "Dillinger requires [Node.js](https://nodejs.org/) v4+ to run." + "\n";
    text += " " + "\n";
    text += "Install the dependencies and devDependencies and start the server." + "\n";
    text += " " + "\n";
    text += "```sh" + "\n";
    text += "$ cd dillinger" + "\n";
    text += "$ npm install -d" + "\n";
    text += "$ node app" + "\n";
    text += "```" + "\n";
    text += " " + "\n";
    text += "For production environments..." + "\n";
    text += " " + "\n";
    text += "```sh" + "\n";
    text += "$ npm install --production" + "\n";
    text += "$ npm run predeploy" + "\n";
    text += "$ NODE_ENV=production node app" + "\n";
    text += "```" + "\n";
    text += " " + "\n";
    text += "### Plugins" + "\n";
    text += " " + "\n";
    text += "Dillinger is currently extended with the following plugins. Instructions on how to use them in your own application are linked below." + "\n";
    text += " " + "\n";
    text += "| Plugin | README |" + "\n";
    text += "| ------ | ------ |" + "\n";
    text += "| Dropbox | [plugins/dropbox/README.md] [PlDb] |" + "\n";
    text += "| Github | [plugins/github/README.md] [PlGh] |" + "\n";
    text += "| Google Drive | [plugins/googledrive/README.md] [PlGd] |" + "\n";
    text += "| OneDrive | [plugins/onedrive/README.md] [PlOd] |" + "\n";
    text += "| Medium | [plugins/medium/README.md] [PlMe] |" + "\n";
    text += "| Google Analytics | [plugins/googleanalytics/README.md] [PlGa] |" + "\n";
    text += " " + "\n";
    text += " " + "\n";
    text += "### Development" + "\n";
    text += " " + "\n";
    text += "Want to contribute? Great!" + "\n";
    text += " " + "\n";
    text += "Dillinger uses Gulp + Webpack for fast developing." + "\n";
    text += "Make a change in your file and instantanously see your updates!" + "\n";
    text += " " + "\n";
    text += "Open your favorite Terminal and run these commands." + "\n";
    text += " " + "\n";
    text += "First Tab:" + "\n";
    text += "```sh" + "\n";
    text += "$ node app" + "\n";
    text += "```" + "\n";
    text += " " + "\n";
    text += "Second Tab:" + "\n";
    text += "```sh" + "\n";
    text += "$ gulp watch" + "\n";
    text += "```" + "\n";
    text += " " + "\n";
    text += "(optional) Third:" + "\n";
    text += "```sh" + "\n";
    text += "$ karma test" + "\n";
    text += "```" + "\n";
    text += "#### Building for source" + "\n";
    text += "For production release:" + "\n";
    text += "```sh" + "\n";
    text += "$ gulp build --prod" + "\n";
    text += "```" + "\n";
    text += "Generating pre-built zip archives for distribution:" + "\n";
    text += "```sh" + "\n";
    text += "$ gulp build dist --prod" + "\n";
    text += "```" + "\n";
    text += "### Docker" + "\n";
    text += "Dillinger is very easy to install and deploy in a Docker container." + "\n";
    text += " " + "\n";
    text += "By default, the Docker will expose port 80, so change this within the Dockerfile if necessary. When ready, simply use the Dockerfile to build the image." + "\n";
    text += " " + "\n";
    text += "```sh" + "\n";
    text += "cd dillinger" + "\n";
    text += "docker build -t joemccann/dillinger:${package.json.version}" + "\n";
    text += "```" + "\n";
    text += "This will create the dillinger image and pull in the necessary dependencies. Be sure to swap out `${package.json.version}` with the actual version of Dillinger." + "\n";
    text += " " + "\n";
    text += "Once done, run the Docker image and map the port to whatever you wish on your host. In this example, we simply map port 8000 of the host to port 80 of the Docker (or whatever port was exposed in the Dockerfile):" + "\n";
    text += " " + "\n";
    text += "```sh" + "\n";
    text += "docker run -d -p 8000:8080 --restart=\"always\" <youruser>/dillinger:${package.json.version}" + "\n";
    text += "```" + "\n";
    text += " " + "\n";
    text += "Verify the deployment by navigating to your server address in your preferred browser." + "\n";
    text += " " + "\n";
    text += "```sh" + "\n";
    text += "127.0.0.1:8000" + "\n";
    text += "```" + "\n";
    text += " " + "\n";
    text += "#### Kubernetes + Google Cloud" + "\n";
    text += " " + "\n";
    text += "See [KUBERNETES.md](https://github.com/joemccann/dillinger/blob/master/KUBERNETES.md)" + "\n";
    text += " " + "\n";
    text += " " + "\n";
    text += "### Todos" + "\n";
    text += " " + "\n";
    text += " - Write MOAR Tests" + "\n";
    text += " - Add Night Mode" + "\n";
    text += " " + "\n";
    text += "License" + "\n";
    text += "----" + "\n";
    text += " " + "\n";
    text += "MIT" + "\n";
    text += " " + "\n";
    text += " " + "\n";
    text += "**Free Software, Hell Yeah!**" + "\n";
    text += " " + "\n";
    text += "[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)" + "\n";
    text += " " + "\n";
    text += " " + "\n";
    text += "   [dill]: <https://github.com/joemccann/dillinger>" + "\n";
    text += "   [git-repo-url]: <https://github.com/joemccann/dillinger.git>" + "\n";
    text += "   [john gruber]: <http://daringfireball.net>" + "\n";
    text += "   [df1]: <http://daringfireball.net/projects/markdown/>" + "\n";
    text += "   [markdown-it]: <https://github.com/markdown-it/markdown-it>" + "\n";
    text += "   [Ace Editor]: <http://ace.ajax.org>" + "\n";
    text += "   [node.js]: <http://nodejs.org>" + "\n";
    text += "   [Twitter Bootstrap]: <https://twitter.github.com/bootstrap/>" + "\n";
    text += "   [jQuery]: <https://jquery.com>" + "\n";
    text += "   [@tjholowaychuk]: <https://twitter.com/tjholowaychuk>" + "\n";
    text += "   [express]: <http://expressjs.com>" + "\n";
    text += "   [AngularJS]: <https://angularjs.org>" + "\n";
    text += "   [Gulp]: <http://gulpjs.com>" + "\n";
    text += " " + "\n";
    text += "   [PlDb]: <https://github.com/joemccann/dillinger/tree/master/plugins/dropbox/README.md>" + "\n";
    text += "   [PlGh]: <https://github.com/joemccann/dillinger/tree/master/plugins/github/README.md>" + "\n";
    text += "   [PlGd]: <https://github.com/joemccann/dillinger/tree/master/plugins/googledrive/README.md>" + "\n";
    text += "   [PlOd]: <https://github.com/joemccann/dillinger/tree/master/plugins/onedrive/README.md>" + "\n";
    text += "   [PlMe]: <https://github.com/joemccann/dillinger/tree/master/plugins/medium/README.md>" + "\n";
    text += "   [PlGa]: <https://github.com/RahulHP/dillinger/blob/master/plugins/googleanalytics/README.md>" + "\n";
    
    text = "";
    
    init();
})();
</script>