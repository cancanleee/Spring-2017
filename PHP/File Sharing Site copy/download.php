<?php
session_start();
$filename = (string) $_POST['filename'];

//checking if the file name is valid
$username = (string) $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

//chekcing if the username is valid
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}


$full_path = sprintf("/home/ziwen/private_html/%s/%s",$username,$filename);

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo -> file($full_path);

header("Content-Type: ".$mime);
header("Content-Disposition: attachment; filename=$filename");  //this line is from the website:http://stackoverflow.com/questions/7263923/how-to-force-file-download-with-php

//download the file
readfile($full_path);
?>