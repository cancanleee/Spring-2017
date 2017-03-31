<?php
  session_start();
  $username = (string) $_GET['username'];
  $_SESSION['username'] = $username;
  //$handle = fopen("/media/module2/users.txt" , "r");
   
   $file=sprintf("/home/ziwen/private_html/accounts.txt");
   $handle = fopen($file,"r");
  while ( !feof($handle)) {
  
    $usernamearray[] = trim(fgets($handle));
  }
    fclose($handle);
    
    
  if(in_array($_SESSION['username'], $usernamearray, true)){
     echo ("Username $username is taken, Pick another one @ login page!");
    
      header( "refresh:5;url=login.php" );

      echo nl2br (" \n ");

      echo nl2br (" \n ");

      echo 'You\'ll be redirected in about 5 secs. If not, click <a href="login.php">here</a>.';      
    exit;
  }
  else {
     $full_path = sprintf("/home/ziwen/private_html/%s", $username);
   if (!mkdir($full_path, 0777, true)){
    echo ("error making directory for new user");
    }
   else {
      $temp = fopen($file, "a");
          if((fwrite($temp, $username))!==false){
            fwrite($temp,"\r\n");
                
                echo htmlentities ("Registered, Congradulation: $username!");
                header( "refresh:5;url=home.php" );
                 echo nl2br (" \n ");
                 echo nl2br (" \n ");
                 echo 'You\'ll be redirected in about 5 secs. If not, click <a href="home.php">here</a>.'; 
                        exit;
                    }
                    else{
                       echo("trouble writing to accounts.txt");
                    }
                    fclose($temp);
                }
  }
  session_destroy();
  
?>