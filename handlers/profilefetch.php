<?php

/*  ---------------------------------------------------------
    Handler zum abholen von Profildaten aus $_GET Parametern
    Und Follower Status sowie Follower Anzahl
    --------------------------------------------------------- */

require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/ProfileService.php';
require_once CONFIG_PATH . '/conn.php';

$profileService = new ProfileService($pdo);
$profileParam = isset($_GET['profile']) ? sanitizeInput($_GET['profile']) : '';


if(!empty($profileParam)) {
    $profile = $profileService->getUserProfile($profileParam);

    if($profile) {
        $prompts = $profileService->getLatestPrompts($profile['user_username']);
        $followerCount = $profileService->getFollowerCount($profile['user_username']);
        $following = $profileService->checkFollowStatus($profile['user_username'], $_SESSION['authUser']);
    }
}

$privateProfileCounter = $profileService->getFollowerCount($_SESSION['authUser']['user_username']); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['follow'])) {
        $profileService->followUser($profile['user_username'], $_SESSION['authUser']);
    } elseif (isset($_POST['unfollow'])) {
        $profileService->unfollowUser($profile['user_username'], $_SESSION['authUser']);
    }
}

?>