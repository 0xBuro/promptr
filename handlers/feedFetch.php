<?php

/*  ----------------------------------------------
    Handler zum abholen aller Prompts aller User
    ---------------------------------------------- */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/PromptService.php';
require_once CONFIG_PATH . '/conn.php';

$promptService = new PromptService($pdo);
$feedParam = $promptService->getPromptFeed();
$feedItems = null;

if($feedParam) {
    $feedItems = $feedParam;
}

?>