<?php

/*  ---------------------------------------------
    Handler zum speichern oder verwerfen eines 
    erfolgreich erstellten Prompts 
    --------------------------------------------- */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/PromptService.php';
require_once CONFIG_PATH . '/conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $error = '';
    $promptService = new PromptService($pdo);

    // user_id des aktuell authentifizierten Nutzers,
    // Prompt Text aus Eingabe und generiertes Bild 
    $userId = $_SESSION['authUser']['user_id'];
    $promptText = $_SESSION['promptResult']->promptInput;
    $promptImage = $_SESSION['promptResult']->promptImage;

    if(isset($_POST['promptAction'])) {
        $promptAction = $_POST['promptAction'];

        switch($promptAction) {
            // save button legt die Ausgabe aus dem Prompt-Generator in der DB ab
            case 'save':
                // Dateinamen und Zielpfad bestimmen
                $filename = 'promptr_' . uniqid() . '.png';
                $storagePath = '../storage/' . $filename;
                
                // bestimmen der Datei, die heruntergeladen werden soll
                $imageData = file_get_contents($promptImage);

                // Datei im Zielpfad auf Server speichern
                if($imageData !== false) {
                    file_put_contents($storagePath, $imageData);
                } else {
                    $error = 'unable to save image';

                    $_SESSION['update_msg'] = $error;
                    unset($_SESSION['promptResult']);
                    header('Location: ' . getRoute('/prompt')  . '?status=error');
                    exit();
                }

                // Angabe zum Pfad in der Datenbank
                $prompt_img_src = "http://" . $_SERVER['HTTP_HOST'] . "/Promptr/storage/" . $filename;
                
                // PromptService Ausgabe an Variable übergeben
                $submitPrompt = $promptService->insertPrompt($promptText, $prompt_img_src, $userId);

                // Fehlerausgabe beim insert in die DB
                if(!$submitPrompt) {
                    $error = 'database error';

                    $_SESSION['update_msg'] = $error;
                    unset($_SESSION['promptResult']);
                    header('Location: ' . getRoute('/prompt')  . '?status=error');
                    exit();
                } 

                // falls erflogreich abgelegt, Session zurücksetzen
                if(empty($error)) {
                    unset($_SESSION['promptResult']);
                    header('Location: ' . getRoute('/prompt')  . '?status=success');
                    exit();
                }
                break;

                // retry button verwirft das generierte Bild und setzt die Session zurück
            case 'retry':
                unset($_SESSION['promptResult']);
                header('Location: ' . getRoute('/prompt')  . '?status=success');
                exit();
                break;  
            default:
                break;      
             
        }
    }
}
?>