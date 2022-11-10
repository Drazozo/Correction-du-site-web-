<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="NeeZiaa#2271">
    <title><?= $page['title'] ?></title>
    <link rel="stylesheet" href="assets/main.css">    
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("formlogin").submit();
            console.log('heyu22')
        }
    </script>
    <?php if($match['target'] != "login" && $match['target'] != "confirm"){ ?> 
    <script src="https://cdn.jsdelivr.net/npm/@widgetbot/crate@3" async defer>
        new Crate({
            server: '936283959594201088',
            channel: '936357916561248256',
            notifications: true
        })
    </script>        
    <?php } ?>

</head>
<body> 
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-dark m-2" style="z-index: 20; color: white !important; ">
            <div class="container-fluid">
                <a href="#"><input type="image" src="assets/images/logo.png" alt="Logo" style="width: 60px; margin-right: 10px;" class="m-2"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02" style="margin-left: 20%">
                    <div class="">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                                <a class="nav-link active" href="https://askly.fr/">GO public</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="https://askly.fr/categories-1">Nos catégories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="https://askly.fr/ask-question">Poser une question</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="https://askly.fr/nous-contacter">Contactez la team</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-wrap m-5 box-header block">
            <h1 class="title1">La réponse à vos questions par une équipe de professionnels -<b> teams</b></h1>
            <img src="/assets/images/illustration-ask-question.svg" alt="" class="img1 top-0 sticked-top imgheader" id=".imgheader">
            <img src="/assets/images/bubble-29.png" alt="" class="bubble imgheader" id="imgheader">
        </div>
        <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ ?>
        <div class="w-75">
            <nav class="navbar navbar-expand-lg navbar-dark m-2" style="z-index: 20;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <h2><a class="nav-link active" aria-current="page" href="/">Accueil</a></h2>
                    </li>
                    <li class="nav-item">
                        <h2><a class="nav-link active" aria-current="page" href="/categories-1">Gestion catégories</a></h2>
                    </li>
                    <li class="nav-item">
                        <h2><a class="nav-link active" href="/questions-1">Gestion questions</a></h2>
                    </li>
                    <li class="nav-item">
                        <h2><a class="nav-link active" href="/utilisateurs-1">Gestion utilisateurs</a></h2>
                    </li>
                    <li class="nav-item">
                        <h2><a class="nav-link active" href="/sous-categories-1">Gestion sous-catégories</a></h2>
                    </li>
                </ul>
            </nav>
        </div>            
        <?php } ?>
        
    </header>