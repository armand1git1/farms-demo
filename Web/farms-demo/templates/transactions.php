<?php 
 $pages   ="transactions";     
 
 switch ($global['action'])
 {                       
  case "details":
   $pages .="/transaction-details.php";  
   include($pages); 
  break; 

  
  default:   
   $pages .="/"."transaction-list.php";  
  include($pages); 

 }

 
?>