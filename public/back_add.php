<?php
// fichier de config et vérification de session
require_once '../inc/config.php';
if (!isset($_SESSION['email'])){
    header('Location: back_login.php');
}

// Initialisation des variables de validation
$infoForm = '';
$saisieOk = false;
$fileOk = false;
echo '<br><br><br><br><br><br>';

// Si le formulaire a été soumis on valide les données saisie
if (!empty($_POST)){
    $saisieOk = true;
    // On récupère les données soumis
    $nameProject = $_POST['nameProject'] ?? '';
    $urlProject = $_POST['urlProject'] ?? '';
    $description = $_POST['description'] ?? '';
    $dateStart = $_POST['dateStart'] ?? '';
    $dateEnd = $_POST['dateEnd'] ?? '';

    // On nettoye les variables
    $nameProject = trim(strip_tags($nameProject));
    $urlProject = trim(strip_tags($urlProject));
    $description = trim(strip_tags($description));
    $dateStart = trim(strip_tags($dateStart));
    $dateEnd = trim(strip_tags($dateEnd));

    if ( empty($nameProject) ){
        $infoForm .= "<li>Veuillez renseigner un nom de projet</li>";
        $saisieOk = false;
    }
    if ( empty($description) ){
        $infoForm .= "<li>Veuillez renseigner la description du projet</li>";
        $saisieOk = false;
    }
    if ( empty($description) ){
        $infoForm .= "<li>Veuillez renseigner la description du projet</li>";
        $saisieOk = false;
    }
}// fin de vérification des saisie
var_dump($_FILES);
// Je regarde si un fichier a été envoyé et je le valide
if (!empty($_FILES)) {
    $fileOk = true;
    // On récupere les fichiers fournie
    $imgGalery = $_FILES['imgGalery'] ?? array();
    $imgGlobal = $_FILES['imgGlobal'] ?? array();

    // Validation avec MIME
    $allowMime = array("image/jpeg", "image/png");
    if (!in_array($imgGalery['type'], $allowMime)) { //
        $infoForm .= '<li>Image galerie de type incorrect (*.jpg, *.png)</li>';
        $fileOk = false;
    }
    if (!in_array($imgGlobal['type'], $allowMime)) {
        $infoForm .= '<li>Image global de type incorrect (*.jpg, *.png)</li>';
        $fileOk = false;
    }
}// fin de vérication des fichiers


var_dump($saisieOk);
var_dump($fileOk);

if ($saisieOk && $fileOk){
    echo "ok";
    $infoForm .= "Projet ajouter";
}

// Fin fichier
require_once '../view/back_header.php';
require_once '../view/back_add.php';
require_once '../view/back_footer.php';
