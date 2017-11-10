<?php

// Variables du formulaire
$infoForm = '';
$formOk = true;

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
    
}

// Title page
$title = "CV Cyril Giuliani";
// include view
require_once "../view/header.php";
require_once "../view/about.php";
require_once "../view/skills.php";
require_once "../view/parcours.php";
require_once "../view/portfolio_mini.php";
require_once "../view/contact.php";
require_once "../view/footer.php";