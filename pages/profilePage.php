<?php

/*  --------------------------------
    profilePage.php  
    eigene Profilseite mit Infos zum
    Nutzer und Konfigurationsmöglichkeiten
    -------------------------------- */

require_once __DIR__ . '/../init.php';

if(!isset($_SESSION['authUser'])) {
    header('Location: ' . getRoute('/'));
  }

if(isset($_GET['profile'])) {
    header('Location: ' . getRoute('/publicProfile') . '?profile=' . $_GET['profile']);
} 

$title = 'Profile | Promptr';

require TEMPLATE_PATH . '/layout.php';
?>

<head>
    <link rel="stylesheet" type="text/css" href="/Promptr/components/generalButton/buttons.css">
    <link rel="stylesheet" type="text/css" href="/Promptr/components/partials/mainlayout.css">
    <link rel="stylesheet" type="text/css" href="/Promptr/components/partials/profilelayout.css">
</head>

<?php 
require COMPONENTS_PATH . '/mainComponents/nav.php'; 
?>

<div class="wrapper">
<?php
require COMPONENTS_PATH . '/mainComponents/sidenav.php';
require COMPONENTS_PATH . '/mainComponents/profile.php';
?>
</div>


<?php
require COMPONENTS_PATH . '/mainComponents/mobilenav.php';
?>