<nav>
<div class="container">
    <div id="title"><a href="<?php echo getRoute("/")?>" style="text-decoration: none; color: #000">Promptr</a></div>
    <?php if(isset($_SESSION['authUser'])): ?>
    <a href="<?php echo getRoute("/profile")?>" style="text-decoration: none; color: #000">
    <div id="profile-badge">
        <div id="profile-image-sm">
            <img src="<?php echo $_SESSION['authUser']['user_avatar']; ?>" />
        </div>
        <div><?php echo $_SESSION['authUser']['user_username']; ?></div>
    </div>
    </a>
    <?php endif; ?>
</div>
</nav>