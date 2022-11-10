<?php

if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}

$cat = $db->prepare('SELECT * FROM categories WHERE id = :id');
$cat->execute(['id' => $params['id']]);
$c = $cat->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    \askly\admin::delete_categorie($c['id']);
}