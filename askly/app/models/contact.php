<?php
if (isset($_POST['send'])) {
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $secret = '6LfdNHMhAAAAADqtBBWK5CECHrJtQiRZl2O1i5Aq';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success) {
            \askly\main::contact($_POST['email'], $_POST['name'], $_POST['surname'], $_POST['sujet'], $_POST['msg']);
        } else {
            $_SESSION['error'] = "Echec lors de la validation anti-robots";
            header('Location: https://askly.fr/nous-contacter');
        }
    } else {
        $_SESSION['error'] = "Echec lors de la validation anti-robots";
        header('Location: https://askly.fr/nous-contacter');
    }
}