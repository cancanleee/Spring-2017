<!Doctype html>
<html>
<head>
<title> UPLOADED </title>
</head>

<?php
session_start();



//$target_dir = sprintf("/Desktop/Spring/330/module2/".$username."/");
//$uploadOk = 1;


//check if the filename is valid or not
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-\s]+$/', $filename) ){
    echo "Invalid filename";
    exit;
}


//check if the username is valid or not
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){           
    echo "Invalid username";
    exit;
}


$full_path = sprintf("/home/ziwen/private_html/%s/%s", $username, $filename);


if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
     echo "Upload Successful. Redirect you in a bit";
       echo "<script>setTimeout(\"location.href = 'uploadpage.php';\",1500);</script>";
                        
     exit;   
} else {
     echo "Upload Failed.";
     exit;
    }


?>
<ul>
<li> <a href="uploadpage.php">Back to Upload Page </a> </li>
</ul>


</body>

</html>