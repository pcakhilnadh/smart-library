<!doctype html>
<?php
require_once 'connect.php';
session_start();
$_SESSION['expire']+=60;

if(($_SESSION['usertype']=="admin")||($_SESSION['usertype']=='stud')||($_SESSION['usertype']==""))
 {			

    session_destroy();
 			header('location:logout.php');
 }
 else
 {
  
      require_once 'timeout.php';

 if (isset($_GET['close'])) {
           echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=index.php">';
         }
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
   <script>
    $(window).load(function(){
      $("#header").sticky({ topSpacing: 0 });
   
      $('#ex').tooltip('hide');
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
		</ul>
							
							
		
						
		</div>				

		</div>

	</div>
	</div>
 <!-- MENU END  --> 
 <!-- Validate the edit start -->
 <div class="container">
<div id="body_content">
       <div class="modal fade error_reporting" id="mymodalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      <center>
        <?php
          if(isset($_POST['update']))
          {
              
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#mymodalUpdate").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

           if (strlen($_POST['p_mobno'])!=10)
              echo " Enter a valid Mobile Number.";
        
            else
            {
              
              
                $query1="SELECT * FROM `login librarian` WHERE username='".$_POST['p_uname']."'   ";
				$query1=mysql_query($query1);
  				$result1=mysql_num_rows($query1);
  				
  				$query2="SELECT * FROM `login student` WHERE username='".$_POST['p_uname']."'  ";
  				$query2=mysql_query($query2);
  				$result2=mysql_num_rows($query2);
			  if ($result1||$result2)
			  echo "User Name <b> ".$_POST['p_uname']."</b> is already taken. Try Different One </br> Username once taken cannot be modified";               
              else
                {
                  if($_SESSION['usertype']=='stud_new')
                  {

                  $query="UPDATE `login student` SET username='".$_POST['p_uname']."',firstname='".$_POST['p_fname']."',lastname='".$_POST['p_lname']."',email='".$_POST['p_email']."',mobno='".$_POST['p_mobno']."',sex='".$_POST['p_sex']."' WHERE admin_no='".$_SESSION['user']."' ";
              		mysql_query($query);
                    $_SESSION['usertype']='';
                    echo "Your New username is <b>".$_POST['p_uname']." </b><br> Login Aagain with Your New Username And old Password";
                    echo "<br><br> <a href='logout.php'><button type='button' class='btn btn-success'>Login Again</button></a>";
                    
                  }
                  else
                  {
                    $query="UPDATE `login librarian` SET username='".$_POST['p_uname']."',firstname='".$_POST['p_fname']."',lastname='".$_POST['p_lname']."',email='".$_POST['p_email']."',mobno='".$_POST['p_mobno']."',sex='".$_POST['p_sex']."' WHERE staff_code='".$_SESSION['user']."' ";
                  mysql_query($query);
                    $_SESSION['usertype']='';
                    echo "Your New username is <b>".$_POST['p_uname']." </b><br> Login Again with Your New Username And old Password";
                    echo "<br><br> <a href='logout.php'><button type='button' class='btn btn-success'>Login Again</button></a>";
                    
                  }

                 
                }
              
            }
          }
        
        ?>
       </center>
  </div>
      <div class="modal-footer">
        <form method="GET" action="signup.php">
        <button type="submit" class="btn btn-danger"name="close"> Close</button>
        </form>
        
      </div>
    </div>
  </div>
</div>      
      </div>
</div>
 <!-- Validate the edit end -->
 <!-- add user Body start-->
 <div id="Edit" >
    <center><h2>Add User Information</h2></center>
    <form class="form-horizontal" role="form" method="post" action="signup.php">
    <div class="form-group">
        <label class="col-sm-3 control-label">
          <?php
          if ($_SESSION['usertype']=='stud_new')
              echo "Admission No";
          else
              echo "Staff Code";
          ?>
        </label>
        <div class="col-sm-3">
            <p class="form-control-static"> <?php echo $_SESSION['user']; ?> </p>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">User Name</label>
        <div class="col-lg-3 ">
              
              <input id="ex" type="text" class="form-control" name="p_uname" value="" required="required" data-toggle="tooltip" data-placement="right" title="Username should be unique.Once created you cannot modify">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">First Name</label>
        <div class="col-lg-3 ">
              <input type="text" class="form-control" name="p_fname" value="" required="required">
        </div>
    </div>
    <div class="form-group">
         <label  class="col-sm-3 control-label">Last name</label>
          <div class="col-lg-3 ">
              <input type="text" class="form-control" name="p_lname" value="" required="required">
          </div>
    </div>
    <div class="form-group">
          <label  class="col-sm-3 control-label">Email</label>
          <div class="col-lg-3 ">
                <input type="email" class="form-control" name="p_email" value="" required="required">
          </div>
    </div>
    <div class="form-group">
          <label  class="col-sm-3 control-label">Mobile No</label>
          <div class="col-lg-3 ">
              <input type="number" class="form-control" name="p_mobno" value="" required="required">
          </div>
    </div>
    <div class="form-group">
          <label  class="col-sm-3 control-label">Sex</label>
          <div class="col-lg-3">
                <div class="radio-inline">
                    <input type="radio" name="p_sex"  value="f" required="required">
                      Female 
                </div>
                <div class="radio-inline">
                    <input type="radio" name="p_sex" value="m" checked required="required">
                      Male
                </div>
          </div>
    </div>
  
  
    <label  class="col-sm-6 control-label">
        <input type="submit"class="btn btn-primary" name="update" value="Update">
    </label>
   
  
    </form>
  </div>
 <!-- add user Body  end -->
 <?php } ?>
<!-- body ends -->
  </body>
  </html>
  
