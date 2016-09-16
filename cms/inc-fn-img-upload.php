<?php
  // Check file is a a jpeg returns a boolean of true if the img is a jpg
  function is_jpg($img_tmp) {

    // return mime type ala mimetype extension
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $ext = finfo_file($finfo, $img_tmp);
    finfo_close($finfo);

    if($ext !== 'image/jpeg'){
      return false;
    } else {
      return true;
    }

  } // End of is_jpg fn

  // Resizes image to specified size based on width
  function img_resize($img_tmp, $img_new_width) {

    // Create new image from file to manipulate
    $img_src = imagecreatefromjpeg($img_tmp);

    // Get original image dimensions
    list($img_width, $img_height) = getimagesize($img_tmp);

    // Specify new image dimensions
    $img_new_height = ($img_height/$img_width) * $img_new_width;

     // Create blank image with the new dimensions
    $img_new = imagecreatetruecolor($img_new_width, $img_new_height);

    // Copy and resize via resampling
    imagecopyresampled($img_new, $img_src, 0, 0, 0, 0, $img_new_width, $img_new_height, $img_width, $img_height);

    return $img_new;

  } // End of img_resize fn

  function upload($img, $dir, $img_name) {

    $img_upload_path = $dir . $img_name;

    // Upload image to server
    return imagejpeg($img, $img_upload_path, 100);

  } // End of upload fn

  function img_check($img_tmp, $img_size) {

    // check that img file is a jpg
    if (is_jpg($img_tmp)) {

      // check that the image is the right size
      if($img_size < 2097152) {

        // Resize image
        return true;

      } else {

        return false;

      } // end size check statement

    } else {

      return false;

    } // end is_jpg statement

  }

    // loads an array of images to server and returns an array as a string
  function multi_img_upload($name, $dir, $size = 300) {

      $img_arr = array();

      if(isset($_FILES[$name])) {

        $vmemory = ini_set('memory_limit', '128M');

        foreach($_FILES[$name]['tmp_name'] as $key => $tmp_name ){

          $images = $_FILES[$name];
          $img_size = $images['size'][$key];
          $img_tmp  = $images['tmp_name'][$key];

          if(img_check($img_tmp, $img_size)) {

            $resized_img = img_resize($img_tmp, $size);

            $img_name = 'img' . date('YmdHis') . $key . '.jpg';

            $img_uploaded = upload($resized_img, $dir, $img_name);

            if($img_uploaded) {
              // push file name to array
              array_push($img_arr, $img_name);
            }

          } // end img_check

        } // foreach loop

        // converts array to string
        return implode(', ', $img_arr);

      } // End isset

  } // End of multi_img_upload fn

  // loads a single image to server and returns new file name to be uploaded to db
  function img_upload($name, $dir, $size = 300) {

      if(isset($_FILES[$name])) {

        $vmemory = ini_set('memory_limit', '128M');

        $images = $_FILES[$name];
        $img_size = $images['size'];
        $img_tmp  = $images['tmp_name'];

        if(img_check($img_tmp, $img_size)) {

          $resized_img = img_resize($img_tmp, $size);

          $img_name = 'img' . date('YmdHis') . '.jpg';

          $img_uploaded = upload($resized_img, $dir, $img_name);

          if($img_uploaded) {

            return $img_name;
          }

        } // end img_check

      } // End isset

  } // End of multi_img_upload fn
?>
