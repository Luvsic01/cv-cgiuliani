<?php

// Données de configuration de la database
$config = array(
    'DB_HOST' => '',
    'DB_USER' => '',
    'DB_PASSWORD' => '',
    'DB_DATABASE' => '',
    'EMAIL'=>'',
    'EMAIL_PWD'=> ''
);

// Inclusions de fichiers
require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';

//inclusion de composer
require_once __DIR__.'/../vendor/autoload.php';