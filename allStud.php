<!doctype html>
<?php
require 'connect.php';
session_start();

if(($_SESSION['usertype']!="admin")||($_SESSION['expire']<=time()))
 {			session_destroy();
 			header('location:logout.php');
 }
 else
 {
 $_SESSION['expire']+=60;
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

 <div class="container">
   
<!-- search TITLE List -->
<div class=" content container" >
  <p class="text-center"><h3>STUDENT LIST</h3></p>
<div class="jumbotron">

       
      
        <table class="table table-hover">
          <thead>
            <th width="200px">Admission Number</th>
            <th width="200px">Name</th>
            <th width="50px">Year</th>
            <th width="100px">Mobile No</th>
            <th>E-mail</th>
            <th></th>
            
          </thead>
                
      <?php
           
           if (isset($_POST['admno'])) 
           {

            $a= $_POST['admno'];
              $a="%".$a."%";
               

              $query1="SELECT admin_no,firstname,lastname,email,mobno,year_admission FROM `login student` WHERE admin_no LIKE '$a' ";
              $query1=mysql_query($query1);
              $result1=mysql_num_rows($query1);
              if($result1)
              {
              while($row=mysql_fetch_assoc($query1))
              {
                              
                  if($row['mobno']==0)
                    continue;
                
         ?>
                <!--while loop to print all details of uploaded book-->
            <tr>
              
              <tbody>
                        
                        <td> <?php echo $row['admin_no'];?> </td>
                        <td><?php echo $row['firstname'].$row['lastname'];?> </td>
                        <td><?php echo $row['year_admission'];?> </td>
                         <td><?php echo $row['mobno'];?> </td>
                         <td><?php echo $row['email'];?> </td>
                        <td>
                         <form  action="searchStud.php" method="POST" class="form-group">
                          <input type="hidden" id="var1" name="ID" value=<?php echo $row['admin_no'];?>/>
                          
                           
                            <input type="submit"class="btn btn-large btn-block btn-primary" value="more details">
                            
                            
                        </form>
                        </td>
              </tbody>              

            </tr> 

            <?php 
            
        }
            //end of while loop
        } //end of if ()     
        else
        {
              $query1="SELECT admin_no,firstname,lastname,email,mobno,year_admission FROM `login student` ORDER BY firstname ";
              $query1=mysql_query($query1);
               while($row=mysql_fetch_assoc($query1))
              {
                if ($row['mobno']==0) 
                  continue;
            ?>
        
               <!--while loop to print all details of uploaded book-->
            <tr>
              
              <tbody>
                        
                        <td> <?php echo $row['admin_no'];?> </td>
                        <td><?php echo $row['firstname']." ".$row['lastname'];?> </td>
                        <td><?php echo $row['year_admission'];?> </td>
                        <td><?php echo $row['mobno'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td>
                         <form  action="searchStud.php" method="POST" class="form-group">
                          <input type="hidden" id="var1" name="ID" value=<?php echo $row['admin_no'];?>/>
                          
                           
                            <input type="submit"class="btn btn-large btn-block btn-primary" value="More Details">
                            
                            
                        </form>
                        </td>
              </tbody>              

            </tr> 

        <?php } //while
              } //else
            } //isset if ()
            else

            {
              //header('location:admin_home.php');
            }
        ?>
         </table>
         </div><!--end div table responsive-->
          </div>  



 <!-- END search LIST -->         


 </div>
 <?php } ?>
<!-- body ends -->
  </body>
  </html>
  
