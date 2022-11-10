<?php

namespace askly;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Pdo;
class main
{


  static function db()
  {
    $db = new PDO("mysql:host=localhost;dbname=*", "*", "*");
    return $db;
  }


  static function getIp()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  static function remove_tags($source, $remove = array('img', 'video', 'canvas'))
{
    $cleanstring = $source;
    foreach($remove as $attribute)
    {
        $cleanstring = preg_replace('!\\s+'.$attribute.'=("|\')?[-_():;a-z0-9 ]+("|\')?!i','',$cleanstring);
    }
    return $cleanstring;
}

  static function edit_account($prenom, $nom, $email, $birthday, $bio)
  {

    if (isset($_SESSION['id'])) {
      $db = \askly\main::db();

      $user = $db->prepare('UPDATE users SET prenom = :prenom, nom = :nom, email = :email, birthday = :birthday, bio = :bio WHERE id = :id');
      $user->execute([
        'prenom' => $prenom,
        'nom' => $nom,
        'email' => $email,
        'birthday' => $birthday,
        'bio' => $bio,
        'id' => $_SESSION['id']
      ]);

      $_SESSION['error'] = "Modifications enregistrées !";

    }
    else {
      header('Location: /');
    }

  }

  static function delete_account()
  {
    if (isset($_SESSION['id'])) {
      $db = \askly\main::db();

      $user = $db->prepare('DELETE FROM users WHERE id = :id');
      $user->execute([
        'id' => $_SESSION['id']
      ]);
      header('Location: /');
    }
    else {
      header('Location: /');
    }
  }

  static function send_mail($email, $subject, $body, $altbody)
  {
    $mail = new PHPMailer(true);

    try {
      //Server settings
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP(); //Send using SMTP
      $mail->Host = 'smtp.ionos.fr'; //Set the SMTP server to send through
      $mail->SMTPAuth = true; //Enable SMTP authentication
      $mail->Username = 'contact@askly.fr'; //SMTP username
      $mail->Password = 'ionosmdp03-'; //SMTP password
      $mail->SMTPSecure = 'tls';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
      $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('contact@askly.fr');
      $mail->addAddress($email); //Name is optional

      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $mail->isHTML(true); //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->AltBody = $altbody;

      $mail->send();
      $resultSend = 'Le message a bien été envoyé';
    }
    catch (Exception $e) {
      $resultSend = "Le message n'a pas été envoyé, erreur mail :  {$mail->ErrorInfo}";
    }

    return $resultSend;
  }

  static function contact($email, $name, $surname, $subject, $msg)
  {
    $db = \askly\main::db();

    // Envoi du mail à la team
    \askly\main::send_mail("mr.metayer.enzo@gmail.com", $_POST['sujet'], $_POST['msg'], $_POST['msg']);
    \askly\main::send_mail("contact@askly.fr", $_POST['sujet'], $_POST['msg'], $_POST['msg']);

    //Envoi du mail au client

    $body = "Bonjour, merci de ta prise de contact avec notre équipe. <br>Nous sommes tous mobilisé pour répondre à vos questions dans les plus brefs délais. En attendant notre réponse, voici une copie du mail que tu as adressée <br> : \n" . $_POST['msg'];

    \askly\main::send_mail($_POST['email'], $_POST['sujet'], $body, $body);

    header('Location: https://askly.fr/merci-contact');

  }

  static function ask_question($question, $categorie, $reponse)
  {

    $db = \askly\main::db();

    if (isset($question, $categorie) && !empty($question) && !empty($categorie)) {

      if (!isset($reponse) && empty($reponse)) {
        $reponse == NULL;
      }

      $insertquestion = $db->prepare('INSERT INTO questions(titre,categorie_id,reponse,date,owner_id) VALUES(:titre,:categorie_id,:reponse,NOW(),:owner_id)');
      $insertquestion->execute([
        'titre' => $question,
        'categorie_id' => $categorie,
        'reponse' => $reponse,
        'owner_id' => $_SESSION['id']
      ]);

      header('Location: https://askly.fr/merci-question');

    }

  }

  static function signalement($id, $raison, $owner)
  {
    $db = \askly\main::db();

    $signalement = $db->prepare('INSERT INTO signalement(question,owner,raison) VALUES(:question,:owner,:raison)');
    $signalement->execute([
      'question' => $id,
      'owner' => $owner,
      'raison' => $raison
    ]);

  }

