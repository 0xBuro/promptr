<?php

/*  ----------------------------------
    Handler zum updaten der Profil Bio
    ---------------------------------- */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/UserService.php';
require_once CONFIG_PATH . '/conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['authUser']['user_username'];
    $info = sanitizeInput($_POST['user_info']);

    $error = '';
    $success = '';
    $userService = new UserService($pdo);

    // prüft ob Eingabe vom Typ String ist.
    if (!is_string($info)) {
        $error = 'invalid input';

        $_SESSION['update_msg'] = $error;
        header('Location: ' . getRoute('/profile')  . '?status=error');
        exit();
    }

    // prüft ob Eingabe die maximale Anzahl an erlaubten Zeichen übersteigt
    if(strlen($info) > 200) {
        $error = 'please provide less than 200 characters';

        $_SESSION['update_msg'] = $error;
        header('Location: ' . getRoute('/profile')  . '?status=error');
        exit();
    }

    // ruft DB Service (UserService) auf, falls keine Fehler existieren
    if (empty($error)) {
        $updateInfo = $userService->updateUserInfo($username, $info);

        if (!$updateInfo) {
            $error = 'Update failed, please try again';

            $_SESSION['update_msg'] = $error;
            header('Location: ' . getRoute('/profile')  . '?status=error');
            exit();
        } else {
            $success = 'profile has been updated successfully';
            
            $_SESSION['update_msg'] = $success;
            // aktualisiert auch den Info-Text in der aktuellen authUser Session
            $_SESSION['authUser']['user_info'] = $info;
            header('Location: ' . getRoute('/profile')  . '?status=success');
            exit();
        }
    }
}
