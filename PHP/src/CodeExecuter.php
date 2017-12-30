<?php 

function executeCode($language,$inputfile,$code){
    $lang=$language;
    $InputFile=$inputfile;
    switch ($lang) {
    case "c":
        include_once('CCompiler.php');				
		include_once('WriteToFile.php');
	    write("CodeFile","c",$code);
        CCompiler($InputFile);		
        break;
    case "cpp":
        include_once('CPPCompiler.php');				
		include_once('WriteToFile.php');
	    write("CodeFile","cpp",$code);
        CPPCompiler($InputFile);
        break;
    case "java":
       include_once('JavaCompiler.php');				
	   include_once('WriteToFile.php');
	   write("CodeFile","java",$code);
       javaCompiler($InputFile);
        break;
    case "pl":
        include_once('PerlInterpreter.php');
		include_once('WriteToFile.php');
		write("CodeFile","pl",$code);
        perlInterpreter($InputFile);
        break;
    case "php":
        include_once('PHPInterpreter.php');
	    include_once('WriteToFile.php');
		write("CodeFile","php",$code);
        phpInterpreter($InputFile);
        break;
     case "py":
        include_once('PythonInterpreter.php');
		include_once('WriteToFile.php');
		write("CodeFile","py",$code);
        pythonInterpreter($InputFile);
        break;  
    default:
        echo "Your favorite color is neither red, blue, nor green!";
    }
}
?>