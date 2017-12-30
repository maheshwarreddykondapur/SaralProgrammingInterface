<!DOCTYPE html>
<html>
<head>
	<title>Live Contests</title>
</head>
<style type="text/css">
	.testButtonsForm
	{ 
		position: relative;
		 left: 28%;
		 top:10%;
		 background-color: #f1f1f1;
		 width:65%;
		 border:1px solid black;
		 padding: 10px;
		 border-radius: 20px;
		 overflow: auto;

	}
	.testButtonClass{
		display: none;
		padding: 5px;

	}
	.contestDescriptionDispaly{
		display: none;
		word-wrap: break-word;
	}
	.testButtonsForm:hover input{
		display: block;
		position: relative;
		left:85%;
		cursor: pointer;
	}
	.testButtonsForm:hover div{
		display: block;
		cursor: text;
	}
	.testButtonClass:hover{
		background-color:green;
		color: white;
		padding: 7px;
	}
	#pagecontent {
		background: white;
		position: absolute;
		left: 10%;
		width:80%; 
		height: 100%;
		z-index: 2;
		
	}
	body
	{
		background-color: #f1f1f1;
		z-index: 3;
	}
	h1
	{
		position: absolute;
		top: 30%;
		left: 38%;
	}
</style>
<body>

<div id='pagecontent'>
<?php
include('confun.php');
session_start();
if(isset($_SESSION['isLogin']))
{
if(!$_SESSION['access']){
include('usernavigation.html');
}
else include('verticalNavigation.html');
    $servername = "localhost";
    $username = "root";
    $password = "";
    date_default_timezone_set('Asia/Kolkata');
    $presenttime = (date('Y-m-d H:i:s.ms ', time())); 
    
    $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    } 

    $result=mysqli_query($connection,"select * from contestlist where starttime<'".$presenttime."' and
endtime>'".$presenttime."'");
 
    
   
      if($x=mysqli_num_rows($result)){
      	echo $x;
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))		
	{ 
		if((strtotime($presenttime)>strtotime($row['starttime']))&&(strtotime($presenttime)<strtotime($row['endtime'])))
    	{

		$dom = simplexml_load_file("Misc\\".$row['contestcode'].'.xml');
		  //if($_SESSION['access'])    
        echo '       
        <form action="backEnd.php" method="post" class="testButtonsForm">
        <b>'.$row['contestname'].'</b><div class="contestDescriptionDispaly">'.(ctsc($dom->contestDescription)).'</div><br>
         <input type="text" name="contestcode" value='.$row['contestcode'].' style="display:none">
         <input type="submit" class="testButtonClass" name="testButton" value="Take Test">
       </form><br><br>';
      // else
       	//echo "<h1 style='color:red'>Sorry! There are no live contests</h1>";
	
	}
}
}
else{
	echo "<h1 style='color:red'>Sorry! There are no live contests</h1>";
}


 
    
}

else{
	header("location:index.php");
}
?>
<script src='jquery-1.12.1.js'></script>
<script type="text/javascript">
    
$(document).on("keydown", function (e) {
    if (e.which === 8 && !$(e.target).is("input:not([readonly]):not([type=radio]):not([type=checkbox]):not([type=button]):not([type=submit]), textarea, [contentEditable], [contentEditable=true]")) {
        e.preventDefault();
    }
});
</script>
</script>
</div>
</body>
</html>