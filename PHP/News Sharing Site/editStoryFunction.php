<?php
session_start();
   if(isset($_GET['story_id'])){
      $_SESSION['story_id']=$_GET['story_id'];
   }
 	// if($_SESSION['token'] !== $_POST['token']){
  //        die("Request forgery detected");
  //   }
   $story_id=$_SESSION['story_id'];
   require 'callNewsDataBase.php';
  
   // Use a prepared statement
if(isset($_POST['update'])){
  $title = (string) trim($_POST['title']);
  $content = (string) trim($_POST['content']);
  $link = (string) trim($_POST['link']);
  
  if(!hash_equals($_SESSION['token'], $_POST['token'])){
  die("Request forgery detected");
}
 $stmt = $mysqli->prepare("UPDATE stories SET title=? where story_id =?");
if(!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
      exit;
  }
  $stmt->bind_param("ss", $title, $story_id);
  $stmt->execute();

 $stmt1 = $mysqli->prepare("UPDATE stories SET content=? where story_id =?");
 $stmt1->bind_param("ss", $content, $story_id);
 $stmt1->execute();

$stmt2 = $mysqli->prepare("UPDATE stories SET link=? where story_id =?");
 $stmt2->bind_param("ss", $link, $story_id);
 $stmt2->execute();

echo "Update Success, Redirecting you in 2 seconds";
  header("Refresh:2; url=main.php");


}
   ?>