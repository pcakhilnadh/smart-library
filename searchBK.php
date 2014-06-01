<?php

function searchBOOK()
{

require_once 'connect.php';
$search= array();
$string="";
    $query = mysql_query("SELECT title FROM `book details' ");            
    
    while ($row = mysql_fetch_array($query))
    {
   
      $string=$string.$row['title'];
      $string=$string."!!";
    }

    $search = explode('!!', $string);
    
 return $search;
}
    

?>