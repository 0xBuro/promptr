<?php

/* 
    Prompt Verlauf Komponente - 
    UI Komponente zum Anzeigen der letzten Prompts des Nutzers.
    über $_GET können auch die Verläufe anderer Nutzer eingesehen werden.
*/

require_once __DIR__ . '../../../init.php';


$profileParam = isset($_GET['profile']) ? $_GET['profile'] : $_GET['profile'] = $_SESSION['authUser']['user_username'];

require HANDLERS_PATH . '/profileFetch.php';
?>

<div class="profileView">
<h2>Prompt History of <strong style="color: #6861fc"><?php echo $profile['user_username'] ?></strong></h2>
<div id="latestPrompts">
    <?php  
    if($prompts): 
    ?>
        <?php foreach($prompts as $prompt) {
            echo '<p>added on: <strong>' . date( 'd F Y g:i A', strtotime($prompt['prompt_date'])). '</strong></p>';
            echo '<p>Prompt: <code>' . $prompt['prompt_text'] . '</code></p>';
            echo '<img src="'. $prompt['prompt_img_src'] .'" alt="prompt image" />';
        } 
    
    else:
        echo '<h2 style="margin: auto; color: lightgray;">No Prompts generated by this user</h2>';

        ?>  
    <?php endif; ?>
    </div>
</div>