  static function search($w, $current)
  {
    $word = '%' . str_replace('%20', ' ', $w) . '%';

    $perPage = 25;

    $db = \askly\main::db();

    $count = $db->prepare("SELECT count(id) FROM questions WHERE state = 'publie' AND (titre LIKE :titre OR reponse LIKE :reponse OR keywords LIKE :keywords)");
    $count->execute([
      'titre' => $word,
      'reponse' => $word,
      'keywords' => $word
    ]);
    $c = $count->fetch(PDO::FETCH_NUM)[0];

    $pages = ceil($c / $perPage);

    $questions = array();

    if ($current > $pages or $current == 0) {
      $word = explode("%20", $w);

      $scount = 0;

      foreach ($word as $wo) {

        $count = $db->prepare("SELECT count(id) FROM questions WHERE state = 'publie' AND (titre LIKE :titre OR reponse LIKE :reponse OR keywords LIKE :keywords)");
        $count->execute([
          'titre' => '%' . $wo . '%',
          'reponse' => '%' . $wo . '%',
          'keywords' => '%' . $wo . '%'
        ]);
        $c = $count->fetch(PDO::FETCH_NUM)[0];

        $offset = $perPage * ($current - 1);

        $search = $db->prepare("SELECT * FROM questions WHERE state = 'publie' AND (titre LIKE :titre OR reponse LIKE :reponse OR keywords LIKE :keywords) ORDER BY vues DESC LIMIT $perPage OFFSET $offset");
        $search->execute([
          'titre' => '%' . $wo . '%',
          'reponse' => '%' . $wo . '%',
          'keywords' => '%' . $wo . '%'
        ]);
        $s = $search->fetchAll();

        foreach ($s as $s2) {
          $questions[] = $s2;
        }

      }
    
      $q = array_unique(array_merge($questions), SORT_REGULAR);

      $scount = count($q);

    } else {

      $offset = $perPage * ($current - 1);

      $search = $db->prepare("SELECT * FROM questions WHERE state = 'publie' AND (titre LIKE :titre OR reponse LIKE :reponse OR keywords LIKE :keywords) ORDER BY vues DESC LIMIT $perPage OFFSET $offset");
      $search->execute([
        'titre' => $word,
        'reponse' => $word,
        'keywords' => $word
      ]);
      $q = $search->fetchAll();
      $scount = $search->rowCount();

    }

    if ($scount == 0) {
      $_SESSION['ask_question'] = $w;
      header('Location: /ask-question');
    }

    $return['q'] = $q;
    $return['pages'] = $pages;
    $return['count'] = $scount;

    return $return;

  }

  static function pagination($current, $table, $perPage, $ordre, $where, $whereValue)
  {

    // current : page actuelle
    // table : nom de la table
    // perPage : objets par page
    // ordre : colonne d'ordre de la requete
    // where : nom de la colonne pour la conditon
    // whereValue: valeur de la condition

    $db = \askly\main::db();

    if ($where == NULL) {

      $count = $db->prepare("SELECT COUNT(id) FROM $table");
      $count->execute();
      $c = $count->fetch(PDO::FETCH_NUM)[0];

    }
    else {
      $count = $db->prepare("SELECT COUNT(id) FROM $table WHERE $where = $whereValue");
      $count->execute();
      $c = $count->fetch(PDO::FETCH_NUM)[0];
    }

    $pages = ceil($c / $perPage);

    if ($current > $pages or $current == 0) {
      header('Location: /404');
    }

    $offset = $perPage * ($current - 1);

    if ($where == NULL) {

      $request = $db->prepare("SELECT * FROM $table ORDER BY $ordre DESC LIMIT $perPage OFFSET $offset");
      $request->execute();
      $q = $request->fetchAll();

    }
    else {

      $request = $db->prepare("SELECT * FROM $table WHERE $where = $whereValue ORDER BY $ordre DESC LIMIT $perPage OFFSET $offset");
      $request->execute();
      $q = $request->fetchAll();

    }

    // dd($request);

    $return['q'] = $q;
    $return['pages'] = $pages;

    return $return;
  }

}