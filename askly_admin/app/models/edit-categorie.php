<?php

if (\askly\permissions::grade() != "admin") {
    header('Location: /403');
}

$cat = $db->prepare('SELECT * FROM categories WHERE id = :id');
$cat->execute(['id' => $params['id']]);
$c = $cat->fetch();

$subcat = $db->prepare('SELECT * FROM sous_categories WHERE cat_id = :cat_id');
$subcat->execute(['cat_id' => $c['id']]);
$sc = $subcat->fetchAll();
$nbrsubcat = $subcat->rowCount();

$ask_questions = $db->prepare('SELECT * FROM questions WHERE categorie_id = :categorie_id AND state != "deleted"');
$ask_questions->execute(['categorie_id' => $c['id']]);
$nbrq = $ask_questions->rowCount();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    dd($_POST, $_FILES);
    \askly\admin::edit_categorie($c['id'], $_POST['titre'], $_FILES['image'], $_POST['desc']);
}