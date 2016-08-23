<?php
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


//CONVERT FILE NAME TO LOWERCASE AND REMOVE SPACES AND UNDERSCORES IN FILE NAME AND REPLACE THEM WITH HYPHENS
 if($_SERVER['REQUEST_METHOD'] == 'POST') {

  ini_set('memory_limit', '128M');

 	$vfile_name = $_FILES['txtimage']['name'];

	$vstring = strtolower(trim($_FILES['txtimage']['name']));

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

			header('Location: image-upload.php?kextension=wrong');
			exit();

 		} else {

			//GET THE FILE SIZE
			$vfile_size = filesize($_FILES['txtimage']['tmp_name']) / 1000000;

			//GET THE DEFAULT FILE SIZE UPLOAD LIMIT FROM THE PHP INI FILE
			//$vmax_file_size = ini_get('upload_max_filesize');

			//TEST THE FILE SIZE
			if ($vfile_size === 0 || $vfile_size > '5M') {

				header('Location: image-upload-form.php?kfilesize=toolarge');
				exit();

			}

//CREATE THE IMAGE BASED ON FILE EXTENSION
if($vfile_extension == 'jpg' || $vfile_extension == 'jpeg' ) {

	$vfile_temp_name = $_FILES['txtimage']['tmp_name'];

	//CREATE A NEW IMAGE FROM FILE
	$vfile_source = imagecreatefromjpeg($vfile_temp_name);

	} elseif($vfile_extension == 'png') {

		$vfile_temp_name = $_FILES['txtimage']['tmp_name'];

		//CREATE A NEW IMAGE FROM FILE
		$vfile_source = imagecreatefrompng($vfile_temp_name);

	} else {

		$vfile_temp_name = $_FILES['txtimage']['tmp_name'];

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
$vfilepath_uploaded_file_dir_large = 'uploaded-files/large/';
$vfilepath_uploaded_file_display_dir_large = 'uploaded-files/large/';

$vfile_new_unique_name_large = date('YmdHis') . '-' . 'thumbnail' . '-' . $vfile_name;

$vfilepath_uploaded_file_dir_large = $vfilepath_uploaded_file_dir_large . $vfile_new_unique_name_large;

$vfilepath_uploaded_file_display_dir_large = $vfilepath_uploaded_file_display_dir_large . $vfile_new_unique_name_large;

//UPLOAD LOCATION + FILE NAME (thumb IMAGE)
$vfilepath_uploaded_file_dir_thumb = 'uploaded-files/thumb/';
$vfilepath_uploaded_file_display_dir_thumb = 'uploaded-files/thumb/';

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

	echo 'File uploaded and resized';

	} else {

		echo 'File not uploaded and resized';

		}



		}

	}

 }
?>
