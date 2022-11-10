<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitsearch'])){
    header('Location: /search-sous-categorie-' . $_POST['search'] . '-1');
}

$sc = \askly\main::pagination($params['current'], "sous_categories", 25, "id", NULL, NULL);
$pages = $sc['pages'];
$sc = $sc['q'];