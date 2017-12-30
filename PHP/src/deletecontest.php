<!DOCTYPE html>
<html>
<head>
  <title>Delete Contest</title>
  <style type="text/css">
    body{
    background: #f1f1f1;
  }
  #pagecontent{
      background: white;
    position: absolute;
    left:15%;
    width:70%; 
    height: 100%;
}
form{
  position: absolute;
  align:top;
    left: 45%;
}
th,tr,td{
    border: 1px solid black;

  }
  table{
    position: relative;
    left: 32%;
    top: 25%;
    width: 60%;
  }
  </style>
</head>
<body>
<div id='pagecontent'>
<form action="#" method="post" >
 <h1>Delete Contest</h1>
<input type="text" name="contestid" placeholder="Contest code">
<input type="submit" name="deletecontest" value="Delete">
</form>
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
    $conn = mysqli_connect($servername, $username, $password,"editor");
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['deletecontest']))
{
  if(file_exists("Misc\\".$_POST['contestid'].'.xml')){
  $dom = simplexml_load_file("Misc\\".$_POST['contestid'].'.xml');
    
    foreach ( $dom->problem as $value) {
     $pcode=$value[0]['problemCode'];
     unlink("Misc\\".$_POST['contestid'].$pcode.'SampleInput.txt');
     unlink("Misc\\".$_POST['contestid'].$pcode.'SampleOutput.txt');
            foreach ($value->TestCase as $key) {  
           unlink($key->InputFile);
            unlink($key->OutputFile);
          }
        }
 unlink("Misc\\".$_POST['contestid'].".xml");
  $deletefromcontestlist=mysqli_query($conn,"delete from contestlist where contestcode='$_POST[contestid]'");
 $deletefromprogramlist=mysqli_query($conn,"delete from programlist where contestcode='$_POST[contestid]'");
 $deletetable=mysqli_query($conn,"DROP TABLE $_POST[contestid]");
 mysqli_query($conn,"delete table '$_POST[contestid]'");
}else
{
echo "<script>alert('No contest exists with given code');</script>";
}
}


    $result=mysqli_query($conn,"select * from contestlist");
    if(mysqli_num_rows($result)>0)
    {
     echo 
     '<table style="">
    <tr>
    <th>Contest Name</th>
    <th>Contest Code</th>
    <th>Questions</th>
    <th>starttime</th>
    <th>Endtime</th>
  </tr>';
  
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
       echo '

  <tr>
    <td>'.$row['contestname'].'</td>
    <td>'.$row['contestcode'].'</td>
    <td>'.$row['noofquestions'].'</td>
    <td>'.$row['starttime'].'</td>
    <td>'.$row['endtime'].'</td>
  </tr>';
  }
  echo "</table>";
}
else{
 echo "<script>alert('No contests found ....');
window.open('practise.php','_self');
 </script>";

}



 

?>

</div>
</body>
</html>