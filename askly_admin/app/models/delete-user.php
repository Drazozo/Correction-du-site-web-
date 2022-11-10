<?php
if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}

$question = $db->prepare('SELECT * FROM users WHERE id = :id');
$question->execute(['id' => $params['id']]);
$q = $question->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    \askly\admin::delete_user($q['id']);
}