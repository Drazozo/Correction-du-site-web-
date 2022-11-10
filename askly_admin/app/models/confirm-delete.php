<?php

if (\askly\permissions::grade() != "admin") {
    header('Location: /403');
}

$question = $db->prepare('SELECT * FROM questions WHERE id = :id');
$question->execute(['id' => $params['id']]);
$q = $question->fetch();

$asker = $db->prepare('SELECT prenom,nom FROM users WHERE id = :id');
$asker->execute(['id' => $q['owner_id']]);
$a = $asker->fetch();

$resp = $db->prepare('SELECT nom,prenom,grade FROM users WHERE id = :id');
$resp->execute(['id' => $q['responser']]);
$rs = $resp->fetch();

if (\askly\permissions::get_grade($q['responser']) == "stagiaire" or \askly\permissions::get_grade($q['responser']) == "user") {

    $response = "<p class=\"text-warning\"><a class=\"text-warning\" href=\"valid-reponse\">A valider</a></p>";
    $responser = "<p>" . $q['response_date'] . "" . $rs['prenom'] . " " . $rs['nom'] . "</p>";

}
else {

    $response = "<p class=\"text-success\">Oui</p>";
    $responser = "<p>" . $rs['prenom'] . " " . $rs['nom'] . "</p>";

}

if ($q['state'] == 'publie') {
    $state = "<p class=\"text-success\">Publié</p>";
}
elseif ($q['state'] == 'deleted') {
    $state = "<p class=\"text-danger\">Supprimé</p>";
}
else {
    $state = "<p class=\"text-warning\">Brouillon</p>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['confirm'])) {
    \askly\admin::delete_question($q['id']);
}