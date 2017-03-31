<?php
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){
  die("Request forgery detected");
}
   if(isset($_GET['comment_id'])){
      $_SESSION['comment_id']=(int)$_GET['comment_id'];
   }
 	
   $comment_id=$_SESSION['comment_id'];
   require 'callNewsDataBase.php';
  
   // Use a prepared statement
if(isset($_POST['update'])){
  
  $content = (string) trim($_POST['content']);
  $token = trim($_POST['token']);
  
  if($token==$_SESSION["token"]){
 $stmt = $mysqli->prepare("UPDATE comments SET content=? where comment_id =?");
if(!$stmt) {
    printf("Query Prep Failed: %s\n", $mysqli->error);
      exit;
  }
  $stmt->bind_param("ss", $content, $comment_id);
  $stmt->execute();
  echo "Update Success, Redirecting you in 2 seconds";
  header("Refresh:2; url=main.php");

}
}
   ?>