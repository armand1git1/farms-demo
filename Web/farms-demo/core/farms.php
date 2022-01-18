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
    

    $total_pages=0; 
  
    if (count($info_farms_details->measurements)>0 && count($info_farms_details->measurements)/50) {
      $total_pages= count($info_farms_details->measurements)/500;
    }
   


   // Search farms based sensor type 
   if (isset($_POST["farm_detail_id"])) 
   {
    
     


   } 
 } 
 break;
  

 default:
  

  $list_all_farms  = Array();

  $list_all_farms  = CallAPI("GET", "",$global['api_url']."/v1/farms");  // get all farms list
  

}
?>
