<?php
require_once __DIR__ . '/../init.php';
/* --------------------------------
    footer.php - Fußzeile
    -------------------------------- */

$year = date("Y");
$Matrikelnummer = getenv('MATRIKELNUMMER');
?>

<footer>
    <p>&copy; <?=$year?> Promptr. All Rights Reserved.</p>
    <p>made with 🦾 by <a href="https://github.com/0xBuro" target="_blank">Oguzhan-Burak Bozkurt</a> | enrolment nr: <?php echo $Matrikelnummer?> </p>
    <p>uses pretrained ML models with diffusers <a href="https://github.com/huggingface/diffusers" target="_blank"><i data-feather="github" style="height: 1rem; width: auto"></i></a> by <a href="https://huggingface.co" target="_blank">Hugging Face</a> 🤗</p>
</footer>


<script>
  feather.replace()
</script>