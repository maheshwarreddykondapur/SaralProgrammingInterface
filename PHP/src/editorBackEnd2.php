<?php
session_start();
 if (isset($_POST['Run']))
    {  $lang=$_POST['language'];
        if($lang=='C')
        {
        $MyFile = fopen("CodeFile.c", "w") or die("Unable to open file!");
        fwrite($MyFile,$_POST['Code']);
        fclose($MyFile);
               
       
         $MyFile = fopen("InputFile.txt", "w") or die("Unable to open file!");
        fwrite($MyFile, $_POST['Args']);
        fclose($MyFile);
         if (system('gcc -o CodeFile CodeFile.c 2>ErrorFile.txt')!==false)
        {

           if( exec('CodeFile.exe 1>OutputFile.txt<InputFile.txt & timeout /t 1 & taskkill /im CodeFile.exe /f'))
           	unlink("CodeFile.exe");
        
        }
       unlink("InputFile.txt");
    
     
       
   //exec("timeout /t 30 & taskkill /im CodeFile.exe /f");
    unlink("CodeFile.c");
    
            
        
    }elseif ($lang=="C++") {
        $MyFile = fopen("CodeFile.cpp", "w") or die("Unable to open file!");
        fwrite($MyFile,$_POST['Code']);
        fclose($MyFile);
        
    
       
            $MyFile = fopen("InputFile.txt", "w") or die("Unable to open file!");
        fwrite($MyFile, $_POST['Args']);
        fclose($MyFile);
       
         if (system('g++ -o CodeFile CodeFile.cpp 2>ErrorFile.txt')!==false)
        {
            if(system('CodeFile.exe 1>OutputFile.txt<InputFile.txt & timeout /t 3 & taskkill /im CodeFile.exe /f'))
            	unlink("CodeFile.exe");
        
        }
        unlink("InputFile.txt");
    
       
     unlink("CodeFile.cpp");
    
}
elseif ($lang=="java") {
       $MyFile = fopen("main.java", "w") or die("Unable to open file!");
        fwrite($MyFile,$_POST['Code']);
        fclose($MyFile);    
             $MyFile = fopen("InputFile.txt", "w") or die("Unable to open file!");
        fwrite($MyFile, $_POST['Args']);
        fclose($MyFile);       
         if (system('javac main.java 2>Misc\\ErrorFile.txt')!==false)
        {
            exec('java main 1>OutputFile.txt<InputFile.txt & timeout /t 3 & taskkill /im CodeFile.exe /f');
        
        }
        unlink("InputFile.txt"); 
		unlink("main.java");
		unlink("main.class");
    }
	elseif ($lang=="python") 
	{
       $MyFile = fopen("main.py", "w") or die("Unable to open file!");
        fwrite($MyFile,$_POST['Code']);
        fclose($MyFile);
         $MyFile = fopen("Misc\\InputFile.txt", "w") or die("Unable to open file!");
        fwrite($MyFile, $_POST['Args']);
        fclose($MyFile);
    
        $s=filesize('Misc\\InputFile.txt');
        
     
       /* if($s){
       
         if (system('javac main.java 2>Misc\\ErrorFile.txt')!==false)//check this code
        {
            //exec('java main 1>Misc\OutputFile.txt<Misc\\InputFile.txt');
        
        }
        //chmod("Misc\\InputFile.txt",0777);
       unlink("Misc\\InputFile.txt");
        }
        else {
        if (system('javac main.java 2>Misc\\ErrorFile.txt')!==false)//check this code
        {
        	
           // exec('java main 1>Misc\OutputFile.txt<'.$link.'sampleinput.txt');
        
        }
		}
			 //chmod("main.java",0777);
		   //chmod("main.class",0777);
			unlink("main.java");
		   unlink("main.class");
    }*/
	}
    if(file_exists("ErrorFile.txt")){
    $handle = fopen("ErrorFile.txt", "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    echo strip_tags($line);
                    echo "<br/>";
                }
                fclose($handle);             
                
            }
           unlink("ErrorFile.txt");
        }
            if(file_exists("OutputFile.txt")){
            $handle = fopen("OutputFile.txt", "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    echo "<br/>";
                    echo strip_tags($line);
                    
                }
                fclose($handle);
                
            }
            unlink("OutputFile.txt");
            
        }
        }