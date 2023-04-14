<?php
require_once __DIR__ . '/../init.php';

/* --------------------------------
    404.php  
    custom 404 Fehlerseite
    -------------------------------- */

?>
<title>404 / Promptr</title>
<style>
.vl {
  border-left: 1px solid gray;
  height: 180px;
  transform: none;
}
</style>
<div style="position: relative;  width: 100%; height: 100%">
<div style="margin: 0; position: absolute; top: 50%; left: 50%; display: flex; gap: 32px; transform: translate(-50%, -50%);">
<p style="font-weight: light; font-size: 62px; font-family: sans-serif;">404</p>
<div class="vl"></div>
<img src="<?php echo ASSETS_PATH . '/404.svg'?>" width="150" />
</div>
</div>
<a href="/Promptr/index.php" >back</a>
