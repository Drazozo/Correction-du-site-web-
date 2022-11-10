<?php

$question = $db->prepare('SELECT * FROM questions WHERE id = :id');
$question->execute(['id' => $params['id']]);
$q = $question->fetch();

$cat = $db->prepare('SELECT * FROM categories');
$cat->execute();
$c = $cat->fetchAll();

$subcat = $db->prepare('SELECT * FROM sous_categories');
$subcat->execute();
$sc = $subcat->fetchAll();

$asker = $db->prepare('SELECT * FROM users WHERE id = :id');
$asker->execute(['id'=>$q['owner_id']]);
$a = $asker->fetch();

if (\askly\permissions::grade() != "admin") {
    $_POST['state'] = $q['state'];
    $reponse_state = "validated";
}

if (\askly\permissions::grade() == "stagiaire") {
    $_POST['state'] = "brouillon";
    $reponse_state = "valid";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $categorie = "";
    $subcat = "";

    $c_a = [];

    foreach($c as $v){
        
        if(isset($_POST['cat_'.$v['id']])){
            $c_a[] = $v['id'];
            $categorie = join(', ', $c_a);
        }

    }

    $sc_a = [];
    
    foreach($sc as $sv){
        if(isset($_POST['subcat_'.$sv['id']])){
            $sc_a[] = $sv['id'];
            $subc = join(', ', $sc_a);
        }
    }

    if($_POST['state'] == "publie"){
        $mail_content = file_get_contents('../app/mails/ask-approve.php');
        $mail_content = str_replace('xxxx_question_xxxx', $q['titre'], $mail_content);
        $mail_content = str_replace('lienquestion', 'https://askly.fr/question-'.$q['id'], $mail_content);
        \askly\main::send_mail($a['email'], utf8_decode('Nouvelle réponse à votre question "'. $_POST['subject'] .'" | Askly.fr'), $mail_content, "Une nouvelle réponse à été apportée à votre question sur Askly.fr. Vous pouvez la consulter avec ce lien : https://askly.fr/question-". $q['id']);
    }


    \askly\admin::edit_question($q['id'], $_POST['titre'], $_POST['reponse'], $categorie, $subc, $_POST['state'], $_POST['keywords'],$_POST['sources']);
}