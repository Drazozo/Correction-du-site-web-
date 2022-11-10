<?php

if (\askly\permissions::grade() != "admin") {
    header('Location: /403;');
    exit;
}

$question = $db->prepare('SELECT * FROM questions WHERE id = :id');
$question->execute(['id' => $params['id']]);
$q = $question->fetch();

$asker = $db->prepare('SELECT * FROM users WHERE id = :id');
$asker->execute(['id'=>$q['owner_id']]);
$a = $asker->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail_content = file_get_contents('../app/mails/ask-deny.php');
    \askly\main::send_mail($a['email'], utf8_decode('Votre question : "'. $q['titre'] .'" n\'a pas été accéptée... | Askly.fr'), utf8_decode($mail_content), utf8_decode("Votre question n'a pas été accéptée... | Askly.fr"));
    \askly\admin::delete_question($q['id']);
    header('Location: /questions-1');
}