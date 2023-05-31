<div class="sidenav">
<?php if(isset($_SESSION['authUser'])): ?>
   <a href="<?php echo getRoute("/main") ?>">
      <div id="link-badge" class="<?php echo ($_SERVER['PHP_SELF'] == getRoute("/main") ? "active" : ""); ?>">
         <div><i data-feather="sidebar"></i></div>
         <div>Feed</div>
      </div>
   </a>
   <a href="<?php echo getRoute("/prompt") ?>">
      <div id="link-badge" class="<?php echo ($_SERVER['PHP_SELF'] == getRoute("/prompt") ? "active" : ""); ?>">
         <div><i data-feather="cpu"></i></div>
         <div>Prompt</div>
      </div>
   </a>
   <a href="<?php echo getRoute("/profile") ?>">
      <div id="link-badge" class="<?php echo ($_SERVER['PHP_SELF'] == getRoute("/profile")  ? "active" : ""); ?>">
         <div id="profile-image-badge">
            <img src="<?php echo $_SESSION['authUser']['user_avatar']; ?>" />
         </div>
         <div>Profile</div>
      </div>
   </a>
   <a href="<?php echo getRoute("/history") ?>">
      <div id="link-badge" class="<?php echo ($_SERVER['PHP_SELF'] == getRoute("/history")  ? "active" : ""); ?>">
         <div><i data-feather="archive"></i></div>
         <div><code>/prompt history</code></div>
      </div>
   </a>
   <a href="<?php echo getRoute("/logout") ?>">
      <div id="link-badge" style="color: #ff5d59; background-color: transparent; margin-top: 3rem">
         <div><i data-feather="log-out"></i></div>
         <div>log out</div>
      </div>
   </a>
   <?php endif; ?>
   <a href="/Promptr/conceptPage.php">
      <div id="link-badge" style="background-color: #f7f7f7; margin-top: 5rem">
         <div>🍱</div>
         <div>get the concept</div>
      </div>
   </a>
   <?php if(!isset($_SESSION['authUser'])): ?>
      <a href="<?php echo getRoute("/signup") ?>">
      <div id="link-badge" style="color: #6861fc; background-color: transparent; margin-top: 3rem">
         <div><i data-feather="log-in"></i></div>
         <div>join now</div>
      </div>
   </a>
   <?php endif; ?>
</div>