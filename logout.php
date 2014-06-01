<?php
session_start();

$_SESSION['user']="";
$_SESSION['usertype']=0;
$_SESSION['expire']=0;   
$_SESSION['fname']="";
$_SESSION['lname']="";              
$_SESSION['password']="";
session_destroy();

?>
<!doctype html>

<html>
  <head>
       <link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
       <link rel="stylesheet" type="text/css" href="styles/mystyles.css">
       <link rel="stylesheet" type="text/css" href="styles/customstyle.css">
       <title>Smart Library</title>
     <script type="text/javascript" src="./js/jquery-1.10.2.js"></script>
     <script type="text/javascript" src="./js/bootstrap.js"></script>
       <script type="text/javascript" src="./js/jquery.sticky.js"></script>
       <script type="text/javascript" src="./js/tabs.js"></script>
     
  </head>
  <body>
 <div class="container">
  
 <div class="col-md-12">
  <img id="logo" src="./images/logo.png" class="img-responsive col-md-4">
  
  <div class =" text-center" id="mainheading">
       <h1>  COLLEGE OF ENGINEERING CHENGANNUR </h1>
       <h2> SMART LIBRARY </h5>

   </div> 
 
  </div>

   <!-- MENU  start-->
   
<hr>
   
  <!-- MENU  start-->
   <center>

 
   	
   	<div id="textp">
   		You are successfully logged out...!! </br> </br>
   		<a href="index.php" style="text-decoration:none;"><button type="button" class="btn btn-success" data-dismiss="modal">Click Here To Login Again</button></a>  
   	</div>
   </center>
   </body>
</html>