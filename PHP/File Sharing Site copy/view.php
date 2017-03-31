<?php
session_start();


// $path = $_SESSION['path'];

//still need to check if the filename is valid or not
$filename = (string) $_POST['filename'];
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo ("Invalid: $filename");
	//echo "Invalid filename";
	exit;
}


//still need to check if the username is valid or not
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){			
    echo "Invalid username";
    exit;
}


$full_path = sprintf("/home/ziwen/private_html/%s/%s", $username, $filename);

ob_clean();
// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);
 
// Finally, set the Content-Type header to the MIME type of the file, and display the file.
header("Content-Type: ".$mime);

readfile($full_path);
ob_clean();

echo '<a href="myfilelist.php">Back to Filelist</a>.'; 

?>