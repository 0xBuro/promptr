<?php
require_once __DIR__ . '/../init.php';

/* --------------------------------
    routes.php  
    Hier werden alle Routes erzeugt.
    -------------------------------- */

function getRoute($path): string { 
  $routes = [
    "/" => "/Promptr/index.php",
    "/signup" => "/Promptr/pages/signupPage.php",
    "/login" => "/Promptr/pages/loginPage.php",
    "/main" => "/Promptr/pages/mainPage.php",
    "/profile" => "/Promptr/pages/profilePage.php",
    "/404" => "/Promptr/pages/404.php"
  ];   

  if(array_key_exists($path, $routes)) {
    return strval($routes[$path]); 
  }
  else {
    return strval($routes["/404"]);
  };

};
