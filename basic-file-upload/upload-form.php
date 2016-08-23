<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Basic file upload</title>
  </head>
  <body>

    <!-- Must be 'post' and must enctype must be 'multipart/form-data' -->
    <form method="post" action="upload-process.php" enctype="multipart/form-data">

      <!-- Cannot have a value -->
      <input type="file" name="txtimg">
      <br>
      <input type="submit" value="Upload image">

    </form>

  </body>
</html>
