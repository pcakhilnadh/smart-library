<?php
include_once 'connect.php';

 function search()
{
$search= array();
$string="";
    $query = mysql_query("SELECT title FROM `seller book info` WHERE status='a'");            
    
    while ($row = mysql_fetch_array($query))
    {
   
      $string=$string.$row['title'];
      $string=$string."!!";
    }

    $search = explode('!!', $string);
    
 return $search;
}
    
  function searchTitle()
  {
      $string="";
      $search= array();
  
      $query = mysql_query("SELECT title FROM `book details` ");            
    
      while ($row = mysql_fetch_array($query))
      {
     
          $string=$string.$row['title'];
          $string=$string."!!";
      }

          $search = explode('!!', $string);
    
          return $search;
   }
  
   
?>