<?php 

ini_set('display_errors', 1);

session_start();

date_default_timezone_set('Europe/Paris');

require_once '../vendor/autoload.php';
require_once '../src/main.class.php';
require_once '../src/login/login.class.php';

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

if (!isset($_COOKIE['theme'])){
    setcookie("theme", "light", time()+60*60*24*365);
    header('Refresh:0');
}

if (!isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'on'){
    header('Location: https://askly.fr');
}

if(isset($_SESSION['id'])){
    $team = $db->prepare('SELECT grade FROM users WHERE id = :id');
    $team->execute(['id'=>$_SESSION['id']]);
    $team = $team->fetch();
    $team = $team['grade'];
    if($team == "admin" or $team == "assistant" or $team == "stagiaire"){
        $team = true;
    } else {
        $team = false;
    }
}

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

$error = NULL;

$settings['name'] = 'askly';