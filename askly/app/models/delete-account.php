<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    \askly\main::delete_account();
}