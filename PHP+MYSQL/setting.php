<?php 
require"db.php";

session_start();

$query = "SELECT * FROM admin";
$result = $db->query($query);
$row = $result->fetch_assoc();
$usr = $row['username'];
if ($_SESSION['username'] == $usr){;?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>cPanel - Onesignal Notification Control Panel</title>
  </head>
  <body>

<div style="text-align:center;"> <h1> Settings Panel </h1> <p style="font-size:12px;color:#737373;">Onesignal app ID and key settings </p> <hr></div>


<div class="container"> 
<a href="table.php">Dashboard</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i> 
<a href="post.php">Send Message</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i>
<span class="text-secondary">Settings</span>
<div class="float-right"><span class="text-secondary">Logged As: </span><?php echo $_SESSION['username'];?><a href="logout.php"> <span class="text-secondary">(LogOut) </span></a></div>
</div>
<hr>



<div class="container">
	
<div style="width:60%;  margin:0 auto;"> 

<div style="margin-top:10%;">
	

	
	
 <form action="" method="POST">
  <div class="form-group">
    <label for="email">Username</label>
    <input type="text" class="form-control" value="<?php 
$query = "SELECT * FROM admin";
$result = $db->query($query);
$row = $result->fetch_assoc();
echo $row['username']; ?>" name="username">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" value="<?php 
$query = "SELECT * FROM admin";
$result = $db->query($query);
$row = $result->fetch_assoc();
echo $row['password']; ?>" name="password">
  </div>

 <div class="form-group" style='color:red;'><?php echo $error;?> </div>
  <button type="submit" class="btn btn-primary" name="submit" style="width:100%;">Update</button>
</form> 
    
    
<?php 

if(isset($_POST['submit'])){
     $username = $_POST['username'];
     $password = $_POST['password'];
  
	$sql = "UPDATE admin SET username = '$username', password= '$password'";
     $db->query($sql);
    $message="<div class='bg alert-danger p-2'>Username and Password Has Ben Updated.. <br>You all be logout after 5 sec.. Please login again</div>"; 
    
     //path
     $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
     $path .=$_SERVER["SERVER_NAME"]. dirname($_SERVER["PHP_SELF"]);   
    
      //Javascript redirect after 5 sec    
      echo $success ="<script>
         setTimeout(function(){
            window.location.href = '$path/post.php';
         }, 3000);
       </script>";   
	
	};?>        
    
    
    
    <br>

    <form action="" method="POST"> 
   <div class="form-group">
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Advanced" data-whatever="@getbootstrap">APP ID AND KEY</button>

<div class="modal fade" id="Advanced" tabindex="-1" role="dialog" aria-labelledby="AdvancedLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AdvancedLabel">Onesignal App ID & KEY</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<div class="form-group">  
<label for="image" class="text-secondary">Onesignal APP ID</label> 
<br><input type="text" name="app" value="<?php 
$query = "SELECT * FROM config";
$result = $db->query($query);
$row = $result->fetch_assoc();
echo $row['ID']; ?>" style="width:100%;"> </div>
       
<div class="form-group"> 
    <label for="web" class="text-secondary">Onesignal KEY</label>
    <br> <input type="password" name="key" value="<?php 
$query = "SELECT * FROM config";
$result = $db->query($query);
$row = $result->fetch_assoc();
echo $row['KEY']; ?>" style="width:100%;">  </div>	
        
        
      </div>
      <div class="modal-footer">
        <button type="submit" name="core" class="btn btn-primary">update</button>
      </div>
    </div>
  </div>
</div>

</div>
 </form>
    
<?php if(isset($_POST['core'])){
	$id = $_POST['app'];
	$key = $_POST['key'];
	
	$sqls = "UPDATE `config` SET `ID` = '$id', `KEY`= '$key'";
     $db->query($sqls);
    $message="<div class='bg alert-danger p-2'>Your New App ID and Key Has Been Updated</div>"; 
	
	};?>    
    
    
    
    	<?php echo $message;?>
    
    
   
    
    </div>
  </div>	  
</div>

<div class="container" style="margin-top:2%;"> 
	<div class="card p-2">
	<small><div class="text-center">Push Notify V1 | <a href="https://needyamin.github.io/">Md. Yamin Hossain</a> | Copyright @ 2021 by <a href="https://www.ansnew.com/"> AnsNew Inc.</a></div></small> </div></div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>





	
<?php } else {
	echo "You can't access these page. Please login as <a href='login.php'>admin</a>";};?>

