<?php
if (\askly\permissions::grade() != "admin") {

    header('Location: /403');

}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ban'])) {
    $ban = $db->prepare('INSERT INTO ban_ips(ip,reason,date) VALUES(:ip,:reason,NOW())');
    $ban->execute([
        'ip' => $_POST['ip'],
        'reason' => $_POST['reason']
    ]);
    header('Location: /connections');
}
