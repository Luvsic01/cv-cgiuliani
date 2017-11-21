<?php
require_once '../inc/config.php';

$arrayMiniPortfolio = getProjects(6);

// Title page
$title = "CV Cyril Giuliani";
// include view
require_once "../view/header.php";
require_once "../view/skills.php";
require_once "../view/parcours.php";
require_once "../view/portfolio_mini.php";
require_once "../view/contact.php";
require_once "../view/footer.php";