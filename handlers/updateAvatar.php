<?php

/*  ---------------------------------------
    Handler zum updaten des Profil Avatars
    --------------------------------------- */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/UserService.php';
require_once CONFIG_PATH . '/conn.php';

// erlaubte Dateiformate
$allowTypes = ['image/jpeg', 'image/png', 'image/gif'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['authUser']['user_username'];

    $error = '';
    $success = '';
    $userService = new UserService($pdo);

    // prüfen ob Datei ausgewählt wurde
    if(isset($_FILES['user_avatar']) && $_FILES['user_avatar']['error'] === UPLOAD_ERR_OK) {
        // auslagern der Auswahl in Variablenamen
        $avatarFile = $_FILES['user_avatar'];
        $tempPath = $avatarFile['tmp_name'];
        $fileName = $avatarFile['name'];
        $fileType = $avatarFile['type'];

        // Zielpfad und Dateiname bestimmen
        $targetDir = '../storage/';
        $targetFilename = uniqid() . '_' . $fileName;
        $targetPath = $targetDir . $targetFilename;
        
        
        // prüft ob erlaubtes Dateienformat gewählt wurde
        if(in_array($fileType, $allowTypes)) {
            // Auswahl und entsprechenden Zielpfad prüfen
            if(move_uploaded_file($tempPath, $targetPath)) {

                // img url für Datenbank und Session
                $user_avatar = "http://" . $_SERVER['HTTP_HOST'] . "/Promptr/storage/" . $targetFilename;
                
                // Service Aufruf für Avatar update
                $updateAvatar = $userService->updateUserAvatar($username, $user_avatar);

                // prüft ob Service erfolgreich war
                if(!$updateAvatar) {
                    $error = 'avatar update failed';

                    $_SESSION['update_msg'] = $error;
                    header('Location: ' . getRoute('/profile')  . '?status=error');
                    exit();
                } else {
                    $success = 'profile has been updated successfully';
                    
                    $_SESSION['update_msg'] = $success;
                    // aktuell authentifizierten User auch im Session mit neuem Avatar versehen
                    $_SESSION['authUser']['user_avatar'] = $user_avatar;
                    header('Location: ' . getRoute('/profile')  . '?status=success');
                    exit();
                }
                // Falls die Schritte zuvor Fehler werfen
            } else {
                $error = 'move uploaded file failed';

                $_SESSION['update_msg'] = $error;
                header('Location: ' . getRoute('/profile')  . '?status=error');
                exit();
            }
        } else {
            $error = 'file type not allowed';

            $_SESSION['update_msg'] = $error;
            header('Location: ' . getRoute('/profile')  . '?status=error');
            exit();
        }
    } else {
        $error = 'no file selected to upload';

        $_SESSION['update_msg'] = $error;
        header('Location: ' . getRoute('/profile')  . '?status=error');
        exit();
    }
}
