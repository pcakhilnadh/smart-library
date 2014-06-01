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
          <a href="home.php" class="active"><li> Home </li></a>
          <a href="#search" class="active"><li> Search </li></a>
          <a href="#upload" class="active"><li> Upload </li></a>
          <a href="#notification" class="active"><li> Notification </li></a>
          <a href="#mykart" class="active"><li> My kart </li></a>
          <a href="#delete" class="active"><li> Delete books </li></a>
         
           <a href="logout.php"><li id="logout"> Logout </li></a>
    </ul>
              
              
    
            
    </div>        

    </div>

  </div>
  </div>
 <!-- MENU END  --> 
 <?php } ?>
 <!--header ends-->
   
   
  <!-- MENU  end-->

  

  <!--search results-->
  
    <!-- Button to trigger modal -->

      <!--form to upload book-->
<!-- form to upload book to kart
=================================================================================================== -->
      <br><br>
      <div id="upload" class="tab-section">



        <center><h2>Add New Book</h2></center><br><br>
         <form class="form-horizontal" role="form" method="post" action="bookart_home.php">
   
          
              <div class="form-group">
                      <label  class="col-sm-3 control-label">Title</label>
                      <div class="col-lg-4 ">
                      <input type="text" class="form-control" name="title" placeholder="Enter the book title" required="required">
                      </div>
                </div>

                <div class="form-group">
                      <label  class="col-sm-3 control-label">Author</label>
                      <div class="col-lg-4 ">
                      <input type="text" class="form-control" name="author" placeholder="Enter the book author" required="required">
                      </div>
                </div>


                <div class="form-group">
                      <label  class="col-sm-3 control-label">Price</label>
                      <div class="col-lg-4 ">
                      <input type="number" class="form-control" name="price" placeholder="Enter the book price" required="required">
                      </div>
                </div>

                <div class="form-group">
                      <label  class="col-sm-3 control-label">Publication</label>
                      <div class="col-lg-4 ">
                            <input type="text" class="form-control" name="publication" placeholder="Enter the book publication" required="required">
                      </div>
                </div>

                <div class="form-group">
                      <label  class="col-sm-3 control-label"> Edition</label>
                      <div class="col-lg-4 ">
                      <input type="text" class="form-control" name="edition" placeholder="Enter the book edition" required="required">
                      </div>
                </div>

                <div class="form-group">
                      <label  class="col-sm-3 control-label"> Commments </label>
                      <div class="col-lg-4 ">
                      <input type="text" class="form-control" class="input-xxlarge" name="comment" placeholder="Enter some comments about book" required="required">
                      </div>
                </div>


              <label  class="col-sm-6 control-label">
              <input type="submit"class="btn btn-primary" name="upload" value="Add A New Book">
              </label>
         </form>



      </div>

      <!--form to upload book ends-->

     <!-- form tosearch book from kart
=================================================================================================== -->


  <div id="body_content">
  <div id="search" class="tab-section">





  <!--query to search results-->

<!--search box-->                                   <br><br><br><br>
<center>
 <?php include 'search.php';?>
 <script>
$(function() {

$( "#accordion" ).accordion();
var availableTags =<?php echo json_encode(search()); ?>;
$( "#autocomplete" ).autocomplete({
source: availableTags
 });
});
</script>
                                                                           

   
    <div class="dropdown">
   
   <form class="form-search " role="search" action="searchall.php" method="POST">
  <div class="form-group">
    <input class="form-control" type="text" id="autocomplete"  name="btitle" placeholder="Enter Book Title">
      <input type="submit" class="btn btn-large  btn-success"   name="titlesearch" value="Search">
  </div>
  </form>
  
  </div>
                                                                        
                                                      <br><br><br><br>
                                                              
                                                          
                                                              
                                                                
                                                               
                                       <!--search box ends-->     

  <!-- form to display all books in book to kart
