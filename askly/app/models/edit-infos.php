<?php

$user = $db->prepare('SELECT * FROM users WHERE id = :id');
$user->execute(['id' => $_SESSION['id']]);
$u = $user->fetch();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    \askly\main::edit_account($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['birthday'], $_POST['biographie']);
}

if ($user->rowCount() != 1) {
    header('Location: /');
}