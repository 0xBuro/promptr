<?php

/* 
    Profil Komponente - 
    UI Komponente zum Anzeigen des eigenen Profils.
    Forms nutzen den updateAvatar und updateInfo Handler,
    um Profilangaben zu aktualisieren.
*/

require_once __DIR__ . '../../../init.php';
require HANDLERS_PATH . '/profileFetch.php';

if (isset($_SESSION['authUser'])) {
    $username = $_SESSION['authUser']['user_username'];
    $avatar = $_SESSION['authUser']['user_avatar'];
    $info = $_SESSION['authUser']['user_info'];
}

?>

<div class="profileView">
    <h2>Profile</h2>
        <div id="editable">
        <?php if ($_SESSION['authUser']) : ?>  
            <div>
            <form action="../handlers/updateAvatar.php" method="post" enctype="multipart/form-data">
            <div>
            <label for="user_avatar">
            <img src="<?php echo $avatar ?>" alt="user_avatar" id="thumb"/>
            </label>
            <input type="file" id="user_avatar" name="user_avatar" onchange="preview()"/>
            </div>
            <input type="submit" value="update avatar" id="secondary-button"></input>
            </form> 
            <h3><?php echo $username ?></h3>
            <a href="/Promptr/pages/publicProfilePage.php?profile=<?php echo $username ?>"><?php echo 'Promptr/' . $username ?></a>
            <p>Follower: <?php if($privateProfileCounter): ?> <?php echo $privateProfileCounter['followers']; else: echo '0'; ?> <?php endif; ?></p>
            <p><?php
            if(!empty($info) || $info !== null) {
            if(strpos($info, '#') !== false) {
                $words = explode(' ', $info);
    
                foreach($words as $word) {
                    if(strpos($word, '#') === 0) {
                        echo '<strong style="color: #6861fc; font-family: monospace;">' . $word . ' </strong>';
                    } else {
                        echo $word . ' ';
                    }
                }
            } else {
                echo $info;
            }
        }
        ?></p>
            </div>
            <div>
                <div>
                <form action="../handlers/updateInfo.php" method="post">   
                    <label for="user_info" style="color: lightgray">Bio (200 Characters allowed)</label>
                    <input style="width: 100%; height: 4rem;" 
                    type="text" 
                    name="user_info" 
                    placeholder=""
                    value=""></input>
                    <input type="submit" value="update bio" id="primary-button"></input>
                </form> 
                </div>         
                <div>
                <?php if (isset($_SESSION['update_msg'])) : ?>
                <p><?php echo ($_SESSION['update_msg']);
                unset($_SESSION['update_msg']); ?></p>
                <?php endif; ?>
                </div>  
            </div>
            <?php endif; ?>
        </div>
</div>

<script>
    function preview() {
        thumb.src=URL.createObjectURL(event.target.files[0]);
    }
</script>
