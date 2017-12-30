<html>
<body>
<?php
session_start();
if($_SESSION['isLogin'])
{
?>	
<style>
	ul#menu {
    padding: 0;
    margin-bottom: 11px;
}

ul#menu li {
    display: inline;
    margin-right: 3px;
}

ul#menu li a {
    background-color: #ffffff;
    padding: 10px 20px;
    text-decoration: none;
    color: #696969;
    border-radius: 4px 4px 0 0;
}

ul#menu li a:hover {
    color: white;
    background-color: black;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
th {
    text-align: left;
}
	</style>
	<nav id="nav01"></nav>

<div id="main">
  

<div id="main">
  


<ul id='menu'>
<li><a href='landingpage.php'>Home</a></li>
<li><a href='newcontest.php' id='new'>Create Contest</a></li>
<li><a href='settings.php'>Settings</a></li>
<li><a href='scores.php'>Scores</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
<form action="#" method="post">
<input type="submit" name="member" id="mmember" value="Manage members">
<input type="submit" name="contest" id="mcontest" value="Delete Contest">
<input type="submit" name="cpass" value="Change password">
</form>
<?php
if(!$_SESSION['access'])
{
  echo "<style>#new {display:none;} 
  #mmember{display:none}
  #mcontest{display:none}</style>";
}
  $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"editor");
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['member']))
{
    echo '<form action="#" method="post">
<input type="submit" name="memberadd" value="Add member">
<input type="submit" name="memberdelete" value="Delete Member">
</form>';
}

if(isset($_POST['memberadd']))
{
    
    echo '<form action="#" method="post" >
<input type="text" name="name" placeholder="Name">
<input type="text" name="cid" placeholder="Roll.No">
<input type="text" name="cname" placeholder="College Name">
<input type="text" name="username" placeholder="User Name(Mail id)">
<input type="password" name="password" placeholder="Password">
<input type="number" name="access" placeholder="access" min="0" max="1">
<input type="submit" name="addmember" placeholder="Add">
</form>';
echo '<i style="color:red">access=1 for admin else 0<i>';

}
if(isset($_POST['addmember']))
{
   
    $result=mysqli_query($conn,"Insert into loginform values('$_POST[name]','$_POST[cid]','$_POST[cname]','$_POST[username]','$_POST[password]','$_POST[access]')");

    
}
if(isset($_POST['memberdelete']))
{
     echo '<form action="#" method="post" >
<input type="text" name="username" placeholder="User Name(Mail id)">
<input type="submit" name="deletemember" value="Delete">
</form>';
    $result=mysqli_query($conn,"select * from loginform");
     echo 
     '<table style="width:100%">
    <tr>
    <th>Name</th>
    <th>College ID</th>
    <th>College Name</th>
    <th>Last Username</th>
    <th>Access</th>
  </tr>';
  
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
       echo '

  <tr>
    <td>'.$row['name'].'</td>
    <td>'.$row['rollno'].'</td>
    <td>'.$row['collegename'].'</td>
    <td>'.$row['uname'].'</td>
    <td>'.$row['access'].'</td>
  </tr>';
  }
  echo "</table>";

}
if(isset($_POST['deletemember']))
{
     $result=mysqli_query($conn,"delete from loginform where uname='$_POST[username]'");

}
if(isset($_POST['contest']))
{
     echo '<form action="#" method="post" >
<input type="text" name="contestid" placeholder="Contest ID">
<input type="submit" name="deletecontest" value="Delete">
</form>';
    $result=mysqli_query($conn,"select * from contestlist");
     echo 
     '<table style="width:100%">
    <tr>
    <th>Contest Name</th>
    <th>Contest ID</th>
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
if(isset($_POST['deletecontest']))
{
   unlink("Misc\\".$_POST['contestid']."rules.txt");
  $del=mysqli_query($conn,"select * from programlist where contestcode='$_POST[contestid]'");
  while($row = mysqli_fetch_array($del,MYSQLI_ASSOC))
  {
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseoutput1.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseoutput2.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseoutput3.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseoutput4.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseoutput5.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseoutput6.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseinput1.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseinput2.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseinput3.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseinput5.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseinput4.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."testcaseinput6.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."problem.txt");
    unlink("Misc\\".$_POST['contestid'].$row['programcode']."sampleinput.txt");
   
    
    


  }
     $deletefromcontestlist=mysqli_query($conn,"delete from contestlist where contestcode='$_POST[contestid]'");
     $deletefromprogramlist=mysqli_query($conn,"delete from programlist where contestcode='$_POST[contestid]'");
     $deletetable=mysqli_query($conn,"DROP TABLE $_POST[contestid]");


}
if(isset($_POST['cpass']))
{
    echo '<form action="#" method="post" >
<input type="password" name="oldpassword" placeholder="Current Password">
<input type="password" name="newpassword" placeholder="New Password">
<input type="submit" name="cpassword" value="Change">
</form>';
}
if(isset($_POST['cpassword']))
{
   $result=mysqli_query($conn,"select * from loginform where uname='$_SESSION[userName]' and password='$_POST[oldpassword]'");
   if($result)
   {
    
    $note=mysqli_query($conn, "update loginform set password='$_POST[newpassword]' where uname='$_SESSION[userName]'");
   }
   if($note)
    echo "Your password has been changed.";
   else
    echo "Your atMisct failed.";
}
}
else{
	header("location:index.php");
}
?>
</body>
</html>

