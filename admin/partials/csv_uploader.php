<?php
$ds          = DIRECTORY_SEPARATOR;  //1

$storeFolder = 'uploaded_csv';   //2

// if (!empty($_FILES)) {
// 	$_FILES['file']['name'] = preg_replace('/[^A-Za-z0-9 _ .-]/', '', $_FILES['file']['name']);
// 	$_FILES['file']['name'] = preg_replace('/\s+/', '_', $_FILES['file']['name']);

//     $tempFile = $_FILES['file']['tmp_name'];          //3            
//     $size = $_FILES['file']['size'];

//     $filename = $_FILES['file']['name'];
//     $ext = substr($filename, strrpos($filename, '.') + 1);

//     if($ext == "csv" && $_FILES["file"]["type"] == "text/csv"){
// 		$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4	
//     	$targetFile =  $targetPath. $_FILES['file']['name'];  //5
//     	move_uploaded_file($tempFile,$targetFile); //6

//     	$path = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//     	echo dirname($path)."/uploaded_csv/".$_FILES['file']['name']."  ".$size;
//     }
//     else{
//     	echo "error";
//     }
// }

?>  