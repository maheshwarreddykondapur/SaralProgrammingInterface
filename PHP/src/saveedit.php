<?php
session_start();
include('confun.php');
$servername = "localhost";
    $username = "root";
    $password = "";
    date_default_timezone_set('Asia/Kolkata');
    $presenttime = (date('Y-m-d H:i:s.ms ', time())); 
    
    $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    }
if(isset($_POST['save'])&&$_SESSION['access'])
{
	mysqli_query($connection,"UPDATE `contestlist` SET `contestname`='".$_POST['cname']."' WHERE contestcode= '".$_SESSION['contestcode']."'");
	$dom = simplexml_load_file("Misc\\".$_SESSION['contestcode'].'.xml');
	$dom->contestName=cfsc($_POST['cname']);
	$dom->contestDescription=cfsc($_POST['cdes']);
	$dom->contestRules=cfsc($_POST['crules']);
	$dom->saveXML("Misc\\".$_SESSION['contestcode'].'.xml');
	header('location:contestpage.php');
}
if(isset($_POST['psave'])&&$_SESSION['access'])
{
	$dom = simplexml_load_file("Misc\\".$_SESSION['contestcode'].'.xml');
	foreach ( $dom->problem as $value) 
	{	
		if($value->attributes()->problemCode == $_SESSION['questioncode'])
		{
			$value->problemName=cfsc($_POST['pname']);
			$value->problemDescription=cfsc($_POST['pdes']);
			$value->inputFormat=cfsc($_POST['pin']);
			$value->outputFormat=cfsc($_POST['pout']);
			$value->constraints=cfsc($_POST['pcons']);
			$value->sampleInput=cfsc($_POST['sin']);
			$value->sampleOutput=cfsc($_POST['sout']);
			 $MyFile = fopen($link."sampleinput.txt", "w") or die("Unable to open file!");
			fwrite($MyFile,$_POST['sin']);
			fclose($MyFile);
			$MyFile = fopen($link."sampleoutput.txt", "w") or die("Unable to open file!");
			fwrite($MyFile,$_POST['sout']);
			fclose($MyFile);
			$dom->saveXML("Misc\\".$_SESSION['contestcode'].'.xml');
			header('location:Question.php');
		}
	}
}
?>