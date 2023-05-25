<?php
require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/UserService.php';
require_once CONFIG_PATH . '/conn.php';

session_start();

$allowTypes = ['image/jpeg', 'image/png', 'image/gif'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['authUser']['user_username'];

    $error = '';
    $success = '';
    $userService = new UserService($pdo);

    if(isset($_FILES['user_avatar']) && $_FILES['user_avatar']['error'] === UPLOAD_ERR_OK) {
        $avatarFile = $_FILES['user_avatar'];
        $tempPath = $avatarFile['tmp_name'];
        $fileName = $avatarFile['name'];
        $fileType = $avatarFile['type'];

        $targetDir = '../storage/';
        $targetFilename = uniqid() . '_' . $fileName;
        $targetPath = $targetDir . $targetFilename;
        
        if(in_array($fileType, $allowTypes)) {
            if(move_uploaded_file($tempPath, $targetPath)) {
                $updateAvatar = $userService->updateUserAvatar($username, $targetPath);

                if(!$updateAvatar) {
                    $error = 'avatar update failed';

                    $_SESSION['update_msg'] = $error;
                    header('Location: ' . getRoute('/profile')  . '?status=error');
                    exit();
                } else {
                    $success = 'profile has been updated successfully';
                    
                    $_SESSION['update_msg'] = $success;
                    $_SESSION['authUser']['user_avatar'] = $targetPath;
                    header('Location: ' . getRoute('/profile')  . '?status=success');
                    exit();
                }
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
