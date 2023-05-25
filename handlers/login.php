<?php
require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/UserService.php';
require_once SERVICES_PATH . '/AuthService.php';
require_once CONFIG_PATH . '/conn.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    $error = '';
    $userService = new UserService($pdo);
    $authService = new AuthService($pdo);

    if (empty($username) || empty($password)) {
        $error = 'please provide valid user credentials';

        $_SESSION['login_errors'] = $error;
        header('Location: ' . getRoute('/login')  . '?status=error');
        exit();
    }

    if (empty($error)) {
        $loggedIn = $userService->loginUser($username, $password);

        if (!$loggedIn) {
            $error = 'the provided credentials are invalid, please try again';
           
            $_SESSION['login_errors'] = $error;
            header('Location: ' . getRoute('/login')  . '?status=error');
            exit();
        } else {
            $authService->authUser($username);
            header('Location: ' . getRoute('/main')  . '?status=success');
            exit();
        }
    }
}
