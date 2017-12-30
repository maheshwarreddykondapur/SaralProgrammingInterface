<?php 
function pythonInterpreter($inputfile){
	
	$sourceFileName="CodeFile";
	
	$sourceFile="CodeFile.py";
	
	$inputFile=$inputfile;
	
	$targetFile="OutputFile.txt";
	
	$errorFile="ErrorFile.txt";
	
	
	
	try{
		
		exec(htmlspecialchars_decode("python Misc\\$sourceFile 2>Misc\\$errorFile 1>Misc\\$targetFile < $inputFile"));
		
		unlink("Misc\\$sourceFile");
		
	}
	
	catch(Exception $e){
		
		echo ("<script>alert('Oops! some thing is wrong.')</script>");
		
	}
	
}





?>