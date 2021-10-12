<?php 
require_once"db.php";
$error="";

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    
    if($username == '' or $password == ''){
	$error = "username and password cannot be blank";
	} else{
	//store value	
    $u = $row['username'];
    $p = $row['password'];
    
    if($u == $username And $p == $password){
	 $error = "<p class='text-primary'>Login successfully.. Please 
	 Wait 3 sec..</p>";
	 session_start();
	 $_SESSION['username'] = $_POST['username'];
	 
	 //path
     $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
     $path .=$_SERVER["SERVER_NAME"]. dirname($_SERVER["PHP_SELF"]);   
    
      //Javascript redirect after 5 sec    
      echo $success ="<script>
         setTimeout(function(){
            window.location.href = '$path/post.php';
         }, 3000);
       </script>";   
       
	 }else { $error = "please enter right username and password";}
         }
         
	};?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>cPanel - Onesignal Notification Control Panel</title>
  </head>
  <body>


<div class="container">
	
<div style="width:40%;  margin:0 auto;"> 

<div style="margin-top:10%;">
	<div style="text-align:center;"> <h1> cPanel </h1> <p style="font-size:12px;color:#737373;">Onesignal Push Notification </p> <hr></div>
	
 <form action="" method="POST">
  <div class="form-group">
    <label for="email">Username</label>
    <input type="text" class="form-control" placeholder="Enter username" name="username">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" placeholder="Enter password" name="password">
  </div>

 <div class="form-group" style='color:red;'><?php echo $error;?> </div>
  <button type="submit" class="btn btn-primary" name="submit" style="width:100%;">Login</button>
</form> 
    
    </div>
  </div>	  
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
