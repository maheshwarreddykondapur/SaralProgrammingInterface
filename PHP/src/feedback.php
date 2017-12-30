<!DOCTYPE html>
<html>
<head>
	<title>Feedback Form</title>
</head>
<style type="text/css">
	img{
	
		
		 height: 100%;
		 width: 100%;
		 
		 
	}
	#container{
		position: absolute;
		left: 35%;
		top:10%;
				
	}
	textarea{
		background-color:transparent;
		border-style: 3px solid;
		border-color: black;
	}


</style>
<body>
<img src="D57CB8024.gif"/>
<div id='container'>
<b style="font-family:tahoma;font-size:200%;padding:5%" >TEAM GETMNC</b><br><br><br>
<form method="post" action="#">
<label><b>Name</b></label><br>
<input type="text" name="name" required /><br><br>
<label><b>Roll Number</b></label><br>
<input type="text" name="rno" required /><br><br>
<label><b>Mail-Id</b></label><br>
<input type="email" name="mail" required><br><br>
<label style="color:darkblue"><b>Feedback</b></label><br>
<textarea name='comments' style="" rows="15" cols="50" required></textarea><br><br>
<input type="submit" name="submit" value="SUBMIT" style="font-weight:bold;font-family:tahoma">
<button onclick="index.php" style="color:black; font-family:tahoma"><b>SKIP</b> </button>
</form>
</div>
<?php
session_start();
if(isset($_POST['submit']))
{
	$message="From :".$_POST['mail']."\n\nName :".$_POST['name']."\nRoll.no : ".$_POST['rno']."\nFeedback :\n".$_POST['comments'];
	$v = mail("bheamu2k@outlook.com","GETMNC Feedback",$message,"From:".$_POST['mail']);
	if($v)
	{
		$_SESSION['msg']="Thank you $_POST[name] for your feedback.";
		header('location:index.php');
	}
	else
	{
		$_SESSION['msg']="Oops sorry we didn't recieve your feedback.";
		header('location:index.php');
	}
}
?>
	


</body>
</html>