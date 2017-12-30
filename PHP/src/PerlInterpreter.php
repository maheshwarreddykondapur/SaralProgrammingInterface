<?php 
function perlInterpreter($inputfile){
	
	$sourceFileName="CodeFile";
	
	$sourceFile="CodeFile.pl";
	
	$inputFile=$inputfile;
	
	$targetFile="OutputFile.txt";
	
	$errorFile="ErrorFile.txt";
	
	
	try{
		
		exec(htmlspecialchars_decode("C:\Strawberry\perl\bin\perl Misc\\$sourceFile 2>Misc\\$errorFile 1>Misc\\$targetFile < $inputFile"));
		
		unlink("Misc\\$sourceFile");
		
	}
	
	catch(Exception $e){
		
		echo ("<script>alert('Oops! some thing is wrong.')</script>");
		
	}
	
}





?>