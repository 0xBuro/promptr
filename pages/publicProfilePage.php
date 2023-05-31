<?php

/*  ----------------------------------------------------------------------
    publicProflePage.php  
    öffentliches Profil (auch durch nicht registrierte Nutzer einsehbar).
    --------------------------------------------------------------------- */

require_once __DIR__ . '/../init.php';

require HANDLERS_PATH . '/profileFetch.php';

if ($profile) {
    $title = $profile['user_username'] . ' | Promptr';
    if(isset($_SESSION['authUser']) && $profile['user_username'] === $_SESSION['authUser']['user_username']) {
        header('Location: ' . getRoute('/profile'));
    }
} else {
    header('Location: ' . getRoute('/'));
}

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
    require COMPONENTS_PATH . '/mainComponents/publicProfile.php';
    ?>
</div>

<?php
require COMPONENTS_PATH . '/mainComponents/mobilenav.php';
?>