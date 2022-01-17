<?php
 
 switch ($action)
 {
  default:
   //data to pass for the graph
  // Alll first 15 transactions 
  
  $periodType                                   = "monthly";  // we would like data monthly
  $sensor_type                                  = "rainfall"; // the initial sensor type is rainfall but could be automated
  
  $list_all_farms_rainfall  = array (array ());;    // double list which will receive the value of rainfall
 

 
  $months_sensor_val       =array();
  $year_start              ="2021-01";       // we want the graph from the start of last year


  for ($i=0;$i<11;$i++) {
    $months_sensor_val[$i] = date('Y-m', strtotime(' +' . $i. 'month', strtotime($year_start)));
  }
  

  //for test  
  $test_data_label1   =$months_sensor_val;  
 
  $farms_list = ["","","",""]; // Array of size 4 with farm   
 
  
  $farms_senor_monthly=array (array ());

  for ($i=0;$i<count($farms_list);$i++) {
    $list_all_farms_rainfall  =Array();  
    
    $list_all_farms_rainfall  = CallAPI("GET", "",$global['api_url']."/v1/farms/".($i+1)."/stats/".$sensor_type."/".$periodType);
    for ($y=0;$y<count($months_sensor_val);$y++) {
      if(isset($list_all_farms_rainfall)) {
     
        $farms_senor_monthly[$i][$y]=0;   
        foreach ($list_all_farms_rainfall->stats as $stats) {      
          if (isset($stats->month) && isset($stats->year)) {    
            $month =$stats->month;
            if (intval($stats->month)<10) {
              $month ="0".$stats->month;    
            }            
             

            if (isset($months_sensor_val[$y]) && (trim($months_sensor_val[$y])== trim($stats->year."-".$month))) {
              if(isset($stats->average)) {
                $farms_senor_monthly[$i][$y]=trim($stats->average);  
              }            
            }
          }
        }           
      } 
    }                  
  }
  
 

  $test_data_serie1   =   $farms_senor_monthly;  
  $test_data_low1  =0;  //origin  
  
 }
?>
