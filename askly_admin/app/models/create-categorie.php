<?php
if (\askly\permissions::grade() != "admin") {
    header('Location: /403');
}    
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    \askly\admin::create_categorie($_POST['titre'], $_FILES['img'], $_POST['desc']);
}