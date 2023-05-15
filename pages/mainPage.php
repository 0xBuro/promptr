<?php
require_once __DIR__ . '/../init.php';

/* --------------------------------
    mainPage.php
    Hauptseite/Feed der Promptr app
    -------------------------------- */

$title = 'Home | Promptr';

require TEMPLATE_PATH . '/layout.php';
?>

<head>
    <link rel="stylesheet" type="text/css" href="/Promptr/components/generalButton/buttons.css">
    <link rel="stylesheet" type="text/css" href="/Promptr/components/partials/mainlayout.css">
</head>

<?php 
include COMPONENTS_PATH . '/mainComponents/nav.php'; 
include COMPONENTS_PATH . '/mainComponents/sidenav.php';
require TEMPLATE_PATH . '/footer.php';
?>

