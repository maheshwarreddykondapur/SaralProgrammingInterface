<!DOCTYPE html>
<html>
<head>
	<title>Contest</title>
	<style type="text/css">
	body
	{background-color: #f1f1f1;}

		#pagecontent{
	    background: white;
		position: absolute;
		left: 10%;
		width:80%; 
		height:100%; 
		 }
		 #contestInfo {
		 position: relative;
		 left: 27%;
		 top:3%;
		 background-color: #f1f1f1;
		 width:70%;
		
		 padding: 10px;
         word-wrap: break-word;
		 }
		 #info textarea{
		 	width: 80%;
		 	height: 30%;
		 }
		 #info{
		 	position: relative;
		 left: 23%;
		 background-color: #f1f1f1;
		 width:70%;
		 height: 100%;
		 overflow: scroll;
		 padding: 10px;
         word-wrap: break-word;
		 }
		 p{
		 	border: 1px solid black;
		 	padding: 25px;
		 }
		  td,tr{
		 	border: 1px solid black;
		 	width: 20%;
		 	padding: 5px;
		 }
		 table{
		 	border: 1px solid black;
		 	padding: 5px;
		 }
		 .rules{
		 	border: 1px solid black;
		 	padding: 25px;
		 }
		  p{
		 	border: 1px solid black;
		 	padding: 5px;
		 }
		 fieldset{
		 
		 	padding: 15px;
		 	align-items: center;
		 }
		 fieldset input{
		 
		 	padding: 6px;
		 }
		 #save,#edit{
		 	position: absolute;
		 	left: 85%;
		 	background: green;
		 	color: white;
		    padding: 5px;
		    width: 10%;
		 }
		 #modal{
	display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    align-items: center;
		 }

	

	</style>
	<script type="text/javascript">
	
	function edit(){
		document.getElementById('modal').style.display='block';
	}
	</script>
</head>
<body>
<div id='pagecontent'>
<?php
include('confun.php');
session_start();
if(isset($_SESSION['isLogin']))
{
if((isset($_SESSION['contestcode']))&&(!empty($_SESSION['contestcode'])))
{

	if(!$_SESSION['access']){
include('usernavigation.html');
}
else include('verticalNavigation.html');

echo "<div id='contestInfo'>";

$dom = simplexml_load_file("Misc\\".$_SESSION['contestcode'].'.xml');
if($_SESSION['access'])
echo "<button onclick='edit()' id= 'edit' class='edit'>Edit</button>";
echo "<b>Contest Name : </b> <h1>".(ctsc($dom->contestName))."</h1>";
echo "<b>Contest Details :</b>";
echo "<p>".(ctsc($dom->contestDescription))."</p><br>";
echo "<table><tr><td colspan=2><b>ContestName</b></td><td colspan=2><pre>".(ctsc($dom->contestName))."</pre></td></tr>";
$starttime = strtotime($dom->startTime);
$stime = date("m/d/Y H:i:s",$starttime);
$endtime = strtotime($dom->endTime);
$etime = date("m/d/Y H:i:s",$endtime);
echo "<tr><td><b>Start Time</b></td><td>".$stime."</td><td><b>End Time</b></td><td>".$etime."</td><tr>";
echo "<tr><td><b>Questions</b></td><td>".$dom->noOfPrograms."</td><td><b>Duration</b></td><td>".$dom->contestDuration."</td><tr>";
echo "</table><br>";
echo "<b>Contest Rules</b><div class='rules'>".(ctsc($dom->contestRules))."</div><br><br>";

echo '<fieldset>';
foreach ($dom->problem as $value) {
	 $x=$value->attributes()->problemCode;
    echo "<form method='post' action='contestbackEnd.php'>
    <input type='text' name='questioncode' value='".$x."' style='display:none'>
    <input type='submit' name='questionname' value='".(ctsc($value->problemName))."' ></form></li>";
     /*if(!$_SESSION['access']&&isset($_POST['contestCode']))
 @mysqli_query($conn,"insert into ".$_POST['contestCode']." values('$_SESSION[Name]','$_SESSION[userName]','$_POST[contestCode]','$_POST[contestName]','$row[programcode]',0,0)");*/
    
}
echo "</fieldset>";


echo "</div>";
}
else{
	header('location:practise.php');
}

######################################################################################################################
echo "<div id='modal'>";
echo "<div id='info'>";
echo "<form method='post' action='saveedit.php'>";
$dom = simplexml_load_file("Misc\\".$_SESSION['contestcode'].'.xml');
echo "<b>Contest Name : </b><h1><input type ='text' name='cname' value='".(ctsce($dom->contestName))."'></h1>";
echo "<b>Contest Details :</b>";
echo "<p><textarea name='cdes' row=100 style='height:150px;'>".(ctsce($dom->contestDescription))."</textarea></p><br>";

echo "<b>Contest Rules</b><div id='rules'><textarea name='crules' rows=50 style='height:150px;'>".(ctsce($dom->contestRules))."</textarea></div><br><br>";
echo "<input type='submit' value='Save' id='save' name='save'>";
echo "</form>";
 

echo "</div>";
echo "</div>";

}

else{
	header("location:index.php");
}
?>
</div>
<script src='jquery-1.12.1.js'></script>
<script type="text/javascript">
    
$(document).on("keydown", function (e) {
    if (e.which === 8 && !$(e.target).is("input:not([readonly]):not([type=radio]):not([type=checkbox]):not([type=button]):not([type=submit]), textarea, [contentEditable], [contentEditable=true]")) {
        e.preventDefault();
    }
});

var modl = document.getElementById('modal');
    window.onclick = function(event) {
    if (event.target == modl) {
        modl.style.display = "none";
    }
   
}
</script>



</body>
</html>