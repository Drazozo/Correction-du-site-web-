<?php

if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}

$subcat = $db->prepare('SELECT * FROM sous_categories WHERE id = :id');
$subcat->execute(['id' => $params['id']]);
$sc = $subcat->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    \askly\admin::delete_sous_categorie($sc['id']);
}
