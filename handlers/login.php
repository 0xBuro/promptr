<?php

/*  -----------------------------------------------
    Handler zum Einloggen und Session zurücksetzen
    ----------------------------------------------- */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/UserService.php';
require_once SERVICES_PATH . '/AuthService.php';
require_once CONFIG_PATH . '/conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Bereinigte Eingaben
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    $error = '';
    $userService = new UserService($pdo);
    $authService = new AuthService($pdo);

    // Fehler falls Username oder Passwort leer
    if (empty($username) || empty($password)) {
        $error = 'please provide valid user credentials';

        $_SESSION['login_errors'] = $error;
        header('Location: ' . getRoute('/login')  . '?status=error');
        exit();
    }

    // login Methode aus UserService aufrufen
    if (empty($error)) {
        $loggedIn = $userService->loginUser($username, $password);

        if (!$loggedIn) {
            $error = 'the provided credentials are invalid, please try again';
           
            $_SESSION['login_errors'] = $error;
            header('Location: ' . getRoute('/login')  . '?status=error');
            exit();
        } else {
            // falls erfolgreich eingelogt, AuthService aufrufen und neue authUser Session starten
            $authService->authUser($username);
            header('Location: ' . getRoute('/main')  . '?status=success');
            exit();
        }
    }
}
