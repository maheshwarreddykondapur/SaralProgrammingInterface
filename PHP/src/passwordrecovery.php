<!DOCTYPE html>
<html>
<head>
	<title>Password Recovery</title>
</head>
<body>
<div id='content' align="center">
<b>Enter your registered mail id.</b>
<br><br>
<form method='post' action='#'>
<input type="text" name="username" required><br><br>
<input type="submit" name="submit" value="Recover"><br>
</form>
</div>
<?php
session_start();
if(isset($_POST['submit']))
{
	$servername = "localhost";
        $userName = "root";
        $password = "";

        $connection = mysqli_connect($servername, $userName, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    } 
   
     $result=mysqli_query($connection,"select * from loginform where uname='".$_POST['username']."'");
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      if(mysqli_num_rows($result)==1){
        $npass=rand();
      	$epass=password_hash($npass,PASSWORD_BCRYPT);
        $message="Dear user,\n Your new credentials are \nusername: ".$_POST['username']."\nPassword :".$npass."\n\nTEAM GETMNC";
       
       $response=mail($row['uname'],"GETMNC Password Recovery",$message,"From:Team GETMNC");
       if($response)
       {
       	 mysqli_query($connection,"update loginform set password='$epass' where uname='$_POST[username]'");
       	$_SESSION['msg']='Your new password is sent to your registered mail-id';
       	header('location:index.php');
       }
       else{
       	$_SESSION['msg']='Oops! something went wrong please try after some time.';
       	header('location:index.php');
       }

      }
      else
      {
      	$_SESSION['msg']='Mail id is not registered.';
      	header('location:index.php');
      }
}
?>
</body>
</html>