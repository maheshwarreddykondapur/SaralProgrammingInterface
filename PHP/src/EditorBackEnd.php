<?php
session_start();
include_once("WriteToFile.php");
$dom = simplexml_load_file("Misc\\".$_SESSION['contestcode'].'.xml');
if (/*isset($_POST['Run'])*/true)
{
	foreach ( $dom->problem as $value) 
	{	
		echo "<div id='questionInfo'>";		
		if($value->attributes()->problemCode == $_SESSION['questioncode'])
		{		
			$link="Misc\\".$_SESSION['contestcode'].$_SESSION['questioncode'];
			$lang=$_POST['language'];
	
			if(!empty($_POST['Args'])){
					
					write("InputFile","txt",$_POST['Args']);	
					$InputFile="Misc\\InputFile.txt";
			}else{			
			$InputFile=$link."sampleinput.txt";
			}

			include_once ("CodeExecuter.php");
			executeCode($lang,$InputFile,$_POST['Code']);		
			if(file_exists("Misc\\ErrorFile.txt")){				
				$handle = fopen("Misc\\ErrorFile.txt", "r");
				if ($handle) {
					while (($line = fgets($handle)) !== false) {		
						echo strip_tags($line);
						echo "<br/>";	
					}
             		fclose($handle);
							
				}
				unlink("Misc\\ErrorFile.txt");
				
			}
			if(file_exists("Misc\\OutputFile.txt")){
				
				$handle = fopen("Misc\\OutputFile.txt", "r");
			
				if ($handle) {
					
					while (($line = fgets($handle)) !== false) {
						
						echo "<br/>";
						echo strip_tags($line);		
					}
					
					fclose($handle);
				
				}
				
				unlink("Misc\\OutputFile.txt");
				
				if(file_exists("Misc\\InputFile.txt")){
						
				    unlink("Misc\\InputFile.txt");
					
				}
							
			}
		}
			
	}	
}
if(isset($_POST['Submit']))
{
	$score=0;
	$link="Misc\\".$_SESSION['contestcode'].$_SESSION['questioncode'];
	$lang=$_POST['language'];	
	$InputFile=$link."sampleinput.txt";	
	foreach ( $dom->problem as $value) {
		
		if($value->attributes()->problemCode == $_SESSION['questioncode']){
			
			foreach ($value->TestCase as $key) {
				
				$filename=(string)$key->InputFile;
							
				include_once ("CodeExecuter.php");
			    executeCode($lang,$filename,$_POST['Code']);
				
				if(filesize('Misc\\OutputFile.txt')){
					
					include_once('FileComparer.php');
					
					if($res=filecompare(strval($key->OutputFile),'Misc\\OutputFile.txt')){
							
						$score=$score+((int)($key->TestCasePoints));
												
					}
					
					unlink('Misc\\OutputFile.txt');	
				}
				
				
			}
			
			
		}
		
		
	}
	if(filesize("Misc\\ErrorFile.txt")){
	
		$handle = fopen("Misc\\ErrorFile.txt", "r");
		
		if ($handle) {
			
			while (($line = fgets($handle)) !== false) {
				
				echo strip_tags($line);
				
				echo "<br/>";
				
				
			}
			
			
			
			fclose($handle);
			
			
			
			
		}
		
		
		
		
		
		unlink("Misc\\ErrorFile.txt");
		
		
		
		
	}
	include_once('ScoreCardUpdater.php');
	scoreUpdater($_SESSION['userName'],$_SESSION['contestcode'],$_SESSION['questioncode'],$score);
	echo "<br/><b>Your score for this problem is </b>".$score;
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
