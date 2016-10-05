<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtId']) && isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']){

  $vid = $_POST['txtId'];

  // Create SQL statement to fetch all records from tblbeneficaries
  $sql_beneficaries = "SELECT * FROM tblbeneficaries WHERE bid = $vid";

  //Connect to MYSQL Server
  require('inc-conn.php');

  //Execute SQL statement
  $rs_beneficaries = mysqli_query($vconn_creativeangels, $sql_beneficaries);

  //Create associative Array
  $rs_beneficaries_rows = mysqli_fetch_assoc($rs_beneficaries);

  //Count the entries into the record set
  $rs_beneficaries_rows_total = mysqli_num_rows($rs_beneficaries);

} else {

  die("Security token");

}

// Function for printing out error messages
function errorMsg($keyName, $label) {

  // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field
  if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

    return "<div class='warning_msg'>Please enter " . $label . ".</div>";

  } //end if statement

} // End of function errorMsg

// Displays values already entered in for input field
function displayTxt($keyValue){

  if(isset($_GET[$keyValue]) && $_GET[$keyValue] !== '') {

    return $_GET[$keyValue];

  } //End if statement

} // End of function displayTxt

function inputVal($key, $col, $rs) {
  if(isset($_GET[$key])) {
    return displayTxt($key);
  } elseif (isset($rs[$col]) && $rs[$col] !== 'na') {
    return $rs[$col];
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Head contents -->
    <?php require('inc-cms-head-content.php'); ?>

  </head>
  <body>
    <!-- PAGE WRAPPER -->
    <div id="page-wrapper">

      <!-- SIDEBAR MAIN MENU -->
      <?php require('inc-cms-sidebar.php'); ?>

        <!-- RIGHT COLUMN MAIN CONTENT CONTAINER -->
      <section class="right-content-wrapper">

        <!-- HEADER -->
        <header class="base">

          <!-- Branding container -->
          <?php require('inc-cms-branding-container.php'); ?>

          <!-- Page title -->
          <div class="page-header">
            <h2>Edit Beneficary > <?php echo $rs_beneficaries_rows['bname'];
            ?></h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <!--#################### ADD NEW FORM #########################-->

          <form id="form" class="form" action="beneficaries-update-process.php" method="post" enctype="multipart/form-data">

            <p><small>Beneficaries are organisations that profit from some of Creative Angels' beneficaries and initiatives</small></p>

            <!-- BENEFICARY NAME -->
            <label>Beneficary name</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kname', 'name'); ?>

            <input type="text" name="txtName" autocomplete="off" autofocus value="<?php echo inputVal('kname', 'bname', $rs_beneficaries_rows); ?>" required="">

            <!-- DESCRIPTION -->
            <label>Description</label>

            <?php echo errorMsg('kdescription', 'description'); ?>

            <textarea name="txtDescription" required=""><?php echo inputVal('kdescription', 'bdescription', $rs_beneficaries_rows); ?></textarea>

            <!-- LINK TO FACEBOOK EVENT PAGE -->
            <label>Beneficary Website <span class="fa fa-globe"></span></label>

            <?php echo errorMsg('klink', 'link'); ?>
            <input type="url" name="txtLink" value="<?php echo inputVal('klink', 'blink', $rs_beneficaries_rows); ?>">

            <!-- IMAGES FOR BENEFICARIES -->
            <label>Upload Images <span class="fa fa-picture-o"></span></label>

            <div class="thumbGallery">
              <?php
                $img_str = $rs_beneficaries_rows['bimg'];
                $img_arr = explode(', ', $img_str);

                if(count($img_arr) > 1) {

                  foreach ($img_arr as $key => $value) { ?>
                    <figure id="<?php echo $value ?>" name="canDel" data-id="<?php echo $rs_beneficaries_rows['bid']; ?>" data-tbl="tblbeneficaries" data-dir="../assets/uploads/beneficaries/" data-img="<?php echo $value; ?>" data-security="<?php echo $_SESSION['svSecurity']; ?>" data-arr-str="<?php echo $img_str; ?>">
                      <img src="../assets/uploads/beneficaries/large/<?php echo $value; ?>">
                      <span class="symbolGallery fa fa-trash-o"></span>
                    </figure>

                  <?php }
                } elseif (count($img_arr) === 1 && $img_arr[0] !== 'na') {?>
                  <figure><img src="../assets/uploads/beneficaries/large/<?php echo $img_str; ?>"></figure>
                <?php } elseif ($img_str === 'na') {
                  echo "<div class='warning_msg'>No images. Please upload images</div>";
                }?>
              <div class="clearfix"></div>
            </div>

            <?php echo errorMsg('kimg', 'image'); ?>
            <input type="file" name="img[]" multiple="">

            <p><small>Logo size may not exceed 2Mb  and must have either a .jpg or .jpeg file extension</small></p>

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
            <input type="hidden" name="txtOldImg" value="<?php echo $rs_beneficaries_rows['bimg']; ?>">

            <!-- BUTTON SET -->
            <div class="button-set">

              <!-- submit form -->
              <button type="submit" name="btnAddNew">Save <span class="fa fa-check"></span></button>

              <a class="button danger-btn" href="beneficaries-display.php" name="btnCancel">Cancel <span class="fa fa-times"></span></a>

            </div>

          </form>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>
      $(document).ready(function() {

        $('.thumbGallery figure[name="canDel"]').click( function() {

          var img = $(this);
          var info = img.data();

          mw.delete('Deleting an image is a permanent action.\nDo you wish to proceed?', '#main-content', function(result) {

            if (result) {
              deleteImage(info, img);
            }

          });
        }); // End of fn

        function deleteImage(info, img){
          $.ajax({
            type: 'POST',
            url: 'inc-ajax-removeImg-process.php',
            data: {
              'txtId': info.id,
              'txtSecurity': info.security,
              'txtTbl': info.tbl,
              'txtDir': info.dir,
              'txtImg': info.img,
              'txtArr': info.arrStr
            },
            success: function(result) {

              // Remove image
              img.remove();

              // Toast
              mw.deleteToast('Image was deleted', '#main-content');

            }
          });
        } // End deleteImage fn

      });

    </script>
  </body>
</html>
