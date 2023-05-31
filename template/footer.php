<?php

/* ------------------------------------------
    footer.php - Fußzeile mit Matrikelnummer
    -----------------------------------------*/

require_once __DIR__ . '/../init.php';

$year = date("Y");
$Matrikelnummer = getenv('MATRIKELNUMMER');
?>

<footer>
    <p>&copy; <?=$year?> Promptr <a href="https://github.com/0xBuro" target="_blank"><i data-feather="github" style="height: 1rem; width: auto;"></i></a> All Rights Reserved. </p>
    <p>made with 🦾 by  <a href="https://github.com/0xBuro" target="_blank" style="text-decoration: dotted;">Oguzhan-Burak Bozkurt</a> | enrolment nr: <strong> <?php echo $Matrikelnummer?> </strong></p>
    <p>uses pretrained ML models from the Cloud with <a href="https://replicate.com" target="_blank" style="text-decoration: dotted;">Replicate.com</a></p>
</footer>