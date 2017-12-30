<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method='post' action='#'>
<textarea name='message' style="width:30%;height:300px;"></textarea>
<input type="submit" name="broadcast" value='broadcast'>
</form>
<?php
if(isset($_POST['broadcast'])){
set_time_limit(30000);

	$servername = "localhost";
    $username = "root";
    $password = "";
    $connection = mysqli_connect($servername, $username, $password,"editor");
    
     $result=mysqli_query($connection,"select * from loginform");
     while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
     	if($row['status']==1)
     	{
            $message="Dear ".$row['name'].",\n".$_POST['message'];
     		mail($row['uname'],"GETMNC mail verification",$message,"From:Team GETMNC");
     	}
     	
     }
 }
?>
</body>
</html>