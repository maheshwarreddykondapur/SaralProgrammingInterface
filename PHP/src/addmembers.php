 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add Members</title>
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
	left: 45%;
}
 	</style>
 </head>
 <body>
 <div id='pagecontent'>
<?php 
session_start();
if(isset($_SESSION['isLogin']))
{
if(!$_SESSION['access']){
include('usernavigation.html');
}
else include('verticalNavigation.html');
}
else{
	header('location:index.php');
}
 $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"editor");
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 echo '<form action="#" method="post" ><br><br>
 <h1>Add Member</h1>
<input type="text" name="name" placeholder="Name"><br><br>
<input type="text" name="cid" placeholder="Roll.No"><br><br>
<input type="text" name="cname" placeholder="College Name"><br><br>
<input type="text" name="username" placeholder="User Name(Mail id)"><br><br>
<input type="password" name="password" placeholder="Password"><br><br>
<input type="number" name="access" placeholder="access" min="0" max="1"><br><br>
<i style="color:red">access=1 for admin else 0<i><br><br>
<input type="submit" name="addmember" placeholder="Add"><br><br>

</form>';


if(isset($_POST['addmember']))
{
	$epass=password_hash($_POST['password'],PASSWORD_BCRYPT);
   
    $result=mysqli_query($conn,"Insert into loginform values('$_POST[name]','$_POST[cid]','$_POST[cname]','$_POST[username]','$epass','$_POST[access]',0,1)");

    
}
?> 	
 </div>
 </body>
 </html>