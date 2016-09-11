<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

  $vImg = 'na';
  $vId = $_POST['txtId'];
  $vcreated = date('Y-m-d');
  $validation = 0;

  //------------------------- IMAGE UPLOAD ----------------------------------

  //GET THE FILE EXTENTION
   function getExtension($str) {

  		 //FIND THE POSITION OF THE LAST OCCURRENCE OF A SUBSTRING IN A STRING
           $i = strrpos($str, '.');

           	if (!$i) {
  			 	return '';
  			 	}
  		 //GET STRING LENGTH
           $l = strlen($str) - $i;

  		 //RETURN PART OF A STRING
           $ext = substr($str, $i+1, $l);
           return $ext;

  	}

     // get the dimensions of the file and if the dimensions are larger than int
     if(isset($_SERVER['CONTENT_LENGTH']) && (int) $_SERVER['CONTENT_LENGTH'] > (1024*1024*(int) ini_get('post_max_size'))){
        header('Location: team-update-display.php?kfilesize=toolarge');
      	exit();
     }

    ini_set('memory_limit', '128M');

   	$vfile_name = $_FILES['txtImg']['name'];

  	$vstring = strtolower(trim($_FILES['txtImg']['name']));

  	//REPLACE ALL OCCURRENCES OF THE SEARCH STRING WITH THE REPLACEMENT STRING
  	//REPLACE ALL SPACES WITH HYPHENS
  	$vfile_name = str_replace(' ', '-', $vfile_name);

  	//REPLACE ALL UNDERSCORS WITH HYPHENS
  	$vfile_name = str_replace('_', '-', $vfile_name);


   	if ($vfile_name) {

    	$vfile_extension = getExtension($vfile_name);

   		$vfile_extension = strtolower($vfile_extension);

  		//CHECK FILE EXTENTION
  		if (($vfile_extension != 'jpg') && ($vfile_extension != 'jpeg') && ($vfile_extension != 'png') && ($vfile_extension != 'gif')) {

  			$vImg = 'na';

   		} else {

  			//GET THE FILE SIZE
  			$vfile_size = filesize($_FILES['txtImg']['tmp_name']) / 1000000;

      //CREATE THE IMAGE BASED ON FILE EXTENSION
      if($vfile_extension == 'jpg' || $vfile_extension == 'jpeg' ) {

      	$vfile_temp_name = $_FILES['txtImg']['tmp_name'];

      	//CREATE A NEW IMAGE FROM FILE
      	$vfile_source = imagecreatefromjpeg($vfile_temp_name);

      } elseif($vfile_extension == 'png') {

      		$vfile_temp_name = $_FILES['txtImg']['tmp_name'];

      		//CREATE A NEW IMAGE FROM FILE
      		$vfile_source = imagecreatefrompng($vfile_temp_name);

      } else {

      		$vfile_temp_name = $_FILES['txtImg']['tmp_name'];

      		//CREATE A NEW IMAGE FROM FILE
      		$vfile_source = imagecreatefromgif($vfile_temp_name);

      }

        //GET IMAGE DIMENTION (ORIGINAL IMAGE)
        list($vfile_original_width, $vfile_original_height) = getimagesize($vfile_temp_name);

        //SPECIFY NEW DIMENTIONS (WIDTH OF LARGE IMAGE)

        //300px wide
        $vfile_new_width = 300;
        $vfile_new_height = ($vfile_original_height/$vfile_original_width) * $vfile_new_width;

        //CREATE A NEW TRUE COLOUR IMAGE (LARGE)
        $vtrue_colour_image_large = imagecreatetruecolor($vfile_new_width, $vfile_new_height);


        //SPECIFVY NEW WIDTH OF THUMBNAIL IMAGE

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
        $vfilepath_uploaded_file_dir_large = '../assets/uploads/team/large/';
        $vfilepath_uploaded_file_display_dir_large = '../assets/uploads/team/large/';

        $vfile_new_unique_name_large = date('YmdHis') . '-' . 'thumbnail' . '-' . $vfile_name;

        $vfilepath_uploaded_file_dir_large = $vfilepath_uploaded_file_dir_large . $vfile_new_unique_name_large;

        $vfilepath_uploaded_file_display_dir_large = $vfilepath_uploaded_file_display_dir_large . $vfile_new_unique_name_large;

        //UPLOAD LOCATION + FILE NAME (thumb IMAGE)
        $vfilepath_uploaded_file_dir_thumb = '../assets/uploads/team/thumb/';
        $vfilepath_uploaded_file_display_dir_thumb = '../assets/uploads/team/thumb/';

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

          $oldImg = $_POST['txtOldImg'];

          if($oldImg !== 'na' && $oldImg !== '') {
            // Delete old file
            unlink('../assets/uploads/team/large/' . $_POST['txtOldImg']);
            unlink('../assets/uploads/team/thumb/' . $_POST['txtOldImg']);
          }


          $vImg = $vfile_new_unique_name_thumb;
         //$vImg = basename($vImg);

      	} else {

      		$vImg = $_POST['txtOldImg'];

      	}
      }

  	} else {
      $vImg = $_POST['txtOldImg'];
    }

  include_once('inc-fn-sanitize.php');

  $vName = ucfirst(strtolower(sanitize('txtName')));
  $vSurname = ucfirst(strtolower(sanitize('txtSurname')));
  $vJobTitle = ucfirst(strtolower(sanitize('txtJobTitle')));
  $vCompany = ucfirst(sanitize('txtCompany'));
  $vBio = ucfirst(sanitize('txtBio'));

