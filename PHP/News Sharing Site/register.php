<?php
session_start();
require 'callNewsDataBase.php';
if(isset($_POST['register'])){
	$username = (string) trim($_POST['username']);
	$password = (string) trim($_POST['password']);
	//no bad naming practice for username including space etc.
	if ( !preg_match('[\w\b]', $username) ){
		echo "Invalid username";
		exit;
	}
	
	
	$pwd_hash = crypt($password,"jkkkoioi");
	
	$stmt = $mysqli->prepare("INSERT INTO users (user_id, username, crypted_password) VALUES ('', ?, ?)");
	//condition check
	if(!$stmt) {
		printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
	}

	
	$stmt->bind_param("ss", $username, $pwd_hash);
	
	if (!$stmt->execute()){
		echo "Username already exists. ";
		$stmt->close();
		header("Refresh:2; url=login.php");
		session_destroy();
	} else {
		echo "User ".$username. " registered successfully";
		$stmt->close();
		header("Refresh:2; url=login.php");
		exit();
	}
}
?>