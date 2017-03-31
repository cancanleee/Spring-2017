<!DOCTYPE html>
<html>
    <head>
        <title>Welcome!</title>
    </head>
    <body>
	
    <div>

<a href="logout.php">Log out</a>
<?php session_start();
if (isset($_SESSION['username'])) ?>
	


			<p>Create a story: </p>
			<form action='main.php' method="POST">
				<div>
				<input type="text" name="title" placeholder="News Title" required>
				<br>
				<textarea name="content" placeholder="Story Content" ></textarea>
				<br>
				<textarea name="link" placeholder="Story link" ></textarea>
				<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
				<input type = "hidden" name = "userName" value ="'.$_SESSION['username'].'" />
				</div>
				<button type="submit" name="upload">Create</button>
			</form>


	
	</div>

	<div>
	     <h1> Stories List </h1>
	     <?php
	     
require 'callNewsDataBase.php';
	         $stmt = $mysqli->prepare("SELECT story_id, title, content, create_date, number_of_comments, link, username FROM stories");
			if(!$stmt) {
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit();
			}
		
			$stmt->execute();
			$stmt->bind_result($story_id, $title, $content, $create_date, $number_of_comments, $link, $username);

			$stmt->store_result();
			while ($stmt->fetch()) {
					$story = '';
					$story = $story. '<a href="content.php?story_id='.$story_id.'"><h2>'.$title.'</h2></a>' .'<div>'.'Author: '.$username.'</div>'.'<div>'.$content.'</div>'.'<div>'.$link.'</div>';
					echo ($story);
			}
			$stmt->close();
		 ?>
	</div>

    </body>
</html>



<?php

require 'callNewsDataBase.php';

if (!isset($_SESSION['username'])){

	echo "unregistered user can not create a story";
}

else{


if (isset($_POST['upload']) && ($_SESSION['token'] == $_POST['token'])){
	$title = (string) $_POST["title"];
	$content = (string) $_POST["content"];
	$link = (string) $_POST["link"];
	$username = $_SESSION["username"];

	
	$stmt=$mysqli->prepare("INSERT INTO stories (title, content, link, username) VALUES (?, ?, ?, ?)");
	if(!$stmt) {
		printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit();
	}
	
	$stmt->bind_param('ssss', $title, $content, $link, $username);
	
	if (!$stmt->execute()) {
	    echo $mysqli->error;
	    $stmt->close();
	} 
	
	
		
		 
	}
}

?>
