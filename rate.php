<?php 
  require_once 'connect.php';


 mysql_query("UPDATE `rate and review` SET rate='".$_POST['rated']."' WHERE sid='".$_POST['stud']."' AND bookid='".$_POST['book']."' ");
 mysql_query("INSERT INTO `rate and review`(sid,bookid,rate) VALUES ('".$_POST['stud']."','".$_POST['book']."','".$_POST['rated']."' )");
if (isset($_POST['comment'])) 
{
mysql_query("UPDATE `rate and review` SET comment='".$_POST['comment']."' WHERE sid='".$_POST['sid']."' AND bookid='".$_POST['bookid']."' ");

}
header('location:library_home.php');
 ?>