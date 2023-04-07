<?php
require_once __DIR__ . '/../init.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_PATH . "/global.css"?>">
</head>
<body>
  <nav>
    <ul>
      <li><a href="/0xburo/">Home</a></li>
      <li><a href="/0xburo/pages/profile">Profile</a></li>
      <li><a href="/0xburo/pages/about">About</a></li>
    </ul>
  </nav>
  <?php echo $content; ?>
</body>
</html>

