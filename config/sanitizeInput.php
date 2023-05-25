<?php
function sanitizeInput($input) {
    $sanitizedInput = trim($input);
    $sanitizedInput = htmlspecialchars($sanitizedInput, ENT_QUOTES, 'UTF-8');

    return $sanitizedInput;
}
?>