<?php

/* -----------------------------------
    sanitizeInput.php -
    Datenbereinigungsfunktion

    Eingaben werden von whitespaces und
    html Chars bereinigt und in UTF-8 
    enkodiert. 
    ----------------------------------- */

function sanitizeInput($input) {
    $sanitizedInput = trim($input);
    $sanitizedInput = htmlspecialchars($sanitizedInput, ENT_QUOTES, 'UTF-8');

    return $sanitizedInput;
}
?>