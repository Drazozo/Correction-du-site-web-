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
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
      $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

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
      $resultSend = 'Message has been sent';
    }
    catch (Exception $e) {
      $resultSend = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    echo $resultSend;
  }

  static function contact($email, $name, $surname, $subject, $msg)
  {
    $db = \askly\main::db();

    // Envoi du mail à la team
    send_mail("mr.metayer.enzo@gmail.com", $_POST['sujet'], $_POST['msg'], $_POST['msg']);
    send_mail("contact@askly.fr", $_POST['sujet'], $_POST['msg'], $_POST['msg']);

    //Envoi du mail au client

    $body = "Copie de votre mail à la team askly : \n" . $_POST['msg'];

    send_mail($_POST['email'], $_POST['sujet'], $body, $body);

  }

  static function ask_question($question, $categorie, $reponse)
  {

    $db = \askly\main::db();

    if (isset($question, $categorie) && !empty($question) && !empty($categorie)) {

      if (!isset($reponse) && empty($reponse)) {
        $reponse == NULL;
      }

      $insertquestion = $db->prepare('INSERT INTO ask_questions(titre,categorie_id,reponse,date,owner_id) VALUES(:titre,:categorie_id,:reponse,NOW(),:owner_id)');
      $insertquestion->execute([
        'titre' => $question,
        'categorie_id' => $categorie,
        'reponse' => $reponse,
        'owner_id' => $_SESSION['id']
      ]);

    }

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
      $count = $db->prepare("SELECT COUNT(id) FROM $table WHERE $where = :$where");
      $count->execute([$where => $whereValue]);
      $c = $count->fetch(PDO::FETCH_NUM)[0];
    }

    $pages = ceil($c / $perPage);

    //if ($current > $pages or $current == 0) {
    //  header('Location: /404');
    //}

    $offset = $perPage * ($current - 1);

    if ($where == NULL) {

      $request = $db->prepare("SELECT * FROM $table ORDER BY $ordre LIMIT $perPage OFFSET $offset");
      $request->execute();
      $q = $request->fetchAll();

    }
    else {

      $request = $db->prepare("SELECT * FROM $table WHERE $where = $whereValue ORDER BY $ordre LIMIT $perPage OFFSET $offset");
      $request->execute();
      $q = $request->fetchAll();

    }

    $return['q'] = $q;
    $return['pages'] = $pages;

    return $return;
  }

  static function search($word)
  {

    $db = \askly\main::db();

    $searchword = htmlspecialchars($word);

    $search = $db->prepare('SELECT * FROM questions WHERE titre LIKE keyword');
    $search->execute();
    $s = $search->fetchAll();

    $s['count'] == $search->rowCount();

    if ($search->rowCount() == 0) {
      header('Location: /ask-question');
    }
    else {
      return $s;
    }

  }

}