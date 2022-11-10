<?php

if (\askly\permissions::grade() != "admin") {

    header('Location: /403');
    
}

$categories = $db->prepare('SELECT * FROM categories');
$categories->execute();
$c = $categories->fetchAll();

$subcat = $db->prepare('SELECT * FROM sous_categories WHERE id = :id');
$subcat->execute(['id' => $params['id']]);
$sc = $subcat->fetch();

$ask_questions = $db->prepare('SELECT * FROM questions WHERE sous_categorie_id = :sous_categorie_id');
$ask_questions->execute([
    'sous_categorie_id' => $sc['id']
]);
$nbrq = $ask_questions->rowCount();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['cat'] == "NULL") {
        $_POST['cat'] = $sc['id'];
    }

    \askly\admin::edit_sous_categorie($sc['id'], $_POST['titre'], $_FILES['image'], $_POST['desc'], $_POST['keywords'], $_POST['cat']);
}