<?php

ini_set('display_errors', 1);

session_start();

date_default_timezone_set('Europe/Paris');

require_once '../vendor/autoload.php';
require_once '../src/main.class.php';
require_once '../src/permissions.class.php';
require_once '../src/login/login.class.php';
require_once '../src/admin.class.php';

$db = \askly\main::db();

$ip = \askly\main::getIp();

$banips = $db->prepare('SELECT * FROM ban_ips WHERE ip = :ip');
$banips->execute(['ip' => $ip]);
$bs = $banips->rowCount();

if ($bs == 1) {
    require '../app/templates/elements/header.php';
    require '../app/templates/errors/banned.php';
    require '../app/templates/elements/footer.php';
    exit;
}

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'):

else:
    header('Location: https://teams.askly.fr');
endif;

if (isset($_COOKIE['ACCOUNT'])){

    $token = $db->prepare('SELECT * FROM connected WHERE token = :token');
    $token->execute(['token'=>$_COOKIE['ACCOUNT']]);
    $t = $token->fetch();

    if($token->rowCount() !== 0 && $t['ip'] === \askly\main::getIp()){

        $user = $db->prepare('SELECT * FROM users WHERE id = :id');
        $user->execute(['id' => $t['account']]);
        $u = $user->fetch();
        $_SESSION['id'] = $u['id'];
        $_SESSION['name'] = $u['nom'];
        $_SESSION['surname'] = $u['prenom'];
        $_SESSION['email'] = $u['email'];

    }

}

$settings['name'] = 'Askly Admin';