<?php

require_once '../src/login/login.class.php';

if (isset($_POST['formlogin']) && !empty($_POST['lemail'])) {
    \askly\login::formLogin($_POST['lemail']);
}
if (isset($_POST['disconnect'])) {
    \askly\login::disconnect();
}