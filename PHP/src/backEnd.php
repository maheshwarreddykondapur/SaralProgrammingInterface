<?php
session_start();

if(isset($_POST['testButton']))
{
	$servername = "localhost";
    $username = "root";
    $password = "";
    
    $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
	mysqli_query($connection,"insert into $_SESSION[contestcode]".'leaderboard'." values('$_SESSION[Name]','$_SESSION[userName]',0)");

	$_SESSION['contestcode']=$_POST['contestcode'];
	header("location:contestpage.php");
}
else
{
	echo '<script>alert("Oops something went wrong!");</script>';
	header("location:practise.php");
}

//==============================================================================================================================//


?>
