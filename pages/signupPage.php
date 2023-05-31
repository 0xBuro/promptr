<?php

/*  --------------------------------
    signupPage.php  
    Registrierrungsseite
    -------------------------------- */

require_once __DIR__ . '/../init.php';

if(isset($_SESSION['authUser'])) {
    header('Location: ' . getRoute('/main'));
}

$title = 'Sign Up | Promptr';

require TEMPLATE_PATH . '/layout.php';
?>

<head>
    <link rel="stylesheet" type="text/css" href="/Promptr/components/generalButtons/buttons.css">
    <link rel="stylesheet" type="text/css" href="/Promptr/components/partials/form.css">
</head>

<div class="onboardScreen">
<h1 id="title" style="text-align: center"><a href="<?php echo getRoute("/")?>" style="text-decoration: none; color: #000">Promptr</a></h1>
<img src="/Promptr/assets/fluent-emojis/rocket_animated.png" id="fluent-emoji"  />
<h2>Get on board now</h2>
<form action="../handlers/signup.php" method="post" style="padding: 0.5rem 1rem">
  <input type="text" id="username" name="username" placeholder="Enter username..."><br>
  <input type="password" id="password" name="password" placeholder="Enter password..."><br><br>
  <?php if (isset($_SESSION['signup_errors'])) : ?>
      <p style="color: red;"><?php echo ($_SESSION['signup_errors']);
                              unset($_SESSION['signup_errors']); ?></p>
    <?php endif; ?>
  <input type="submit" value="Sign Up" id="primary-button">
</form> 
<p>Already have an account? <a href="<?php echo getRoute("/login")?>">login</a></p>
</div>

<?php 
include COMPONENTS_PATH . '/conceptbutton/conceptbutton.php';
?>
