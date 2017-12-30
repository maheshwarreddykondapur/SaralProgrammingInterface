<?php 

function CCompiler($inputfile){
	
	$sourceFileName="CodeFile";
	
	$sourceFile="Misc\\CodeFile.c";
	
	$inputFile=$inputfile;
	
	$targetFile="Misc\\OutputFile.txt";
	
	$errorFile="Misc\\ErrorFile.txt";
	
	
	try{
		
		if (system("gcc -o Misc\\$sourceFileName $sourceFile 2>$errorFile")!==false)
		{
			
			exec(htmlspecialchars_decode("Misc\\$sourceFileName.exe 1>$targetFile<$inputFile"));
			
			
			unlink("Misc\\$sourceFileName.exe");
			
			
			
		}
		
		unlink($sourceFile);
		
	}
	
	catch(Exception $e){
		
		echo ("<script>alert('Oops! some thing is wrong.')</script>");
		
	}
	
}


//CCompiler("Misc/InputFile.txt");

?>