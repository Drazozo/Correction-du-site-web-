<?php 
if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}
   
$user = $db->prepare('SELECT * FROM users WHERE id = :id');
$user->execute(['id' => $params['id']]);
$u = $user->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    \askly\admin::edit_user($u['id'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['grade']);
}