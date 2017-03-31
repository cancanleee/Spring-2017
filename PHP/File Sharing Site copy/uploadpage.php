<!Doctype html>
<html>
<head>
<title> Upload Page </title>
</head>


<?php
session_start();

if (!isset($_SESSION['username'])){
header("Location:login.php");
}

$username = $_SESSION['username'];
// $path = $_SESSION['path'];
?>

<body>

<form action = "upload.php" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
	Upload this file: <input name="uploadedfile" type="file" id="uploadfile_input" />
	<input type="submit" value="Upload File" /> <br>
</form>


<p> Attention Users! Filename can't have space within the naming. User need to be careful when choosing file to upload! </p>

<ul>
    <li><a href="home.php">Back to home page</a></li>
</ul>


</body>

</html>