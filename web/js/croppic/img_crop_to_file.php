<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
$imgUrl = $_POST['imgUrl'];
// original sizes
$imgInitW = $_POST['imgInitW'];
$imgInitH = $_POST['imgInitH'];
// resized sizes
$imgW = $_POST['imgW'];
$imgH = $_POST['imgH'];
// offsets
$imgY1 = $_POST['imgY1'];
$imgX1 = $_POST['imgX1'];
// crop box
$cropW = $_POST['cropW'];
$cropH = $_POST['cropH'];
// rotation angle
$angle = $_POST['rotation'];

$jpeg_quality = 80;

$imagePath = "temp/";

$source_filename = pathinfo($imgUrl, PATHINFO_FILENAME);
$output_filename = "c".$source_filename;


$what = getimagesize($imgUrl);

switch(strtolower($what['mime']))
{
    case 'image/png':
		$source_image = imagecreatefrompng($imgUrl);
		$type = '.png';
        break;
    case 'image/jpg':
        $source_image = imagecreatefromjpeg($imgUrl);
        error_log("jpg");
        $type = '.jpeg';
        break;
    case 'image/pjpeg':
        $source_image = imagecreatefromjpeg($imgUrl);
        error_log("jpg");
        $type = '.jpeg';
        break;
    case 'image/jpeg':
		$source_image = imagecreatefromjpeg($imgUrl);
		error_log("jpg");
		$type = '.jpeg';
        break;
    case 'image/gif':
		$source_image = imagecreatefromgif($imgUrl);
		$type = '.gif';
        break;
    default: 
    	$response = Array(
	    "status" => 'error',
	    "message" => 'Формат изображения не поддерживается'.$imgUrl
    	);
    	print json_encode($response);
    	return;
}

//Check write Access to Directory

if(!is_writable(dirname($imagePath.$output_filename))){
	$response = Array(
	    "status" => 'error',
	    "message" => 'Нет доступа к директории с изображением'
    );	
}else{

    // resize the original image to size of editor
    $resizedImage = imagecreatetruecolor($imgW, $imgH);
	imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
    // rotate the rezized image
    $rotated_image = imagerotate($resizedImage, -$angle, 0);
    // find new width & height of rotated image
    $rotated_width = imagesx($rotated_image);
    $rotated_height = imagesy($rotated_image);
    // diff between rotated & original sizes
    $dx = $rotated_width - $imgW;
    $dy = $rotated_height - $imgH;
    // crop rotated image to fit into original rezized rectangle
	$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
	imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
	imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
	// crop image into selected area
	$final_image = imagecreatetruecolor($cropW, $cropH);
	imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
	imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
	// finally output png image
	//imagepng($final_image, $output_filename.$type, $png_quality);
	imagejpeg($final_image, $imagePath.$output_filename.'.jpeg', $jpeg_quality);

    if(isset($_POST['is_source']))
        imagejpeg($source_image, $imagePath.$source_filename.'.jpeg', $jpeg_quality);

	$response = Array(
	    "status" => 'success',
	    "url" => '/js/croppic/'.$imagePath.$output_filename.'.jpeg'
    );
}
print json_encode($response);