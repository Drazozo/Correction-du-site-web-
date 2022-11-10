<?php

if ($params['code'] != 000000) {

\askly\login::confirm_code($params['code'], $params['email']);

}
elseif (isset($_POST['formconfirm']) && strlen($_POST['code']) == 6) {

\askly\login::confirm_code($_POST['code'], $params['email']);

}