=================================================================================================== -->                                               
       <?php
          $user=$_SESSION['sid'];
         $query= mysql_query("SELECT * FROM `seller book info` WHERE status='a' AND sid NOT IN ('$user') ");
        
      
         $row=mysql_num_rows($query);

         
       if($row>0)//if there is no uploads
       {

        ?>
        <!--printing search result in table format-->
        
       <div > 
              <table class="table table-hover">
                
                    <thead>

                      <th>BOOK TITLE </th>
                      <th>BOOK AUTHOR</th>
                      <th></th>
                    </thead>   
                                            <!--php parts-->
                                            <?php
                                            
                                             }
                                             else
                                             {
                                               echo "<div class='jumbotron'><center><h2>No uploads yet</h2></center></div>";
                                             }
                                              $array = array();
              
            while($result=mysql_fetch_assoc($query))
            {     
               
                             
                ?>
                <!--while loop to print all details of uploaded book-->
            <tr>
              
              <tbody>
                        
                        <td> <?php echo $result['title'];?> </td>
                        <td><?php echo $result['author'];?> </td>
                        <td>
                         <form  action="more.php" method="POST" id="form">
                          <input type="hidden" id="var1" name="ID1" value=<?php echo $result['sid'];?>/>
                          <input type="hidden" id="var1" name="ID2" value=<?php echo $result['book_uid']; ?>/>
                           <label  class="col-sm-6 control-label">
                            <input type="submit"class="btn btn-large btn-block btn-primary" id="form" name="'.$result['sid'].'" value="more details">
                            </label>
                            
                        <td>
                        </form>
              </tbody>              

            </tr> 

            <?php 
            
            }
            //end of while loop
              
            ?>
        
        
         </table>
         </div><!--end div table responsive-->
            
            
            

  </div><!--end div search-->

  </div><!--end div body_content-->

  <!--pop over window to new book added
=================================================================================================== -->

<div class="container">
<div id="body_content">
     <div class="modal fade error_reporting" id="myModalupload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
  

  
<?php
if(isset($_POST['upload']))
        {
          $up=uniqid();
        echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModalupload").modal({keyboard:false}); });
                         </script>';

        if(mysql_query("INSERT INTO `seller book info`(sid,book_uid, title, author, price, publication, edition, status, comment) VALUES  ('".$_SESSION['sid']."','$up','".$_POST['title']."' ,'".$_POST['author']."','".$_POST['price']."','".$_POST['publication']."','".$_POST['edition']."','a','".$_POST['comment']."'  )"))
        {
          echo "*new book added*";
         $_SESSION['sid'];
          $_POST['ID']="";
                 echo ' <META HTTP-EQUIV="refresh" CONTENT="2;URL=bookart_home.php"> ';
       
        }
        


        
      }

?>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>                                             </div>
                                             </div>
                                             </div>

                                             <!-- pop over window ends
=================================================================================================== -->


<!-- form to offer price if booked
=================================================================================================== -->

<div class="container">
<div id="body_content">
     <div class="modal fade error_reporting" id="myModalbooked" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
<?php
if(isset($_POST['booknow']))
        {
               
                  $a= $_POST['ID2'];
                  $a= substr($a, 0,-1);
                 
                echo'<form class="form-horizontal" role="form" method="post" action="#">
           
                  
                        <div class="form-group">
                              <label  class="col-sm-3 control-label">Price you Offer</label>
                              <div class="col-lg-4 ">
                              <input type="number" class="form-control" name="ofr_price" placeholder="Enter the price you offer" required="required">
                              </div>
                        </div>
                        <input type="hidden" id="var1" name="ofr_buk_id" value='. $a.' />

                        
                      <center>
                      <div class="form-group">
                      <input type="submit" class="btn btn-large  btn-success"   name="offerprice" value="Book now">
                      </div>
                      </center>
                      </form>  ';
                       echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModalbooked").modal({keyboard:false}); });
                         </script>';


      

        }

?>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<!-- send mail ends
==================================================================================================-->

 <!-- uploading offered price
