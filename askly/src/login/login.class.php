<?php
namespace askly;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use OAuthProvider;
use PDO;
use main;
class login
{

    static function formLogin($email)
    {

        $db = \askly\main::db();

        $code = random_int(100000, 999999);

        $ip = \askly\main::getIp();

        $suser = $db->prepare('SELECT * FROM users WHERE email = :email');
        $suser->execute(['email' => $email]);
        $s = $suser->fetch();
        $resultuser = $suser->rowCount();

        $timestamp = time() + (15*60);
        $timestamp = date("Y-m-d H:i:s", $timestamp);

        if ($resultuser == 0) {

            $_SESSION['error'] = "Aucun compte portant cet email n'a été trouvé";
            $_SESSION['formemail'] = $email;

        }
        else {

            $token = $db->prepare('INSERT INTO authorizations(date,ip,user,code,expiration_date) VALUES(NOW(),:ip,:user,:code,:expiration_date)');
            $token->execute([
                'ip' => $ip,
                'user' => $s['id'],
                'code' => $code,
                'expiration_date' => $timestamp
            ]);

            $subject = "Code de connexion | Askly";

            $body = file_get_contents('../app/mails/login.php');
            $body = str_replace('liendeconnexion', 'https://askly.fr/confirm-' . $s['id'] . '-' . $code, $body);
            $body = str_replace('code_unique_a_ne_pas_changer', $code, $body);

            $altbody = "Bonjour, vous avez utilisé cette adresse mail pour vous inscrire sur le site https://askly.fr. Vous pouvez désormais vous connecter grâce au lien magique ci-dessous</p>
            Voici votre code de vérification : Vous pouvez également rentrer manuellement le code de vérification $code. Lien magique : https://askly.fr/confirm-$email/$code";

            // envoi du mail

            \askly\main::send_mail($email, $subject, $body, $altbody);
            header('Location: /confirm-' . $s['id'] . '-000000');

        }


    }

    static function formSignin($email, $name, $surname)
    {

        $db = \askly\main::db();

        //$p = new OAuthProvider(array("oauth_signature_method" => OAUTH_SIG_METHOD_HMACSHA1));

        // $t = $p->generateToken(10);  

        // $uuid = bin2hex($t);
        // echo $uuid;

        $timestamp = time() + (2*60*60);
        $timestamp = date("Y-m-d H:i:s", $timestamp);

        $code = random_int(100000, 999999);

        $ip = \askly\main::getIp();

        $suser = $db->prepare('SELECT * FROM users WHERE email = :email');
        $suser->execute(['email' => $email]);
        $resultuser = $suser->rowCount();

        if ($resultuser == 1) {

            $_SESSION['error'] = "Un compte existe déjà avec cet email";

        }
        else {

            $user = $db->prepare('INSERT INTO users(email,prenom,nom,date,lastconnect,grade) VALUES(:email,:prenom,:nom,NOW(),NOW(),:grade)');
            $user->execute([
                'email' => $email,
                'prenom' => $surname,
                'nom' => $name,
                'grade' => 'user'
            ]);

            $suser = $db->prepare('SELECT * FROM users WHERE email = :email');
            $suser->execute(['email' => $email]);
            $s = $suser->fetch();

            $token = $db->prepare('INSERT INTO authorizations(date,ip,user,code,expiration_date) VALUES(NOW(),:ip,:user,:code,:expiration_date)');
            $token->execute([
                'ip' => $ip,
                'user' => $s['id'],
                'code' => $code,
                'expiration_date' => $timestamp
            ]);



            $subject = "Code de connexion | Askly";
            $body = file_get_contents('../app/mails/login.php');
            $body = str_replace('XXX.XXXXXXX.XXX/XXXXXXXXXXXXX', 'https://askly.fr/confirm-' . $s['id'] . '-' . $code, $body);
            $body = str_replace('liendeconnexion', 'https://askly.fr/confirm-' .  $s['id'] . '-' . $code, $body);
            $body = str_replace('code_unique_a_ne_pas_changer', $code, $body);

            $altbody = $code;

            \askly\main::send_mail($email, $subject, $body, $altbody);
            header('Location: /confirm-' . $s['id'] . '-000000');

        }

    }

    static function confirm_code($code, $id)
    {

        $db = \askly\main::db();

        $suser = $db->prepare('SELECT * FROM users WHERE id = :id');
        $suser->execute(['id' => $id]);
        $s = $suser->fetch();
        $resultuser = $suser->rowCount();

        if ($resultuser == 1) {

            $authorization = $db->prepare('SELECT * FROM authorizations WHERE code = :code AND user = :user');
            $authorization->execute([
                'code' => $code,
                'user' => $s['id']
            ]);
            $a = $authorization->fetch();
            $resulta = $authorization->rowCount();

            if ($resulta == 1) {
                login::login($s['email']);
                $delcode = $db->prepare('DELETE FROM authorizations WHERE code = :code');
                $delcode->execute(['code' => $code]);
                header('Location: https://askly.fr/');
            }
            else {
                $_SESSION['error'] = "Code invalide";
            }

        }
        else {
            $_SESSION['error'] = "Aucun compte portant cet email n'a été trouvé";
        }

    }

    static function login($email)
    {

        $db = \askly\main::db();

        $connectuser = $db->prepare('SELECT * FROM users WHERE email = :email');
        $connectuser->execute(['email' => $email]);
        $user = $connectuser->fetch();
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['prenom'];
        $_SESSION['surname'] = $user['nom'];
        $_SESSION['email'] = $user['email'];

        $t = bin2hex(random_bytes(10));

        $token = $db->prepare('INSERT INTO connected(account,ip,token) VALUES(:account,:ip,:token)');
        $token->execute([
            'account' => intval($user['id']),
            'ip' => \askly\main::getIp(),
            'token' => $t
        ]);

        // 1 an
        setcookie("ACCOUNT", $t, time()+60*60*24*30*12, "", "", true);

        $logConnect = $db->prepare('INSERT INTO connections(ip,account,date) VALUES(:ip,:account,NOW())');
        $logConnect->execute([
            'ip' => \askly\main::getIp(),
            'account' => $user['id']
        ]);
        header('Location: https://askly.fr');
    }

    static function disconnect()
    {

        $db = \askly\main::db();

        $token = $db->prepare('DELETE FROM connected WHERE token = :token');
        $token->execute(['token'=>$_COOKIE['account']]);

        unset($_COOKIE['ACCOUNT']);
        setcookie('ACCOUNT', '', time() - 3600, '/');
        session_destroy();
        session_unset();

        header('Location: https://askly.fr');

    }

}