<?php


if($_SESSION['expire']<=time())
 {			session_destroy();
 			header('location:logout.php');
 }

 else
 {
 	$_SESSION['expire']+=60;

 }
?>