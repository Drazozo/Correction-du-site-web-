<?php

if (\askly\permissions::grade() == "stagiaire") {

    header('Location: /403');

}

$question = $db->prepare('SELECT * FROM questions WHERE id = :id');
$question->execute(['id' => $params['id']]);
$q = $question->fetch();

$categories = explode(',', $q['categorie_id']);
$souscategories = explode(',', $q['subcat_id']);

if ($question->rowCount() != 1) {
    header('Location: /confirm-questions');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    \askly\admin::confirm_reponse($params['id']);
    $mail_content = file_get_contents('../app/mails/ask-approve.php');
    $mail_content = str_replace('xxxx_question_xxxx', $_POST['question'], $mail_content);
    $mail_content = str_replace('lienquestion', 'https://askly.fr/question-'.$q['id'], $mail_content);
    \askly\main::send_mail($a['email'], utf8_decode('Nouvelle réponse à votre question "'. $_POST['subject'] .'" | Askly.fr'), $mail_content, "Une nouvelle réponse à été apportée à votre question sur Askly.fr. Vous pouvez la consulter avec ce lien : https://askly.fr/question-". $q['id']);
}

require '../app/templates/elements/header.php';
require '../app/templates/confirm-reponse.php';
