<?php

/* 
    Prompt Box Komponente - 
    UI Komponente zum Anzeigen des Prompt-Eingabe Bereichs.
    Hier können Prompts generiert, ausgegeben und gespeichert werden.
*/

require HANDLERS_PATH . '/promptGenerate.php';
require API_PATH . '/replicate_api.php';

?>

<div class="mainView">
    <h2>Prompt</h2>
    <p style="color: gray">Generate an image by simply describing what you want to create inside the Prompt box</p>
    <div class="promptBox">
    <form method="post" action="../handlers/promptGenerate.php">  
        <div class="promptArea">
            <input <?php if(isset($_SESSION['promptStatus']) || isset($_SESSION['promptResult'])): ?>disabled<?php endif; ?> name="promptInput" id="promptInput" placeholder="a cat riding a unicorn on the moon..."></input>
        </div>
        <?php if(!isset($_SESSION['promptResult']) && !isset($_SESSION['promptStatus'])): ?>
            <button>prompt</button>
        <?php else: ?>
            <p>
            <?php echo "<code>" . (isset($_SESSION['promptStatus']) ? $_SESSION['promptStatus'] : '') . "</code>"; ?>
            <?php if(isset($_GET['promptStatus']) && $_GET['promptStatus'] === 'error')
            { echo '<br/><a href="' . getRoute('/prompt') . '">Retry</a>'; }
            else {
                echo 'save or delete your last output to generate new prompts';
            }
            ?>
            </p>
        <?php
        unset($_SESSION['promptStatus']);
        endif;
        ?>
        </form>  
    </div>

    <?php 
    
    if(isset($_SESSION['promptData']) && $_SESSION['promptData'] !== null) {
        $promptResult = replicateApi($_SESSION['promptData']);
        if($promptResult !== null) {
    
        $_SESSION['promptResult'] = $promptResult;
        unset($_SESSION['promptData']);
        }
    }
    
    ?>


    <?php if(isset($_SESSION['promptResult']) && $_SESSION['promptResult'] !== null): ?>
        <p><code>Used cURL API from <strong><a href="https://replicate.com/stability-ai/stable-diffusion/api">replicate</a></strong>
        <br/>
        Model: <strong>stability-ai / stable-diffusion</strong>
        <br/>
        Generated prompt for: <strong><?php echo $_SESSION['promptResult']->user_username ?></strong>
        <br/>
        Prompt text: <strong><?php echo $_SESSION['promptResult']->promptInput ?></strong><br/>
        prompt image: </code></p><br/>
        <?php echo '<img src="'. $_SESSION['promptResult']->promptImage . '"/>' ?>
        <br/>
        <br/>
        <form action="../handlers/promptSubmit.php" method="post">  
            <input type="submit" name="promptAction" value="save"  id="primary-button"></input>
            <br/>
            <input type="submit" name="promptAction" value="retry" id="secondary-button"></input>
        </form>
    <?php 
    endif; 
?>
    
</div>