// ----------------------- VALIDATION FUNCTIONS --------------------------
if(!$vName || !$vSurname || !$vJobTitle || !$vCompany || !$vBio) {

    $qs = '?kval=failed';
    $qs .= "&kname=".urlencode($vName);
    $qs .= "&ksurname=".urlencode($vSurname);
    $qs .= "&kcompname=".urlencode($vCompName);
    $qs .= "&kjobtitle=".urlencode($vJobTitle);
    $qs .= "&kbio=".urlencode($vBio);
    $qs .= "&kid=". $vid;
    $qs .= "&txtSecurity=" . $_SESSION['svSecurity'];

    header('Location: team-update-display.php' . $qs);
    exit();

    // validation check
  } else if ($validation === 0) {

      // Connect to mysql server
      require('inc-conn.php');

      // Calls the file where the user defined function escapestring receives its instructions
      require('inc-function-escapestring.php');

      // Connect to mysql server
      require('inc-conn.php');

      // The proper way to insert sql statement (SQL Injection)
      // The first specifier (%s) corresponds to the first escapestring function as so on and so forth
      $sql_insert = sprintf("UPDATE tblteam SET tname = %s, tsurname = %s, tcompname = %s, tjobtitle = %s, tbio = %s, tphotograph = %s WHERE tid = $vId",
        escapestring($vconn_creativeangels, $vName, 'text'),
        escapestring($vconn_creativeangels, $vSurname, 'text'),
        escapestring($vconn_creativeangels, $vCompName, 'text'),
        escapestring($vconn_creativeangels, $vJobTitle, 'text'),
        escapestring($vconn_creativeangels, $vBio, 'text'),
        escapestring($vconn_creativeangels, $vImg, 'text')
      );

      // die($sql_insert);
      // Execute insert statement
      $vinsert_results = mysqli_query($vconn_creativeangels, $sql_insert);

      if($vinsert_results) {
        header('Location: team-details-display.php?kupdate=success');
        exit();

      } else {
        header('Location: team-details-display.php?kupdate=failed');
        exit();
      }

  } // END OF VALIDATION METHOD
} else {

   echo 'security token';
  //header('Location:signout.php');
  exit();
}
?>
