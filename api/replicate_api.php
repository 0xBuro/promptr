<?php

/* ------------------------------------------------------------------------------------------------------
    Implementierung der Replicate HTTP API / cURL für das stable diffusion Model von stability AI in PHP 
    Link: https://replicate.com/stability-ai/stable-diffusion/api

    Die cURL basierte Schnittstelle hat zwei Endpoints;
     - eine zum generieren einer Vorhersage 
     - eine zum ausgeben einer Vorhersage (erwartet die ID aus der initialen Vorhersage) 
     - Das Array mit dem Output (Link zum generierten Bild) wird erhalen, sobald der prediction status 
       'succeeded' ist

    lokale oder remote Server Umgebung (Webspace der hsh).

    die DatabaseConnection empfängt im Konstruktor
    die übergebene Konfiguration und gibt sie in $pdo zurück.
    ------------------------------------------------------------------------------------------------------*/

require_once __DIR__ . '/../init.php';

function replicateApi($promptObject) {
    // API Endpoints
    $predictionsURL = "https://api.replicate.com/v1/predictions";
    $predictionStatusURL = "https://api.replicate.com/v1/predictions/{prediction_id}";

    // API token aus Umgebungsvariable
    $apiToken = getenv('REPLICATE_API_TOKEN');

    $promptText = $promptObject->promptInput;

    $error = '';

    // initialer request für vorhersage
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $predictionsURL);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
     "version" => "db21e45d3f7023abc2a46ee38a23973f6dce16bb082a930b0c49861f96d1e5bf",
     "input" => ["prompt" => $promptText]
     ]));
     
     curl_setopt($ch, CURLOPT_HTTPHEADER, [
     "Authorization: Token $apiToken",
     "Content-Type: application/json"
     ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
     
        // Fehler im response
        $error = 'error occurred in initial prediction response';
    
        $_SESSION['promptStatus'] = $error;
        header('Location: ' . getRoute('/prompt')  . '?status=error');
        exit();
    }


    if(empty($error)) {
        $prediction = json_decode($response, true);
        $predictionId = $prediction["id"];

        $maxAttempts = 5;
        $attemptInterval = 5;

    
        // Status der Vorhersage abfragen (prediction ID mit unserer ID ersetzen)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, str_replace("{prediction_id}", $predictionId, $predictionStatusURL));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Token $apiToken",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
    }
        
    if ($response === false) {
        // Fehler im response
        $error = 'error occurred during prediction status';
        
        $_SESSION['promptStatus'] = $error;
        header('Location: ' . getRoute('/prompt')  . '?status=error');
        exit();
    }

    if(empty($error)) {
        $predictionStatus = json_decode($response, true);
        
        // prüft ob Vorhersage status = succeeded
        if ($predictionStatus["status"] === "succeeded") {
            $promptObject->promptImg = $predictionStatus["output"][0];
            return $promptObject;
        } else {
            // abfrage maximal 5 Mal alle 5 sekunden nach prediction status 
            for($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, str_replace("{prediction_id}", $predictionId, $predictionStatusURL));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Authorization: Token $apiToken",
                    "Content-Type: application/json"
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                // Fehler im response
                $error = 'error occurred during prediction status';
                
                $_SESSION['promptStatus'] = $error;
                header('Location: ' . getRoute('/prompt')  . '?status=error');
                exit();
            }

            // json String dekodieren
            $predictionStatus = json_decode($response, true);

            // wenn status succeeded ist der erste Index im output Array unser generiertes Bild
            if($predictionStatus["status"] === "succeeded") {
                // Prompt-Objekt um promptImage mit img URL erweitern
                $promptObject->promptImage = $predictionStatus["output"][0];
                return $promptObject;
            } else {
                // sonst nach 5 Sekunden erneut versuchen
                sleep($attemptInterval);
            }
        }
    }
    }
}
 
?>