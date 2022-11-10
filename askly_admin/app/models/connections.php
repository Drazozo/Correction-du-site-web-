<?php

if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}

$connections = $db->prepare('SELECT * FROM connections ORDER BY date DESC');
$connections->execute();
$c = $connections->fetchAll();

require '../app/templates/elements/header.php';
require '../app/templates/connections.php';