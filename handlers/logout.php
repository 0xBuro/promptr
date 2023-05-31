<?php

/*  -----------------------------------------------
    Handler zum Ausloggen und Session zurücksetzen
    ----------------------------------------------- */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/UserService.php';
require_once CONFIG_PATH . '/conn.php';

session_destroy();
header('Location: ' . getRoute('/'));