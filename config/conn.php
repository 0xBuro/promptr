<?php 

/* --------------------------------------------------------
    conn.php  
    Datenbankkonfiguration -

    die Arrays remote und local haben jeweils
    Key-Value Paare mit Konfigurationsparametern für die
    lokale oder remote Server Umgebung (Webspace der hsh).

    die DatabaseConnection empfängt im Konstruktor
    die übergebene Konfiguration und gibt sie in $pdo zurück.
    -------------------------------------------------------*/

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/DatabaseService.php';

// db hsh config
$remote = [
    'host' => getenv('DB_HOST'),
    'dbname' => getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD')
];


// db local config
$local = [
    'host' => 'localhost',
    'dbname' => 'promptr',
    'username' => 'root',
    'password' => ''
];

// conn kann mit lokaler oder remote konfiguration gestartet werden
$conn = new DatabaseConnection($local);
$pdo = $conn->getPdo();

return $pdo;
?>