<!doctype html>
<?php
require 'connect.php';
session_start();
$_SESSION['expire']+=60;

if(($_SESSION['usertype']!="admin")||($_SESSION['expire']<=time()))
 {			session_destroy();
 			header('location:logout.php');
 }
 else
 {
 	require_once 'timeout.php';
 	  if (isset($_GET['close'])) 
    {
          
        echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=admin_home.php">';
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
     <script type="text/javascript" src="./js/jquery.min.js"></script>
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
      		<a href="admin_home.php" class="active"><li> Home </li></a>
  			
  			<li class="dropdown-toggle">  
  					Manage Student    
  			  		<ul>
  			  			<a href="#searchstud"><li> Search Student </li></a>
      					<a href="#addstud"><li> Add Student </li></a>
						<a href="#deleteStud"><li> Delete Student </li></a>
      					<a href="#changepswdStud"><li>Reset Password</li></a>
      				</ul>
  			</li>
  			<li>  
  					Manage Librarian    
  			  		<ul>
      					<a href="#addlib"><li>Add Librarian</li></a>
						<a href="#deleteLib"><li> Delete Librarian </li></a>
      					<a href="#editlib"><li>Edit Librarian</li></a>
      					<a href="#changepswd"> <li>Change Password  </li></a>
      				</ul>
  			</li>
        <li class="dropdown-toggle">  
            Manage Book    
              <ul>
                <a href="#searchBook"><li> Search Book </li></a>
                <a href="#addBook"><li> Add Book </li></a>
                <a href="#editBook"><li>Edit Book</li></a>
				        <a href="#deleteBook"><li> Delete Book </li></a>
                <a href="#issueBook"><li> Issue Book </li></a>
                <a href="#returnBook"><li>Return Book</li></a>
              </ul>
        </li>
  			
  			   <a href="logout.php"><li id="logout"> Logout </li></a>
		</ul>
							
							
		
						
		</div>				

		</div>

	</div>
	</div>
 <!-- MENU END  --> 
 
<!-- Search Stud body start-->
<div class="container">


<div id="body_content">
     
        <?php
          if(isset($_POST['searchstud']))
          {
          	
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaleSearchStud").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $query2="SELECT * FROM `login student` WHERE admin_no='".$_POST['adminno']."'   ";
 			 $query2=mysql_query($query2);
  			$result2=mysql_num_rows($query2);
  		
      	if ($result2!=1) 
  			{
  			    echo '<form style="display: hidden" action="allStud.php" method="POST" id="form">
                    <input type="hidden"  name="admno" value="'.$_POST['adminno'].'"/>
                </form>
                <script type="text/javascript">
                    $(window).load(function(){$("#form").submit();});
                </script>';
  			}
  			else
  			{

  			   $_POST['adminno']=$_POST['adminno'].'/';
           echo '<form style="display: hidden" action="searchStud.php" method="POST" id="form">
                    <input type="hidden"  name="ID" value="'.$_POST['adminno'].'"/>
                </form>
                <script type="text/javascript">
                    $(window).load(function(){$("#form").submit();});
                </script>';
  			}
        	
          }
        
        ?>

           
      

      <div id="searchstud" class="tab-section">
        <center><h2>Search Studnet</h2></center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Admission No" class="form_text form-control  text-center" name="adminno" id="username" required="required" /> 
                </div>
              
                <input type="submit" class="btn btn-primary" name="searchstud" value="search">
         </form>

      </div>

</div>

</div>
<!-- Search Stud body ends -->   

<!-- change password start-->
<div class="container">
<div id="body_content">
       <div class="modal fade error_reporting" id="myModalchangePswd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      <center>
        <?php
          if(isset($_POST['changepswd']))
          {
          	
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModalchangePswd").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $_POST['currentpswd']=md5($_POST['currentpswd']);

            if($_POST['currentpswd']!=$_SESSION['password'])
              echo "* Please enter your old password correctly";
            else if($_POST['newpswd']!=$_POST['renewpswd'])
              echo "* Password mismatch.Enter passord correctly";
            else
            {
              $_POST['newpswd']= md5($_POST['newpswd']);
               $_SESSION['password']=$_POST['newpswd'];
              $query="UPDATE `login librarian` SET password='".$_POST['newpswd']."' WHERE username='".$_SESSION['user']."' ";
              $query=mysql_query($query);
              
              if($query)
                {
                  echo "Password has been successfully changed.";
                }
                else
                  echo "Internal Error";
            }
          }
        
        ?>
       </center>
  </div>
      <div class="modal-footer">
        <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>      
      </div>

      <div id="changepswd" class="tab-section">
        <center><h2>Change Password</h2></center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                 <input type="password" placeholder="Cuerrent Password" class="form_text form-control  text-center" name="currentpswd" id="username" required="required" /> 
                </div>
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                <input type="password"  placeholder="Enter New Password" class= "form_text form-control  text-center " name="newpswd" required="required"/>
                </div>

                <div class="login_element">
                <img id="form_image" src="./images/lock.png" >
                 <input type="password"  placeholder="Re-Enter New Password" class="form_text form-control  text-center" name="renewpswd" id="username" required="required" /> 
                </div>
                <button type="submit" class="btn btn-primary" name="changepswd" >
                Change Password
                </button>
         </form>

      </div>

</div>
<!-- change password end-->

<!-- add student body start-->
<div class="container">
<div id="body_content">
     <div class="modal fade error_reporting" id="myModaladdStud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['addstud']))
          {
          		
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaladdStud").modal({keyboard:false,backdrop:"static"}); });
                 </script>';
             
             if($_POST['adminno']!=$_POST['readminno'])
              echo "Admission number Do not match.";   
             elseif (!(($_POST['year']>='1992')&&($_POST['year']<=date("Y"))))
              {
             	echo "Enter a valid Year Of admission";
             }
            elseif(strlen($_POST['newpswd'])<=6)
            	echo " Password should be atleast 7 letters";
             else
             {

             if($_POST['newpswd']!=$_POST['renewpswd'])
              echo "* Password mismatch.Enter passord correctly";
            else
            {
               $_POST['newpswd']=md5($_POST['newpswd']);


               $query1="SELECT * FROM `login librarian` WHERE staff_code='".$_POST['adminno']."'   ";
               $query1=mysql_query($query1);
               $result1=mysql_num_rows($query1);

               if ($result1) {
                 echo "Admission Number Already In Use";;
               }
              else
              {
              $query="INSERT INTO `login student` (admin_no, password,username,year_admission) VALUES ('".$_POST['adminno']."','".$_POST['newpswd']."','".$_POST['adminno']."','".$_POST['year']."') ";
              $query=mysql_query($query);
              
              if($query)
                {
                  echo "A New Student has been successfully added.";
                }
                else
                  echo "Admission Number Alreadey In Use";
            }
          }
        	}
          }
        }
        ?>
       </center>
   </div>
      <div class="modal-footer">
        <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
      

      <div id="addstud" class="tab-section">
        <center><h2>Add New Studenet</h2></center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Admission No" class="form_text form-control  text-center" name="adminno" id="username" required="required" /> 
                </div>
                <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Re-Enter Admission No" class="form_text form-control  text-center" name="readminno" id="username" required="required" /> 
                </div>
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                <input type="password"  placeholder="Enter A Password" class= "form_text form-control  text-center " name="newpswd" required="required"/>
                </div>

                <div class="login_element">
                <img id="form_image" src="./images/lock.png" >
                 <input type="password"  placeholder="Re-Enter New Password" class="form_text form-control  text-center" name="renewpswd" id="username" required="required" /> 
                </div>
                <div class="login_element ">
                <input type="text" pattern="[0-9]{4}" placeholder="Year Of Admission" class="form_text form-control  text-center" name="year"  required="required" /> 
                </div>
                <input type="submit" class="btn btn-primary" name="addstud" value="Add Student">
         </form>

      </div>

</div>
<!-- add student body ends -->

<!-- changepswdstudent body start-->
<div class="container">


<div id="body_content">
     <div class="modal fade error_reporting" id="myModaleditStud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['editstud']))
          {
            
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaleditStud").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $_POST['currentpswd']=md5($_POST['currentpswd']);

            if($_POST['currentpswd']!=$_SESSION['password'])
              echo "* Please enter Librarian/Admin password correctly";
            elseif (strlen($_POST['newpswd'])<=6)
              echo "Password should be atleast 7 letters ";
            else if($_POST['newpswd']!=$_POST['renewpswd'])
              echo "* Password mismatch.Enter passord correctly";
            else
            {

                $query2="SELECT * FROM `login student` WHERE admin_no='".$_POST['adminno']."' ";
                $query2=mysql_query($query2);
                $result2=mysql_num_rows($query2);
                if(!$result2)
                    echo "* There is no Student with Admission Number <b>".$_POST['adminno']."</b>";
                  else
                  {
              $_POST['newpswd']= md5($_POST['newpswd']);
               $_SESSION['password']=$_POST['newpswd'];
              $query="UPDATE `login student` SET password='".$_POST['newpswd']."' WHERE admin_no='".$_POST['adminno']."' ";
              $query=mysql_query($query);
              
              if($query)
                {
                  echo "Password has been successfully changed.";
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
        <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
      

      <div id="changepswdStud" class="tab-section">
        <center><h2>Change Password Of A Student</h2></center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Admission No" class="form_text form-control  text-center" name="adminno" id="username" required="required" /> 
                </div>
              <div class="login_element ">  
                <img id="form_image" src="./images/lock.png" >
                 <input type="password" placeholder="Enter Admin Password" class="form_text form-control  text-center" name="currentpswd" id="username" required="required" /> 
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

</div>
<!-- changepswd student body ends -->
<!-- delete student body start-->
<div class="container">


<div id="body_content">
     <div class="modal fade error_reporting" id="myModaldeleteStud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['deleteStud']))
          {
            
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaldeleteStud").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $_POST['currentpswd']=md5($_POST['currentpswd']);

            if($_POST['currentpswd']!=$_SESSION['password'])
              echo "* Please enter Librarian/Admin password correctly";
            else if($_POST['adminno']!=$_POST['readminno'])
              echo "Admission Number mismatch.Enter correctly";
            else
            {

                $query2="SELECT * FROM `login student` WHERE admin_no='".$_POST['adminno']."' ";
                $query2=mysql_query($query2);
                $result2=mysql_num_rows($query2);
				  if(!$result2)
                    echo "* There is no Student with Admission Number <b>".$_POST['adminno']."</b>";
                  else
					{
					echo "All records of studnet with Admission Number <b>".$_POST['adminno']." has been deleted</b>";
						$query="DELETE FROM `login student` WHERE admin_no='".$_POST['adminno']."' ";
						mysql_query($query);
						$query="DELETE FROM `rate and review` WHERE sid='".$_POST['adminno']."' ";
						mysql_query($query);
						$query="DELETE FROM `book manager` WHERE student_id='".$_POST['adminno']."' ";
						mysql_query($query);
						$query="DELETE FROM `buyer info` WHERE sid='".$_POST['adminno']."' ";
						mysql_query($query);
						$query="DELETE FROM `preorder` WHERE sid='".$_POST['adminno']."' ";
						mysql_query($query);
						$query="DELETE FROM `seller book info` WHERE sid='".$_POST['adminno']."' ";
						mysql_query($query);
						$query="DELETE FROM `seller info` WHERE sid='".$_POST['adminno']."' ";
						mysql_query($query);
					}
            }
          }
        
        ?>
<script type="text/javascript"></script>
       </center>
   </div>
      <div class="modal-footer">
        <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
       <div class="modal fade error_reporting" id="myModaldeleteStudY" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['deleteStudY']))
          {
           

            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaldeleteStudY").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $_POST['currentpswd']=md5($_POST['currentpswd']);

            if($_POST['currentpswd']!=$_SESSION['password'])
              echo "* Please enter Librarian/Admin password correctly";
            else if($_POST['year']!=$_POST['reyear'])
              echo "Year of Admission mismatch.Enter very carefully";
            else
            {

                $query2="SELECT * FROM `login student` WHERE year_admission='".$_POST['year']."' ";
                $query2=mysql_query($query2);
                $result2=mysql_num_rows($query2);
				  if(!$result2)
                    echo "* There is no Student who took  Admission in the Year <b>".$_POST['year']."</b>";
                  else
					{
					echo "All records of studnets who took Admission In the Year <b>".$_POST['year']." has been deleted</b>";
						$query="DELETE FROM `rate and review` WHERE sid IN(SELECT admin_no FROM `login student` WHERE year_admission='".$_POST['year']."')";
						mysql_query($query);
						$query="DELETE FROM `rate and review` WHERE sid IN(SELECT admin_no FROM `login student` WHERE year_admission='".$_POST['year']."')";
						mysql_query($query);
						$query="DELETE FROM `book manager` WHERE student_id IN(SELECT admin_no FROM `login student` WHERE year_admission='".$_POST['year']."')";
						mysql_query($query);
						$query="DELETE FROM `buyer info` WHERE sid IN(SELECT admin_no FROM `login student` WHERE year_admission='".$_POST['year']."')";
						mysql_query($query);
						$query="DELETE FROM `preorder` WHERE sid IN(SELECT admin_no FROM `login student` WHERE year_admission='".$_POST['year']."')";
						mysql_query($query);
						$query="DELETE FROM `seller book info` WHERE sid IN(SELECT admin_no FROM `login student` WHERE year_admission='".$_POST['year']."')";
						mysql_query($query);
						$query="DELETE FROM `seller info` WHERE sid IN(SELECT admin_no FROM `login student` WHERE year_admission='".$_POST['year']."')";
						mysql_query($query);
						$query="DELETE FROM `login student` WHERE year_admission='".$_POST['year']."'";
						mysql_query($query);
					}
            }
          }
        
        ?>
<script type="text/javascript"></script>
       </center>
   </div>
      <div class="modal-footer">
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div> 

      <div id="deleteStud" class="tab-section">
        <center><h2>Delete A Student Record</h2></center>
         <div class="col-md-5">
			<center> <h3>Using Admission Number</h3> </center>
		<form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Admission No" class="form_text form-control  text-center" name="adminno" id="username" required="required" /> 
                </div>
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                <input type="txt"  placeholder="Re-Enter Admission No" class= "form_text form-control  text-center " name="readminno" required="required"/>
                </div>
              <div class="login_element ">  
                <img id="form_image" src="./images/lock.png" >
                 <input type="password" placeholder="Enter Admin Password" class="form_text form-control  text-center" name="currentpswd" id="username" required="required" /> 
                </div>

                
                <button type="submit" class="btn btn-primary" name="deleteStud" >
                Delete Student Records
                </button>
         </form>
		 </div>
		<div class="col-md-5">
		<center> <h3>Using Year Of Admission</h3> </center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Admission Year" class="form_text form-control  text-center" name="year" id="username" required="required" /> 
                </div>
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                <input type="txt"  placeholder="Re-Enter Year" class= "form_text form-control  text-center " name="reyear" required="required"/>
                </div>
              <div class="login_element ">  
                <img id="form_image" src="./images/lock.png" >
                 <input type="password" placeholder="Enter Admin Password" class="form_text form-control  text-center" name="currentpswd" id="username" required="required" /> 
                </div>

                
                <button type="submit" class="btn btn-primary" name="deleteStudY" >
                Delete Student Records
                </button>
         </form>
		</div>
      </div>

</div>

</div>
<!-- delete  student body ends -->
<!-- delete librarian body start-->
<div class="container">


<div id="body_content">
     <div class="modal fade error_reporting" id="myModaldeleteLib" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['deleteLib']))
          {
            
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaldeleteLib").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $_POST['currentpswd']=md5($_POST['currentpswd']);

            if($_POST['currentpswd']!=$_SESSION['password'])
              echo "* Please enter current Librarian/Admin password correctly";
            else if($_POST['staffcode']!=$_POST['restaffcode'])
              echo "Staff Code mismatch.Enter correctly";
			
            else
            { 
				
                $query2="SELECT * FROM `login librarian` WHERE staff_code='".$_POST['staffcode']."' ";
                $query2=mysql_query($query2);
                $result2=mysql_num_rows($query2);
				$query1="SELECT * FROM `login librarian` WHERE username='".$_SESSION['user']."' ";
                $query1=mysql_query($query1);
				  if(!$result2)
                    {echo "* There is no Librarian with Staff Code <b>".$_POST['staffcode']."</b>";
               

                }
                  else
					
					  if ($row=mysql_fetch_assoc($query1))
						if($row['staff_code']==$_POST['staffcode'])
							 echo " You Cannot Delete A Current Account ";
						else 
							{
								echo "All records of  Libraian With Staff Code <b>".$_POST['staffcode']." has been deleted</b>";
								$query="DELETE FROM `login librarian` WHERE staff_code='".$_POST['staffcode']."' ";
								mysql_query($query);
						
							} 
            }
          }
        
        ?>
<script type="text/javascript"></script>
       </center>
   </div>
      <div class="modal-footer">
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
      

      <div id="deleteLib" class="tab-section">
        <center><h2>Delete A Librarian Account</h2></center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Staff Code" class="form_text form-control  text-center" name="staffcode" id="username" required="required" /> 
                </div>
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                <input type="txt"  placeholder="Re-Enter Staff Code" class= "form_text form-control  text-center " name="restaffcode" required="required"/>
                </div>
              <div class="login_element ">  
                <img id="form_image" src="./images/lock.png" >
                 <input type="password" placeholder="Current Admin Password" class="form_text form-control  text-center" name="currentpswd" id="username" required="required" /> 
                </div>

                
                <button type="submit" class="btn btn-primary" name="deleteLib" >
                Delete Librarian Account
                </button>
         </form>

      </div>

</div>

</div>
<!-- delete  librarian body ends -->
<!-- delete student body start-->
<div class="container">


<div id="body_content">
     <div class="modal fade error_reporting" id="myModaldeleteBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['deleteBook']))
          {
            
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaldeleteBook").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $_POST['currentpswd']=md5($_POST['currentpswd']);

            if($_POST['currentpswd']!=$_SESSION['password'])
              echo "* Please enter Librarian/Admin password correctly";
            else if($_POST['bookno']!=$_POST['rebookno'])
              echo "Book Code Number Mismatch.Enter Book Code carefully";
            else
            {

                $query2="SELECT * FROM `book details` WHERE id='".$_POST['bookno']."' ";
                $query2=mysql_query($query2);
                $result2=mysql_num_rows($query2);
				  if(!$result2)
                    echo "* There is no Book with Code Number <b>".$_POST['bookno']."</b>";
                  else
					{
					echo "Book with Number <b>".$_POST['bookno']." has been deleted</b>";
						$query="DELETE FROM `book details` WHERE id='".$_POST['bookno']."' ";
						mysql_query($query);
						$query="DELETE FROM `rate and review` WHERE bookid='".$_POST['bookno']."' ";
						mysql_query($query);
						$query="DELETE FROM `book manager` WHERE WHERE book_id='".$_POST['bookno']."' ";
						mysql_query($query);
						$query="DELETE FROM `preorder` WHERE WHERE bookid='".$_POST['bookno']."' ";
						mysql_query($query);
						
					}
            }
          }
        
        ?>
<script type="text/javascript"></script>
       </center>
   </div>
      <div class="modal-footer">
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
      

      <div id="deleteBook" class="tab-section ">
        <center><h2>Delete A Book Record</h2></center>
		<div class="col-md-5">
		<center> <h3>Using Book Code </h3> </center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Book Code" class="form_text form-control  text-center" name="bookno" id="username" required="required" /> 
                </div>
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                <input type="txt"  placeholder="Re-Enter Book Code" class= "form_text form-control  text-center " name="rebookno" required="required"/>
                </div>
              <div class="login_element ">  
                <img id="form_image" src="./images/lock.png" >
                 <input type="password" placeholder="Enter Admin Password" class="form_text form-control  text-center" name="currentpswd" id="username" required="required" /> 
                </div>

                
                <button type="submit" class="btn btn-primary" name="deleteBook" >
                Delete Book Records
                </button>
         </form>
		</div>
		
		
      </div>

</div>

</div>
<!-- delete  Book body ends -->
<!-- add librarian body starts-->
<div class="container">
<div id="body_content">
      <div class="modal fade error_reporting" id="myModaladdLib" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      <center>
        <?php
          if(isset($_POST['addlib']))
          {	
             echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaladdLib").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

              if($_POST['staffcode']!=$_POST['restaffcode'])   
                  echo " Enter Staff Code correctly";            
             elseif(strlen($_POST['newpswd'])<=6)

             	echo "Password should be atleast 7 letters ";
              else
              {

             if($_POST['newpswd']!=$_POST['renewpswd'])
              echo "* Password mismatch.Enter passord correctly";
            else
            {
              $query1="SELECT * FROM `login student` WHERE admin_no='".$_POST['staffcode']."'   ";
               $query1=mysql_query($query1);
               $result1=mysql_num_rows($query1);

               if ($result1) {
                 echo "Staff Code Number Alreadey In Use";;
               }
              else
              {
               $_POST['newpswd']=md5($_POST['newpswd']);
              $query="INSERT INTO `login librarian` (staff_code, password,username) VALUES ('".$_POST['staffcode']."','".$_POST['newpswd']."','".$_POST['staffcode']."') ";
              $query=mysql_query($query);
              
              if($query)
                {
                  echo "A New Librarian has been successfully added.";
                }
                else
                  echo "Staff Code Number Alreadey In Use";
            }
          }
          }
      }
        
        ?>
       </center>
   </div>
      <div class="modal-footer">
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
      </div>

      <div id="addlib" class="tab-section">
        <center><h2>Add New Librarian</h2></center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Staff Code " class="form_text form-control  text-center" name="staffcode" id="username" required="required" /> 
                </div>
                <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Re-Enter Staff Code " class="form_text form-control  text-center" name="restaffcode" id="username" required="required" /> 
                </div>
              <div class="login_element ">
                <img id="form_image" src="./images/lock.png" >
                <input type="password"  placeholder="Enter A Password" class= "form_text form-control  text-center " name="newpswd" required="required"/>
                </div>

                <div class="login_element">
                <img id="form_image" src="./images/lock.png" >
                 <input type="password"  placeholder="Re-Enter New Password" class="form_text form-control  text-center" name="renewpswd" id="username" required="required" /> 
                </div>
                <input type="submit" class="btn btn-primary" name="addlib" value="Add Librarian">
         </form>

      </div>

</div>
<!-- add librarian body ends-->

<!-- edit Libraian body start-->
<div class="container">


<div id="body_content">
     <div class="modal fade error_reporting" id="myModaleditLib" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['editlib']))
          {	
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaleditLib").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $query2="SELECT * FROM `login librarian` WHERE staff_code='".$_POST['staffcode']."'   ";
 			 $query2=mysql_query($query2);
  			$result2=mysql_num_rows($query2);
  			if (!$result2) 
  			{
  			   echo " No Librarian with staff code <b>".$_POST['staffcode']." </b>is found .";
               

                
        }
  			else
  			{

  			   
           echo '<form style="display: hidden" action="editLib.php" method="POST" id="form">
                    <input type="hidden" id="var1" name="ID" value="'.$_POST['staffcode'].'"/>
                </form>
                <script type="text/javascript">
                    $(window).load(function(){$("#form").submit();});
                </script>';
  			}
        	
          }
        
        ?>

       </center>
   </div>
      <div class="modal-footer">
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
      

      <div id="editlib" class="tab-section">
        <center><h2>Edit A Librarian</h2></center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Staff Code" class="form_text form-control  text-center" name="staffcode" id="username" required="required" /> 
                </div>
              
                <input type="submit" class="btn btn-primary" name="editlib" value="Edit">
         </form>

      </div>

