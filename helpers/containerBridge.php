<?php
require '../../autoload.php';
$fm = new db();
if (isset($_GET['path'])){
	$url = $_GET['path'];
	// Search for the extension of the file
	$url = substr($url, 0, strpos($url, "?"));
	$url = substr($url, strrpos($url, ".") + 1);
	 
			// Send the correct Content-Type header
			if($url == "jpg"){
			header('Content-type: image/jpeg');
			} else if($url == "gif"){
			header('Content-type: image/gif');
			} 
			else if($url == "png"){
			header('Content-type: image/png');
			}else if($url == "pdf"){
			header('Content-type: application/pdf');
			}else{
			header('Content-type: application/octet-stream');
			}
			 
	// Show the contents of the container field
	echo $fm->getContainerData($_GET['path']);
	 
}

?>
