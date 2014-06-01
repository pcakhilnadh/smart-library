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
       <title>BoOkArT_HoME</title>
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
 
		
 <!-- main heading ends -->

</div>
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
									  <a href="home.php" class="active"><li> Home </li></a>
									  
									 
									   <a href="logout.php"><li id="logout"> Logout </li></a>
										</ul>
              
              
    
            
									</div>        

					</div>

				</div>
				 </div>
<?php
  } 
			if(isset($_POST['titlesearch']))
			{
							 $a= $_POST['btitle'];
							 $a="%".$a."%";
							 
						  $query1="SELECT * FROM `seller book info` WHERE title LIKE '$a' ";
						  $query1=mysql_query($query1);
						  $result1=mysql_num_rows($query1);
						 
              if($result1)
              {
                 if ($row=mysql_fetch_assoc($query1))
                 {
                    $title=$row['title'];
                    $bid=$row['book_uid'];
					$author=$row['author'];
					$publisher=$row['publication'];
					$edition=$row['edition'];
					$sid=$row['sid'];
					$query2="SELECT * FROM `login student` WHERE admin_no='$sid'";
					$query2=mysql_query($query2);
					$result2=mysql_num_rows($query2);
							if($result2)
							{
								if ($row=mysql_fetch_assoc($query2))
								{
									$sid=$row['admin_no'];
									$fname=$row['firstname'];
									$lname=$row['lastname'];
									$uname=$row['username'];
									$email=$row['email'];
									$mobno=$row['mobno'];
						   
								}
							} 
?>
            <div id="Edit" >
			   <center><h2>Book Info</h2></center>
				   <form class="form-horizontal" role="form" method="post" action="signup.php">
   
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

							

    
				    </form>
		    </div>
    </div>



     <div id="Edit" >
			<center><h2>Uploader Info</h2></center>
				<form class="form-horizontal" role="form" method="post" >

						  <div class="form-group">
							<label class="col-sm-3 control-label">
							  <?php
							  
								  echo "Name :";
							 
							  ?>
							</label>
							<div class="col-sm-3">
								<p class="form-control-static"> <?php echo $fname.$lname ?> </p>
							</div>
						</div>

							<div class="form-group">
								<label  class="col-sm-3 control-label">Email:</label>
								<div class="col-lg-3 ">   
								 <p class="form-control-static"> <?php echo $email ?> </p>
								</div>
								
								
							</div>
    

    

							<div class="form-group">
								<label  class="col-sm-3 control-label">Mobile Number:</label>
								<div class="col-lg-3 ">   
								 <p class="form-control-static"> <?php echo $mobno ?> </p>
								</div>
							</div>  

				</form >
     </div>
			<center>
    
				<form action="bookart_home.php" class="form-horizontal" method="POST">
						<input type="hidden" id="var1" name="ID1" value=<?php echo $sid ?>/>
						<input type="hidden" id="var1" name="ID2" value=<?php echo $bid ?>/>
						<input type="hidden" id="var1" name="mailid" value=<?php echo $email ?>/>
						<input type="hidden" id="var1" name="query" value=<?php echo $sid ?>/>
						<input type="submit"  class="btn btn-large  btn-primary" name="booknow" value="book now">
				</form>
    <br><br>
				<form action="home.php" class="form-horizontal">
				 <input type="submit"  class="btn btn-large  btn-primary" name="cancel" value="cancel">
				 </form>
			</center>

<!--pop up window-->

      

                                          


  


            <?php
           
                }
               } 

            else    
            {
              echo "internel error student";
              echo '<br>';
            }

        }

	   if(isset($_POST['authorsearch']))
	   {
				$b=$_POST['bauthor'];
				$b= '%'.$b.'%';
			   
				$query2="SELECT * FROM `seller book info` WHERE author LIKE '$b'" ;
				 $query2=mysql_query($query2);
				 $result2=mysql_num_rows($query2);

					   if($result2)
					  {
									 if ($row=mysql_fetch_assoc($query2))
									 {   
									$title=$row['title'];
								   $bid=$row['book_uid'];
									$author=$row['author'];
									$publisher=$row['publication'];
									$edition=$row['edition'];
									$sid=$row['sid'];
									$query3="SELECT * FROM `login student` WHERE admin_no='$sid'";
									$query3=mysql_query($query3);
									$result3=mysql_num_rows($query3);
										if($result3)
										{
											while($row=mysql_fetch_assoc($query3))
											  {
												$sid=$row['admin_no'];
												$fname=$row['firstname'];
												$lname=$row['lastname'];
												$uname=$row['username'];
												$email=$row['email'];
												$mobno=$row['mobno'];
									   
											  }
										} 
           
?>
       <div id="Edit" >
    <center><h2>Book Info</h2></center>
    <form class="form-horizontal" role="form" method="post" action="signup.php">
   
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

    
     <div id="Edit" >
    <center><h2>Uploader Info</h2></center>
    <form class="form-horizontal" role="form" method="post" >

      <div class="form-group">
        <label class="col-sm-3 control-label">
          <?php
          
              echo "Name :";
         
          ?>
        </label>
        <div class="col-sm-3">
            <p class="form-control-static"> <?php echo $fname.$lname ?> </p>
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-3 control-label">Email:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $email ?> </p>
        </div>
        
        
    </div>
    

    

    <div class="form-group">
        <label  class="col-sm-3 control-label">Mobile Number:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $mobno ?> </p>
        </div>
    </div>  

    </form >
    </div>
    <center>
   
    <form action="bookart_home.php" class="form-horizontal" method="POST">
    <input type="hidden" id="var1" name="ID1" value=<?php echo $sid ?>/>
    <input type="hidden" id="var1" name="ID2" value=<?php echo $bid ?>/>
    <input type="hidden" id="var1" name="mailid" value=<?php echo $email ?>/>
    <input type="hidden" id="var1" name="query" value=<?php echo $sid ?>/>
    <input type="submit"  class="btn btn-large  btn-primary" name="booknow" value="book now">
    </form>
    
    <form action="home.php" class="form-horizontal">
     <input type="submit"  class="btn btn-large  btn-primary" name="cancel" value="cancel">
     </form>
    </center>

<!--pop up window-->

      

                                          </div>
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
  else    
  {
    echo "internel error";
     echo '<br>';
  }
   }






   if(isset($_POST['title']))
   {
         $a= $_POST['btitle'];
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
    <center>
    <br><br><br>
    <form action="library_home.php" class="form-horizontal" method="POST">
    <input type="hidden" id="var1" name="ID1" value=<?php echo $id ;?>/>
    
    <input type="submit"  class="btn btn-large  btn-primary" name="booknow" value="book now">
    </form>
    <br><br>
    <form action="home.php" class="form-horizontal">
     <input type="submit"  class="btn btn-large  btn-primary" name="cancel" value="cancel">
     </form>
    </center>

    
    </form>
    </div>
     </div>
<hr>
<hr>
<hr>



     





            <?php
           
                }
            } 

            else    
            {
              echo "internel error student";
              echo '<br>';
            }

   }

   if(isset($_POST['author']))
   {
        $b=$_POST['bauthor'];
        $b= '%'.$b.'%';
        
       
        $query2="SELECT * FROM `book details` WHERE author LIKE '$b'" ;
         $query2=mysql_query($query2);
         $result2=mysql_num_rows($query2);
        

   if($result2)
  {
     while ($row=mysql_fetch_assoc($query2))
     {   $title=$row['title'];
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

     <center>
    <br><br><br>
    <form action="library_home.php" class="form-horizontal" method="POST">
    <input type="hidden" id="var1" name="ID1" value=<?php echo $id ;?> />
    
    <input type="submit"  class="btn btn-large  btn-primary" name="booknow" value="book now">
    </form>
    <br><br>
    <form action="home.php" class="form-horizontal">
     <input type="submit"  class="btn btn-large  btn-primary" name="cancel" value="cancel">
     </form>
    </center>
 
    
     <hr>
<hr>
<hr>

    <?php
                                   
    }
  } 
  else    
  {
    echo "internel error";
     echo '<br>';
  }
   }
    

?>


 </body>
  </html>