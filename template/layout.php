<?php
require_once __DIR__ . '/../init.php';
/* --------------------------------
    layout.php - Seitenlayout
    -------------------------------- */
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title ?></title>

  <?php include(TEMPLATE_PATH . '/seo.php'); ?>

  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_PATH . "/global.css"?>">
</head>
<body>
  <main>

    <?php include(CONFIG_PATH . '/routes.php'); ?>

  </main>
</body>
</html>

