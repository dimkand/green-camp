<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/

//define('HOME_DIR', $_SERVER['DOCUMENT_ROOT'].'/');
   // $imagePath =HOME_DIR. "tmp/";
	$imagePath = "temp/";
	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);
	
	//Check write Access to Directory

	if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Не могу загрузить изображение. Нет доступа к директории.'
		);
		print json_encode($response);
		return;
	}

	if($files = glob($imagePath.'*')){
		foreach ($files as $file) {
            $time_file_save = 60*60*24;
            if(filectime($file) + $time_file_save < time() && is_file($file))
				unlink($file);
		}
	}
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'Ошибка. Код ошибки: '. $_FILES["img"]["error"],
			);			
		}
	  else
		{
			
	      $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );

		  if(isset($_POST['prefix']))
              $new_basename = 'img_'.$_POST['prefix'].'.'.$extension;
		  else
              $new_basename = 'img_'.time().'.'.$extension;

		  move_uploaded_file($filename,  $imagePath.$new_basename);

		  $response = array(
			"status" => 'success',
			"url" => $_POST['baseUrl'].'/js/croppic/'.$imagePath.$new_basename,
			"width" => $width,
			"height" => $height
		  );
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'Неправельное расширение файла, выбирите файлы с расширением `gif`, `png` или `jpg`.',
		);
	  }
	  
	  print json_encode($response);

?>
