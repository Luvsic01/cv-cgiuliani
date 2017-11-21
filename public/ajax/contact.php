<?php
require_once '../../inc/config.php';

// Variables du formulaire
$infoForm = '';
$formOk = true;
$returnEmail = false;

// Formulaire contact submit
if (!empty($_POST)){
    // On récupère les donnée envoyer
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $msg = $_POST['msg'] ?? '';

    // Nettoyage des variables
    $name = trim(strip_tags($name));
    $email = trim(strip_tags($email));
    $subject = trim(strip_tags($subject));
    $msg = trim(strip_tags($msg));

    // Validation du nom
    if ( empty($name) ){
        $infoForm .= "Veuillez renseigner un prenom<br>";
        $formOk = false;
    } elseif (strlen($name) < 2){
        $infoForm .= "Veuillez renseigner un prenom d'au moins 2 caractères<br>";
        $formOk = false;
    }
    // validation email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $infoForm .='Veuillez renseigner un Email correct<br>';
        $formOk = false;
    }
    // Validation du sujet
    if (empty($subject)){
        $infoForm .= "Veuillez renseigner sujet<br>";
        $formOk = false;
    }
    // Validation msg
    if (empty($msg)){
        $infoForm .= "Veuillez renseigner message<br>";
        $formOk = false;
    }

    // en POST sur reCaptcha
    $curl = new Curl\Curl(); // création de l'objet
    $curl->post('https://www.google.com/recaptcha/api/siteverify', array(
        'secret' => '6LedsjgUAAAAABipcvblcVXsRrjttR10lA0BXkFa',
        'response' => $_POST['g-recaptcha-response'],
    ));
    $googleResponse = json_decode($curl->response, true);
    if ($googleResponse['success'] === false){
        $infoForm .= "reCAPTCHA non validé<br>";
        $formOk = false;
    }

    // Si les données de contact sont correct envoie par mail
    if ($formOk){
        $returnEmail = sendEmailContact($email, $name, $subject, $msg, $msg);
        if ($returnEmail){
            $infoForm = "Votre message à été correctement envoyé";
        }else{
            $infoForm = "Votre message n'a pas pu être envoyé veuillez réessayer plus tard";
        }
    }
}// Fin du traintement post du formulaire de contact
$json = array('infoForm' => $infoForm, 'formOk' => $formOk, 'returnEmail' => $returnEmail);
echo json_encode($json);
