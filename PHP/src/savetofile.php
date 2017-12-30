   <?php
   session_start();
    header('Content-Type: application/json');

    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['content']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'savetofile':
                switch($_POST['extension']){
                    case 'c':
                    $path="UserFolders/".$_SESSION['rollno']."/C/";
                    break;
                    case 'cpp':
                    $path="UserFolders/".$_SESSION['rollno']."/C++/";
                    break;
                    case 'java':
                    $path="UserFolders/".$_SESSION['rollno']."/Java/";
                    break;
                    case 'pl':
                    $path="UserFolders/".$_SESSION['rollno']."/Pearl/";
                    break;
                    case 'py':
                    $path="UserFolders/".$_SESSION['rollno']."/Python/";
                    break;
                    case 'php':
                    $path="UserFolders/".$_SESSION['rollno']."/Php/";
                    break;
            
                }
                $MyFile = fopen($path.$_POST['filename'].".".$_POST['extension'], "w") or die("Unable to open file!");
		 	   fwrite($MyFile,$_POST['content']);
               fclose($MyFile);
               break;

            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    

?>