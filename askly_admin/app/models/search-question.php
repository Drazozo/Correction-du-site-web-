<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitsearch'])) {
    header('Location: /search-question-' . $_POST['search'] . '-1');
}

$word = str_replace('%20', ' ', $params['search']);

$current = $params['current'];
$perPage = 35;

$count = $db->prepare("SELECT count(id) FROM questions WHERE titre LIKE '%$word%' OR keywords LIKE '%$word%' OR reponse LIKE '%$word%' OR id LIKE :id");
$count->execute(['id'=>$word]);
$c = $count->fetch(PDO::FETCH_NUM)[0];

$pages = ceil($c / $perPage);

if ($current > $pages or $current == 0) {
    header('Location: /404');
}

$offset = $perPage * ($current - 1);

$search = $db->prepare("SELECT * FROM questions WHERE titre LIKE '%$word%' OR keywords LIKE '%$word%' OR reponse LIKE '%$word%' OR id LIKE :id ORDER BY id LIMIT $perPage OFFSET $offset");
$search->execute(['id'=>$word]);
$s = $search->fetchAll();