<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitsearch'])){
    header('Location: /search-question-' . $_POST['search'] . '-1');
}

$q = \askly\main::pagination($params['current'], "questions", 25, "id", NULL, NULL);
$pages = $q['pages'];
$q = $q['q'];