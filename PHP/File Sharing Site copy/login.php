<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Index</title>
<style>
.center {
    text-align: center;
    border: 20px solid blue;
}
</style>
</head>


<body><div class="center">
<form action="loginAct.php" method="POST">
   
  <p>
  Returning User? Welcome! Login below by simply input your username
  <br> <br>
 <label for="username">Username:</label>
   <input type="text" name="username"  id="username" />
  <input type="submit" name= "aa" value="Log In" /> 
  </p>
</form>

<br> <br> <br>

	<form class="text-center" action="new.php" method="GET">
          New User? Register below by simply input your choice of username! 
          <br> <br>
					<label for="username"> New User: </label>
					 <input type="text" style="width:inherit;" name="username"/> 
				<button type="submit" class="btn btn-info">Join here!</button>
        <br>
				</form>
        <br>

<p> Sometimes the user browser have cache that might require user to type in the correct username again. </p>
</div></body>
</html>


