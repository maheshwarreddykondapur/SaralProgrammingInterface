<?php 


function write($filename,$extension,$code){
	
	$file = $filename.".".$extension;
	
	try{
		
		$MyFile = fopen("Misc\\".$file, "w") or die("Unable to open file!");
		
		fwrite($MyFile,$code);
		
		
	}
	
	catch(Exception $e) {
		
		echo ("<script>alert('Oops! some thing is wrong.')</script>");
		
	}
	
	finally {
		
		fclose($MyFile);
		
	}
	
	
}




?>