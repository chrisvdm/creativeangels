<div class="applemenu">

<!-- ADMIN STAFF STARTS -->
  <div class="silverheader">
		<a href="#">Administrators</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="admin-display.php">Display</a></td>
  </tr>

  <?php if($_SESSION['svcaccesslevel'] === 'a') { ?>
  <tr>
    <td align="left" class="accmenu"><a href="admin-add-new.php">Add new</a></td>
  </tr>
  <?php } ?>
    </table>
  </div>
<!-- ADMIN STAFF ENDS -->







<!-- NEWS STARTS -->
  <div class="silverheader">
		<a href="#">News</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="#">Archive</a></td>
  </tr>
  <tr>
    <td align="left" class="accmenu"><a href="#">Post new</a></td>
  </tr>
    </table>
  </div>
<!-- NEWS ENDS -->







<!-- EVENTS STARTS -->
  <div class="silverheader">
		<a href="#">Events</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="#">Archive</a></td>
  </tr>
  <tr>
    <td align="left" class="accmenu"><a href="#">Post new</a></td>
  </tr>
    </table>
  </div>
<!-- EVENTS ENDS -->







<!-- CONTACT STARTS -->
  <div class="silverheader">
		<a href="#">Contact</a>
		</div>
  <div class="submenu">
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td align="left" class="accmenu"><a href="#">Display</a></td>
  </tr>
    </table>
  </div>
<!-- CONTACT ENDS -->





</div>
