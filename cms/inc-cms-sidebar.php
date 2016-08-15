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

  <li class="opt-menu">User Accounts
    <span class="oc-obj">
      <div data-bar="1"></div>
      <div data-bar="2"></div>
    </span>
  </li>
  <ul class="submenu">
    <li><a  class="opt-menu"href="admin-display.php">User Account Overview</a></li>
    <?php if($_SESSION['svcaccesslevel'] === 'a') { ?>
      <li><a  class="opt-menu"href="admin-add-new.php">Add Users</a></li>
    <?php } ?>
  </ul>

  <li class="opt-menu">News</li>
  <li class="opt-menu">Manage events</li>
  <li class="opt-menu">Contact Details</li>
  <ul class="submenu">
    <li><a class="opt-menu" href="contact-particulars-display.php?kid=<?php echo base64_encode(1); ?>">Durban</a></li>
    <li><a class="opt-menu" href="contact-particulars-display.php?kid=<?php echo base64_encode(2); ?>">Cape Town</a></li>
  </ul>

  <li class="opt-menu">Log out</li>
  <!-- FOOTER -->
  <?php require('inc-cms-footer.php'); ?>
</ul>

<script src="js/oc.js"></script>
