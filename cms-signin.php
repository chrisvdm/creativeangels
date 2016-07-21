<?php session_start(); ?>
<?php $_SESSION['svSecurity'] = sha1(date('YmdHis')); ?>
<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">
    <title> Creative Angels Login</title>

    <link href="css/public.css" rel="stylesheet">

  </head>

  <body>

    <article>

      <form action="cms-signin-process.php" method="post">

          <!-- If valfailed has been sent via GET method and is also equal to '1', display error message to user. -->
          <?php if (isset($_GET['valfailed']) && $_GET['valfailed'] === '1') { ?>

            <div class="warning_msg" >Please enter a valid username and password. <br><br></div>

          <?php } ?>

          <?php if (isset($_GET['kmatch']) && $_GET['kmatch'] === '0') { ?>

            <div class="warning_msg" >Signin failed. The username and password did not match. Please try again <br><br></div>

          <?php } ?>

        <label>
          Username<br><br>
          <input type="text" name="txtUsername">
        </label>

          <br><br>

        <label>
          Password<br><br>
          <input type="password" name="txtPassword">
        </label>

          <br><br>

          <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

        <button>Sign in</button>

      </form>

    </article>

  </body>

</html>
