<!DOCTYPE html>
<html>
<head>
<title> Home </title>
<style>
p  {color: #556B2F;}
</style>
</head>


<?php
session_start();
if (!isset($_SESSION['username'])){
header("Location:login.php");
}



$username = (string) $_SESSION['username'];


	
?>


<body>
	<p><b> Welcome,  <?php echo $username."<br>" ?> <a href="logout.php">Log out</a>  </b></p> 
	<ul>
		<li><a href="myfilelist.php">Click to browse your files</a></li>
		<li><a href="uploadpage.php">Click to upload new files</a></li>    
	</ul>

	

</body>

</html>
