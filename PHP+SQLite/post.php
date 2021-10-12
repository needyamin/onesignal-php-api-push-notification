<?php
session_start();
include"db.php";
$query = "SELECT * FROM admin";
$result = $db->query($query);
$row = $result->fetchArray();
$usr = $row['username'];

if ($_SESSION['username'] == $usr){;?>

	



<?PHP

$message='';
date_default_timezone_set('Asia/Dhaka');

function sendMessage() {
	
include"db.php";
$query = "SELECT * FROM config";
$result = $db->query($query);

while($row = $result->fetchArray()) {
	$ID = $row['ID'];
	$KEY = $row['KEY'];
	
	
	$message = $_POST['message'];
	$image = $_POST['image'];
    $android = $_POST['android'];
    $web = $_POST['web'];
    $segments = $_POST['segments'];

    $content = array(
        "en" => $message,
    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Like",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://yoursite.com"
    ));
    array_push($hashes_array, array(
        "id" => "like-button-2",
        "text" => "Like2",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://yoursite.com"
    ));
    $fields = array(
        'app_id' => $ID,
        'global_image' => $image,
        'included_segments' => array(
            $segments,
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,
        'delivery_time_of_day' => $date = date('d-m-y h:i:s'),
        'web_url' => $web,
        'app_url' => $android,
        'web_buttons' => $hashes_array
    );
    
    $fields = json_encode($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic '.$KEY
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}}

if(isset($_POST['submit'])){
$response = sendMessage();
}

$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);

/*
echo '<pre>';
echo print_r($data); 
 echo '</pre>'; 
*/

if ($data['id'] == '') {
	
	} else {
		$message = "<div class='bg alert-danger p-2'>Push Notifiaction Sent Successfully</div>";
		}
 
 
foreach($data['errors'] as $row){
if($row[0] == ''){
	$message = "<div class='bg alert-danger p-2'>Something is Wrong.. Please contact with developer needyamin@ansnew.com</div>";
	} 
	else{
		$message = "<div class='bg alert-danger p-2'> Something is Wrong. Please fill up Messages with english text</div>";
		}
}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>cPanel - Onesignal Notification Control Panel</title>
  </head>
  <body>



	

<div style="margin-top:1%;">
	<div style="text-align:center;"> <h2 style="font-size: 3.5vw;"> SEND NOTIFICATION </h2> <p style="font-size:12px;color:#737373;">Onesignal Push Notification Posting </p> <hr></div>


<div class="container"> 
<a href="table.php">Dashboard</a> <i class="fa fa-angle-double-right" aria-hidden="true"></i>
<span class="text-secondary">Send Message</span> <i class="fa fa-angle-double-right" aria-hidden="true"></i>
<a href="setting.php">Settings</a>
<div class="float-right"><span class="text-secondary">Logged As: </span><?php echo $_SESSION['username'];?><a href="logout.php"> <span class="text-secondary">(LogOut) </span></a></div>
</div>
<hr>
	
	<div class="container">
		
		
	<form action="" method="POST">


<div class="form-group"> <?php echo $message;?> </div>


<div class="form-group">
  <label for="message" class="text-secondary">Type Your Message:</label>
  <textarea class="form-control rounded-0" name="message" rows="5"></textarea>
</div>



 <div class="form-group">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Advanced" data-whatever="@getbootstrap">Advanced</button>

<div class="modal fade" id="Advanced" tabindex="-1" role="dialog" aria-labelledby="AdvancedLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AdvancedLabel">Advanced Tool</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
       <div class="form-group">  <label for="image" class="text-secondary">Image URL</label> <br><input type="url" name="image" placeholder="https://site.com/image.png" style="width:100%;"> </div>
       
<div class="form-group">  <label for="android" class="text-secondary">Add Link For Android</label> <br><input type="url" name="android" placeholder="https://site.com/" style="width:100%;">  </div>

<div class="form-group">  <label for="web" class="text-secondary">Add Link for Web</label><br> <input type="url" name="web" placeholder="https://site.com/" style="width:100%;">  </div>	
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>

</div>






  <div class="form-group">
	  
    <label for="segments" class="text-secondary">Segments:</label>
    <select class="form-control" name="segments">
      <option value="Subscribed Users">Subscribed Users</option>
      <option value="New Users">New Users</option>
      <option>None</option>
    </select>
    
  </div>
  
  
<div class="form-group"><input type="submit" name="submit" class="btn-primary" value="Send Notification" style="width:100%;"> </div>
</form>


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
