<?php

$q = $db->prepare('SELECT * FROM questions WHERE id = :id');
$q->execute(['id'=>$params['id']]);

if($q->rowCount() != 1){
    header('Location: /404');
}

$q = $q->fetch();

$asker = $db->prepare('SELECT * FROM users WHERE id = :id');
$asker->execute(['id'=>$_SESSION['id']]);
$a = $asker->fetch();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    \askly\main::signalement($q['id'], $_POST['raison'], $_SESSION['id']);
    \askly\main::send_mail($a['email'], utf8_decode("Signalement effectué"), utf8_decode("Merci d'avoir signalé !"), utf8_decode("Merci d'avoir signalé !"));
    $_SESSION['error'] = "Merci d'avoir signalé ! ";
    header('Location: /question-' . $q['id']);
}