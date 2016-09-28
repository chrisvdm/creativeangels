<?php require('inc-cms-pre-doctype.php');
if( isset($_GET['txtSecurity']) && $_GET['txtSecurity'] === $_SESSION['svSecurity'] && isset($_GET['txtId']) && $_GET['txtId'] !== ''){
 $vId = $_GET['txtId'];

 // Create SQL statement
 $sql_news = "SELECT * FROM tblnews WHERE nid = $vId";

 //Connect to MYSQL Server
 require('inc-conn.php');

 //Execute SQL statement
 $rs_news = mysqli_query($vconn_creativeangels, $sql_news);

 //Create associative Array
 $rs_news_rows = mysqli_fetch_assoc($rs_news);

} else {
  echo 'security token';
  //header('Location: signout.php');
  exit();
}

// Function for printing out error messages
function errorMsg($keyName, $label) {

  // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field

  if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

    return "<div class='warning_msg'>Please enter " . $label . ".</div>";

  } elseif (isset($_GET[$keyName]) && $_GET[$keyName] === 'failed'){

    return "<div class='warning_msg'>Passwords do not match</div>";

  } elseif(isset($_GET[$keyName]) && $_GET[$keyName] === 'emaildup'){

    return '<div class="warning_msg">Email already in use</div>';

  }//end if statement

} // End of function errorMsg

// Displays values already entered in for input field
function displayTxt($keyValue){

  if(isset($_GET[$keyValue]) && $_GET[$keyValue] !== '') {

    return $_GET[$keyValue];

  }

} // End of function displayTxt
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Head contents -->
    <?php require('inc-cms-head-content.php'); ?>

    <script src="ckeditor/ckeditor.js"></script>

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
            <h2>Edit News article > <?php echo $rs_news_rows['nheading']; ?></h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <form class="form news" method="post" action="news-update-display-process.php">
            <h3 class="accent">Article content</h3>
              <!-- HEADLINE -->
              <?php echo errorMsg('kheading', 'title'); ?>
              <input class="h2" name="txtHeading" type="text" placeholder="Title" value="<?php if(isset($_GET['kname'])){ echo displayTxt('kheading'); } elseif (isset($rs_news_rows['nheading']) && $rs_news_rows['nheading'] !== 'na'){ echo $rs_news_rows['nheading']; } ?>">

              <!-- SUMMARY -->
              <textarea name="txtSummary" type="text" placeholder="Type a short description of the news article."><?php if(isset($_GET['kname'])){ echo displayTxt('ksummary'); } elseif (isset($rs_news_rows['nsummary']) && $rs_news_rows['nsummary'] !== 'na'){ echo $rs_news_rows['nsummary']; } ?></textarea>

              <!-- BODY -->
              <label>Body</label>

              <?php echo errorMsg('kbody', 'body'); ?>
              <textarea id="txtBody" name="txtBody"><?php if(isset($_GET['kname'])){ echo displayTxt('kbody'); } elseif (isset($rs_news_rows['nbody']) && $rs_news_rows['nbody'] !== 'na'){ echo $rs_news_rows['nbody']; } ?></textarea>
              <script>
              CKEDITOR.replace('txtBody');
              </script>
              <br>
              <br>

              <h3 class="accent">Article settings</h3>
              <!-- DATE -->
              <label>Article Date<label>

                <input type="date" name="txtDate" placeholder="DD/MM/YYYY" value="<?php if(isset($_GET['kname'])){ echo displayTxt('kdate'); } elseif (isset($rs_news_rows['ndatepublished']) && $rs_news_rows['ndatepublished'] !== 'na'){ echo $rs_news_rows['ndatepublished']; } ?>">

              <label>Status</label><br>
              <input type="radio" name="txtStatus" value="i" checked> Save as Draft<br>
              <input type="radio" name="txtStatus" value="a"> Publish on Save<br>

              <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
              <input type="hidden" name="txtId" value="<?php echo $vId; ?>">

              <div class="button-set">

                <button type="submit" name="btnSave">Save</button>

                <a class="button danger-btn" href="news-display.php" name="btnCancel">Cancel</a>

              </div>

          </form>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
