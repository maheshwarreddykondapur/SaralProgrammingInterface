<!DOCTYPE html>
<html>
<head>
  <title>New Contest</title>
  <style type="text/css">
  body{
    background: #f1f1f1;
}
#pagecontent{
  background: white;
    position: absolute;
    left: 10%;
    width: 80%; 
    height: 100%; 
    
    
}
input[type=text],[type=number],[type=name]
{
  width: 25%;
}
input[type=datetime-local]
{
  width: 30%;
}
textarea{
 
  width: 90%;
  height: 30%;
}

ul
{
  position:absolute;
  left:120px;
}
form{
  position: absolute;
  left: 30%;
  top: 10%;
}

  
  </style>
  <script type="text/javascript">
     function chText()
{
    var str=document.getElementById("contestcode");
    var regex=/[^a-z]/gi;
    str.value=str.value.replace(regex ,"");
}
  </script>
</head>
<body>

<div id="pagecontent" >
<form action="#" method="post">
Contest Name <input type="text" name="contestname" placeholder="Required" required ></input><span>    </span>
Contest Code  <input type="name" name="contestcode" onKeyUp="chText()" onKeyDown="chText" id="contestcode" placeholder="Required" required></input><br><br>
No of problems <input type="number" name="noofquestions" min="1" placeholder="Required" required></input>
Time Limit <input type="number" name="contestduration"  min="0" ></input><br><br>
Start Time<input type="datetime-local" name="starttime"  required></input>
End Time <input type="datetime-local" name="endtime" required></input><br><br>
Contest Description:<br><textarea name="contestdescription" rows=10 cols=100 style="" required></textarea><br>
Contest Rules:<br><textarea name="contestrules" rows=10 cols=100 style="" required></textarea><br><br>
<input type="submit" name="next" value="Next" style="width:130px;height:30px;"></input>
<input type="reset" style="width:130px;height:30px;"></input>
</form>
</div>

<?php
session_start();
include('confun.php');
if(!$_SESSION['isLogin'])
{
  header("location:index.php");
}
if($_SESSION['access']){

include('verticalNavigation.html');
}else{
  include('usernavigation.html');
}

if(isset($_POST['next']))
{
  if(!file_exists("Misc\\".$_POST['contestcode'].'.xml')){
    
   $_SESSION['contestCode']=$_POST['contestcode'];
      $_SESSION['no']=$_POST['noofquestions'];
      $_SESSION['contestName']=$_POST['contestname'];
      $_SESSION['contestduration']=$_POST['contestduration'];
      $_SESSION['contestdescription']=$_POST['contestdescription'];
      $_SESSION['starttime']=$_POST['starttime'];
      $_SESSION['endtime']=$_POST['endtime'];
  
  $dom = new DOMDocument('1.0','UTF-8');
      $dom->formatOutput = true;
      $root = $dom->createElement("contest");
      $dom->appendChild($root);
      $root->setAttribute('contestCode',$_SESSION['contestCode']);
      $contestname=$dom->createElement('contestName', cfsc($_SESSION['contestName']));
      $root->appendChild($contestname);
      $noofquestions= $dom->createElement('noOfPrograms',$_SESSION['no']);
      $root->appendChild($noofquestions);
      $contestDuration=$dom->createElement('contestDuration', $_SESSION['contestduration']);
      $root->appendChild($contestDuration);
      $startTime=$dom->createElement('startTime', $_SESSION['starttime']);
      $root->appendChild($startTime);
      $endTime=$dom->createElement('endTime', $_SESSION['endtime']);
      $root->appendChild($endTime);
      $contestdescription=$dom->createElement('contestDescription', cfsc($_SESSION['contestdescription']));
      $root->appendChild($contestdescription);
      $contestRules=$dom->createElement('contestRules',cfsc($_POST['contestrules']));
      $root->appendChild($contestRules);
      $dom->save("Misc\\".$_POST['contestcode'].'.xml') or die('XML Create Error');
      if(file_exists("Misc\\".$_POST['contestcode'].'.xml')){
        $_SESSION['newcontest']='ok';
      header('location:publish.php');
    }
    else{
      
      echo "<script>alert('Please change your contest code');</script>";
    }

    }
    else{

      echo "<script>alert 'Contest with same code already exists';</script>";
    }
}




?>

</body>
</html>