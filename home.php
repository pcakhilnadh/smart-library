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
  
?>
<html>
<head>

       <link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
       <link rel="stylesheet" type="text/css" href="styles/mystyles.css">
       <link rel="stylesheet" type="text/css" href="styles/customstyle.css">
       <title>HoME</title>
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
           <a href="logout.php"><li id="logout"> Logout </li></a>
           <a href="#changepswdStud"><li id="logout"> Change password </li></a>       
           <a href="#Edit"><li id="logout"> Edit info </li></a>
            <a href="home.php"><li id="logout"> Home </li></a>
    </ul>
              
              
    
            
    </div>        

    </div>

  </div>
  </div>

   <div class="content" id="home">

<div class="container">
<div id="textp">
   <center>   Choose your wish...... </center>
    </div>
   <form action="library_home.php" method="GET">
      <input type="submit" value="LIBRARY" class="buttn btn btn-danger" id="btn_library">
   </form>
   <form action="bookart_home.php" method="GET">
      <input type="submit" value="BOOKART" class="buttn btn btn-danger" id="btn_bookart">
   </form>
   </div>
   
  
   </div>
   </div>
   


   <!-- MENU  end-->

        <?php } ?>


        <div id="changepswdStud" class="tab-section">
        <center><h2>Change Password</h2></center>
         <form action="home.php" method="post" class="form-inline " id="forms">

          
              
              <div class="login_element ">  
                <img id="form_image" src="./images/lock.png" >
                 <input type="password" placeholder="Enter current Password" class="form_text form-control  text-center" name="currentpswd" id="username" required="required" /> 
                </div>
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                <input type="password"  placeholder="Enter New Password" class= "form_text form-control  text-center " name="newpswd" required="required"/>
                </div>

                <div class="login_element">
                <img id="form_image" src="./images/lock.png" >
                 <input type="password"  placeholder="Re-Enter New Password" class="form_text form-control  text-center" name="renewpswd" id="username" required="required" /> 
                </div>
                <button type="submit" class="btn btn-primary" name="editstud" >
                Change Password
                </button>
         </form>

      </div>

</div>



<div id="body_content">
     <div class="modal fade error_reporting" id="myModaleditStud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['editstud']))
          {
            
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaleditStud").modal({keyboard:false}); });
                 </script>';

            $_POST['currentpswd']=md5($_POST['currentpswd']);

            if($_POST['currentpswd']!=$_SESSION['password'])
              echo "* Please enter current password correctly";
            elseif (strlen($_POST['newpswd'])<=6)
              echo "Password should be atleast 7 letters ";
            else if($_POST['newpswd']!=$_POST['renewpswd'])
              echo "* Password mismatch.Enter passord correctly";
            else
            {

                $query2="SELECT * FROM `login student` WHERE admin_no='".$_SESSION['sid']."' ";
                $query2=mysql_query($query2);
                $result2=mysql_num_rows($query2);
                if(!$result2)
                    echo "* There is no Student with Admission Number <b>".$_POST['adminno']."</b>";
                  else
                  {
              $_POST['newpswd']= md5($_POST['newpswd']);
               $_SESSION['password']=$_POST['newpswd'];
              $query="UPDATE `login student` SET password='".$_POST['newpswd']."' WHERE admin_no='".$_SESSION['sid']."' ";
              $query=mysql_query($query);
              
              if($query)
                {
                  echo "Password has been successfully changed.";
                  echo ' <META HTTP-EQUIV="refresh" CONTENT="2;URL=logout.php"> ';

                }
                else
                  echo "Internal Error";
              }
            }
          }
        
        ?>
<script type="text/javascript"></script>
       </center>
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>       









      <div id="Edit" class="tab-section" >
    <center><h2>Edit Studnet Information</h2></center>
    <form class="form-horizontal" role="form" method="post" action="#">
    <div class="form-group">
        <label class="col-sm-3 control-label">Admission number</label>
        <div class="col-sm-3">
            <p class="form-control-static"> <?php echo $_SESSION['sid']; ?> </p>
        </div>
    </div>
    
    <div class="form-group">
        <label  class="col-sm-3 control-label">First Name</label>
        <div class="col-lg-3 ">
              <input type="text" class="form-control" name="p_fname" value="<?php echo $_SESSION['fname']; ?>" required="required">
        </div>
    </div>
    <div class="form-group">
         <label  class="col-sm-3 control-label">Last name</label>
          <div class="col-lg-3 ">
              <input type="text" class="form-control" name="p_lname" value="<?php echo $_SESSION['lname']; ?>" required="required">
          </div>
    </div>
    <div class="form-group">
          <label  class="col-sm-3 control-label">Email</label>
          <div class="col-lg-3 ">
                <input type="email" class="form-control" name="p_email" value="<?php echo $_SESSION['mail']; ?>" required="required">
          </div>
    </div>
    <div class="form-group">
          <label  class="col-sm-3 control-label">Mobile No</label>
          <div class="col-lg-3 ">
              <input type="text" class="form-control" name="p_mobno" value="<?php echo $_SESSION['mobno']; ?>" required="required">
          </div>
    </div>
    <div class="form-group">
          <label  class="col-sm-3 control-label">Sex</label>
          <div class="col-lg-3">
                <div class="radio-inline">
                    <input type="radio" name="p_sex"  value="F" required="required">
                      Female 
                </div>
                <div class="radio-inline">
                    <input type="radio" name="p_sex" value="M"  required="required">
                      Male
                </div>
          </div>
    </div>
  <label  class="col-sm-6 control-label">
        <input type="submit"class="btn btn-primary" name="update" value="Update">
    </label>
    <input type="hidden" name="ID" value="<?php echo $_SESSION['sid']; ?>">
  
    </form>

</div>


    <div class="container">
<div id="body_content">
       <div class="modal fade error_reporting" id="mymodalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
<?php
          if(isset($_POST['update']))
          {
              
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#mymodalUpdate").modal({keyboard:false}); });
                 </script>';

           if (strlen($_POST['p_mobno'])!=10)
              echo " Enter a valid Mobile Number.";
        
            else
            {
              
              
              $query="UPDATE `login student` SET firstname='".$_POST['p_fname']."',lastname='".$_POST['p_lname']."',email='".$_POST['p_email']."',mobno='".$_POST['p_mobno']."',sex='".$_POST['p_sex']."' WHERE admin_no='".$_POST['ID']."' ";
              $query=mysql_query($query);
              
              if($query)
                {
                  echo $_SESSION['fname']." details updated Succesfully";
                  $_POST['ID']="";
                 echo ' <META HTTP-EQUIV="refresh" CONTENT="2;URL=home.php"> ';
                }
                else
                  echo "Internal Error";
            }
          }
        
        ?>
       </center>
  </div>

  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>      
      </div>
</div>
  
   </body>
</html>