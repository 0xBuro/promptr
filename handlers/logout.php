<?php
require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/UserService.php';
require_once CONFIG_PATH . '/conn.php';

session_start();
session_destroy();
header('Location: ' . getRoute('/'));