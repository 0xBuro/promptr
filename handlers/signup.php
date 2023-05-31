<?php

/*  ---------------------------------------------
    Handler zum registrieren eines neuen Nutzers
    --------------------------------------------- */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/UserService.php';
require_once SERVICES_PATH . '/AuthService.php';
require_once CONFIG_PATH . '/conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // bereinigte Daten an variable übergeben 
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    $error = '';
    $userService = new UserService($pdo);
    $authService = new AuthService($pdo);

    // prüft ob Eingabe leer ist
    if (empty($username) || empty($password)) {
        $error = 'please provide a valid username and password';

        $_SESSION['signup_errors'] = $error;
        header('Location: ' . getRoute('/signup')  . '?status=error');
        exit();
    }

    // prüft ob Username mindestens 4 Zeichen hat
    if (strlen($username) < 4) {
        $error = 'the username should be at least 4 characters';

        $_SESSION['signup_errors'] = $error;
        header('Location: ' . getRoute('/signup')  . '?status=error');
        exit();
    }

    // prüft ob Passwortlänge mindestens 6 Zeichen lang ist
    if (strlen($password) < 6) {
        $error = 'the password should be at least 6 characters';

        $_SESSION['signup_errors'] = $error;
        header('Location: ' . getRoute('/signup')  . '?status=error');
        exit();
    }

    // wenn keine Fehler geworfen werden, wird ein neuer User in der Datenbank angelegt
    // UserService registriert und setzt ein Avatar für den neuen Nutzer, AuthService legt User in der Session ab
    if (empty($error)) {
        $signedUp = $userService->registerUser($username, $password);

        if (!$signedUp) {
            $error = 'unable to create user, please try again';

            $_SESSION['signup_errors'] = $error;
            header('Location: ' . getRoute('/signup')  . '?status=error');
            exit();
        } else {
            $userService->generateAvatar($username);
            $authService->authUser($username);
            header('Location: ' . getRoute('/main')  . '?status=success');
            exit();
        }
    }
}
