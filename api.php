<?php
header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

include 'dbconfig.php'; // include database connection file
$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
	
$fileName  =  $_FILES['sendimage']['name'];
$tempPath  =  $_FILES['sendimage']['tmp_name'];
$fileSize  =  $_FILES['sendimage']['size'];
$newfilename;

		
if(empty($fileName))
{
	$errorMSG = json_encode(array("message" => "please select image", "status" => false));	
	echo $errorMSG;
}
else
{
	$upload_path = 'upload/'; // set upload folder path 
	
	$fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
		
	// valid image extensions
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf');
					
	// allow valid image file formats
	if(in_array($fileExt, $valid_extensions))
	{				
		//check file not exist our upload folder path
		
			// check file size '50MB'
			if($fileSize < (1000000 * 50)){
				$newfilename = round(microtime(true)) . '.' . $fileExt;

				move_uploaded_file($tempPath, $upload_path . $newfilename); // move file from system temporary path to our upload folder path 
			}
			else{
				$errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 50 MB size", "status" => false));	
				echo $errorMSG;
			}

	}
	else
	{		
		$errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));	
		echo $errorMSG;		
	}
}
		
// if no error caused, continue ....
if(!isset($errorMSG))
{
	if(mysqli_query($conn, "INSERT INTO `files` (`id`, `link`, `filename`) VALUES (NULL, 'https://cdn.dlsoftbd.com/upload/$newfilename', '$newfilename');")){
		echo json_encode(array("message" => "Image Uploaded Successfully", "status" => true));
	}else{
		echo json_encode(array("message" => "DB IMAGE UPLOAD FAILD", "status" => false));
	}
			
	
}

?>