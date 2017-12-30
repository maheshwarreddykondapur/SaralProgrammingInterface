<?php
session_start();
if(!$_SESSION['isLogin'])
header('location:index.php');
if(isset($_POST['questioncode'])&&(!empty($_POST['questioncode'])))
{
	$servername = "localhost";
    $username = "root";
    $password = "";
    
    $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    }
    $result=mysqli_query($connection,"select * from $_SESSION[contestcode] where username='$_SESSION[userName]' and programcode='$_POST[questioncode]'");
  
   
    if(mysqli_num_rows($result)==0){
        
	mysqli_query($connection,"insert into $_SESSION[contestcode] values('$_SESSION[Name]','$_SESSION[userName]','$_POST[questioncode]',0,0)");
    
	 }
	$_SESSION['questioncode']=$_POST['questioncode'];
    $_SESSION['question']='ok';
	header('location:Question.php');
}
else
{
	echo '<script>alert("Oops something went wrong!");</script>';
	header("location:contestpage.php");
}
?>