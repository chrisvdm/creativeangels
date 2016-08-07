<ul id="main-menu" class="menu">

  <div class="main-header base">
    <h1><a href="cms-homepage.php">Creative Angels</a></h1>
  </div>

  <li class="opt-menu">Dashboard</li>
  <ul class="submenu">
    <li class="opt-menu">Overview</li>
    <li class="opt-menu">Traffic</li>
    <li class="opt-menu">User Log</li>
  </ul>

  <li class="opt-menu">User Accounts</li>
  <ul class="submenu">
    <li><a  class="opt-menu"href="admin-display.php">Display</a></li>
    <?php if($_SESSION['svcaccesslevel'] === 'a') { ?>
      <li><a  class="opt-menu"href="admin-add-new.php">Add Users</a></li>
    <?php } ?>
  </ul>

  <li class="opt-menu">News</li>
  <li class="opt-menu">Manage events</li>
  <li class="opt-menu">Contact</li>
  <li class="opt-menu">Log out</li>
  <!-- FOOTER -->
  <!-- <?php// require('inc-cms-footer.php'); ?> -->
</ul>
