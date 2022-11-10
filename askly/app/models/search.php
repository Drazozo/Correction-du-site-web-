<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    header('Location: /q-' . $_POST['search'] . '-1');
}

$search = utf8_decode(str_replace(' ', '%20', $params['search']));
$return = \askly\main::search($search, $params['current']);
$s = $return['q'];
$pages = $return['pages'];
$scount = $return['count'];