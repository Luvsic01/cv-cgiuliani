<?php
require_once '../inc/config.php';

if (!isset($_SESSION['email'])){
    header('Location: back_login.php');
}

$arrayProject = getProjects();

// Title page
$title = "CV Cyril Giuliani";
// Fin fichier
require_once '../view/back_header.php';
require_once '../view/back_index.php';
require_once '../view/back_footer.php';
