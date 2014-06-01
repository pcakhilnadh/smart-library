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
<!-- Login BOx  start -->      
	<div class="col-sm-5" >
     <DIV id="login_box" >
             <p class="text-center" id="login_heading">Login</p>       
          <div id="login" >

			<?php 
      session_start();
error_reporting(E_NOTICE==0);

  if($_SESSION['usertype']=='admin')
  header('location:admin_home.php');
  
if($_SESSION['usertype']=='stud')
  header('location:home.php');

require 'connect.php';
$error=0;
if(isset($_POST['register']))
{
    
    $_SESSION['user']=$_POST['username'];
    $pswd = $_POST['password'];
    $pswd=md5($pswd);
  $query1="SELECT * FROM `login librarian` WHERE username='".$_SESSION['user']."' AND password='$pswd'  ";
  $query1=mysql_query($query1);
  $result1=mysql_num_rows($query1);
  $query2="SELECT * FROM `login student` WHERE username='".$_SESSION['user']."' AND password='$pswd'  ";
  $query2=mysql_query($query2);
  $result2=mysql_num_rows($query2);
  if($result1)
  {
     if ($row=mysql_fetch_assoc($query1))
     {
        $_SESSION['fname']=$row['firstname'];
        $_SESSION['lname']=$row['lastname'];

        $_SESSION['usertype']="admin";
        $_SESSION['expire'] =time()+(10*60);
        $_SESSION['password']=$pswd;
        if ($_SESSION['user']==$row['staff_code']) 
        {
        $_SESSION['usertype']="admin_new";
        header('location:signup.php');
        }
        else
        header('location:admin_home.php');
    }
  }
  elseif ($result2)
  {
    if ($row=mysql_fetch_assoc($query2))
     {
        $_SESSION['sid']=$row['admin_no'];
        echo $_SESSION['sid'];
        $_SESSION['fname']=$row['firstname'];
        $_SESSION['lname']=$row['lastname'];
        $_SESSION['password']=$pswd;
        $_SESSION['mail']=$row['email'];
        $_SESSION['mobno']=$row['mobno'];
        $_SESSION['usertype']="stud";
        $_SESSION['expire'] =time()+(10*60);
        $_SESSION['password']=$pswd;
        if ($_SESSION['user']==$row['admin_no']) 
        {
        $_SESSION['usertype']="stud_new";
        header('location:signup.php');
        }
        else
        header('location:home.php');
    }
  }

 else
 {
    $error=1;
    
 }
}

           if ($error) {
        
           echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModal").modal({keyboard:false,backdrop:"static"}); });
                 </script>'; 
                 
          
          } 
         if (isset($_GET['close'])) {
           echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=index.php">';
         }
          
           ?>
      
                <form action="index.php" method="POST" class="form-inline" id="forms" >
				<div class="login_element">
                <img id="login_box_image" src="./images/user.png" >
                 <input type="text" name="username" placeholder="Enter Username" class="form-control login_box_text text-center" id="username" required="required" autofocus/> 
                </div>
				<div class="login_element">
                <img id="login_box_image" src="./images/password.png" >
                <input type="password" name="password" placeholder="Enter Password" class= "form-control login_box_text text-center "required="required"/>
                </div>
                
                
                <button type="submit" name="register" id="register" data-toggle="modal">
                    <img src="./images/login.png" id="login_image">
                  <img src="./images/loginhover.png" id="login_imageh">
                 </button>
                 </br></br></br>
                </form>
           </div>
     </DIV>
	 </div>
<!-- Login BOx  end -->
     
  


	 
  <!-- cec image-->
   <div id="cec_image" >
             <img src="./images/cec.jpg" class="img-responsive">
     </div>
     
      <!-- Model For Error Reporting -->

      <div class="modal fade error_reporting" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
        <center> Username Password Combination Do not Match...! </center>
      </div>
      <div class="modal-footer">
        <form method="GET" action="index.php">
        <button type="submit" class="btn btn-danger"name="close" >Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- End Model -->
     

        </div>
     </div>
  </body>
  </html>
