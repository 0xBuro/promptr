<?php

/*  --------------------------------
    loginPage.php
    Logingseite
    -------------------------------- */


require_once __DIR__ . '/../init.php';

if(isset($_SESSION['authUser'])) {
    header('Location: ' . getRoute('/main'));
}

$title = 'Login | Promptr';

require TEMPLATE_PATH . '/layout.php';
?>

<head>
  <link rel="stylesheet" type="text/css" href="/Promptr/components/generalButtons/buttons.css">
  <link rel="stylesheet" type="text/css" href="/Promptr/components/partials/form.css">
</head>

<div class="onboardScreen">
  <h1 id="title" style="text-align: center"><a href="<?php echo getRoute("/") ?>" style="text-decoration: none; color: #000">Promptr</a></h1>
  <img src="/Promptr/assets/fluent-emojis/waving-hand_animated.png" id="fluent-emoji" />
  <h2>Welcome back</h2>
  <form action="../handlers/login.php" method="post" style="padding: 0.5rem 1rem">
    <input type="text" id="username" name="username" placeholder="Enter username..." required><br>
    <input type="password" id="password" name="password" placeholder="Enter password..." required><br><br>
    <?php if (isset($_SESSION['login_errors'])) : ?>
      <p style="color: red;"><?php echo ($_SESSION['login_errors']);
                              unset($_SESSION['login_errors']); ?></p>
    <?php endif; ?>
    <input type="submit" value="Login" id="primary-button">
  </form>

  <p>Don't have an account? <a href="<?php echo getRoute("/signup") ?>">Sign Up</a></p>
</div>



<?php
include COMPONENTS_PATH . '/conceptbutton/conceptbutton.php';
?>