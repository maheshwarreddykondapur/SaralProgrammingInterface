<!DOCTYPE html>
<html>
<head>

    <script src='jquery-1.12.1.js'></script>
	<style type="text/css">
		.pd{
			width:60%;
			height:120%;
		}
		.test1 {
			width:20%;
			height:25%;
		}
		.box{
			width:20%;
			height:30%;
		}
		input[type=text]{
			width: 25%;
		}
		
	</style>
	<script type="text/javascript">
		function chText()
{
    var str=document.getElementById("aliasEntry");
    var regex=/[^a-z]/gi;
    str.value=str.value.replace(regex ,"");
}
	</script>
</head>
<body>
<?php
session_start();
if(!$_SESSION['isLogin'])
header('location:index.php');
if(!$_SESSION['access'])
header('practise.php');
?>
<form method="post" action="pbackEnd.php">
    Problem Code<input type="text" name="problemcode" placeholder="Required" onkeydown="chText()" onkeyup="chText()" id="problemcode" required>Problem Name<input type="text" name="problemname"  placeholder="Required" required><br><br>
<br><b>Problem Description</b><br>
<textarea class='pd' name="problemdescription" rows="6"></textarea><br>
<b>Input Format</b><br>
<textarea class='pd' name="inputformat" rows="6"></textarea><br>
<b>Output Format</b><br>
<textarea class='pd' name="outputformat" rows="6"></textarea><br>
<b>Constraints</b><br>
<textarea class='pd' name="constraints" rows="6"></textarea><br>
<i>Sample Input</i><textarea class='test1' name="sampleinput" rows="7"></textarea><i>Sample Output</i><textarea class='test1' name="sampleoutput" rows="7" ></textarea><br><br>
<br><br>
<b>Test Cases</b>
<br><br>
<span id="response"  rows="7"></span><br>
<input type="hidden" id="hidden" name="hidden"/>
<input type="button" id="uvw" onclick="addInput()" value="Add Test Case" />
<input type="submit" id='s' name='save' value=" Save ">
<input type="reset" id='r' value=" Reset ">

</form>
</body>
</html>
<script type="text/javascript">
	var countBox =1;
var boxName = 0;
function addInput()
{
     var boxName="Testcase"+countBox; 
     $('#response').append('Input : <textarea class="box" name="testcaseinput'+countBox+'"></textarea> Output : <textarea class="box" output" name="testcaseoutput'+countBox+'" rows"100"></textarea> Points : <input type="number" min=1 name="testcasepoints'+countBox+'" style="width:20%" /><br/><br/>');
document.getElementById('hidden').value=countBox;
     countBox += 1;
     
   
    
}



</script>
