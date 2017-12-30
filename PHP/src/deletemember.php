<!DOCTYPE html>
<html>
<head>
  <title>Remove members</title>
</head>
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

  }
  table{
    position: relative;
    left: 27%;
    top: 20%;
    width: 70%;
  }
  form{
    position: absolute;
    left: 45%;
  }
  th,tr,td{
    border: 0px solid black;

  }
  table{
    position: relative;
    box-shadow:1px 1px 1px 1px dimgray;
    top: 30%;
    width: 60%;
  }
  h1{
    position: absolute;
    left: 40%;
  }
  .tt{
    background: green;
    color: white;
    padding: 10px;
    border: 0px;
    border-radius:2px green;
  }
  .tt:hover{
    background: red;
  }
</style>
<body>
<div id='pagecontent'>
<?php
        session_start();
        if(!$_SESSION['isLogin'])
        {
        header('location:index.php');
        }
        if(!$_SESSION['access']){
include('usernavigation.html');
}
else include('verticalnavigation.html');
?>

<h1>Remove member</h1><br><br><br><br><br>
<div class="table-responsive ">
<table class="table table-striped table-hover">
<thead>
    <tr>
    <th>Name</th>
    <th>College ID</th>
    <th>College Name</th>
    <th>Username</th>
    <th>Access</th>
    <th>Option</th>
  </tr>
  </thead>
<?php

if(!$_SESSION['isLogin'])
{
  header('location:index.php');
}
   $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"editor");
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
   
    $result=mysqli_query($conn,"select * from loginform");
    
  
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
       echo '
<tbody>
  <tr>
  <form method="post" class="form" action="#">
    <td>'.$row['name'].'</td>
    <td>'.$row['rollno'].'</td>
    <td>'.$row['collegename'].'</td>
    <td>'.$row['uname'].'</td>
    <td>'.$row['access'].'</td>
     <input type="text" name="username" value='.$row['uname'].' style="display:none">
              <td><input type="submit" name="deletemember" class="tt btn btn-danger" value="Delete" ></td>
               </form>
  </tr></tbody>
  ';
  }
  echo "</table>";


if(isset($_POST['deletemember']))
{
     $result=mysqli_query($conn,"delete from loginform where uname='$_POST[username]'");

}
?>
</div>
</div>
</body>
</html>