</div>

</div>
<!-- edit Librarian body ends -->    


<!-- add BOOK body start-->
<div class="container">
<div id="body_content">
     <div class="modal fade error_reporting" id="myModaladdBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['addBook']))
          {
            error_reporting(0);
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaladdBook").modal({keyboard:false,backdrop:"static"}); });
                 </script>';
            $myTime = date("d-m-Y", mktime(0, 0, 0, '01','01','1992'));
           
            $Date= date("d-m-Y", strtotime($_POST['b_purchase']));
           
            $author="";
            $c=$_POST['count'];
            $query2="SELECT * FROM `login student` WHERE admin_no='".$_POST['b_id']."'   ";
 			 $query2=mysql_query($query2);
  			$result2=mysql_num_rows($query2);
  			if((strtotime($Date)>strtotime(date("d-m-Y")))||(strtotime($Date)<strtotime($myTime)))
  				echo "Enter A valid date of purchase .<b>".$Date."</b> is not valid date";
             elseif ($_POST['b_id']!=$_POST['reb_id']) 
               echo "Book Code  Do not Match. Please Re-Enter Book Code";
            elseif (!$_POST['count'])
              echo "Enter An Author For Your Book";
            elseif ($_POST['b_section']=="none") 
               echo " Enter A valid Book Section";
           	elseif($result2)
           		echo "Book code ".$_POST['b_id']." should not be an admission number <br> Enter Valid Code";
             else
             {  for ($count='1'; $count<=$c ; $count++) 
                if($_POST[$count]=="")
                  continue;
                else
                $author=$author.$_POST[$count].',' ;
                $query="INSERT INTO `book details` VALUES ('".$_POST['b_id']."','$author','".$_POST['b_title']."','".$_POST['b_publication']."','".$_POST['b_edition']."','".$_POST['b_purchase']."','".$_POST['b_price']."','A','0','".$_POST['b_section']."') ";
                $query=mysql_query($query);
              
              if($query)
                  echo "<b>".$_POST['b_title']."</b> has been successfully added to Library";
              else
                  echo "Book with Book Code ".$_POST['b_id']." Already exists in our Library ";

                  
          }
            }
        ?>
       </center>
   </div>
      <div class="modal-footer">
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
      

      <div id="addBook" class="tab-section">
        <center><h2>Add New Book</h2></center>
         <form class="form-horizontal" role="form" method="post" action="admin_home.php">
   
    
    <div class="form-group">
        <label  class="col-sm-3 control-label">Enter Book Code </label>
        <div class="col-lg-4 ">
              <input type="text" class="form-control" name="b_id" value="" required="required">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">Re-Enter Book Code</label>
        <div class="col-lg-4 ">
              <input type="text" class="form-control" name="reb_id" value="" required="required">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">Enter Book Title</label>
        <div class="col-lg-4 ">
              <input type="text" class="form-control" name="b_title" value="" required="required">
        </div>
    </div>
  <div class="form-group">
        <label  class="col-sm-3 control-label">Enter Book Author</label>
        <div class="col-lg-8 " id="itemRows">
                <input onclick="addRow();" type="button" value="Add Author " class="btn btn-default" />
                             
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">Enter Book Publication</label>
        <div class="col-lg-4 ">
              <input type="text" class="form-control" name="b_publication" value="" required="required">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">Enter Book Edition</label>
        <div class="col-lg-4 ">
              <input type="text" class="form-control" name="b_edition" value="" required="required">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">Enter Book Price</label>
        <div class="col-lg-4 ">
              <input type="number" class="form-control" name="b_price" value="" required="required">
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">Enter Date of Purchase</label>
        <div class="col-lg-4 ">
              <input type="date" class="form-control" name="b_purchase" value="" required="required">
        </div>
    </div>
    
    <label  class="col-sm-6 control-label">
        <input type="submit"class="btn btn-primary" name="addBook" value="Add A New Book">
    </label>
    
  
    </form>

      </div>

