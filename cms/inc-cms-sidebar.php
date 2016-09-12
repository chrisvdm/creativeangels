<ul id="main-menu" class="menu">

  <div class="main-header base">
    <h1><a href="cms-homepage.php">Creative Angels</a></h1>

  </div>


  <li><a class="opt-menu" href="cms-homepage.php">Dashboard</a></li>
  <li class="opt-menu">User Accounts</li>
  <ul class="submenu">
    <li><a  class="opt-menu"href="admin-display.php">View</a></li>
    <?php if($_SESSION['svcaccesslevel'] === 'a') { ?>
      <li><a  class="opt-menu"href="admin-add-new.php">Add Users</a></li>
    <?php } ?>
  </ul>

  <li class="opt-menu">News</li>
  <ul class="submenu">
    <li><a class="opt-menu" href="news-display.php">View</a></li>
    <li><a class="opt-menu" href="news-insert.php">Add New</a></li>
  </ul>
  <li class="opt-menu">Manage events</li>
  <li class="opt-menu">Contact Details</li>
  <ul class="submenu">
    <li><a class="opt-menu" href="contact-particulars-display.php?kid=<?php echo base64_encode(1); ?>">Durban</a></li>
    <li><a class="opt-menu" href="contact-particulars-display.php?kid=<?php echo base64_encode(2); ?>">Cape Town</a></li>
  </ul>

  <li class="opt-menu">About Details</li>
  <ul class="submenu">
    <li><a class="opt-menu" href="about-details-display.php">View</a></li>
  </ul>

  <li class="opt-menu" >Team</li>
  <ul class="submenu">
    <li><a class="opt-menu" href="team-details-display.php">View</a></li>
    <li><a class="opt-menu" href="team-add-new.php">Add New</a></li>
  </ul>

  <li class="opt-menu" >Partners</li>
  <ul class="submenu">
    <li><a class="opt-menu" href="partners-display.php">View</a></li>
    <li><a class="opt-menu" href="partners-add-new.php">Add New</a></li>
  </ul>

  <li class="opt-menu">Log out</li>
  <!-- FOOTER -->
<?php // require('inc-cms-footer.php'); ?>
</ul>
