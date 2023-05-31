<?php if(isset($_SESSION['authUser'])): ?>
<div id="mobileNav">
    <a href="<?php echo getRoute("/main") ?>" class="mobileIcons">
    <i data-feather="sidebar"></i></a>
    <a href="<?php echo getRoute("/prompt") ?>" class="mobileIcons">
    <i data-feather="cpu"></i></a>
    <a href="<?php echo getRoute("/profile") ?>" class="mobileIcons">
    <i data-feather="user"></i></a>
    <a href="<?php echo getRoute("/history") ?>" class="mobileIcons">
    <i data-feather="archive"></i></a>
    <a href="<?php echo getRoute("/logout") ?>" class="mobileIcons">
    <i data-feather="log-out"></i></a>
</div>
<?php endif; ?>
<?php if(!isset($_SESSION['authUser'])): ?>
    <div id="mobileNav">
    <a href="<?php echo getRoute("/signup") ?>" class="mobileIcons">
    <i data-feather="log-in"></i></a>
    </div>
<?php endif; ?>

<script>
  feather.replace()
</script>