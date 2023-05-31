<?php
require_once __DIR__ . '/../init.php';

/* -----------------------------------
    routes.php  
    Key-Value Paare für Routes.
    die Funktion getRoute() gibt
    den String-Wert für den Pfad wieder,
    Falls der übergebene Key existiert.
    ----------------------------------- */

function getRoute($path): string { 
  $routes = [
    "/" => "/Promptr/index.php",
    "/signup" => "/Promptr/pages/signupPage.php",
    "/login" => "/Promptr/pages/loginPage.php",
    "/main" => "/Promptr/pages/mainPage.php",
    "/prompt" => "/Promptr/pages/promptPage.php",
    "/profile" => "/Promptr/pages/profilePage.php",
    "/history" => "/Promptr/pages/promptHistoryPage.php",
    "/publicProfile" => "/Promptr/pages/publicProfilePage.php",
    "/logout" => "/Promptr/handlers/logout.php",
    "/404" => "/Promptr/pages/404.php"
  ];   

  if(array_key_exists($path, $routes)) {
    return strval($routes[$path]); 
  }
  else {
    return strval($routes["/404"]);
  };

};
