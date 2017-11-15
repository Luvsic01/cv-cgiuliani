<?php
require_once '../inc/config.php';

if (isset($_SESSION['email'])){
    header('Location: back_index.php');
}

// Variables de valideations
$usrExist = false;
$pwdOk = false;
$infoForm = '';

// Si $_POST n'est pas vide le formulaire de connection a été soumis
if (!empty($_POST)) {
    // Filtrage des variables
    $email = $_POST['email'] ?? '';
    $email = strtolower(trim(strip_tags($email)));
    $pwd = $_POST['password'] ?? '';
    $pwd = trim(strip_tags($pwd));

    // Utilisateur existant et mdp Valide ?
    $usrExist = usrEmailExist($email);
    if( $usrExist ){
        $pwdOk = checkPassword($email,$pwd);
    }// Fin de vérification si utilisateur existe et mdp valide

    // Si usr Valide création de la session
    if ($usrExist && $pwdOk){
        createSession($email);
        header('Location: back_index.php');
    }else{
        $infoForm = 'Utilisateur ou mot de passe invalide';
    }

}// Fin si $_post n'est pas vide

// Fin fichier
require_once '../view/back_login.php';