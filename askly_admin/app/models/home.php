<?php

$todayq = $db->prepare('SELECT * FROM questions WHERE DAY(date) = DAY(NOW())');
$todayq->execute();
$tq = $todayq->rowCount();

$todayrq = $db->prepare('SELECT * FROM questions WHERE DAY(response_date) = DAY(NOW()) AND reponse_state = "valided" AND reponse IS NOT NULL');
$todayrq->execute();
$trq = $todayrq->rowCount();

$qrtotal = $db->prepare('SELECT * FROM questions WHERE reponse_state = "valided" AND reponse IS NOT NULL');
$qrtotal->execute();
$qrt = $qrtotal->rowCount();

$srtotal = $db->prepare('SELECT * FROM signalement');
$srtotal->execute();
$srt = $srtotal->rowCount();

$todayusers = $db->prepare('SELECT * FROM connections WHERE DAY(date) = DAY(NOW())');
$todayusers->execute();
$tu = $todayusers->rowCount();

$yesterdayu = $db->prepare('SELECT * FROM connections WHERE DAY(date) = DAY(DATE_SUB(DATE(NOW()), INTERVAL 1 DAY))');
$yesterdayu->execute();
$yu = $yesterdayu->rowCount();

$respondq = $db->prepare('SELECT id FROM questions WHERE (ISNULL(reponse) = 1 OR reponse = "")  AND state != "deleted"');
$respondq->execute();
$rq = $respondq->rowCount();

$verifq = $db->prepare("SELECT * FROM questions WHERE reponse_state = 'valid' AND state != 'deleted'");
$verifq->execute();
$vq = $verifq->rowCount();

$nbrsubcat = $db->prepare('SELECT * FROM sous_categories');
$nbrsubcat->execute();
$nsc = $nbrsubcat->rowCount();

$nbrcat = $db->prepare('SELECT id FROM categories');
$nbrcat->execute();
$nc = $nbrcat->rowCount();

$users = $db->prepare('SELECT id FROM users');
$users->execute();
$u = $users->rowCount();

$assistants = $db->prepare('SELECT id FROM users WHERE grade = :grade');
$assistants->execute(['grade' => "assistant"]);
$ast = $assistants->rowCount();

$stagiaires = $db->prepare('SELECT id FROM users WHERE grade = :grade');
$stagiaires->execute(['grade' => "stagiaire"]);
$sg = $stagiaires->rowCount();

$questions = $db->prepare('SELECT id FROM questions WHERE state != "deleted"');
$questions->execute();
$q = $questions->rowCount();

$srt = $db->prepare('SELECT * FROM signalement');
$srt->execute();
$srt = $srt->rowCount();