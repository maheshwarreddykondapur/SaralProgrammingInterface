<!DOCTYPE html>
<html>
<head><meta name="viewport"></head>
<style type="text/css">
input[type=text]{
width: 70%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
border-radius:5px;
}
input[type=password] {
width: 70%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
border-radius:5px;
}
input[type=name] {
width: 70%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
border-radius:5px;
}
input[type=email] {
width: 70%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
border-radius:5px;
}
/* Set a style for all buttons */
button {


color: white;
padding: 14px 20px;
margin: 8px 0;
border: none;
cursor: pointer;
border-radius:5px;

}
.reg{
 background-color: #75db42;   
width: 10%;
}
.reg:hover{
background-color: ivory; 
color:black;
}
.login{
 background-color: #f1801f;   
width: 10%;

}
.login:hover{
background-color: ivory; 
color:black;
}
/* Extra styles for the cancel button */

.rcancelbtn {
position: relative;
right:30%;
width: auto;
padding: 10px 18px;
background-color: #f44336;
}
.rcancelbtn:hover{
    color:black;
}
.register-submit:hover{
color: black;
}
.lcancelbtn{
position: relative;
right: 27%;
}
#register {

width: auto;
padding: 10px 18px;
background-color: #4CAF50;
float: right;
}

/* Center the image and position the close button */

img.avatar {
width: 40%;
border-radius: 50%;
}

.container {
padding: 16px;
}

span.psw {
float: right;
padding-top: 16px;
}

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
padding-top: 60px;
align-items: center;
border-radius:5px;
}

/* Modal Content/Box */
.modal-content {

align-content: center;
background-color: #fefefe;
margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
border: 1px solid #888;
width: 40%; /* Could be more or less, depending on screen size */
border-radius:5px;
}

/* The Close Button (x) */
.close {
position: absolute;
right: 25px;
top: 0;
color: #000;
font-size: 35px;
font-weight: bold;
}

.close:hover,
.close:focus {
color: red;
cursor: pointer;
}

.animate {
-webkit-animation: animatezoom 0.6s;
animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
from {-webkit-transform: scale(0)}
to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
from {transform: scale(0)}
to {transform: scale(1)}
}
.lcancelbtn{
    background-color:red;
}
.login-submit{
    background-color: #f1801f;   
width: 10%;
}
.lcancelbtn:hover {
    color:black;
}
 .login-submit:hover{
    color:black;
}


#submit {
position: relative;
float:middle;
width: 100px;
}
#container{
position: relative;
top:10%;
}
</style>
<body style="background-color:#D0DADD;">
<?php
error_reporting(1);
session_start();
// if($_SESSION['isLogin'])
// {
// echo $_SESSION['Name'];
// header('location:practise.php');
// }
?>

<div id="container" align="center" >
<div class="header">
<div style="background-color:#D1D0DB;">
<b style="font-family:Times-new-roman;font-size:350%;padding:5%;color:#345A5A;" >SARAL PROGRAMMING</b>
</div>
<div class="aside"><img src="saral.png" class="mobile-image" style="width:60%;height:80%; float:left;"></div>
<div class="logo"><img src="CMRLOGO.png" height="250" width=250  /></div>
<div class="title"style="color:#232342;"><h2>CMR College of Engineering and Technology</h2></div>
<button onclick="document.getElementById('id01').style.display='block'" class='login'>Login</button>
<button onclick="document.getElementById('id02').style.display='block'" class='reg'>Register</button><br><br>
<?php if(!empty($_SESSION['msg'])){echo $_SESSION['msg'];$_SESSION['msg']=''; }?>
</div>  


<div id="id01" class="modal">

<form class="modal-content animate" action="login.php" method="post">
<div class="container">

<label><b> Username &nbsp; </b></label>
<input type="email" placeholder="Enter Username" name="userName" required><br>

<label><b> Password &nbsp; </b></label>
<input type="password" placeholder="Enter Password"  name="password" required><br>

<button type="submit" id='submit'class="login-submit" name="login-Button">Login</button>

</div>

<div class="container" style="background-color:#f1f1f1">
<button type="button"  onclick="document.getElementById('id01').style.display='none'" class="lcancelbtn">Cancel</button>
<span class="psw"><a href="passwordrecovery.php">Forgot password?</a></span>
</div>
</form>
</div>
<div id="id02" class="modal">
<form class="modal-content animate" action="login.php" method="post">
<div class="imgcontainer">
<h2>Register</h2>
<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
</div>

<div class="container">

<label><b>&nbsp; Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></label>
<input type="name" placeholder="Enter name" name="name" required><br>

<label><b>&nbsp; Roll.no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></label>
<input type="text" placeholder="Enter Roll.no" name="rno" required><br>

<label><b>&nbsp; College &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></label>
<input type="text" placeholder="Enter College name" name="college" required><br>

<label><b>&nbsp; Username &nbsp; </b></label>
<input type="email" placeholder="Enter mail-id" name="username" required><br>

<label><b>&nbsp; Password &nbsp;&nbsp; </b></label>
<input type="password"  pattern=".{6,}" placeholder="Enter Password" name="password" id='pwd1'
                    onchange="  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                                if(this.checkValidity()) form.pwd2.pattern = this.value;" required><br>
<label><b>&nbsp; Confirm &nbsp;&nbsp; </b></label>
<input type="password"  pattern=".{6,}" class="form-control" placeholder="Confirm Password" name="pwd2" id='pwd2'
                     onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" required><br>

</div>

<div class="container" style="background-color:#f1f1f1">
<button type="button"  onclick="document.getElementById('id02').style.display='none'" class="rcancelbtn">Cancel</button>
<button type="submit" id='register' class="register-submit" name="register-Button">Register</button>
</div>
</form>
</div>

<script>

var modal = document.getElementById('id01');
var register=document.getElementById('id02');
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
if (event.target == register) {
register.style.display = "none";
}
}
</script>


</body>
</html>
