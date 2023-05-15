<?php 
/* --------------------------------
    init.php 
    hier werden alle Pfade definiert
    um den Zugriff auf bestimmte Unterodner
    zu vereinfachen. 
    -------------------------------- */
define('APP_ROOT', __DIR__);

define('API_PATH', APP_ROOT. '/api');
define('ASSETS_PATH', APP_ROOT . '/assets');
define('COMPONENTS_PATH', APP_ROOT . '/components');
define('CONFIG_PATH', APP_ROOT . '/config');
define('PAGES_PATH', APP_ROOT . '/pages');
define('SERVICES_PATH', APP_ROOT . '/services');
define('TEMPLATE_PATH', APP_ROOT . '/template');

require CONFIG_PATH . '/routes.php';
?>
