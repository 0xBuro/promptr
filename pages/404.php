<?php

/*  --------------------------------
    404.php  
    custom 404 Fehlerseite
    -------------------------------- */

require_once __DIR__ . '/../init.php';

$title = '404 | Promptr';

require TEMPLATE_PATH . '/layout.php';
?>


<div style="margin: 0; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
<div style="display: flex; flex-direction: row; gap: 1.25;">
<p style="font-weight: 600; font-size: 2.625rem; ">404</p>
<img src="/Promptr/assets/fluent-emojis/ghost_animated.png" width="128" height="128"/>
</div>
<p style="text-align: center; margin-top: 1.375rem"> it looks spooky in here... <br/> 
<a href="<?php echo getRoute("/") ?>">go back to Promptr</a>
</div>


