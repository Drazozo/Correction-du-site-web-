<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitsearch'])) {
    header('Location: /search-categorie-' . $_POST['search'] . '-1');
}

$word = str_replace('%20', ' ', $params['search']);

$current = $params['current'];
$perPage = 35;

$count = $db->prepare("SELECT count(id) FROM categories WHERE id = :id OR titre LIKE :titre OR description LIKE :description");
$count->execute([
    'id' => intval($word),
    'titre' => "%" . $word . "%",
    'description' => "%" . $word . "%" 
]);
$c = $count->fetch(PDO::FETCH_NUM)[0];

$pages = ceil($c / $perPage);

if ($current > $pages or $current == 0) {
    header('Location: /404');
}

$offset = $perPage * ($current - 1);

$search = $db->prepare("SELECT * FROM categories WHERE id = :id OR titre LIKE :titre OR description LIKE :description ORDER BY id LIMIT $perPage OFFSET $offset");
$search->execute([
    'id' => intval($word),
    'titre' => "%" . $word . "%",
    'description' => "%" . $word . "%" 
]);
$s = $search->fetchAll();