<ul id="main-menu" class="menu">

  <div class="main-header base">
    <h1>Creative Angels</h1>
  </div>

  <li>Dashboard</li>
  <ul class="submenu">
    <li>Overview</li>
    <li>Traffic</li>
    <li>User Log</li>
  </ul>

  <li>User Accounts</li>
  <ul class="submenu">
    <li>Display</li>
    <?php if($_SESSION['svcaccesslevel'] === 'a') { ?>
      <li align="left" class="accmenu"><a href="admin-add-new.php">Add Users</a></li>
    <?php } ?>
  </ul>

  <li>News</li>
  <li>Manage events</li>
  <li>Contact</li>
  <li>Log out</li>

</ul>
