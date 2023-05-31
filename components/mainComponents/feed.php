<?php

/* 
    Feed Komponente - 
    UI Komponente zum Anzeigen des Feed.
    Hier können alle Prompts von allen Usern 
    nach aktuellstem Datum sortiert eingesehen werden
*/

require HANDLERS_PATH . '/feedFetch.php';

?>

<div class="mainView">
    <h2>Feed</h2>

    <?php 
    foreach($feedItems as $feedItem) {
        $user_avatar = $feedItem['user_avatar'];
        $username = $feedItem['user_username'];
        $prompt_date = $feedItem['prompt_date'];
        $prompt_text = $feedItem['prompt_text'];
        $promptImage = $feedItem['prompt_img_src'];

        echo '<div class="feedBox">
                <div>
                <a href="/Promptr/pages/publicProfilePage.php?profile=' . $username . '">
                <img id="userAvatar" src="' . $user_avatar . '"/>
                </a>
                <p id="username">
                <a href="/Promptr/pages/publicProfilePage.php?profile=' . $username . '">
                ' . $username . '</a>
                </p>
                
                ' . '
                <p id="promptDate"> &middot; prompted at <strong>' . date( 'd F Y g:i A', strtotime($prompt_date)) . '
                </strong></p>
                </div>
                <div>
                <p id="promptText"/>Prompt text: <code>' . $prompt_text . '</code></p>
                <img src="' . $promptImage . '"/>
                </div>
                </div>'; 
    }
    ?>
</div>


