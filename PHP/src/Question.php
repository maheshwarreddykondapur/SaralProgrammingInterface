<!DOCTYPE html>
<html>
<head>
	<title>Question</title>
	<style type="text/css">
		body
	{background-color: white;}
j{
	white-space: pre-wrap;

}
#info{
		 	position: relative;
		 left: 23%;
		 background-color: #f1f1f1;
		 width:70%;
		 height: 100%;
		 overflow: scroll;
		 padding:10px;
         word-wrap: break-word;
		 }
		#pagecontent{
	    background: white;
		position: absolute;
		left: 7%;
		width:85%; 
		min-height:230%;
		max-height: 300%;
		height: 250%;
		
		 }
		 #questionInfo {
		 position: absolute;
		 left: 25%;
		 top:3%;
		 background-color: #f1f1f1;
		 width:70%;
		 padding: 10px;
		 border: 1px solid black;
         word-wrap: break-word;
		 }
		 iframe{
    	position: absolute; 
        
        top:110%;
    	width: 100%;
    	height: 120%; 
        border: 0px;
    }
    #questionInfo b,h3,p{
    	padding: 5px;

    }
    #info textarea{
    	width: 70%;
    	height: 150px;
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
		 .container{
		 	word-break: break-all;
		 }


	</style>
</head>
<body>

<?php
session_start();
include('confun.php');
if(isset($_SESSION['isLogin']))
{if(isset($_SESSION['questioncode'])&&isset($_SESSION['contestcode'])&&(!empty($_SESSION['questioncode'])))

{	echo "<div id='pagecontent'>";
if(!$_SESSION['access']){
include('usernavigation.html');
}
else include('verticalNavigation.html');
if($_SESSION['access'])
echo "<button onclick='edit()' id= 'edit' class='edit'>Edit</button>";

$dom = simplexml_load_file("Misc\\".$_SESSION['contestcode'].'.xml');
foreach ( $dom->problem as $value) {
	
if($value->attributes()->problemCode == $_SESSION['questioncode'])
{    echo "<div id='questionInfo' class='container'>";
	echo "<h3>".ctsc($value->problemName)."</h3>";
	echo "<j>".(ctsc($value->problemDescription))."</j><br/>";
	echo  "<b>Input Format :</b><br><p>";
	echo (ctsc($value->inputFormat))."</p>";
	echo  "<div id='inputformat'><b>Output Format :</b><br><p>";
	echo (ctsc($value->outputFormat))."</p></div>";
	echo  "<b>Constraints :</b><br><p>";
	echo (ctsc($value->constraints))."</p>";
	echo  "<b>Sample Input :</b><br><p>";
	echo (ctsc($value->sampleInput))."</p>";
	echo  "<b>Sample Output :</b><br><p>";
	echo (ctsc($value->sampleOutput))."</p>";
}
}
echo '<iframe id="editorFrame" src="EditorFrontEnd.php" ></iframe>
</div>';

}
else{
	header('location:practise.php');
}
}

else{
	header("location:index.php");
}
echo "</div>";
echo "<div id='modal'>";
echo "<div id='info'>";
$dom = simplexml_load_file("Misc\\".$_SESSION['contestcode'].'.xml');
foreach ( $dom->problem as $value) {
	
if($value->attributes()->problemCode == $_SESSION['questioncode'])
{    echo "<form method='post' action='saveedit.php' >
<b>Problem Name</b>";
	echo "<h3><input type='text' name='pname' value='".ctsc($value->problemName)."' ></h3><b>Problem Description</b>";
	echo "<textarea name='pdes' >".(ctsc($value->problemDescription))."</textarea><br><br>";
	echo  "<b>Input Format :</b><br/>";
	echo "<textarea name='pin'>".(ctsc($value->inputFormat))."</textarea><br><br>";
	echo  "<b>Output Format :</b><br/>";
	echo "<textarea name='pout'>".(ctsc($value->outputFormat))."</textarea><br>";
	echo  "<b>Constraints :</b><br>";
	echo "<textarea name='pcons'>".(ctsc($value->constraints))."</textarea><br><br>";
	echo  "<b>Sample Input :</b>";
	echo "<textarea name='sin' style='width:20%;height:85px;'>".(ctsc($value->sampleInput))."</textarea>";
	echo  "<b>Sample Output :</b>";
	echo "<textarea name='sout' style='width:20%;height:85px;'>".(ctsc($value->sampleOutput))."</textarea></p>";
	echo "<input type='submit' value='Save' id='save' name='psave'>";
}
}
echo "</div></div>";
?>
<script src='jquery-1.12.1.js'></script>
<script type="text/javascript">
    
$(document).on("keydown", function (e) {
    if (e.which === 8 && !$(e.target).is("input:not([readonly]):not([type=radio]):not([type=checkbox]):not([type=button]):not([type=submit])")) {
    	alert(e.target);
        e.preventDefault();
    }
});
function edit(){
		document.getElementById('modal').style.display='block';
	}
	var modl = document.getElementById('modal');
    window.onclick = function(event) {
    if (event.target == modl) {
        modl.style.display = "none";
    }
   
}
</script>


</body>
</html>