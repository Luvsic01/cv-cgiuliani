<?php
// fichier de config et vérification de session
require_once '../inc/config.php';
if (!isset($_SESSION['email'])){
    header('Location: back_login.php');
}

// Initialisation des variables de validation
$infoForm = '';
$saisieOk = false;
$fileOk = true;

if (!empty($_GET['id'])){
    $projectSelect = getProjectById($_GET['id']);
    //var_dump($projectSelect);
    $nameProject = $projectSelect['pro_name'] ?? '';
    $urlProject = $projectSelect['pro_url'] ?? '';
    $description = $projectSelect['pro_description'] ?? '';
    $dateStart = $projectSelect['pro_date_start'] ?? '';
    $dateEnd = $projectSelect['pro_date_end'] ?? '';
}

if (!empty($_POST)){ // Si le formulaire a été soumis on valide les données saisie
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

$imgGalery = $_FILES['imgGalery'] ?? array();
$imgGlobal = $_FILES['imgGlobal'] ?? array();
$allowExtensions = array('jpg', 'jpeg', 'png'); // Extension autorisées
// Je regarde si un fichier a été envoyé et je le valide
if (!empty($imgGalery['name'])) {
    //On vérifie l'extension avec le tableau suivant
    if(!checkExtension($allowExtensions, $imgGalery['name'])){
        $infoForm .= "<li>Image galerie de type incorrect (*.jpg, *.png)</li>";
        $formOk = false;
    }
}// fin de vérication des fichiers
if (!empty($imgGlobal['name'])) {
    //On vérifie l'extension avec le tableau suivant
    if(!checkExtension($allowExtensions, $imgGlobal['name'])){
        $infoForm .= "<li>Image global de type incorrect (*.jpg, *.png)</li>";
        $formOk = false;
    }
}// fin de vérication des fichiers

// Si le formaulaire est ok
if ($saisieOk && $fileOk){
    if (!empty($_GET['id'])){
        if (updateProject($_GET['id'], $nameProject, $description, $urlProject, $dateStart, $dateEnd)) {
            $infoForm .= "Projet mis à jour";
        } else {
            $infoForm .= "<li>Probleme lors de la mise à jour du projet</li>";
            $formOk = false;
        }
    }else {
        // On définit un nom aléatoire
        $newFileNameGalery = newFileName($imgGalery['name'], 'galery');
        $newFileNameGlobal = newFileName($imgGlobal['name'], 'global');

        // Chemin upload stocké dans la bdd
        $urlImgGalery = '/img/galery/' . $newFileNameGalery;
        $urlImgGlobal = '/img/global/' . $newFileNameGlobal;

        // J'upload le fichier
        $uploadGalery = move_uploaded_file($imgGalery['tmp_name'], __DIR__ . $urlImgGalery);
        $uploadGlobal = move_uploaded_file($imgGlobal['tmp_name'], __DIR__ . $urlImgGlobal);

        if ($uploadGlobal && $uploadGalery) {
            if (addProject($nameProject, $description, $urlProject, $dateStart, $dateEnd, $urlImgGalery, $urlImgGlobal)) {
                $infoForm .= "Projet ajouter";
            } else {
                $infoForm .= "<li>Probleme lors de l'ajout dans la base de donnée</li>";
                $formOk = false;
            }
        } else {
            $infoForm .= "<li>Probleme lors de l'envoi des fichier</li>";
            $formOk = false;
        }
    }
}

// Title page
$title = "Ajout d'un projet";
// Fin fichier
require_once '../view/back_header.php';
require_once '../view/back_add.php';
require_once '../view/back_footer.php';
