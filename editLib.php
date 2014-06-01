<!doctype html>
<?php
require 'connect.php';
session_start();
$_SESSION['expire']+=60;

if(($_SESSION['usertype']!="admin")||($_SESSION['expire']<=time()))
 {			session_destroy();
 			header('location:logout.php');
 }

elseif ($_POST['ID']=='') {
  header('location:admin_home.php');
}
 else
 {
    $_SESSION['expire'] +=(60);

    $query1="SELECT * FROM `login librarian` WHERE staff_code='".$_POST['ID']."' ";
  $query1=mysql_query($query1);
  $result1=mysql_num_rows($query1);
  
  if($result1)
  {
     if ($row=mysql_fetch_assoc($query1))
     {
        $fname=$row['firstname'];
        $lname=$row['lastname'];
        $uname=$row['username'];
        $email=$row['email'];
        $mobno=$row['mobno'];
    }
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
      		<a href="admin_home.php" class="active"><li> Home </li></a>
  		
  			
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
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      <center>
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
              
              
              $query="UPDATE `login librarian` SET firstname='".$_POST['p_fname']."',lastname='".$_POST['p_lname']."',email='".$_POST['p_email']."',mobno='".$_POST['p_mobno']."',sex='".$_POST['p_sex']."' WHERE staff_code='".$_POST['ID']."' ";
              $query=mysql_query($query);
              
              if($query)
                {
                  echo "Librarian details updated Succesfully";
                  $_POST['ID']="";
                 echo ' <META HTTP-EQUIV="refresh" CONTENT="2;URL=admin_home.php"> ';
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
 <!-- Validate the edit end -->
 <!-- Edit Body start-->
 <div id="Edit" >
    <center><h2>Edit Librarian Information</h2></center>
    <form class="form-horizontal" role="form" method="post" action="editLib.php">
    <div class="form-group">
        <label class="col-sm-3 control-label">Staff Code</label>
        <div class="col-sm-3">
            <p class="form-control-static"> <?php echo $_POST['ID']; ?> </p>
        </div>
    </div>
    
    <div class="form-group">
        <label  class="col-sm-3 control-label">First Name</label>
        <div class="col-lg-3 ">
              <input type="text" class="form-control" name="p_fname" value="<?php echo $fname; ?>" required="required">
        </div>
    </div>
    <div class="form-group">
         <label  class="col-sm-3 control-label">Last name</label>
          <div class="col-lg-3 ">
              <input type="text" class="form-control" name="p_lname" value="<?php echo $lname; ?>" required="required">
          </div>
    </div>
    <div class="form-group">
          <label  class="col-sm-3 control-label">Email</label>
          <div class="col-lg-3 ">
                <input type="email" class="form-control" name="p_email" value="<?php echo $email; ?>" required="required">
          </div>
    </div>
    <div class="form-group">
          <label  class="col-sm-3 control-label">Mobile No</label>
          <div class="col-lg-3 ">
              <input type="text" class="form-control" name="p_mobno" value="<?php echo $mobno; ?>" required="required">
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
                    <input type="radio" name="p_sex" value="M" checked required="required">
                      Male
                </div>
          </div>
    </div>
  
  
    <label  class="col-sm-6 control-label">
        <input type="submit"class="btn btn-primary" name="update" value="Update">
    </label>
    <input type="hidden" name="ID" value="<?php echo $_POST['ID']; ?>">
  
    </form>

  </div>
 <!-- Edit Body  end -->


 <?php } ?>
 
 </div>
<!-- body ends -->
  </body>
  </html>
  
