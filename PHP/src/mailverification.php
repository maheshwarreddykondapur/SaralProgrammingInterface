<?php
session_start();
 $uname=$_GET['em'];
 $hashcode=$_GET['vhash'];
 $servername = "localhost";
        $username = "root";
        $password = "";
        $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    } 
   
     $result=mysqli_query($connection,"select * from loginform where uname='".$uname."'");
     
     

      while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
       { 
        $dbcode=$row['hash'];
       
      if( $hashcode == $dbcode )
      {
        
      	mysqli_query($connection,"update loginform set status=1 where uname='$uname'");
      	mysqli_query($connection,"update loginform set hash=0 where uname='$uname'");
      	$_SESSION['msg']="Thank You ".$row['name'].". Your mail-id has been verified.";
      	header('location:index.php');


      }
      else
      {

      	$_SESSION['msg']="Your account is already activated.";
      	header('localhost:index.php');
      }
    }
?>