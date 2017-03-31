<?php
session_start();

$username = $_SESSION['username'];
// $path = $_SESSION['path'];

$filename = (string) $_POST['filename'];

// echo $filename;


//still need to check if the file name is valid or not
 if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
 	echo "Invalid filename";
 	exit;
 }
$full_path = sprintf("/home/ziwen/private_html/%s/%s", $username, $filename);
// echo $full_path;   

if (!unlink($full_path)){
  echo ("Error deleting $filename");
}else{
  echo htmlentities("Successfully Deleted $filename!");
  header( "refresh:5;url=myfilelist.php" );  //go back to the file list page after successfully deleting the file

		echo nl2br (" \n ");

      	echo nl2br (" \n ");

      	echo 'You\'ll be redirected in about 5 secs. If not, click <a href="myfilelist.php">here</a>.';

  exit;
  }
  
?>