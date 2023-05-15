<?php
require_once __DIR__ . '/../init.php';

/* --------------------------------
    loginPage.php
    Logingseite
    -------------------------------- */

$title = 'Login | Promptr';

require TEMPLATE_PATH . '/layout.php';
?>

<head>
    <link rel="stylesheet" type="text/css" href="/Promptr/components/generalButtons/buttons.css">
    <link rel="stylesheet" type="text/css" href="/Promptr/components/partials/form.css">
</head>

<div style="margin: 0; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: flex; flex-direction: column">
<h1 id="title"><a href="<?php echo getRoute("/")?>" style="text-decoration: none; color: #000">Promptr</a></h1>
<img src="/Promptr/assets/fluent-emojis/waving-hand_animated.png" id="fluent-emoji" />
<h2>Welcome back</h2>
<form action="/signupService.php" method="post" style="padding: 0.5rem 1rem">
  <input type="text" id="username" name="username" placeholder="Enter username..."><br>
  <input type="password" id="password" name="password" placeholder="Enter password..."><br><br>
  <input type="submit" value="Login" id="primary-button">
</form> 
<p>Don't have an account? <a href="<?php echo getRoute("/signup")?>">Sign Up</a></p>
</div>

<?php 
require TEMPLATE_PATH . '/footer.php';
include COMPONENTS_PATH . '/conceptbutton/conceptbutton.php';
?>