</div>
<!-- add BOOK body ends -->

<!-- edit BOOK body start-->
<div class="container">


<div id="body_content">
     <div class="modal fade error_reporting" id="myModaleditStud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
      
      <center>
        <?php
          if(isset($_POST['editstud']))
          {
            
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#myModaleditStud").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

            $_POST['currentpswd']=md5($_POST['currentpswd']);

            if($_POST['currentpswd']!=$_SESSION['password'])
              echo "* Please enter Librarian/Admin password correctly";
            elseif (strlen($_POST['newpswd'])<=6)
              echo "Password should be atleast 7 letters ";
            else if($_POST['newpswd']!=$_POST['renewpswd'])
              echo "* Password mismatch.Enter passord correctly";
            else
            {

                $query2="SELECT * FROM `login student` WHERE admin_no='".$_POST['adminno']."' ";
                $query2=mysql_query($query2);
                $result2=mysql_num_rows($query2);
                if(!$result2)
                    echo "* There is no Student with Admission Number <b>".$_POST['adminno']."</b>";
                  else
                  {
              $_POST['newpswd']= md5($_POST['newpswd']);
               $_SESSION['password']=$_POST['newpswd'];
              $query="UPDATE `login student` SET password='".$_POST['newpswd']."' WHERE admin_no='".$_POST['adminno']."' ";
              $query=mysql_query($query);
              
              if($query)
                {
                  echo "Password has been successfully changed.";
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
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>       
      

      <div id="changepswdStud" class="tab-section">
        <center><h2>Change Password Of A Student</h2></center>
         <form action="admin_home.php" method="post" class="form-inline " id="forms">

          
              <div class="login_element ">
                <img id="form_image" src="./images/user.png" >
                 <input type="text" placeholder="Enter Admission No" class="form_text form-control  text-center" name="adminno" id="username" required="required" /> 
                </div>
              <div class="login_element ">  
                <img id="form_image" src="./images/lock.png" >
                 <input type="password" placeholder="Enter Admin Password" class="form_text form-control  text-center" name="currentpswd" id="username" required="required" /> 
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

</div>


<div class="content" id="home">
<div>
<div class="jumbotron">
  <center>
  <h2>Hello Admin,</h2>
  <p>You can select Options From The Menu</p>
  </center>



</div>
</div>

<!-- Notification-->
<div class="panel-group col-md-5" id="accordion">
  <div class="panel panel-default ">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
      <h4 class="panel-title">
     <span class="badge pull">0</span>
     Notifications 
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">
       All caught Up..!!
      </div>
    </div>
  </div>
  
</div>
</div>
<!-- Notification End-->

<!-- edit BOOK body ends -->


<!-- to search a book based on title and  id -->
<?php include 'search.php';?>
<script>
$(function() {
                                                                            
$( "#accordion" ).accordion();
                                                                            

                                                                            
var availableTags =<?php echo json_encode(searchTitle()); ?>;
var tags =<?php echo json_encode(searchTitle());?>;
$( "#autocomplete" ).autocomplete({

source: availableTags

                                                                              
});

});
</script>

<div id="searchBook" class="tab-section">

             
           <center>
                                                                       
                                                                           

   
   <center><h2>Search A Book</h2></center>
   <div class="content2 container">
   <div >
   <form class="form-search " role="search" action="searchList.php" method="POST">
  <div class="form-group ">
    <input class="form-control text-center " type="text" id="autocomplete"  name="btitle" placeholder="Enter Book Title">
   </div>  
   <div class="form-group ">
      <input type="submit" class="btn btn-large  btn-primary "   name="title" value="Search">
    
  </div>
  </form>
  </div>
  
                                                                      

   </div>                                                             


      </div>
</div>

<?php
if(isset($_POST['admintitle_submit']))
   {
         $a= $_POST['admintitle'];
         $a="%".$a."%";
         
         
                            $query1="SELECT * FROM `book details` WHERE title LIKE '$a' ";
                            $query1=mysql_query($query1);
                            $result1=mysql_num_rows($query1);
                           
              if($result1)
              {
                 while ($row=mysql_fetch_assoc($query1))
                 {
                      $title=$row['title'];
                      $id=$row['id'];       
                      $author=$row['author'];
                      $publisher=$row['publication'];
                      $edition=$row['edition'];
                     
                      $section=$row['section'];
            
                          ?>

                                     <div id="Edit" >
                                  <center><h2>Book Info</h2></center>
                                  <form class="form-horizontal" role="form" method="post" action="signup.php">

                                   <div class="form-group">
                                      <label  class="col-sm-3 control-label">BOOK id:</label>
                                      <div class="col-lg-3 ">   
                                       <p class="form-control-static"> <?php echo $id ?> </p>
                                      </div>
                                  </div> 
                                 
                                  <div class="form-group">
                                      <label  class="col-sm-3 control-label">Title:</label>
                                      <div class="col-lg-3 ">   
                                       <p class="form-control-static"> <?php echo $title ?> </p>
                                      </div>
                                  </div> 

                                  

                                  <div class="form-group">
                                      <label  class="col-sm-3 control-label">Author:</label>
                                      <div class="col-lg-3 ">   
                                       <p class="form-control-static"> <?php echo $author ?> </p>
                                      </div>
                                  </div> 

                                   <div class="form-group">
                                      <label  class="col-sm-3 control-label">Publication:</label>
                                      <div class="col-lg-3 ">   
                                       <p class="form-control-static"> <?php echo $publisher ?> </p>
                                      </div>
                                  </div> 

                                   <div class="form-group">
                                      <label  class="col-sm-3 control-label">Edition:</label>
                                      <div class="col-lg-3 ">   
                                       <p class="form-control-static"> <?php echo $edition ?> </p>
                                      </div>
                                  </div>  

                              <div class="form-group">
                                      <label  class="col-sm-3 control-label">Section:</label>
                                      <div class="col-lg-3 ">   
                                       <p class="form-control-static"> <?php echo $section ?> </p>
                                      </div>
                                  </div>  
                                  </form>
    
    
    
     </div>
     </div>
<hr>
<hr>
<hr>

            <?php
           
                }
            } 
         }   


?>
<!--                  issuing books
====================================================================================================================   -->
<div id="issueBook" class="tab-section">

      <div id="body_content">

    <center><h2>Issuing Books</h2></center><br><br>

  <!--sss-->
  

          <?php
          $query2=mysql_query("SELECT * FROM `preorder` WHERE Status='WAITING' ORDER BY bookid,time "  );
                            
                            $result2=mysql_num_rows($query2);
                            

          if (!$result2) {
            echo `<div class="jumbotron"><div class="container"><center><b> You Have Not Taken Any Books Yet</b></center></div></div>`;
          }
          else
          { ?>
        
      
       <div class="table-responsive">
         <table class="table table-hover">
           <thead>
             <th width="500px;">BOOK ID</th>
             <th width="500px;">BOOK TITLE</th>
             <th width="100px;">SECTION</th>
             <th width="100px;">DATE of Order</th>
             <th width="100px;">Name of student</th>
             <th width="300px;"></th>
           </thead>
<?php
while($row=mysql_fetch_assoc($query2))
{
        $tsid=$row['sid'];
        
        $bid=$row['bookid'];
       $temp2=mysql_query("SELECT id,title,section FROM `book details` WHERE id='$bid' ") ; 
      
       $temp=mysql_query("SELECT firstname FROM `login student` WHERE admin_no='$tsid' ") ;
     
          if($user=mysql_fetch_assoc($temp))
          {
            $x=$user['firstname'];

          } 
          if($book=mysql_fetch_assoc($temp2))
          {
            $y=$book['title'];
               $z= $book['section'];
          }               
                  
                
         ?>
                <!--while loop to print all details of uploaded book-->
             
            <tr>
              
              <tbody>
                      <td><?php echo $bid; ?> </td>
                       <td ><?php echo $y;?></td>
                       <td><?php echo $z;?></td>
                       <td><?php echo $row['time']?></td>  
                      
                       <td><?php echo $x; ?> </td>
                      <td>
                              <form  action="#" method="POST" id="form">
                              <input type="hidden" id="var1" name="issueuser" value=<?php  echo $row['sid']; ?> />
                              <input type="hidden" id="var1" name="issuebook" value=<?php  echo $row['bookid']; ?> />
                               <input type="hidden" id="var1" name="issuetime" value=<?php  echo $row['time']; ?> />
                          
                                <label  class="col-sm-6 control-label">
                                <button type="submit"class="btn btn-large btn-block btn-warning" id="form" name="issue"  >ISSUE</button>
                            </label>
                            
                        </td>
                        </form>
                       
              </tbody>              

            </tr> 

            <?php 
            
}
            //end of while loop
           }   
            ?>
        
         </table>
         </div>

      </div>
</div>
<div class="modal fade error_reporting" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">


      <?php
       if(isset($_POST['issue']))
        {
          $xy= $_POST['issueuser'];
         
          $yz= $_POST['issuebook'];
          $d_of_issue=date('Y-m-d ');
         
          

          $stop_date = $d_of_issue;

$stop_date = date('Y-m-d H:i:s', strtotime($stop_date . ' + 10 day'));
          $d_of_ret=$stop_date;
         
          if($query3=mysql_query(" INSERT INTO `book manager` (book_id, date_issue, date_return, student_id) VALUES ('$yz', '$d_of_issue','$d_of_ret', '$xy')"))
            {
                  $query2="UPDATE `preorder` SET Status = 'ISSUED' WHERE sid = '$xy' AND bookid = '$yz'";
         
                  mysql_query("UPDATE `book details` SET status='NA' WHERE id='$yz'");
                           
                           if(mysql_query($query2));
                              echo '<script type="text/javascript">
                            $("#cancelModal").modal({kyboard:false,backdrop:"static"}); 
                         </script>';


        
                    echo "BooK is ISSUED successfully";
               
               }
               else
               {
                echo '<script type="text/javascript">
                            $("#cancelModal").modal({kyboard:false,backdrop:"static"}); 
                         </script>';
                   
    
                echo "Alredy issued ";
               
               }
                   
                
}
      ?>
</div>
      <div class="modal-footer">
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>  






<!--return book
======================================================================================= -->
<div id="returnBook" class="tab-section" >
 <center><h2>  BOOK code</h2></center>
<form class="form-horizontal" role="form" method="post" action="#">
    <div class="login_element ">
    <input type="text" placeholder="Enter BOOK Code" class="form_text form-control  text-center" name="returncode" id="username" required="required" /> 
    </div>
    <div class="login_element">
    <input type="text" placeholder="Re-Enter BOOK Code" class="form_text form-control  text-center" name="re-returncode" id="username" required="required" /> 
    </div>
    <input type="submit"class="btn btn-primary" name="returnbuk" value="return">
 </form> 

</div>
<div class="modal fade error_reporting" id="myModalreturnBOOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
<?php
if(isset($_POST['returnbuk']))
{
  echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModalreturnBOOK").modal({keyboard:false,backdrop:"static"}); });
                         </script>';

  if ($_POST['returncode']!==$_POST['re-returncode']) 
    echo " Book Code Does not match . Enter BOOK code carefully";
  else
  {
  $yz= $_POST['returncode'];
  $q=mysql_query("SELECT * FROM `preorder` LEFT JOIN `book manager` ON book_id='$yz' WHERE bookid='$yz' AND Status='ISSUED'");
  $r=mysql_num_rows($q);
  if($r){

        if($row=mysql_fetch_assoc($q))
          {
                            if ($row['Status']=='ISSUED'&& ($row['date_return']<date('Y-m-d ')))
                             {  

                                $today=date('Y-m-d ');
                                $date1=date_create($row['date_return']);
                                $date2=date_create($today);
                                $diff=date_diff($date1,$date2);
                                $fine_days= $diff->format("%R%a days");
                                if($fine_days)
                                  {
                                    $fine=$fine_days*5;
                                    mysql_query("UPDATE `book details` SET fine_collection='$fine' WHERE id='$yz'");
                                    echo " Fine Charged : <b> Rs.".$fine."</b><br>";
                                  }
                        
                            }
 mysql_query("DELETE FROM `preorder` WHERE bookid='$yz' AND Status='ISSUED'");
 mysql_query("DELETE FROM `book manager` WHERE book_id='$yz' ");
 mysql_query("UPDATE `book details` SET status='A' WHERE id='$yz'");
echo "book returns sucessfully";

 }
}
else
echo " Sorry...There is no book with id <b> ".$yz."</b>";
}

}


?>




      </div>
      <div class="modal-footer">
        
         <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
     
      </div>
    </div>
  </div>
</div>






<!-- edit book details 
============================================================================================== -->

<div id="editBook" class="tab-section" >
 <center><h2> EDIT BOOK code</h2></center>
<form class="form-horizontal" role="form" method="post" action="#">
    <div class="login_element ">
    <img id="form_image" src="./images/user.png" >
    <input type="text" placeholder="Enter BOOK Code" class="form_text form-control  text-center" name="editcode" id="username" required="required" /> 
    </div>
    <input type="submit"class="btn btn-primary" name="editbuk" value="search">
 </form> 

</div>
 <div id="body_content">

<?php
if(isset($_POST['editbuk']))
{

  $a=$_POST['editcode'];
  
  $query4=mysql_query("SELECT * FROM `book details` WHERE id='$a'");
  $num4=mysql_num_rows($query4);
  if($num4)
  {
      if($row4=mysql_fetch_assoc($query4))
      {
?>
              <center><h2>Edit Book Information</h2></center>
              <form class="form-horizontal" role="form" method="post" action="#">
              <div class="form-group">
                  <label class="col-sm-3 control-label">Book Code</label>
                  <div class="col-sm-3">
                      <p class="form-control-static"> <?php echo $_POST['editcode']; ?> </p>
                  </div>
              </div>
              
              <div class="form-group">
                  <label  class="col-sm-3 control-label">TITLE</label>
                  <div class="col-lg-3 ">
                        <input type="text" class="form-control" name="u_title" value="<?php echo $row4['title']; ?>" required="required">
                  </div>
              </div>
              <div class="form-group">
                   <label  class="col-sm-3 control-label">Author</label>
                    <div class="col-lg-3 ">
                        <input type="text" class="form-control" name="u_author" value="<?php echo $row4['author']; ?>" required="required">
                    </div>
              </div>
              <div class="form-group">
                    <label  class="col-sm-3 control-label">Publication</label>
                    <div class="col-lg-3 ">
                          <input type="text" class="form-control" name="u_publication" value="<?php echo $row4['publication']; ?>" required="required">
                    </div>
              </div>
              <div class="form-group">
                    <label  class="col-sm-3 control-label">Edition</label>
                    <div class="col-lg-3 ">
                        <input type="text" class="form-control" name="u_edition" value="<?php echo $row4['edition']; ?>" required="required">
                    </div>
              </div>

               <div class="form-group">
                  <label class="col-sm-3 control-label">Book Section</label>
                  <div class="col-sm-3">
                      <p class="form-control-static"> <?php echo $row4['section']; ?> </p>
                  </div>
              </div>
              
            <label  class="col-sm-6 control-label">
                  <input type="submit"class="btn btn-primary" name="update_book" value="Update">
              </label>
              <input type="hidden" name="u_id" value="<?php echo $row4['id']; ?>">
            
            

             
              </form>  

<?php
}
}
else
{
 ?> 

<div class="container">
<div id="body_content">
     <div class="modal fade error_reporting" id="myModalbooked" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">


<?php
echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModalbooked").modal({keyboard:false,backdrop:"static"}); });
                         </script>';
  echo "no Book found";
?>
 </div>
      <div class="modal-footer">
        <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close">Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>
 


<?php  
}    
}    
?>
 <div class="container">
<div id="body_content">
       <div class="modal fade error_reporting" id="mymodalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
<?php
          if(isset($_POST['update_book']))
          {
              
            echo '<script type="text/javascript">
                  $(window).load(function(){   $("#mymodalUpdate").modal({keyboard:false,backdrop:"static"}); });
                 </script>';

              if($query="UPDATE `book details` SET author='".$_POST['u_author']."',title='".$_POST['u_title']."',publication='".$_POST['u_publication']."',edition='".$_POST['u_edition']."' WHERE id='".$_POST['u_id']."' ")
              
              $query=mysql_query($query);
              
              if($query)
                {
                  echo " details updated Succesfully";
                  
                
                }
                else
                  echo "Internal Error";
            }
         
        
        ?>
       </center>
  </div>

  <div class="modal-footer">
        <form method="GET" action="admin_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
</div>



<!-- edit book ends
================================================================================================================= -->
<!--



<!-- body ends -->
  </body>
  </html>