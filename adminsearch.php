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
  					
  			
  			   <a href="logout.php"><li id="logout"> Logout </li></a>
		</ul>
							
							
		
						
		</div>				

		</div>

	</div>
	</div>
  <?php } ?>

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
                        $temp=mysql_query("SELECT `Status` FROM `preorder` WHERE bookid='$id' " );
                        
                        if($cur=mysql_fetch_assoc($temp))
                        {
                        $s=$cur['Status'];
                        
                        }
                        else
                        {
                            $s='available';
                        }
            
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
                               <div class="form-group">
                                      <label  class="col-sm-3 control-label">Status:</label>
                                      <div class="col-lg-3 ">   
                                       <p class="form-control-static"> <?php echo $s ?> </p>
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



<?php
if(isset($_POST['search_admin_id_submit']))
   {
         $a= $_POST['search_admin_id'];
        
         
                            $query1="SELECT * FROM `book details` WHERE id='$a' ";
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
                        $temp=mysql_query("SELECT Status from `preorder` where bookid='$id'");
                        
                        if($cur=mysql_fetch_assoc($temp))
                        {
                        $s=$cur['Status'];
                        
                        }
                        else
                        {
                            $s='available';
                        }
            
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
                               <div class="form-group">
                                      <label  class="col-sm-3 control-label">Status:</label>
                                      <div class="col-lg-3 ">   
                                       <p class="form-control-static"> <?php echo $s ?> </p>
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



  </body>
  </head>