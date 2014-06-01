<!doctype html>
<?php
require 'connect.php';
session_start();


if(($_SESSION['usertype']!="stud")||($_SESSION['expire']<=time()))
 {      session_destroy();
      header('location:logout.php');
 }
 else
 {
  $_SESSION['expire']+=60;
  require_once 'timeout.php';
  
  include 'search.php';
  if (isset($_GET['close'])) 
    {
          
        echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=library_home.php">';
    }
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
$(document).ready(function () {
        window.scrollTo(0,0);
    });
});

$(function() {
                                                                            
$( "#accordion" ).accordion();
                                                                            

                                                                            
var availableTags =<?php echo json_encode(searchTitle()); ?>;
var tags =<?php echo json_encode(searchTitle());?>;
$( "#autocomplete" ).autocomplete({

source: availableTags

                                                                              
});

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
 <nav>
 <div id="header">
    <div class = "container">
         
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
        <span class="glyphicon glyphicon-list"></span>
        </button>
              <li class="nav navbar-nav header_bar_text">Hi <?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>, </li>
              <div class = "collapse navbar-collapse navHeaderCollapse ">

            <ul>

          <a href="home.php" class="active"><li> Home </li></a>
          <a href="#mytrans" class="active"><li> My Transaction </li></a>
          <a href="#search" class="active"><li> search </li></a>
          
           <a href="logout.php"><li id="logout"> Logout </li></a>

    </ul>
              
              
    
            
    </div>   
        

  </div>
  </div>
 
  </nav>
  </div>
  
   <!-- MENU  end-->
    
    <div id="mytrans" class="tab-section">

      <div id="body_content">

    <center><h2>My Transactions</h2></center><br><br>

  <!--sss-->
   

          <?php
          $query2="SELECT * FROM `book details` INNER JOIN `preorder` ON `preorder`.bookid= `book details`.id  AND `preorder`.sid='".$_SESSION['sid']."' LEFT JOIN  `book manager` ON `book manager`.book_id=`preorder`.bookid  AND `book manager`.student_id= `preorder`.sid WHERE id in(SELECT bookid from `preorder` where sid='".$_SESSION['sid']."') "; 
                            $query2=mysql_query($query2);
                            $result2=mysql_num_rows($query2);
          

          if (!$result2) {
            echo `<div class="jumbotron"><div class="container"><center><b> You Have Not Taken Any Books Yet</b></center></div></div>`;
          }
          else
          {?>
        
      
       <div class="table-responsive">
         <table class="table table-hover">
           <thead>
            <th>Book ID</th>
            <th>book title</th>
            <th>author</th>
            <th>section</th>
            <th>Book Status</th>
            <th>Order Status</th>
            <th>Order/Issue Date</th>
            <th>Return Date</th>
            <th>Fine</th>
            <th></th>
           </thead>
<?php
while($row=mysql_fetch_assoc($query2))
{
                              
                  
                
         ?>
                <!--while loop to print all details of uploaded book-->
             
            <tr>
              
              <tbody>
                       <td ><?php echo $row['id'];?></td> 
                       <td ><?php echo $row['title'];?></td>
                        <td ><?php echo $row['author'];?></td>
                       <td><?php echo $row['section'];?></td>
                      <td><?php if($row['status']=='A')echo "Available"; else echo "Not Available";?> </td>
                      <td><?php echo $row['Status'];?> </td>
                       <td><?php if($row['Status']=='WAITING')echo $row['time']; else echo $row['date_issue'];?></td>  
                        <td><?php if($row['Status']=='ISSUED') echo $row['date_return'];?></td>  
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
                      <td><?php if($row['Status']=='WAITING'){?>
                         <form  action="#" method="POST" id="form">
                          <input type="hidden" id="var1" name="cancelID" value=<?php  echo $row['id']; ?> />
                          
                           <label  class="control-label">
                            <button type="submit"class="btn btn-large btn-block btn-warning" id="form" name="cancelnow"  >Cancel Order</button>
                            </label>
                            
                        </td>
                        </form>
                        <?php } ?>
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
       if(isset($_POST['cancelnow']))
        {
          $query2="DELETE FROM `preorder` WHERE sid='".$_SESSION['sid']."' AND bookid='".$_POST['cancelID']."' ";
                            if(mysql_query($query2));
                              echo '<script type="text/javascript">
                            $("#cancelModal").modal({kyboard:false,backdrop:"static"}); 
                         </script>';


        
                    echo "Your Order For the Book Is Canceled.Order Another Book";
                   
}
      ?>
</div>
      <div class="modal-footer">
       <form method="GET" action="library_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>  



      <div id="search" class="tab-section">

           <center>
                                                                       
                                                                           

   
   <div class="content2 container">
   <div >
   <form class="form-search " role="search" action="searchList.php" method="POST">
  <div class="form-group ">
    <input class="form-control text-center " type="text" id="autocomplete"  name="btitle" placeholder="Enter Book Title">
   </div> 
   
   <div class="form-group ">
      <input type="submit" class="btn btn-large  btn-primary "   name="search" value="Search">
    
  </div>
  </form>
  </div>
     <center><h4>( OR )</h4></center>
   <form class="form-search " role="search" action="searchList.php" method="POST">
   <div class="form-group ">
    <input class="form-control text-center " type="text" id="autocomplete"  name="bauthor" placeholder="Enter Book Author">
   </div>  
   <div class="form-group ">
      <input type="submit" class="btn btn-large  btn-primary "   name="search" value="Search">
  	
  </div>
  </form>
  </div>
  
                                                                      

   </div>                                                             


      </div>
  
<!-- form to pre order booked
=================================================================================================== -->



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
if(isset($_POST['booknow']))
        {

            $search= array();
              $search2= array();
          $string=$_POST['ID1'];
        
          $search=explode("/", $string);
          $bookid= $search[0];
//echo $string2."hai<br>";
           
            //echo $_POST['mailid']."after<br>";
            $t=time();            
           $m= date("Y-m-d",time());
          $date = date('h:i:s', time());
          $sid=$_SESSION['sid'];
            
        echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModalbooked").modal({kyboard:false,backdrop:"static"}); });
                         </script>';
        if($query=mysql_query("SELECT section,count(section) FROM `book details` INNER JOIN `preorder` ON `preorder`.bookid= `book details`.id LEFT JOIN  `book manager` ON `book manager`.book_id=`book details`.id WHERE id in(SELECT bookid from `preorder` where sid='".$_SESSION['sid']."') GROUP BY section" )) 
          {   
                  $count=array();
                  $count['GEN']=0;
                  $count['S']=0;
                  $count['BB']=0;
                  $count['DB']=0;
                  $count['TQ']=0;
                  $count['SCST']=0;
                      while($res=mysql_fetch_assoc($query))
                      {
                        
                        $count[$res['section']]=$res['count(section)'];
                      
                              
                              
                      }         
                          if($temp=mysql_query("SELECT `section` FROM `book details` WHERE id='$bookid'"))
                          {
                               if($r=mysql_fetch_assoc($temp))
                               {
                                $cout2=$count[$r['section']];
                              
                                
                               }
                               

                               if($cout2<2)
                               {

                                   if(mysql_query(" INSERT INTO preorder (sid,bookid) VALUES ('$sid','$bookid') "))
                                    {
                   
                                          echo "your request was sucessfully processed";
                                          
                                    }
                                    else
                                    echo "You are already requested for this BOOK.... !!!";
                               }
                               else
                               {
                                echo "limit exceed";
                               }
                           }    
           }  
   }                          


?>

</div>
      <div class="modal-footer">
        <form method="GET" action="library_home.php">
        <button type="submit" class="btn btn-danger" name="close" >Close</button>
        
        </form>
        
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!-- RATE AND REVIEW -->
<div >


<!-- Button trigger modal -->


<?php 

$query1=" SELECT * FROM `preorder` WHERE sid='".$_SESSION['sid']."'  AND Status='ISSUED' AND bookid NOT IN (SELECT bookid FROM `rate and review` WHERE sid='".$_SESSION['sid']."' )  ";
$query1=mysql_query($query1);
$result1=mysql_num_rows($query1);

if($result1)
{
		
	while ($row=mysql_fetch_assoc($query1)) 
	{
	   $book=$row['bookid'];
	}

		if($_SESSION['count']==0)
		{
		echo				'<script type="text/javascript">
                          $(document).ready(function(){   $("#modalRatenReview").modal({kyboard:false}); });
                         </script>'  ;
          $_SESSION['count']++;
         }
}

?>


<!-- Modal -->
<form class="form-horizontal" role="form" method="post" action="rate.php">
<div class="modal fade" id="modalRatenReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Take Time To Rate Your Book</h4>
      </div>
      <div class="modal-body">
        <?php  

        	$query=mysql_query("SELECT * FROM `book details` WHERE id='$book' ");
        	if($row=mysql_fetch_assoc($query))
        	{
        ?>
        	<div  >
    
    
    <div class="form-group">
        <label class="col-sm-3 control-label">
          Book ID
        </label>
        <div class="col-sm-3">
            <p class="form-control-static"> <?php echo $book; ?> </p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
          Book Title
        </label>
        <div class="col-sm-5">
            <p class="form-control-static"> <?php echo $row['title']; ?> </p>
        </div>
    </div>
  	<div class="form-group">
        <label class="col-sm-3 control-label">
          Book Author(s)
        </label>
        <div class="col-sm-5">
            <p class="form-control-static"> <?php echo $row['author']; ?> </p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">
          Your Rating
        </label>
        <div class="col-sm-4">
            <p class="form-control-static"> 
            <div class="rateit" id="rateit5" data-rateit-min="0"></div>
            <div>
                  <span id="value5"></span>

                  <span id="hover5"></span>
          </div>
          <script type="text/javascript">
           $("#rateit5").bind('rated', function (event, value) { $('#value5').text('You\'ve rated it: ' + value);
    
        var hash = value;
$.post('rate.php',{rated:hash , book:"<?php echo $book; ?>",stud:"<?php echo $_SESSION['sid']; ?>"},function(data){
    
});
         });
    </script>
             </p>
        </div>
    </div>
  <div class="form-group">
        <label class="col-sm-3 control-label">
          Comments
        </label>
        <div class="col-sm-5">
            <textarea class="form-control" rows="3" name="comment"></textarea>
            
        </div>
    </div>
   
  
    
  </div>
     <?php 



     }


      ?>
      </div> <!-- mODAL body ends-->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="hidden" name="sid" value=<?php echo $_SESSION['sid']; ?> />
        <input type="hidden" name="bookid" value=<?php echo $book; ?> />
        <input type="submit" class="btn btn-primary" id="save" value="Save Changes">
      </div>
    </div>
  </div>
</div> <!--Modal ends -->
</form>
</div>
<!-- END RATE AND REVIW-->
 

<div class="container">
<div class="content" id="home">
<div class="jumbotron">
  <center>
  <h2>Hello Student,</h2>
  <p>You can select Options From The Menu</p>
  </center>



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
</div>
<!-- Notification End-->
  
   
</div>  
 <?php } ?>
   </body>
</html>