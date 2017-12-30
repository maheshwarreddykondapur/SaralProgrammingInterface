<?php 


function CPPCompiler($inputfile){
	
	$sourceFileName="CodeFile";
	
	$sourceFile="Misc\\CodeFile.cpp";
	
	$inputFile=$inputfile;
	
	$targetFile="Misc\\OutputFile.txt";
	
	$errorFile="Misc\\ErrorFile.txt";
	
	
	try{
		
		if (system("g++ -o Misc\\$sourceFileName $sourceFile 2>$errorFile")!==false)
		{
			
			exec(htmlspecialchars_decode("Misc\\$sourceFileName.exe 1>$targetFile<$inputFile"));
			
			unlink("Misc\\$sourceFileName.exe");
			
			
			
		}
		
		unlink("$sourceFile");
		
	}
	
	catch(Exception $e){
		
		echo ("<script>alert('Oops! some thing is wrong.')</script>");
		
	}
	
}





?>