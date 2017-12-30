<!DOCTYPE html>
<html>
<head>
  <title>Password Change</title>
  <style type="text/css">
    body{
    background: #f1f1f1;
  }
  #pagecontent{
      background: white;
    position: absolute;
    left:15%;
    width:70%; 
    height: 100%;
}
form{
  position: absolute;
  left: 35%;
  top: 5%;

}
</style>

</head>
<body>
<div id='pagecontent'>
<form action="#" method="post" >
<h1>&nbsp;&nbsp; &nbsp;Change Password</h1>
<input type="password" name="oldpassword" placeholder="Current Password" required>
<input type="password" name="newpassword" placeholder="New Password" required>
<input type="submit" name="cpassword" value="Change">
</form>
<?php
session_start();
if(!$_SESSION['isLogin'])
{
  header('location:index.php');
}
if(!$_SESSION['access']){
include('usernavigation.html');
}
else include('verticalNavigation.html');
if(isset($_POST['cpassword'])){
$userName = $_SESSION['userName'];
  $userPassword = $_POST['oldpassword'];
  $servername = "localhost";
    $username = "root";
    $password = "";
     $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    } 
   $newpassword=password_hash($_POST['newpassword'],PASSWORD_BCRYPT);
     $result=mysqli_query($connection,"select * from loginform where uname='".$userName."'");
       
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(strcmp($_POST['oldpassword'],$_POST['newpassword'])){  
  if((mysqli_num_rows($result)==1)&&(password_verify($userPassword,$row['password']))){
    $note=mysqli_query($connection, "update loginform set password='$newpassword' where uname='$_SESSION[userName]'");
    if($note){
    echo "<script>alert('Your password has been changed.');</script>";
    header('location:practise.php');
  }
   else
    echo "<script>alert('Your attempt failed.');</script>";
   }
  
}
else{
  echo "<script>alert('Please enter different password.');</script>";
}
}
    
?>
</div>

</body>
</html>