<?php
if (\askly\permissions::grade() == "stagiaire") {

    header('Location: /403');

}
$confirm_questions = $db->prepare("SELECT * FROM questions WHERE reponse_state = 'valid' AND state != 'deleted'");
$confirm_questions->execute();
$cq = $confirm_questions->fetchAll();
$cqcount = $confirm_questions->rowCount();