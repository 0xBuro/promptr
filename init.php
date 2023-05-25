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
define('HANDLERS_PATH', APP_ROOT . '/handlers');
define('PAGES_PATH', APP_ROOT . '/pages');
define('SERVICES_PATH', APP_ROOT . '/services');
define('STORAGE_PATH', APP_ROOT . '/storage');
define('TEMPLATE_PATH', APP_ROOT . '/template');

require CONFIG_PATH . '/routes.php';
require CONFIG_PATH . '/sanitizeInput.php';
?>
