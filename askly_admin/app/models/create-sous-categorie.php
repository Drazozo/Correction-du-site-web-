<?php

if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}

$categories = $db->prepare('SELECT * FROM categories');
$categories->execute();
$cat = $categories->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    \askly\admin::create_sous_categorie($_POST['titre'], $_FILES['img'], $_POST['desc'], $_POST['keywords'], $_POST['cat']);
}