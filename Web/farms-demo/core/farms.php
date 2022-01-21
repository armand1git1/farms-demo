<?php

 switch ($action)
 {
  case "details":
   // display completed details about a transaction 
 
   
      $info_farms_details             =Array();      
      $myfarms_details                =Array();
      $myfamr_index                   =0;
      $Array_sensortype               =Array("temperature","ph","rainfall");
      $sensor_type                    ="temperature";    

  if (isset($_GET['view'])) {               // get the transaction val 
    $farm_index_decode            = base64_decode($_GET['view']);  // decode and decrease so that it can fit the array logic         
    //echo $farm_index_decode;  
    if(intval($farm_index_decode)>0) {

      $myfamr_index               = $farm_index_decode;             
      $myfarms_details            = CallAPI("GET", "",$global['api_url']."/v1/farms/".$myfamr_index."");  // My farms details
  

      // Search farms based sensor type 
     if (isset($_POST["farm_detail_id"]) && isset($_POST["btn_sentortype"])) 
     {    
      if(isset($_POST["sensor_type"])) {
      $sensor_type                = $_POST["sensor_type"];  // get sensor posted
      }
     }        
      // Everything
      //$info_farms_details         = CallAPI("GET", "",$global['api_url']."/v1/farms/".$myfamr_index."/stats");  // get all farms stats 
    }
    
    //monthly 
    $info_farms_details         = CallAPI("GET", "",$global['api_url']."/v1/farms/".$myfamr_index."/stats/".$sensor_type."/monthly");  // get all farms stats 
   
    echo $global['api_url']."/v1/farms/".$myfamr_index."/stats/".$sensor_type."/monthly";

    //print_r($info_farms_details);

    $total_pages=0; 
  
    //if (count($info_farms_details->measurements)>0 && count($info_farms_details->measurements)/50) {
      if (is_array($info_farms_details) && count($info_farms_details)>0) {  
      $total_pages= count($info_farms_details)/20;
    }
   


  
 } 
 break;

 case "location":
  $info_farms_details             =Array();      
  $myfarms_details                =Array();
  $myfamr_index                   =0;
  $city                           ="tampere";

 if (isset($_GET['view'])) {               // get the transaction val 
    $farm_index_decode            = base64_decode($_GET['view']);  // decode and decrease so that it can fit the array logic         
    //echo $farm_index_decode;  
    if(intval($farm_index_decode)>0) {

      $myfamr_index               = $farm_index_decode;             
      $myfarms_details            = CallAPI("GET", "",$global['api_url']."/v1/farms/".$myfamr_index."");  // My farms details
     
      if (isset($myfarms_details->location))
      {
        $city = $myfarms_details->location;
      } 
  }

 } 
 break;
  

 default:
  

  $list_all_farms  = Array();

  $list_all_farms  = CallAPI("GET", "",$global['api_url']."/v1/farms");  // get all farms list
  

}
?>
