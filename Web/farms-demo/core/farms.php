<?php

 switch ($action)
 {
  case "details":
   // display completed details about a transaction 
 
   
      $info_farms_details             =Array();      
      $myfarms_details                =Array();
      $myfamr_index                   =0;
      $Array_sensortype               = Array("temperature","php","rainfall");

  if (isset($_GET['view'])) {               // get the transaction val 
    $farm_index_decode            = base64_decode($_GET['view']);  // decode and decrease so that it can fit the array logic         
    //echo $farm_index_decode;  
    if(intval($farm_index_decode)>0) {

      $myfamr_index               = $farm_index_decode;             
      $myfarms_details            = CallAPI("GET", "",$global['api_url']."/v1/farms/".$myfamr_index."");  // My farms details
  

      $info_farms_details         = CallAPI("GET", "",$global['api_url']."/v1/farms/".$myfamr_index."/stats");  // get all farms stats 
    }
    
       // Listing transactions status ( All status)
  $list_all_transactions_status  = Array();
  if (isset($_SESSION['token'])) {
    $list_all_transactions_status  = CallAPI("GET", $_SESSION['token'], $global['api_url']."/transactions/status");
  }
  



  $total_pages=0; 
  
  if (count($info_farms_details->measurements)>0 && count($info_farms_details->measurements)/50) {
    $total_pages= count($info_farms_details->measurements)/500;
  }
  

  $page =0; 
  if (isset($_GET['pg']) && base64_decode($_GET['pg'])>0) {
    $page   =base64_decode($_GET['pg'])-1; 
  }

  //echo $page; 
    
  if (!isset($_GET["srchdate"]) ) {    
    if(isset($_SESSION['username'])) {
      $list_all_transactions = CallAPI("GET", $_SESSION['token'], $global['api_url']."/accounts/".$_SESSION['username']."/transactions"."?page=".$page."&size=15&sort=DESC&sortField=createDate"); 
    }
    
    if(isset($_SESSION["date1"]))  unset($_SESSION["date1"]);
    if(isset($_SESSION["date2"]))  unset($_SESSION["date2"]);
    if (isset($_SESSION['list_transactions'])) unset($_SESSION['list_transactions']); // destroys and create a new one
    if (isset($list_all_transactions)) {
      $_SESSION['list_transactions'] = $list_all_transactions;        
    }
    
  }
 
  // clear transaction status if not needed
  if (!isset($_GET["srchstatus"])) {
    if(isset($_SESSION["status"])) unset($_SESSION["status"]);
  } 
  
 
  $arr_feed            = Array();

  // Search transaction by status 
  if (isset($_POST["paiement_method"]) || isset($_GET["srchdate"]) || isset($_GET["srchstatus"])) 
  {
    //die("bonjour");
    $date1      = "";   // Period from
    $date2      = "";   // Period to

    if (isset($_SESSION["date1"]))  $date1             =$_SESSION["date1"]; 
    if (isset($_SESSION["date2"]))  $date2             =$_SESSION["date2"]; 
    $status     = "";   // of the transaction

    if(isset($_SESSION["status"]))  $status            =$_SESSION["status"];   
    $currency   = "";   // of currency
    $msg="";


    if (isset($_POST["date_from"]) && (trim($_POST['date_from']))!="") {     
      $date1    = trim(date('Y-m-d', strtotime($_POST['date_from']))); //format and save date1 
      $_SESSION["date1"]  = $date1; 
    }

    if (isset($_POST['date_to']) && (trim($_POST['date_to']))!="") {           
      $date2    = trim(date('Y-m-d', strtotime($_POST['date_to'])));   // Now manual ==> automatic with calendar
      $_SESSION["date2"]  = $date2;       
    }


    if (isset($_POST["transac_stat"]) && (trim($_POST['transac_stat']))!="") {
      $status   = trim($_POST['transac_stat']);
      $_SESSION["status"]= $status;    //format and save status
    } 

    if (isset($_POST["transac_cur"]) && (trim($_POST['transac_cur']))!="")    $currency = trim($_POST['transac_cur']);


    
    $status_default_value ="Any";
    $date_query="";
    $date_query1="";
    $date_query2="";
    
    if (($date1!="") || ($date2!=""))
    {
      $page =0; // Initialize the page number to fit the new query
      if (isset($_GET['pg']) && base64_decode($_GET['pg'])>0 && !isset($_POST["paiement_method"]) ) {
        $page =base64_decode($_GET['pg'])-1; 
      }
     
      

      //echo $status; die();      
      if (!isset($status) || (isset($status) && $status=="") || (isset($status) && !empty($status) && (strcmp($status, "ANY") === 0) )) {
        // getting transactions by date and marchant
        if (isset($_SESSION['list_transactions'])) unset($_SESSION['list_transactions']); // destroys and create a new one  
    

        $list_all_transactions = CallAPI("GET", $_SESSION['token'], $global['api_url']."/accounts/".$_SESSION['username']."/transactions?"."dateAfter=".$date2."&dateBefore=".$date1."&page=".$page."&size=15&sort=DESC&sortField=createDate");
        
        if (isset($_SESSION['list_transactions'])) unset($_SESSION['list_transactions']);
        $_SESSION['list_transactions'] = $list_all_transactions;    
       
        if (isset($_POST["date_to"]) || isset($_POST["date_from"]) ) {
          redirectTo("index.php?lang=".$lang."&module=transactions&srchdate");
          }     
      }

      
      // transaction via marchant dates, via status
      if ((isset($status) && !empty($status) && (strcmp($status, "ANY") !== 0)) && ( (isset($_POST["transac_stat"])) || (isset($_GET['pg'])))) {
       $list_all_transactions = CallAPI("GET", $_SESSION['token'], $global['api_url']."/accounts/".$_SESSION['username']."/transactions?"."dateAfter=".$date2."&dateBefore=".$date1."&page=".$page."&size=15&sort=DESC&sortField=createDate"."&status=".$status);
    
       $_SESSION['list_transactions'] =$list_all_transactions;
        redirectTo("index.php?lang=".$lang."&module=transactions&srchdate&srchstatus");
      }
    }

    
    // transaction via marchant, via status
    $status_query="";
      
    if ((strcmp($status, "ANY") !== 0) && !isset($_GET["srchdate"])) {  
      //die("No status selected ");
      $status_query1=""; // manage the and clause
      if (trim($date_query)!="") $status_query1="and";
      $status_query=$status_query1." "."transactions.transaction_status='$status'"." ";
      $list_all_transactions = CallAPI("GET", $_SESSION['token'], $global['api_url']."/accounts/".$_SESSION['username']."/transactions?"."page=".$page."&size=15&sort=DESC&sortField=createDate"."&status=".$status);
 
      if (isset($_SESSION['list_transactions'])) unset($_SESSION['list_transactions']);
      $_SESSION['list_transactions'] = $list_all_transactions;       
            
      if (isset($_POST["paiement_method"])) {
        redirectTo("index.php?lang=".$lang."&module=transactions&srchstatus");
      }         
    }
     

    // transaction via currency
    $currency_query="";
    if ($currency!="any")
    {
      $currency_query1="";
      if($date_query!="" && $status_query!="") $currency_query1="and";
      $currency_query= $currency_query1." "."transactions.currency='$currency'"." ";
    }
    // usage or not of where clause
    $where_clause="";
    if (($date_query!="") || ($status_query!="") || ($currency_query!="")) $where_clause="where";
    $req = "select *from transactions ".$where_clause." ".$date_query."  ".$status_query."  ".$currency_query." order by transactions.transaction_date desc";
   }
 
   $page= 1;
   if (isset($_GET['pg']) && base64_decode($_GET['pg'])>0)
   {
    $page=base64_decode($_GET['pg']);
   } 

   if(isset($_SESSION['list_transactions'])) {
    $list_all_transactions= $_SESSION['list_transactions'];
   } 
  } 
 break;
  

 default:
  

  $list_all_farms  = Array();

  $list_all_farms  = CallAPI("GET", "",$global['api_url']."/v1/farms");  // get all farms list
  

}
?>
