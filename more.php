  <!doctype html>
<?php
require 'connect.php';
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
              <!--<li class="nav navbar-nav header_bar_text">Hi <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>, </li>-->
        
        <div class = "collapse navbar-collapse navHeaderCollapse ">
            <ul>
          <a href="admin_home.php" class="active"><li> Home </li></a>
          
         
           <a href="logout.php"><li id="logout"> Logout </li></a>
    </ul>
              
              
    
            
    </div>        

    </div>

  </div>
  </div>
  <?php
        
        
          
          $a= $_POST['ID1'];
          $a= substr($a, 0,-1);
          $b= $_POST['ID2'];
          $b= substr($b, 0,-1);
         
            
          
          $query1="SELECT * FROM `login student` WHERE admin_no='$a'";
          $query2="SELECT * FROM `seller book info` WHERE book_uid='$b'";
          $query1=mysql_query($query1);
           $query2=mysql_query($query2);
          $result1=mysql_num_rows($query1);
          $result2=mysql_num_rows($query2);
  
  if($result1)
  {
     if ($row=mysql_fetch_assoc($query1))
     {
        $sid=$row['admin_no'];
        $fname=$row['firstname'];
        $lname=$row['lastname'];
        $uname=$row['username'];
        $email=$row['email'];
        $mobno=$row['mobno'];
       
    }
  } 
  else    
  {
    echo "internel error student";
    echo '<br>';
  }

   if($result2)
  {
     if ($row=mysql_fetch_assoc($query2))
     {  echo "<br>";
        $title=$row['title'];
        $author=$row['author'];
        $publisher=$row['publication'];
        $edition=$row['edition'];
        $status=$row['status'];
        $comment=$row['comment'];
        
    }
  } 
  else    
  {
    echo "internel error";
     echo '<br>';
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

    <div class="form-group">
        <label  class="col-sm-3 control-label">Status:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $status ?> </p>
        </div>
    </div>
<div class="form-group">
        <label  class="col-sm-3 control-label">Price:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo "Rs.".$row['price'] ?> </p>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-3 control-label">Comment:</label>
        <div class="col-lg-3 ">   
         <p class="form-control-static"> <?php echo $comment ?> </p>
        </div>
    </div> 
    </form>
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
    <br><br><br>
    <form action="bookart_home.php" class="form-horizontal" method="POST">
    <input type="hidden" id="var1" name="ID1" value=<?php echo $a ?>/>
    <input type="hidden" id="var1" name="ID2" value=<?php echo $b ?>/>
   
    <input type="submit"  class="btn btn-large  btn-primary" name="booknow" value="book now">
    </form>
    <br><br>
    <form action="home.php" class="form-horizontal">
     <input type="submit"  class="btn btn-large  btn-primary" name="cancel" value="cancel">
     </form>
    </center>

<!--pop up window-->

      

                                          </div>
                                             </div>
                                             </div>


</body>
</html>