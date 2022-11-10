<?php

// Affichage des erreurs -- dev
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// Base du site

require_once "../src/base.php";

$router = new AltoRouter();

// Liste des urls

require_once "../app/routes.php";

$match = $router->match();

if (!isset($_SESSION['id']) && empty($_SESSION['id']) && $match['target'] != "login" && $match['target'] != "confirm") { //header('Location: https://teams.askly.fr/login');
    if(\askly\main::getIp() == "212.227.142.154"){

    } else {
        header('Location: https://teams.askly.fr/login');
    }
}
elseif (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (\askly\permissions::is_team($_SESSION['id']) == false) {
        \askly\login::disconnect();
    }

}

if (is_array($match)) {

    $params = $match['params'];

    // Développement : affiche les paramètres et détails de l'url
    // dump($match);

    $page['title'] = $match['name'];

    // Model

    include_once '../app/models/' . $match['target'] . '.php';

    // Header

    require_once '../app/templates/elements/header.php';

    // Template

    require_once '../app/templates/' . $match['target'] . '.php';
}
else {
    require '../app/templates/elements/header.php';
    require_once '../app/templates/errors/404.php';
}

require '../app/templates/elements/footer.php';