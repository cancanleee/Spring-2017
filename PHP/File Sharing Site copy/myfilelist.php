<!Doctype html>
<html>
<head>
	<title>Your FileList</title>

</head>

<body>




<?php
	session_start();

if (!isset($_SESSION['username'])){
header("Location:login.php");
}
	 printf( "%s's files:", $_SESSION['username']) ;
			 	echo nl2br (" \n ");
	 $full_path = '/home/ziwen/private_html/'.$_SESSION['username'];

	
	 $files = scandir($full_path);
	 // $files = array_diff(scandir($full_path), array('.', '..'));
		//  echo "jajaj";
	 	echo "<br>";
		//  //echo $files;
	    foreach($files as $filename){

	    	if ($filename != ".." && $filename !="." ){
	
	    	echo htmlentities("$filename");

	    	 	

		printf("
		<form name='View' method='POST' action='view.php'>
		<input type='hidden' name='filename' value='%s'/>
		<input type='submit' value='Open' />
		</form>", htmlentities($filename) );
		
		printf("
		<form name='Download' method='POST' action='download.php'>
		<input type='hidden' name='filename' value='%s'/>
		<input type='submit' value='Download' />
		</form>", htmlentities($filename) );
		
		printf("
		<form name='Delete' method='POST' action='delete.php'>
		<input type='hidden' name='filename' value='%s'/>
		<input type='submit' value='Delete' />
		</form>", htmlentities($filename) );

}


	}
?>

<br>
<p> If the file is a Microsoft Word or Excel document, it cannot be viewed directly. </p>
<p> Please choose "Download" to download and view it." </p>


<a href="home.php">Back to Home Page</a>

</body>
</html>