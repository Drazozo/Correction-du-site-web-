<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['send'])) {
        \askly\main::ask_question($_POST['question'], $_POST['categorie'], $_POST['reponse']);
    }
    if (isset($_POST['search'])) {
        header('Location: /q-' . $_POST['search'] . '-1');
    }
}



$categorie = $db->prepare('SELECT * FROM categories ORDER BY titre ASC');
$categorie->execute();
$cat = $categorie->fetchAll();