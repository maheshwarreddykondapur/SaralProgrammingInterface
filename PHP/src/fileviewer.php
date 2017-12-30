<?php
session_start();
header("location:UserFolders/".$_SESSION['rollno']);
?>