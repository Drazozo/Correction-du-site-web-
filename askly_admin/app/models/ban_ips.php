<?php
if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}

$ips = $db->prepare('SELECT * FROM ban_ips ORDER BY date DESC');
$ips->execute();
$i = $ips->fetchAll();

require '../app/templates/elements/header.php';
require '../app/templates/ban_ips.php';