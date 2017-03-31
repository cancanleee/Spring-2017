<!DOCTYPE html>

<html>
<body>
<head>
  
   <meta charset="utf-8"/>
   
   <style>
      table {
      width:25%;
      border:0;
      cellspacing:0;
      cellpadding:0;
      }
   </style>
   <title>Edit News</title>
</head>
<?php
    session_start();
    ?>

<form action="editStoryFunction.php?story_id=<?php echo $_GET['story_id'] ?>" method="post" >
   Title:<input type="text" id="title" name="title" required>
   <br>
   <br>
   Content: <textarea id="content" name="content" required></textarea>
   <br>
   <br>
   Link: <textarea type="text" id="link" name="link" required></textarea>
  <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />   
   <br>
   <button type="submit" name="update">Update</button>
</form>

<br>

<a href="main.php">Back to Main List</a>


</body>
</html>

