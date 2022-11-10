<?php

require_once "../src/base.php";

require_once "../app/routes.php";

$match = $router->match();

if($_COOKIE['consent'] == "false" && $match['target'] != "no-consent"){
    header('Location: /no-consent');
}

if (is_array($match)) {

    $params = $match['params'];

    $page['title'] = $match['name'];

    include_once "../app/models/" . $match['target'] . ".php";
    require_once "../app/templates/elements/header.php";
    require_once "../app/templates/" . $match['target'] . ".php";

}
else {

    $page['title'] = '404';

    require '../app/templates/elements/header.php';
    require_once '../app/templates/errors/404.php';


}
require '../app/templates/elements/footer.php';