<!doctype html>
<?php
require 'connect.php';
session_start();
$_SESSION['expire']+=60;

if(($_SESSION['usertype']!="stud")||($_SESSION['expire']<=time()))
 {      session_destroy();
      header('location:logout.php');
 }
 else
 {
  require_once 'timeout.php';
?>
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
       <script type="text/javascript" src="./js/duplicate.js"></script>
   <script>
    $(window).load(function(){
      $("#header").sticky({ topSpacing: 0 });
    });
  </script> 
</head>
  
<body>

<!-- BODY starts -->
  <div class="container">
  
  
 <!-- main heading starts -->  
  <div class="col-md-12">
  <img id="logo" src="./images/logo.png" class="img-responsive col-md-4">
  
  <div class =" text-center" id="mainheading">
       <h1>  COLLEGE OF ENGINEERING CHENGANNUR </h1>
       <h2> SMART LIBRARY </h5>

   </div> 
 
  </div>
 <!-- main heading ends -->


   <!-- MENU  start-->
 <div class="header_bar">
 <div id="header">
    <div class = "container">
         
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
        <span class="glyphicon glyphicon-list"></span>
        </button>
              <li class="nav navbar-nav header_bar_text">Hi <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>, </li>
              <div class = "collapse navbar-collapse navHeaderCollapse ">

            <ul>
          <a href="home.php" class="active"><li> Home </li></a>
          
           <a href="logout.php"><li id="logout"> Logout </li></a>
    </ul>
              
              
    
            
    </div>   
        

  </div>
  </div>
  </div>

   <?php } ?>
   </h2>

   </body>
   </html>