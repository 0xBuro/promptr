<?php
require_once __DIR__ . '/../init.php';

/* --------------------------------
    home.php  
    Home Page
    -------------------------------- */

include(TEMPLATE_PATH . '/header.php');
$title = 'Home / Promptr';
include(TEMPLATE_PATH . '/layout.php');
?>

<h2>Welcome</h2>

<?php
include(TEMPLATE_PATH. '/footer.php');
?>