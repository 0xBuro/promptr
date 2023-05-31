<?php

/* ------------------------------------------
    header.php - 
    head Komponente mit globalen Stylesheets
    und Feathericons
    ----------------------------------------- */

require_once __DIR__ . '/../init.php';
?>

<head>
  <title><?php echo $title ?></title>
  <?php require TEMPLATE_PATH . '/seo.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/Promptr/assets/global.css">
  <link rel="stylesheet" type="text/css" href="/Promptr/components/generalButtons/buttons.css">
  <link rel="stylesheet" type="text/css" href="/Promptr/components/conceptbutton/conceptbutton.css">
</head>