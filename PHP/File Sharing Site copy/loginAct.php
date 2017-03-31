<?php
	session_start();

if (!isset($_SESSION['username'])){
header("Location:login.php");
}


	$username= (string) $_POST['username'];
	$_SESSION['username'] = $username;
	
	$handle = fopen("/home/ziwen/private_html/accounts.txt" , "r");
   
   
	while ( !feof($handle)) {
	
		$usernamearray[] = trim(fgets($handle));
		
	}
    
  	

	fclose($handle);
    
	if(in_array($_SESSION['username'], $usernamearray, true)){
	
		echo htmlentities("Login Successful,  $username");
		

		
		 header( "refresh:5;url=home.php" );

      	echo nl2br (" \n ");

      	echo nl2br (" \n ");

      	echo 'You\'ll be redirected in about 5 secs. If not, click <a href="home.php">here</a>.';
      
    	
		exit;
	}
	else echo "wrong user, redirecting you to the main login page in five seconds. ";
	 echo "<script>setTimeout(\"location.href = 'login.php';\",1500);</script>";
    
	session_destroy();
	
?>