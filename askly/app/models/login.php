<?php

if (isset($_POST['formlogin']) && !empty($_POST['lemail'])) {
    \askly\login::formLogin($_POST['lemail']);
}
if (isset($_POST['formsignin']) && !empty($_POST['semail']) && !empty($_POST['name']) && !empty($_POST['surname'])) {
    \askly\login::formSignin($_POST['semail'], $_POST['name'], $_POST['surname']);
}
if (isset($_POST['disconnect'])) {
    \askly\login::disconnect();
}