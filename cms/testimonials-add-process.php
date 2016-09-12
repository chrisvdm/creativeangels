<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && $_SERVER['REQUEST_METHOD'] == 'POST') {

  $validation = 0;
  ini_set('memory_limit', '128M');

  include_once('inc-fn-sanitize.php');

  $vContributor = sanitize('txtContributor');
  $vTestimonial = sanitize('txtTestimonial');

    //------------------------- IMAGE UPLOAD ----------------------------------

  if(file_exists($_FILES['txtImg']['tmp_name'])){

  	$vfile_name = strtolower(trim(basename($_FILES['txtImg']['name'])));

  	//REPLACE ALL OCCURRENCES OF THE SEARCH STRING WITH THE REPLACEMENT STRING
  	//REPLACE ALL SPACES WITH HYPHENS
  	$vfile_name = str_replace(' ', '-', $vfile_name);

  	//Replace underscores with hyphens
  	$vfile_name = str_replace('_', '-', $vfile_name);

    $img_temp = $_FILES['txtImg']['tmp_name'];

    $vfile_extension = mime_content_type($img_temp);

   	if ($vfile_name) {

  		//CHECK FILE EXTENTION
  		if ($vfile_extension !== 'image/jpeg') {

        $vImg = '';

   		} else {

        // get the dimensions of the file and if the dimensions are larger than int
        if(isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > (1024*1024*(int) ini_get('post_max_size'))){

          header('Location: testimonials-add-new.php?kfilesize=toolarge');
          exit();

        }

  			//GET THE FILE SIZE
  			$vfile_size = filesize($_FILES['txtImg']['tmp_name']) / 1000000;

      	$vfile_temp_name = $_FILES['txtImg']['tmp_name'];

      	//CREATE A NEW IMAGE FROM FILE
      	$vfile_source = imagecreatefromjpeg($vfile_temp_name);

      //GET IMAGE DIMENTION (ORIGINAL IMAGE)
      list($vfile_original_width, $vfile_original_height) = getimagesize($vfile_temp_name);

      //SPECIFY NEW DIMENTIONS (WIDTH OF LARGE IMAGE)

      //300px wide
      $vfile_new_width = 300;
      $vfile_new_height = ($vfile_original_height/$vfile_original_width) * $vfile_new_width;

      //CREATE A NEW TRUE COLOUR IMAGE (LARGE)
      $vtrue_colour_image_large = imagecreatetruecolor($vfile_new_width, $vfile_new_height);


      //SPECIFY NEW WIDTH OF THUMBNAIL IMAGE

      //120px wide
      $vfile_new_thumb_width = 180;
      $vfile_new_thumb_height = ($vfile_original_height/$vfile_original_width) * $vfile_new_thumb_width;

      //CREATE A NEW TRUE COLOUR IMAGE (THUMB)
      $vtrue_colour_image_thumb = imagecreatetruecolor($vfile_new_thumb_width, $vfile_new_thumb_height);

      //COPY AND RESIZE PART OF THE LARGE IMAGE WITH RESAMPLING
      imagecopyresampled($vtrue_colour_image_large, $vfile_source, 0, 0, 0, 0, $vfile_new_width, $vfile_new_height, $vfile_original_width, $vfile_original_height);

      //COPY AND RESIZE PART OF THE THUMBNAIL IMAGE WITH RESAMPLING
      imagecopyresampled($vtrue_colour_image_thumb, $vfile_source, 0, 0, 0, 0, $vfile_new_thumb_width, $vfile_new_thumb_height, $vfile_original_width, $vfile_original_height);

      //UPLOAD LOCATION + FILE NAME (LARGE IMAGE)
      $vfilepath_uploaded_file_dir_large = '../assets/uploads/testimonials/large/';
      $vfilepath_uploaded_file_display_dir_large = '../assets/uploads/testimonials/large/';

      $vfile_new_unique_name_large = date('YmdHis') . '-' . 'thumbnail' . '-' . $vfile_name;

      $vfilepath_uploaded_file_dir_large = $vfilepath_uploaded_file_dir_large . $vfile_new_unique_name_large;

      $vfilepath_uploaded_file_display_dir_large = $vfilepath_uploaded_file_display_dir_large . $vfile_new_unique_name_large;

      //UPLOAD LOCATION + FILE NAME (thumb IMAGE)
      $vfilepath_uploaded_file_dir_thumb = '../assets/uploads/testimonials/thumb/';
      $vfilepath_uploaded_file_display_dir_thumb = '../assets/uploads/testimonials/thumb/';

      $vfile_new_unique_name_thumb = date('YmdHis') . '-' . 'thumbnail' . '-' . $vfile_name ;

      $vfilepath_uploaded_file_dir_thumb = $vfilepath_uploaded_file_dir_thumb . $vfile_new_unique_name_thumb;

      $vfilepath_uploaded_file_display_dir_thumb = $vfilepath_uploaded_file_display_dir_thumb . $vfile_new_unique_name_thumb;


      //UPLOAD THE IMAGES TO LOCATION ON SERVER LARGE
      $vfile_large_upload_result = imagejpeg($vtrue_colour_image_large, $vfilepath_uploaded_file_dir_large, 100);

      //UPLOAD THE IMAGES TO LOCATION ON SERVER THUMB
      $vfile_thumb_upload_result = imagejpeg($vtrue_colour_image_thumb, $vfilepath_uploaded_file_dir_thumb, 100);

      //DESTROYS THE IMAGES AND FREE UP ANY MEMORY ASSOCIATED WITH THE IMAGES
      imagedestroy($vfile_source);
      imagedestroy($vtrue_colour_image_large);
      imagedestroy($vtrue_colour_image_thumb);

          //ECHO IF FILE WAS UPLOADED AND RESIZED
          if ($vfile_large_upload_result && $vfile_thumb_upload_result) {
            //if file is uploaded
            $vImg = $vfile_new_unique_name_thumb;

        	}
        }

    	} else {
        $vImg = '';
      }

    } else {

      $vImg = '';

    }


  if($vContributor && $vTestimonial) {
    // Validation passed
    require('inc-conn.php');
    require('inc-function-escapestring.php');

    // insert query
    $sql_insert = sprintf("INSERT INTO tbltestimonials (tcontributor, ttestimonial, timg) VALUES (%s, %s, %s)",
      escapestring($vconn_creativeangels, $vContributor, 'text'),
      escapestring($vconn_creativeangels, $vTestimonial, 'text'),
      escapestring($vconn_creativeangels, $vImg, 'text')
    );

    // Execute insert statement
    $vinsert_results = mysqli_query($vconn_creativeangels, $sql_insert);

    if($vinsert_results) {

      header('Location: testimonials-display.php');
      exit();

    } else {
      header('Location: signout.php');
      exit();

    } // DB end

  } else {

    $qs = '?kval=failed';
    $qs .= '&kcontributor=' . $vContributor;
    $qs .= '&vtestimonial=' . $vTestimonial;

    header('location: testimonials-add-new.php' . $qs);
    exit();
  } // Validation end


} else {
  header('location: signout.php');
  exit();
}

?>
