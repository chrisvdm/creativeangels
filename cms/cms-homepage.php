<?php require("inc-cms-pre-doctype.php"); ?>
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

  <h2> Hi there <?php echo $_SESSION['svcname']; ?></h2>

    <div id="body_column_right">
        <p>&nbsp;</p>
        <table cellspacing="0" class="tbldatadisplay">
        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        </table>
    </div>

</div>

<div class="clearfloat_both"></div>

</div>

</body>
</html>
