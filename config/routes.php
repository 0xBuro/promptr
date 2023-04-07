<?php

$base_dir = __DIR__ . "../";

$routes = [
    '/' => 'home.php',
    '/about' => 'about.php',
    '/contact' => 'contact.php',
];

$route = rtrim($_SERVER['REQUEST_URI'], '/');
if (array_key_exists($route, $routes)) {
    require_once __DIR__ . '/../pages/' . $routes[$route];
} else {
    require_once __DIR__ . '/../pages/404.php';
}