<?php
require_once __DIR__ . '/../init.php';

/* --------------------------------
    routes.php  
    Hier werden alle Routes erzeugt 
    und entsprechend zurückgegeben.
    -------------------------------- */

$base_dir = APP_ROOT;
// URI Request
$request_uri = $_SERVER['REQUEST_URI'];


// URI in Parameter Array splitten
$parameters = explode('/', $request_uri);

// Falls URI leer ist
if (empty($parameters[0])) {
  // default page laden
  include($base_dir . '/index.php');
} else if ($parameters[0] == $base_dir and $parameters[1] == 'page') {
  // falls page existiert
  $page_name = $parameters[1];
  $page_path = 'pages/' . $page_name . '.php';
  if (file_exists($page_path)) {
    // page Inhalt laden
    include($page_path);
  } else {
    // page existiert nicht
    include($base_dir . '/pages/404.php');
  }
} else {
  // page nicht gefunden
  include($base_dir . '/pages/404.php');
}
?>