=================================================================================================== -->  
<div class="container">
<div id="body_content">
     <div class="modal fade error_reporting" id="myModalp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">  
    <?php
      if(isset($_POST['offerprice']))
      {

                  $x= $_POST['ofr_buk_id'];
                  $y=$_POST['ofr_price'];
                 
                  if(mysql_query("INSERT INTO `buyer info`(`sid`, `book uid`, `offer_price`) VALUES ('".$_SESSION['sid']."','$x','$y')"))
                  {
                    echo "*sucessfully processed*";
                    echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModalbookedp").modal({keyboard:false}); });
                         </script>';
                  
                           echo ' <META HTTP-EQUIV="refresh" CONTENT="2;URL=bookart_home.php"> ';
                 
                  }
                  
      }

    ?>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

   <!-- optionn to user to approve his book based on offer price and delete book
   =================================================================================================================-->
      <div id="body_content">
            <div id="mykart" class="tab-section">

                <?php
                $current= $_SESSION['sid'];
                 if($query=mysql_query("SELECT * FROM `buyer info` WHERE `book uid` IN(SELECT book_uid from `seller book info` WHERE sid='$current' AND status='a')"))
                 {
                    $count=mysql_num_rows($query);
                   
                    if($count)
                    {?>
                        <table  class="table table-hover">
                          <thead>
                            <th>Book Name</th>
                            <th>My price</th>
                            <th>Buyer Name</th>
                            <th>Contact Number</th>
                            <th>Offered Price</th>
                            <th></th>
                          </thead>

                          
                          <?php
                          while($arr1=mysql_fetch_assoc($query))
                          {
                            echo "<tbody>";
                            $cur_sid=$arr1['sid'];
                            $cur_bookid=$arr1['book uid'];
                                $query_sid=mysql_query("SELECT * FROM `login student` WHERE admin_no='$cur_sid' ");
                                $query_book=mysql_query("SELECT * FROM `seller book info` WHERE book_uid='$cur_bookid'");
                                $stud=mysql_fetch_assoc($query_sid);
                                $book=mysql_fetch_assoc($query_book);
                                echo "<td>".$book['title']."</td> ";
                                echo "<td>".$book['price']."</td> ";
                                echo "<td>".$stud['firstname']."  ".$stud['lastname']."</td> ";
                                echo "<td>".$stud['mobno']." </td> ";
                                echo "<td>".$arr1['offer_price']."</td> ";
                               echo'<td>
                                <form  action="#" method="POST" id="form">
                                <input type="hidden" id="var1" name="place_book_id" value='.$cur_bookid.'/>
                                <input type="hidden" id="var1" name="place_student" value='.$stud['admin_no'].'/>
                                <label  class=" control-label">
                                <input type="submit"class="btn btn-large btn-block btn-primary" id="form" name="placeorder" value="placeorder">
                                
                                </form>
                            
                                <td>';
                                echo "</tbody>";

                                
                          }
                          ?>   
                          
                        </table>



                      <?php
                    }
                    else
                    {
                      echo "<div class='jumbotron'><center><h2>No one Orderd your book yet</h2></center></div>";
                    }

                    
                 }


                ?>


            </div>
      </div>
<!--       place order
======================================================================================================-->
<div class="container">
<div id="body_content">
     <div class="modal fade error_reporting" id="myModalplace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
<?php
if(isset($_POST['placeorder']))
{
 $book_selled=substr($_POST['place_book_id'],0,-1);
 $book_owner=substr($_POST['place_student'],0,-1);
 mysql_query("UPDATE `seller book info` SET status='na' WHERE book_uid='$book_selled'");
 if(mysql_query("UPDATE `buyer info` SET status = 'CANCELLED' WHERE 'sid' NOT IN ('$book_owner') AND `book uid` = '$book_selled'"))
    {
     
     } 
 $x=mysql_query("SELECT * FROM `buyer info` WHERE status='ISSUED' AND `book uid`='$book_selled'");
 $count= mysql_num_rows($x);

  if(!$count)
  {
    if(mysql_query("UPDATE `buyer info` SET status = 'ISSUED' WHERE sid = '$book_owner' AND `book uid` = '$book_selled'"))
    {
      echo "sucessfully processed your request";
    
                        echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModalplace").modal({keyboard:false}); });
                         </script>';


       echo ' <META HTTP-EQUIV="refresh" CONTENT="2;URL=bookart_home.php"> ';

   }
 }
 else
 {
  echo "Sorry already SElled plaese remove book";
   echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModalplace").modal({keyboard:false}); });
                         </script>';

  
   echo ' <META HTTP-EQUIV="refresh" CONTENT="2;URL=bookart_home.php"> ';
 }
 }

