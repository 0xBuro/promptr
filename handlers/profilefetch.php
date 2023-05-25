<?php
require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/ProfileService.php';
require_once CONFIG_PATH . '/conn.php';

$profileService = new ProfileService($pdo);
$profileParam = isset($_GET['profile']) ? sanitizeInput($_GET['profile']) : '';

if(!empty($profileParam)) {
    $profile = $profileService->getUserProfile($profileParam);

    if($profile) {
        $prompts = $profileService->getLatestPrompts($profile['user_username']);
    }
}
?>