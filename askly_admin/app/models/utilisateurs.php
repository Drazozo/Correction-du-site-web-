<?php

if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}
$u = \askly\main::pagination($params['current'], "users", 25, "id", NULL, NULL);
$pages = $u['pages'];
$u = $u['q'];