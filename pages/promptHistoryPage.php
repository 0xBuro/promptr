<?php
require_once __DIR__ . '/../init.php';

session_start();
if(!isset($_SESSION['authUser'])) {
    header('Location: ' . getRoute('/'));
  }
/* --------------------------------
    promptHistoryPage.php  
    Seite mit Prompt Verlauf 
    -------------------------------- */

$title = 'History | Promptr';

require TEMPLATE_PATH . '/layout.php';
?>

<head>
    <link rel="stylesheet" type="text/css" href="/Promptr/components/generalButton/buttons.css">
    <link rel="stylesheet" type="text/css" href="/Promptr/components/partials/mainlayout.css">
</head>

<?php 
require COMPONENTS_PATH . '/mainComponents/nav.php'; 
?>

<div class="wrapper">
<?php
require COMPONENTS_PATH . '/mainComponents/sidenav.php';
require COMPONENTS_PATH . '/mainComponents/history.php';
?>
</div>

<?php
require COMPONENTS_PATH . '/mainComponents/mobilenav.php';
require TEMPLATE_PATH . '/footer.php';
?>