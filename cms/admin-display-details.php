<?php //require("inc-cms-pre-doctype.php"); ?>
<?php
  session_start();
  // Security check
  if(isset($_GET['txtSecurity']) && $_GET['txtSecurity'] === $_SESSION['svSecurity']) {

    $vId = $_GET['txtId'];
    //Connect to MYSQL Server
    require('inc-conn.php');

    // Calls the file where the user defined function escapestring receives its instructions
    require('inc-function-escapestring.php');

    // Select all data from entry where cid is the same as $vId
    $sql_cms = sprintf("SELECT * FROM tblcms WHERE cid = %u",
    escapestring($vconn_creativeangels, $vId, 'int')
    );

    //Execute SQL statement
    $rs_cms = mysqli_query($vconn_creativeangels, $sql_cms);

    //Create associative Array
    $rs_cms_rows = mysqli_fetch_assoc($rs_cms);


  } else {
    header('Location: signout.php');
    exit();
  }
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-cms-head-content.php"); ?>
</head>

<body>

<div id="main_container">

<div id="branding_bar">
<?php require("inc-cms-branding-bar.php"); ?>
</div>

<div id="body_column_left_container">

    <div id="body_column_left">
        <?php require("inc-cms-accordion_menu.php"); ?>
    </div>

</div>

<div id="body_column_right_container">

    <div id="body_column_right">
        <h2>Details</h2>
        <p>&nbsp;</p>

        <!-- Tabe that displays the information from the database -->
        <table cellspacing="0" class="tbldatadisplay">

          <!-- Row 1: Displays admin name and surname -->
          <tr>
            <td colspan="2"><strong><?php echo $rs_cms_rows['csurname'] . ', ' . $rs_cms_rows['cname']; ?></strong></td>
          </tr>

          <!-- Row 2: Displays when admin was added -->
          <tr>
            <td align="right">Registered</td>
            <td><?php echo $rs_cms_rows['ccreated']; ?></td>
          </tr>

          <!-- Row 3: Displays when the entry was last modified -->
          <tr>
            <td align="right">Modified</td>
            <td><?php echo $rs_cms_rows['cupdated']; ?></td>
          </tr>

          <!-- Row 4: Displays admin accesslevel -->
          <tr>
            <td align="right">Access Level</td>
            <td><?php echo $rs_cms_rows['caccesslevel']; ?></td>
          </tr>

          <!-- Row 5: Displays whether admin is active -->
          <tr>
            <td align="right">Status</td>
            <td><?php if($rs_cms_rows['cstatus'] === 'i') {echo 'Inactive';} elseif ($rs_cms_rows['cstatus'] === 'a') {echo 'Active';} ?></td>
          </tr>

          <!-- Row 6: Displays admin username -->
          <tr>
            <td align="right">Username</td>
            <td><?php echo $rs_cms_rows['cusername']; ?></td>
          </tr>

          <!-- Row 7: Displays admin email -->
          <tr>
            <td align="right">Email</td>
            <td><a href="mailto:<?php echo $rs_cms_rows['cemail']; ?>" title="Send email to Admin"><?php echo $rs_cms_rows['cemail']; ?></a></td>
          </tr>

          <!-- Row 8: Displays mobile -->
          <tr>
            <td align="right">Mobile</td>
            <td><?php echo $rs_cms_rows['cmobile']; ?></td>
          </tr>

          <!-- Row 9: YOLO -->
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>

        </table>
    </div>

</div>

<div class="clearfloat_both"></div>

</div>

</body>
</html>
