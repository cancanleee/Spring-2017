<?php
session_start();
require 'callNewsDataBase.php';
if(isset($_POST['update'])){
	$username = (string) trim($_POST['username']);
	$password = (string) trim($_POST['password']); //change
	//no bad naming practice for username including space etc.
	if ( !preg_match('[\w\b]', $username) ){
		echo "Invalid username";
		exit;
	}
	

	$pwd_hash = crypt($password,"jkkkoioi");
	
	$stmt = $mysqli->prepare("UPDATE users SET crypted_password =? where username =?");
	//condition check
	if(!$stmt) {
		printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
	}


	// header("Refresh:2; url=login.php");

	
	$stmt->bind_param("ss", $pwd_hash, $username);
	$stmt->execute();
	if ($mysqli->affected_rows==0){
		echo "Username do not exists. Redirect you to Login Page in 2 seconds. ";
		$stmt->close();
		header("Refresh:3; url=login.php");
		session_destroy();
	} else {
		echo "User ".$username. " updated successfully";
		$stmt->close();
		header("Refresh:3; url=login.php");
		exit();
	}
}
?>