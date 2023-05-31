<?php

/*  ------------------------------------------------------
    Handler zum generieren des Prompt-Objekts aus Eingabe
    ------------------------------------------------------ */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/PromptService.php';
require_once CONFIG_PATH . '/conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    // aktuell authentifizierter User Username und bereinigte Prompt-Eingabe
    $username = $_SESSION['authUser']['user_username'];
    $promptInput = sanitizeInput($_POST['promptInput']);

    $error = '';
    $success = '';

    $promptService = new PromptService($pdo);

    // prüft ob prompt-Eingabe vom Typ String ist
    if(!is_string($promptInput)) {
        $error = 'invalid prompt';

        $_SESSION['promptStatus'] = $error;
        header('Location: ' . getRoute('/prompt')  . '?promptStatus=error');
        exit();
    }

    // prüft ob Prompt-Eingabe mindestens 10 Zeichen hat
    if(strlen($promptInput) < 10) { 
        $error = 'prompt must be at least 10 characters';

        $_SESSION['promptStatus'] = $error;
        header('Location: ' . getRoute('/prompt')  . '?promptStatus=error');
        exit();
    }

    // falls keine Fehler geworfen werden, PromptService aufrufen und Prompt-Objekt generieren
    if (empty($error)) { 
        $promptObject = $promptService->generatePromptObject($username, $promptInput);

        if($promptObject !== null) {
            $success = 'generated prompt object.';
        }


        // falls Prompt-Objekt generiert wurde, promptData Session mit neuem Prompt-Objekt anlegen
        if(!empty($success)) {
            $_SESSION['promptStatus'] = $success;

            $_SESSION['promptData'] = $promptObject;
            header('Location: ' . getRoute('/prompt')  . '?promptStatus=success');
            exit();
        }
    } else {
        $error = 'prompt object retrieval failed';

        $_SESSION['promptStatus'] = $error;
        header('Location: ' . getRoute('/prompt')  . '?promptStatus=error');
        exit();
    }
} 

?>