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
  $_SESSION['expire']+=60;

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


 
 <?php }
 ?>


 <?php 
 
 $_POST['ID'] = substr($_POST['ID'], 0, -1);

$query=mysql_query("SELECT * FROM `login student` WHERE  admin_no='".$_POST['ID']."'  ");
$result=mysql_num_rows($query);
if($result)
{
    while($row=mysql_fetch_assoc($query))
    {
       $admin_no=$row['admin_no']; 
      ?>
<div id="Edit" >
    <center><h2>Student Info</h2></center>
    <form class="form-horizontal" role="form" method="post" action="signup.php">
   

      <div class="form-group">
        <label  class="col-sm-3 control-label">name:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $row['firstname'].$row['lastname']; ?> </p>
        </div>
    </div>  
<div class="form-group">
        <label  class="col-sm-3 control-label">Sex :</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $row['sex']; ?> </p>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label"> email:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $row['email']; ?> </p>
        </div>
    </div>  

    <div class="form-group">
        <label  class="col-sm-3 control-label">Admission no:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $row['admin_no']; ?> </p>
        </div>
    </div>  

    <div class="form-group">
        <label  class="col-sm-3 control-label">Mobile Number:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $row['mobno']; ?> </p>
        </div>
    </div> 
    <div class="form-group">
        <label  class="col-sm-3 control-label">Year Of Admission:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $row['year_admission']; ?> </p>
        </div>
    </div>  
    </form>
    </div>
<div id="Edit" >
    <center><h2>Transaction Details</h2></center>
    <div class="jumbotron">
 <table class="table table-hover">
          <thead>
            <th>Book ID</th>
            <th>book title</th>
            <th>author</th>
            <th>section</th>
            <th>Status</th>
            <th>Order/Issue Date</th>
            <th>Return Date</th>
            <th>Fine</th>

            <th ></th>
            
          </thead>
    
<?php
    }
}
else
{
  header('location:admin_home.php');
} 

if($query=mysql_query("SELECT * FROM  `book details` 
INNER JOIN  `preorder` ON  `preorder`.bookid =  `book details`.id AND `preorder`.sid='".$_POST['ID']."' LEFT JOIN  `book manager` ON  `book manager`.book_id =  `book details`.id  AND `book manager`.student_id='".$_POST['ID']."' WHERE id IN ( SELECT bookid FROM  `preorder`  WHERE sid ='".$_POST['ID']."')")); 
  
{
    while($row=mysql_fetch_assoc($query))
    {
      
      ?>
           <tr>
              
              <tbody>
                        <td> <?php echo $row['id'];?>  </td>   
                        <td> <?php echo $row['title'];?> </td>
                        <td><?php echo $row['author'];?> </td>
                        <td><?php echo $row['section'];?> </td>
                        <td><?php echo $row['Status'];?> </td>
                        <td>
                        <?php 
                         if ($row['Status']=='WAITING')
                           echo $row['time'];
                         else
                           echo $row['date_issue'];
                        ?> </td>
                        <td><?php 
                          if ($row['Status']=='ISSUED') echo $row['date_return']; ?></td>
                        <td><?php 
                          if ($row['Status']=='ISSUED'&& ($row['date_return']<date('Y-m-d ')))
                           {  

                              $today=date('Y-m-d ');
                              $date1=date_create($row['date_return']);
                              $date2=date_create($today);
                              $diff=date_diff($date1,$date2);
                              $fine_days= $diff->format("%R%a days");
                              if($fine_days)
                                echo "Rs.".($fine_days*5);
                      
                          }?> 
                        </td>
                        <td>
                         <?php if ($row['Status']=='WAITING') {?>
                         <form  action="admin_home.php" method="POST" class="form-group">
                             <input type="hidden" id="var1" name="issueuser" value=<?php  echo $admin_no; ?> />
                              <input type="hidden" id="var1" name="issuebook" value=<?php  echo $row['id']; ?> />
                              
                                
                                <button type="submit"class="btn btn-large btn-block btn-warning" id="form" name="issue"  >ISSUE</button>
                            
                           
                        </form>
                        <?php }?>
                        </td>
              </tbody>              

            </tr> 

        
    </div>

<?php
    }
//}
}

 ?>
<!-- body ends -->
  </body>
  </html>
  
