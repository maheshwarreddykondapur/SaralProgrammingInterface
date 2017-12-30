<!DOCTYPE html>
<html lang="en-US">

  <head>
  <meta charset="utf-8">
   <title>Register Backend</title>

  </head>
  <body >
  <?php 
  session_start();
 
  	
	if(isset($_POST['register-Button']))
	{
		$servername = "localhost";
        		$userName = "root";
       		 $password = "";

        		$connection = mysqli_connect($servername, $userName, $password,"editor");
		if (!$connection) 
		{
			die("Connection failed: " . mysqli_connect_error());
		} 
   
		$result=mysqli_query($connection,"select * from loginform where uname='".$_POST['uname']."'");
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
		if(mysqli_num_rows($result)>0)
		{
			$_SESSION['msg']="Member already Exists";

		
			if($row['status']=='0')
			{
			
				$message="Please click the link below to activate your account http://getmnc.com/mailverification.php?em=$row[uname]&vhash=$row[hash]";
				if(mail($row['uname'],"GETMNC Account Validation",$message,"From:Team GETMNC"))
				{
					$_SESSION['msg']="Username is already registered. Verification link has been sent.";
					header("location:practise.php");
				}
				else
				{
					$_SESSION['msg']="Sorry! something went wrong please try after some time.";
					header('location:index.php');
				}
	          
			}
			header('location:index.php'); 
		}	
		else
		{

			$epass=password_hash($_POST['password'], PASSWORD_BCRYPT);
			$hash = md5(rand());

	 

			$message="Please click the link below to activate your account http://getmnc.com/mailverification.php?em=$_POST[username]&vhash=$hash";
			$v=mail($_POST['username'],"GETMNC Account Validation",$message,"From:Team GETMNC");
	  
			if($v)
			{
				$_SESSION['msg']="Validation link has been sent to your mail.";
				mysqli_query($connection,"Insert into loginform values('$_POST[name]','$_POST[rno]','$_POST[college]','$_POST[username]','$epass',0,'$hash',0)");
				header('location:index.php');
			}
			else
			{
				$_SESSION['msg']="Sorry! something went wrong please try after some time.";
				header('location:index.php');
			}

		}

		
	}

?>
</body>
</html>