?>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!-- delete books that are uploaded
======================================================================================================-->
<div id="body_content">
          <div id="delete" class="tab-section">


              <?php
              if($query=mysql_query("SELECT * FROM `seller book info` WHERE sid='".$_SESSION['sid']."'"))
              {
                if(mysql_num_rows($query))
                {?>
                   <table  class="table table-hover">
                          <thead>
                            <th>Book Name</th>
                            <th>Status</th>
                            <th></th>
                          </thead>
                           <?php
                          while($arr1=mysql_fetch_assoc($query))
                          {
                            echo "<tbody>";
                          
                            $cur_bookid=$arr1['book_uid'];
                               $check= mysql_query("SELECT status FROM `buyer info` WHERE status='ISSUED' AND `book uid`='$cur_bookid'");
                                $count= mysql_num_rows($check);

                                
                                echo "<td>".$arr1['title']."</td> ";
                                if(!$count)
                                {
                                  echo  "<td>"."Still in the cart" ."</td> ";
                                }
                                else
                                {
                                  echo  "<td>"."Issued" ."</td> ";
                                }
                               echo'<td>
                                <form  action="#" method="POST" id="form">
                                <input type="hidden" id="var1" name="delete_book_id" value='.$cur_bookid.'/>
                                
                                <label  class="col-sm-6 control-label">
                                <input type="submit"class="btn btn-large btn-block btn-primary" id="form" name="deletebook" value="delete">
                                </label>
                                </form>
                            
                                <td>';
                                echo "</tbody>";

                                
                          }

                      echo "</table>";

               }
                else
                {
                  echo "<div class='jumbotron'><center><h2>NO books Found</h2></center></div>";
                }
        } 


              ?>


          </div>
</div>

<div class="container">
<div id="body_content">
     <div class="modal fade error_reporting" id="myModaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body">
<?php
if(isset($_POST['deletebook']))
{
    $a=$_POST['delete_book_id'];
    $a= substr($a, 0,-1); 
   
   if(mysql_query("DELETE FROM `seller book info` WHERE book_uid='$a' "))
   
     if(mysql_query("DELETE FROM `buyer info` WHERE `book uid`='$a' "))
     
     echo "Book deleted sucessfully";
    echo '<script type="text/javascript">
                          $(window).load(function(){   $("#myModaldelete").modal({keyboard:false}); });
                         </script>';

  
   echo ' <META HTTP-EQUIV="refresh" CONTENT="2;URL=bookart_home.php"> ';
     
}


?>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<!--                                notification area
================================================================================================-->
 <div id="notification" class="tab-section">

  <table  class="table table-hover">
  <?php
  $temp=mysql_query("SELECT * FROM `buyer info` WHERE sid='".$_SESSION['sid']."' ");
 $count= mysql_num_rows($temp);
                          if($count)
                          {
  ?>
                                  <thead>
                                    <th>Book Name</th>
                                    <th>Status</th>
                                    <th>Uploader name</th>
                                    <th>Uploader mob:</th>

                                    <th></th>
                                  </thead>
      <?php                    while($arr=mysql_fetch_assoc($temp))
                                {
                                         echo "<tbody>";
                                         echo "</tbody>";
                                         $p= $arr['book uid'];
                                         $temp2=mysql_query("SELECT * FROM `seller book info`WHERE `book_uid`='$p' ");
                                         
                                        if($temp_book= mysql_fetch_assoc($temp2))
                                        {
                                          echo "<td>".$temp_book['title']."</td>";
                                          echo "<td>".$arr['status']."</td>";
                                          $y= $temp_book['sid'];
                                         $temp3= mysql_query("SELECT * FROM `login student`WHERE admin_no='$y' ");
                                          $x=mysql_fetch_assoc($temp3);
                                          echo "<td>".$x['firstname']."</td>";
                                           echo "<td>".$x['mobno']."</td>";
                                        }
                                
                                }
                        }
                          else
                          {
                              echo "<div class='jumbotron'><center><h2>sorry no notification this time</h2></center></div>";
                          }
                          ?>
                        
   </table>                      
 </div>

  </body>
  </html>