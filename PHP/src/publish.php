<!DOCTYPE html>
<html>
<head>
  <title>Publish</title>
  <style type="text/css">
  body{
    background: #f1f1f1;
  }
  #pagecontent{
      background: white;
    position: absolute;
    left: 5%;
    width:90%; 
    height: 100%; 
     }
     .form1{
      position: absolute;
      left:23%;
      
      
     }
     #pagecontent button{
      position: absolute;
      background: red;
      color:white;
      padding: 10px;
      border-radius: 5px;
     }
     #contestsettingframe{
      position: absolute;
      left:33%;
      top:5%;
      width: 65%;
      height: 90%;
     }
     #button
     {
      position: relative;
      top: 25%;
      padding: 3px;
     }
     #form2 input{
      position: absolute;
      top:15%;
      left: 23%;
      background-color: green;
      color:white;
      padding: 10px;
      border-radius: 5px;
     }
     b{
      position: absolute;
      left: 26%;
      top: 0.5%;
     }
  </style>
</head>
<body>
<div id="pagecontent">
<?php

session_start();
if(!$_SESSION['isLogin'])
{
  header('location:index.php');
}
if($_SESSION['access']&&(!empty($_SESSION['newcontest'])))
{
 include('verticalNavigation.html');


  
if(file_exists("Misc\\".$_SESSION['contestCode'].'.xml'))
{
  $no=$_SESSION['no'];
  echo "<div id='button'>";
  for($i=1;$i<=$no;$i++)
  {
   echo '<button class="form1"  onclick="tracking(this)"> problem'. $i.'</button>';
   echo "<br/><br/>";
  }
  echo '</div>';
  echo '<form method="post" action="#" id="form2"><input type="submit" name="publish" value="Publish" ></form>';
  echo "<b style='color:red'>NOTE:Please donot refresh this page and make sure you have proper internet connection</b>";
  echo '<iframe id="contestsettingframe" name="OutputFrame" style=""></iframe>';
 // <input name="newThread" type="button" value="New Discussion" onclick="window.open('Political/Thread/thread_insert.php')"/>

}
if(isset($_POST['publish']))
{
   $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"editor");
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
    
$result=mysqli_query($conn,"Insert into contestlist values('$_SESSION[contestName]','$_SESSION[contestCode]','$_SESSION[no]','$_SESSION[contestduration]','$_SESSION[starttime]','$_SESSION[endtime]')"); 

 if($result)
     {   
        
        mysqli_query($conn,  "CREATE TABLE ".$_SESSION['contestCode']."(contestantname  VARCHAR(50) NOT NULL,username VARCHAR(50) NOT NULL,programcode VARCHAR(50) NOT NULL,score INT(5),lastatMiscted TIMESTAMP)");
         mysqli_query($conn,  "CREATE TABLE ".$_SESSION['contestCode']."leaderboard"."(contestantname  VARCHAR(50) NOT NULL,username VARCHAR(50) NOT NULL,score INT(5))");
        
        echo "<script>window.alert('Your Contest has been published');</script>";
        $_SESSION['newcontest']="";
        $_SESSION['publish']='ok';
        header('location:practise.php');
        
     }
   else
  {
    echo "<script>window.alert('Your Contest has not been published');</script>";
  }  
mysqli_close($conn);

  
}

}

else{
  header("location:practise.php");
}
?>
<script type="text/javascript">

  function tracking($x)
  {
    $x.disabled=true;
    $x.style="display:none";
    window.open('publishbackEnd.php', 'OutputFrame');

  }
</script>
<script src='jquery-1.12.1.js'></script>
<script type="text/javascript">
    
$(document).on("keydown", function (e) {
    if (e.which === 8 && !$(e.target).is("input:not([readonly]):not([type=radio]):not([type=checkbox]):not([type=button]):not([type=submit]), textarea, [contentEditable], [contentEditable=true]")) {
        e.preventDefault();
    }
});
</script>


</div>
</body>
</html>