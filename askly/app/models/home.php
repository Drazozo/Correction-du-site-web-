<?php


// permet d'afficher une catégorie sur la première page 
// $catvues = $db->prepare('SELECT * FROM categories ORDER BY vues DESC LIMIT 3');
// $catvues->execute();
// $cv = $catvues->fetchAll();

$qvues = $db->prepare('SELECT * FROM questions WHERE state = "publie" ORDER BY vues DESC LIMIT 6');
$qvues->execute();
$qv = $qvues->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    header('Location: /q-' . $_POST['search'] . '-1');
}

$categorie = $db->prepare('SELECT * FROM categories ORDER BY id LIMIT 8');
$categorie->execute();
$c = $categorie->fetchAll();