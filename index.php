<?php
require_once __DIR__ . '/init.php';

if(isset($_SESSION['authUser'])) {
    header('Location: ' . getRoute('/main'));
}

/* --------------------------------
    index.php 
    root / Homepage
    -------------------------------- */ 

$title = 'Promptr | Welcome';

require TEMPLATE_PATH . '/layout.php';
?>

<div class="onboard">
    <div class="left"></div>
    <div class="right">
        <div class="fluent-text">
        <h1 id="title">Promptr</h1>
        <img src="/Promptr/assets/fluent-emojis/robot_animated.png" id="fluent-emoji" />
        </div>
        <p>Share AI generated art with a single prompt.</p>
        <br/>
        <p>Join Promptr today.</p>
        <a href="<?php echo getRoute("/signup") ?>"><button id="signup-button">Sign Up</button></a>
        <a href="<?php echo getRoute("/login") ?>"><button id="login-button">Login</button></a>
    </div>
</div>


<?php 
include COMPONENTS_PATH . '/conceptbutton/conceptbutton.php';
?>