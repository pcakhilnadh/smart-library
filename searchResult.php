<!doctype html>
<?php
session_start();
$_SESSION['expire']+=60;
require 'connect.php';
?>

<html>
 <head>
 	   <link rel="stylesheet" type="text/css" href="./styles/rateit.css">
       <link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
       <link rel="stylesheet" type="text/css" href="styles/mystyles.css">
       <link rel="stylesheet" type="text/css" href="styles/customstyle.css">
       <title>Smart Library</title>
     <script type="text/javascript" src="./js/jquery-1.10.2.js"></script>
     <script type="text/javascript" src="./js/jquery.min.js"></script>
     <script type="text/javascript" src="./js/bootstrap.js"></script>
       <script type="text/javascript" src="./js/jquery.sticky.js"></script>
       <script type="text/javascript" src="./js/tabs.js"></script>
       <script type="text/javascript" src="./js/duplicate.js"></script>
        <script type="text/javascript" src="./js/jquery.rateit.min.js"></script>
    
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
              <!--<li class="nav navbar-nav header_bar_text">Hi <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>, </li>-->
        
        <div class = "collapse navbar-collapse navHeaderCollapse ">
            <ul>
          <a href="index.php" class="active"><li> Home </li></a>
          
         
           <a href="logout.php"><li id="logout"> Logout </li></a>
    </ul>
              
              
    
            
    </div>        

    </div>

  </div>
  </div>
  <?php
     if(isset($_GET['ID1']))   
     {   
          $search= array();
          $string=$_GET['ID1'];
        

          $search=explode("/", $string);
          
         
           $a=$search[0];
                    
          
         
          $query2="SELECT * FROM `book details` WHERE id='$a'";
          
           $query2=mysql_query($query2);
          
          $result2=mysql_num_rows($query2);
  
 
   if($result2)
  {
     if ($row=mysql_fetch_assoc($query2))
     {  echo "<br>";
       $id=$row['id'];     
        $title=$row['title'];
        $author=$row['author'];
        $publisher=$row['publication'];
        $edition=$row['edition'];
        $status=$row['status'];
        $section=$row['section'];
        $fine=$row['fine_collection'];
        
    }
  } 
 
  ?>
<div class="container">
<center><h2>Book Details</h2></center>
<div class="section col-md-8">
  <div>
    
    <form class="form-horizontal" role="form" method="post" >


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
        <label  class="col-sm-3 control-label">Status:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $status ?> </p>
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-3 control-label">Section:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $section ?> </p>
        </div>
    </div> 
<?php if($_SESSION['usertype']=='admin') { ?>
<div class="form-group">
        <label  class="col-sm-3 control-label">Total Fine Collected:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo "Rs.".$fine ?> </p>
        </div>
    </div>
     <?php } ?>
    </form>
    </div>

    <center>
    
    
  
   
    </center>
</div> <!-- Section End -->
<div>
<?php
$q=mysql_query("SELECT bookid, SUM( rate ) AS sum, COUNT( * ) AS count FROM  `rate and review`  WHERE bookid =  '$id'");

if($row=mysql_fetch_assoc($q))
  if($row['count'])
      $Overall_rating = $row['sum']/$row['count'];
    else
      $Overall_rating=0;

 
?>
 
 <div class="form-group">
        
        <div>
        <label  class="col-sm-1 control-label">Rating :</label>
        <div class="">   
         <p class="form-control-static"> 
         <div class="rateit" data-rateit-value=<?php echo $Overall_rating; ?> data-rateit-ispreset="true" data-rateit-readonly="true"></div>
         </p>
         </div>
         </div>
         <div>
        <label  class="col-sm-1 control-label"></label>
        <div class="">   
         <p class="form-control-static"> Overall Rating:
         <?php echo $Overall_rating; ?>
         
         </p>
          </div>
         </div>
         <div>
        <label  class="col-sm-1 control-label"></label>
        <div class="">   
         <p class="form-control-static"> Based on:
         <?php echo $row['count']; ?> Reviews
         
         </p>
          </div>
         </div>

        </div>
    </div>
    <div class="form-group">	
    <?php if ($_SESSION['usertype']=='stud') {
     ?>
 <form action="library_home.php" class="form-horizontal" method="POST">
    <input type="hidden" id="var1" name="ID1" value=<?php echo $id ;?>/>
    
    <input type="submit"  class="btn btn-large  btn-primary" name="booknow" value="Order This Now">
    </form>
 </div>
</div> <!-- Section End -->
</div>  <!-- Container End-->


    <?php
      }
?>

</div></div></div>

<!--Transaction-->
<div class="container">
<h2><center>Transaction Details</center></h2>

<div class="jumbotron">
 <table class="table table-hover">
          <thead>
            <th>Admission No</th>
            <th>Name</th>
            <th>Status</th>
            <th>Order/Issue Date</th>
            <th>Return Date</th>
           
            <th ></th>
            
          </thead>
    
<?php

if($query=mysql_query("SELECT * FROM `preorder` LEFT JOIN `login student` ON `login student`.admin_no= `preorder`.sid LEFT JOIN `book manager` ON `book manager`.book_id= `preorder`.bookid LEFT JOIN `book details` ON  `book details`.id= `preorder`.bookid WHERE bookid='$id'"));
{
    while($row=mysql_fetch_assoc($query))
    {
      
      ?>
           <tr>
              
              <tbody>
                        <td> <?php echo $row['admin_no'];?>  </td>   
                        <td> <?php echo $row['firstname']." ".$row['lastname'];?> </td>
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
            
                        
                        
                        <?php }}?>
              </tbody>              

            </tr> 
        </table>
        
    </div>
</div>
<!--Transaction End-->
<!--COMMENT-->
<div class="container">
<h2><center>Comments</center></h2>
<?php $q=mysql_query("SELECT * FROM `rate and review` LEFT JOIN `login student` ON `login student`.admin_no= `rate and review`.sid WHERE bookid='$id'");
  
  while ($row=mysql_fetch_assoc($q)) {
   
 ?>

<!--commet body start-->
<div class="col-md-6">
  
 <div class="panel panel-info">
  <div class="panel-heading"><?php echo $row['firstname']." ".$row['lastname']; ?> , says</div>
  <div class="panel-body">
    <?php echo $row['comment']; ?>
  </div>
</div>


 </div>
 <?php }?>
<!--commets end-->

</div>
<!--COMMENT end-->




</div>
  <?php }
  else
    header('location:index.php')
  ?>

</body>
</html>