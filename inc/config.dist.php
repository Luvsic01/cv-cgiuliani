<?php
session_start();
if (isset($_SESSION['ip'])){
    if ( $_SESSION['ip'] != $_SERVER["REMOTE_ADDR"] ){
        session_destroy();
        header("Location: index.php");
    }
}

// Données de configuration de la database
$config = array(
    'DB_HOST' => '',
    'DB_USER' => '',
    'DB_PASSWORD' => '',
    'DB_DATABASE' => '',
    'EMAIL_ENVOIE'=>'',
    'EMAIL_CONTACT'=>'',
    'EMAIL_HOST' => 'smtp.gmail.com',
    'EMAIL_SECURE' => 'tls',
    'EMAIL_PORT' => 587,
    'EMAIL_PWD'=> ''
);

// Inclusions de fichiers
require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';

//inclusion de composer
require_once __DIR__.'/../vendor/autoload.php';