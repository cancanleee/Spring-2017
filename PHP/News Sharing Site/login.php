<?php
// This is a *good* example of how you can implement password-based user authentication in your web application.
 
session_start();
require 'callNewsDataBase.php';
if(isset($_POST['username'])){
	
	$password=trim($_POST['password']);
 
	// Use a prepared statement
	$stmt = $mysqli->prepare("SELECT COUNT(*), user_id, crypted_password FROM users WHERE username=?");
 
	// Bind the parameter
	$stmt->bind_param('s', $user);
	$user=(string) trim($_POST['username']);
	$stmt->execute();
	 
	// Bind the results
	$stmt->bind_result($cnt, $user_id, $pwd_hash);
	$stmt->fetch();
	 
	$pwd_guess = (string) $_POST['password'];
	// Compare the submitted password to the actual password hash
	if( $cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
		// Login succeeded!
		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $user;
		$token = substr(md5(rand()), 0, 10);
    	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32)); 
		// Redirect to your target page
		header("Location: main.php");
	}else{
		// Login failed; redirect back to the login screen
		echo "Failed to log in. ";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta charset="UTF-8">
</head>



<body>
<link rel="stylesheet" href="style.css"> 
<div class="login">
	<form action="login.php" method="POST">
		<h1>Login</h1>
		<input type="text" id="username" placeholder="Username" name="username" required>
		<input type="password" id="password" placeholder="Password" name="password" required>
		<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
		<button type="submit" name="login">Login</button>
	</form>

    <h1> New User?  </h1> 
    <form action="register.html" method="post">
        <input type='submit' name='submit' value='Register' class='register' />
    </form>

    <p> Don't want to register? Enter as Guest</p> 
    <form action="main.php" method="post">
        <input type='submit' name='guest' value='Guest' class='guest' />

    </form>

     <p> Update your password?</p> 
    <form action="update.html" method="post">
        <input type='submit' name='update' value='Update' class='updates' />
    </form>

  <form action="deleteUser.php" method="POST">
        <p>Enter name of the User wanted to be deleted</p>
        <input type="text" id="deleteUser" placeholder="Username" name="deleteUser" required>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <button type="submit" name="delete">Delete</button>
    </form>


</div>
</body>



</html>