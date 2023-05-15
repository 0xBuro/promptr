<div class="wrapper">
    <div class="sidenav">
    <a href="<?php echo getRoute("/main") ?>">
    <div id="link-badge" class="<?php echo ($_SERVER['PHP_SELF'] == "/Promptr/pages/mainPage.php" ? "active" : "");?>">
        <div><i data-feather="home"></i></div>
        <div>Home</div>
     </div>
     </a>    
     <a href="<?php echo getRoute("/profile") ?>">
     <div id="link-badge" class="<?php echo ($_SERVER['PHP_SELF'] == "/Promptr/pages/profilePage.php" ? "active" : "");?>">
     <div id="profile-image-badge">
            <img src="https://storage.ko-fi.com/cdn/useruploads/00a0ab38-058d-4a95-884d-e98532c2f799_tiny.png" />
        </div>
        <div>Profile</div>
     </div>
     </a>
     <a href="<?php echo getRoute("/history") ?>">
     <div id="link-badge" class="<?php echo ($_SERVER['PHP_SELF'] == "/Promptr/pages/historyPage.php" ? "active" : "");?>">
        <div><i data-feather="cpu"></i></div>
        <div><code>/prompt history</code></div>
     </div>
     </a>
     <div id="link-badge" style="color: #ff5d59; background-color: transparent; margin-top: 3rem">
        <div><i data-feather="log-out"></i></div>
        <div>log out</div>
     </div>
     <a href="/Promptr/pages/conceptPage.php">
     <div id="link-badge" style="background-color: #f7f7f7; margin-top: 5rem">
        <div>🍱</div>
        <div>get the concept</div>
     </div>
     </a>
    </div>
</div>


<script>
  feather.replace()
</script>