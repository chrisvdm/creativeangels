<?php
  $imgDbName = imgUpload('txtimg', 'uploads', 'image-test.php');
  echo $imgDbName;
  exit();

  function imgUpload($img, $uploadPath, $failUrl){

    $img_temp = $_FILES[$img] ['tmp_name'];
    $error = '?';

    ini_set('memory_limit', '128M');

    if(checkSize()) {

      // Checks whether image is an image and returns temp location
      $file_src = createTempImg($img);

      // Creates a resized version of the image
      $preparedImg = resizeImg($file_src, 300);
      $preparedThumb = resizeImg($file_src, 180);

      // Upload large image to specified filepath
      $file_name = uploadJpg($preparedImg, $preparedThumb, $uploadPath);

      // destroys files to free memory
      imagedestroy($file_src);
      imagedestroy($preparedImg);
      imagedestroy($preparedThumb);

      return $file_name;

    } else {

      $error .= 'file=toolarge';
      echo $error;
      // header('location:' . $failUrl . $error );
      exit();

    }

  } // end of upload fn

  function resizeImg($img, $img_new_width) {

    $img_src = $_FILES[$img] ['tmp_name'];

    //GET IMAGE DIMENSION (ORIGINAL IMAGE)
    list($img_width, $img_height) = getimagesize($img_src);

    $img_new_height = ($img_height/$img_width) * $img_new_width;

    // Create blank (black) image with new image dimensions
    $img_new = imagecreatetruecolor($img_new_width, $img_new_height);

    // Copy and resize part of the large image with resampling
    imagecopyresampled($img_new, $img_temp, 0, 0, 0, 0, $img_new_width, $img_new_height, $img_width, $img_height);

    return $img_new;
  }

  function createTempImg($img) {

    	$img_temp_create = $_FILES['txtimg']['tmp_name'];

    $filetype = mime_content_type($img_temp_create);

    if($filetype === 'image/jpeg') {

      return imagecreatefromjpeg($img_temp_create);

    } else {

      echo 'wrong file extension';
      // $error .= 'file=wrongextension';
      // header('location:' . $failUrl . $error );
      exit();
    }
  }

  function checkSize() {
    // get the dimensions of the file and if the dimensions are larger than int
    if(isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > (1024*1024*(int) ini_get('post_max_size'))){

      return false;

    } else {

      return true;

    }

  }

  function uploadJpg($img, $thumbnail, $path){

    $img_name ='img' . date('YmdHis') . '.jpg';

    // Prepare filepath
    $path = $path . '/large/n' . $img_name;
    $pathThumb = $path . '/thumb/n' . $img_name;

    // Upload
    $upload_results = imagepng($img, $path, 100);
    $upload_thumb_results = imagepng($img, $path, 100);

    if($upload_results && $upload_thumb_results) {

      return $img_name;

    }

  }
?>
