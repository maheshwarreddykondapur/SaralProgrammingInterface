<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<title>Scores</title>
<style type="text/css">
body{
    background: #f1f1f1;
  }
  #pagecontent{
      background: white;
    position: absolute;
    left:10%;
    width:80%; 
    height: 100%;
}
  th,tr,td{
    border: 1px solid black;
    padding: 3px;

  }
  table{
    position: relative;
    left: 27%;
    top: 20%;
    width: 70%;
  }
  h1{
    position: absolute;
    left: 45%;
  }
  .tt{
    background: green;
    color: white;
    padding: 10px;
    border: 0px;
  }
</style>
</head>
<body>
<div id='pagecontent'>
<h1>Contest List</h1>
<?php
session_start();
if(!$_SESSION['isLogin'])
{
header('location:index.php');
}
if(!$_SESSION['access']){
include('usernavigation.html');
}
else include('verticalNavigation.html');
$servername = "localhost";
    $username = "root";
    $password = "";
    date_default_timezone_get();
    $presenttime = date('y-m-d h:i:s.ms ', time()); 
    $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    } 
      
     $result=mysqli_query($connection,"select * from contestlist");
     if(mysqli_num_rows($result)>0)
    {
     echo "<table>
       <tr>
       <th>Contest Name</th>
       <th>No of Questions</th>
       <th>From</th>
       <th>To</th>
       <th></th>
       <tr/>";
    
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
        $filename=$row['contestname'];
        
       echo '
       <form method="post" class="form" action="scoresbackend.php">
       <tr>
       <td>'.$filename.'</td>
       <td>'.$row['noofquestions'].'</td>
       <td>'.$row['starttime'].'</td>
       <td>'.$row['endtime'].'</td>
       <input type="text" name="contestcode" value='.$row['contestcode'].' style="display:none">
       <td><input type="submit" name="scorecard" class="tt" value="View score" ></td>
       </tr>
       </form>';
         
    }
  }else{
     echo "<script>alert('No contests found ....');
window.open('practise.php','_self');
 </script>";
  }

    
?>
</div>
</body>
</html>

