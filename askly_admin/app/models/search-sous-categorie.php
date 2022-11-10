<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitsearch'])) {
    header('Location: /search-sous-categorie-' . $_POST['search'] . '-1');
}

$word = str_replace('%20', ' ', $params['search']);

$current = $params['current'];
$perPage = 35;

$count = $db->prepare("SELECT count(id) FROM sous_categories WHERE id = :id OR titre LIKE :titre OR keywords LIKE :keywords OR description LIKE :description");
$count->execute([
    'titre' => "%". $word ."%",
    'keywords' => "%". $word ."%",
    'description' => "%". $word ."%",
    'id' => intval($word)
]);
$c = $count->fetch(PDO::FETCH_NUM)[0];

$pages = ceil($c / $perPage);

if ($current > $pages or $current == 0) {
    header('Location: /404');
}

$offset = $perPage * ($current - 1);

$search = $db->prepare("SELECT * FROM sous_categories WHERE id = :id OR titre LIKE :titre OR keywords LIKE :keywords OR description LIKE :description ORDER BY id DESC LIMIT $perPage OFFSET $offset");
$search->execute([
    'titre' => "%". $word ."%",
    'keywords' => "%". $word ."%",
    'description' => "%". $word ."%",
    'id' => intval($word)
]);
$s = $search->fetchAll();