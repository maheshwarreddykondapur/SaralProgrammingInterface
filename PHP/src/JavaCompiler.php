<?php 

function javaCompiler($inputfile){
	
	$sourceFileName="CodeFile";
	
	$sourceFile ='CodeFile.java';
	
	$inputFile=$inputfile;
	
	$targetFile="OutputFile.txt";
	
	$errorFile="ErrorFile.txt";
	
	
	try{
		
		
		
		if (system("cd Misc && javac $sourceFile 2>$errorFile")!==false)
		{
			
			exec(htmlspecialchars_decode("cd Misc && java $sourceFileName 1>$targetFile < $inputFile"));
			
			unlink("Misc\\$sourceFileName.class");
			
			
			
		}
		
		unlink("Misc\\$sourceFile");
		
		
	}
	
	catch(Exception $e){
		
		echo ("<script>alert('Oops! some thing is wrong.')</script>");
		
	}
	
}



?>