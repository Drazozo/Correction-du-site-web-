<?php
 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitsearch'])) {
    header('Location: /search-categorie-' . $_POST['search'] . '-1');
}

$c = \askly\main::pagination($params['current'], "categories", 25, "id ", NULL, NULL);
$pages = $c['pages'];
$c = $c['q'];