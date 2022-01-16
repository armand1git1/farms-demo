<div class="row">
<div id="div_1" class="container">
 <form action="" method="post" name="search_trans">


  <?php
  
  //data to pass for the graph
  // Alll first 15 transactions 
  
  $page=0;
  $periodType                                   = "month"; 
  
  $list_all_transactions_type_monthly_sent      = Array(); 
  $list_all_transactions_type_monthly_received  = Array();
  $list_all_transactions                        = Array();    

  if (isset($_SESSION['token'])) {
    $list_all_transactions_type_monthly_sent      = CallAPI("GET", $_SESSION['token'], $global['api_url']."/accounts/".$_SESSION['username']."/transactions"."/stats"."/sent"."?periodType=".$periodType);  
  }
  
  if (isset($_SESSION['token'])) {
    $list_all_transactions_type_monthly_received  = CallAPI("GET", $_SESSION['token'], $global['api_url']."/accounts/".$_SESSION['username']."/transactions"."/stats"."/receive"."?periodType=".$periodType);
  }
  


  if(isset($_SESSION['username'])) {
    $list_all_transactions   = CallAPI("GET", $_SESSION['token'], $global['api_url']."/accounts/".$_SESSION['username']."/transactions"."?page=".$page."&size=15&sort=DESC&sortField=createDate");
  }
  

  if (isset($list_all_transactions->_embedded->transactionDetailList[0]->createDate)) {
    $most_reccent_transaction_date = $list_all_transactions->_embedded->transactionDetailList[0]->createDate; 
  }
  
  $string_array1           = Array(); 
  if (isset($most_reccent_transaction_date)) {
    $string_array1           = explode("T",$most_reccent_transaction_date);
  }
  
  
  if (isset($list_all_transactions->page->totalPage)) {
    $page                    = $list_all_transactions->page->totalPages-1;
  }
  
  

  $list_all_transactions1 = Array();     
  if (isset($_SESSION['token'])) {
    $list_all_transactions1 = CallAPI("GET", $_SESSION['token'], $global['api_url']."/accounts/".$_SESSION['username']."/transactions"."?page=".$page."&size=15&sort=DESC&sortField=createDate");
  }
  
 

  if (isset($list_all_transactions1->_embedded)) {
    $less_reccent_transaction_date = $list_all_transactions1->_embedded->transactionDetailList[count($list_all_transactions1->_embedded->transactionDetailList)-1]->createDate; 
  }
  

  /* 
  echo $less_reccent_transaction_date; 
  print_r($list_all_transactions1); 
  die();
  */
  $string_array2           = Array(); 
  if (isset($less_reccent_transaction_date)) {
    $string_array2           = explode("T",$less_reccent_transaction_date);
  }
  
  if (count($string_array2)>0) {
    $month_diff              = nbr_month_2dates($string_array2[0], $string_array1[0]); 
  }
  

  print_r($list_all_transactions_type_monthly_sent);
  $transaction_type        = ["SENDED_TO_PAYEE","TECHNICAL_MOMO_PROVIDER_PROBLEM","INITIALIZED"];
  $transaction_type_monthly=array (array ());

  echo "<br />"; 
  // verify the code with data sent
  for($i=0; $i<count($transaction_type);$i++) {
    $sended_total=0;      
    
      if( (isset($list_all_transactions_type_monthly_sent) && !empty($list_all_transactions_type_monthly_sent))  ||   (isset($list_all_transactions_type_monthly_received) && !($list_all_transactions_type_monthly_received))) {
        $type              = $transaction_type[$i];
        $month_diff=0;
        for($y=0; $y<=$month_diff; $y++) 
        { 
          $montant_sent    =0;
          $montant_receive =0;
          //$Sent transaction   
          if (isset($list_all_transactions_type_monthly_sent->$type[$y]->total)) {
            $montant_sent   = $list_all_transactions_type_monthly_sent->$type[$y]->total;
          }         
          // receive transaction 
          if (isset($list_all_transactions_type_monthly_received->$type[$y]->total)) {
            $montant_receive = $list_all_transactions_type_monthly_received->$type[$y]->total;  
          }

          // total transaction related to period
          $transaction_type_monthly[$i][$y] = ($montant_sent +$montant_receive);  
        }  
      }               
  }

  //print_r($transaction_type_monthly);
  
  //die();
  $test_data_low1  =5000;  //origin
 
  //die(); 
  ?>

  <h5 class="header center boutique section-title"><?php if (isset($tab_value['subtitle'])) echo $tab_value['subtitle'];?></h5>

 <div class="row">
      <div class="input-field col s6" style="width:150px">      
        <label style="color:#000000"><strong><?php if (isset($tab_value['charac1'])) echo $tab_value['charac1'];?> :</strong></label> 
      </div>
      <div class="input-field col s6" style="width:250px">      
       <label style="color:#000000"><?php if (isset($tab_value['charac3'])) echo $tab_value['charac3'];?></label>
      </div>
  </div>     

  <div class="row">
      <div class="input-field col s6" style="width:150px">      
        <label style="color:#000000"><strong><?php if (isset($tab_value['charac2'])) echo $tab_value['charac2'];?>:</strong></label> 
      </div>
      <div class="input-field col s6" style="width:250px">      
        <label style="color:#000000"> <?php if (isset($tab_value['charac4'])) echo $tab_value['charac4'];?></label>
      </div>
  </div>     

  <div class="row">&nbsp;
  </div>   

 <div class="row">
      <div class="input-field col s6" style="width:50px; background-color: #59922b">&nbsp;</div>

      <div class="input-field col s6" style="width:120px">      
        <label style="color:#000000"><?php if (isset($tab_value['charac5'])) echo $tab_value['charac5'];?></label>
      </div>

      <div class="input-field col s6" style="width:50px; margin-left:50px; background-color: #f05b4f">&nbsp;</div>
      <div class="input-field col s6" style="width:280px">      
        <label style="color:#000000"><?php if (isset($tab_value['charac6'])) echo $tab_value['charac6'];?></label>
      </div>

      <div class="input-field col s6" style="width:50px; margin-left:50px; background-color: #f4c63d">&nbsp;</div>
      <div class="input-field col s6" style="width:170px">      
        <label style="color:#000000"><?php if (isset($tab_value['charac7'])) echo $tab_value['charac7'];?></label>
      </div>

      <!--
      <div class="input-field col s6" style="width:50px; margin-left:50px; background-color: #d17905">&nbsp;</div>
-->
      <!--
      <div class="input-field col s6" style="width:100px">      
        <label style="color:#000000"><?php //if (isset($tab_value['charac8'])) echo $tab_value['charac8'];?></label>
      </div>
-->
 </div>  

 <div class="row">&nbsp;</div> 

 <div class="row">
 <div class="ct-chart ct-perfect-fourth">

  <script src="bower_components/chartist/dist/chartist.js"></script>
   <script>
   
   /* 
    test1 
    var data = {
    // A labels array that can contain any sort of values
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
    // Our series array that contains series objects or in this case series data arrays
    series: [[5, 2, 4, 2, 0]]};

    // Create a new line chart object where as first parameter we pass in a selector
    // that is resolving to our chart container element. The Second parameter
    // is the actual data object.
    new Chartist.Line('.ct-chart', data);

    */


// passing php data to javascript code 
 var data1  = <?php echo json_encode($test_data_label1, JSON_HEX_TAG); ?>; // months x (axis)
 var data2  = <?php echo json_encode($test_data_serie1, JSON_HEX_TAG); ?>; // numbers y (axis)
 var origin = <?php echo json_encode($test_data_low1, JSON_HEX_TAG); ?>;   // origin of the graph


 //document.write(data);

/*
var chart = new Chartist.Line('.ct-chart', {
  //labels: represente x axis, we suppose we are in this current year 2020
  //  1st serie : Approved
  //  2nd serie : Declined
  //  3rd serie : Refunded
  //  4rd serie : Auth
  labels: ['Jan 2020', 'Freb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
  series: [
    [100000, 150000, 5000, 15000, 200000, 50000, 175000, 50000, 75000, 180000, 190000, 200000],
    [80000,  10000, 15000, 0, 20000, 35000, 30000, 20000, 10000, 5000, 25000, 30000],
    [25000,  50000, 0, 0, 10000, 5000, 5000, 10000, 5000, 0, 5000, 8000],
    [5000,  20000, 25000, 10000, 15000, 0, 25000, 50000, 100000, 50000, 5000, 10000]
  ]
}, {
  low: 0
});
*/


var chart = new Chartist.Line('.ct-chart', {
  //labels: represente x axis, we suppose we are in this current year 2020
  //  1st serie : Approved
  //  2nd serie : Declined
  //  3rd serie : Refunded
  //  4rd serie : Auth
  labels: data1,
  series: data2}, {
  low: origin});


// Let's put a sequence number aside so we can use it in the event callbacks
/*
var seq = 0,
  delays = 80,
  durations = 500;
*/
var seq = 0,
  delays = 50,
  durations = 1000;
// Once the chart is fully created we reset the sequence
chart.on('created', function() {
  seq = 0;
});

// On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
chart.on('draw', function(data) {
  seq++;

  if(data.type === 'line') {
    // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
    data.element.animate({
      opacity: {
        // The delay when we like to start the animation
        begin: seq * delays + 2000,
        // Duration of the animation
        dur: durations,
        // The value where the animation should start
        from: 0,
        // The value where it should end
        to: 1
      }
    });
  } else if(data.type === 'label' && data.axis === 'x') {
    data.element.animate({
      y: {
        begin: seq * delays,
        dur: durations,
        from: data.y + 100,
        to: data.y,
        // We can specify an easing function from Chartist.Svg.Easing
        easing: 'easeOutQuart'
      }
    });
  } else if(data.type === 'label' && data.axis === 'y') {
    data.element.animate({
      x: {
        begin: seq * delays,
        dur: durations,
        from: data.x - 100,
        to: data.x,
        easing: 'easeOutQuart'
      }
    });
  } else if(data.type === 'point') {
    data.element.animate({
      x1: {
        begin: seq * delays,
        dur: durations,
        from: data.x - 10,
        to: data.x,
        easing: 'easeOutQuart'
      },
      x2: {
        begin: seq * delays,
        dur: durations,
        from: data.x - 10,
        to: data.x,
        easing: 'easeOutQuart'
      },
      opacity: {
        begin: seq * delays,
        dur: durations,
        from: 0,
        to: 1,
        easing: 'easeOutQuart'
      }
    });
  } else if(data.type === 'grid') {
    // Using data.axis we get x or y which we can use to construct our animation definition objects
    var pos1Animation = {
      begin: seq * delays,
      dur: durations,
      from: data[data.axis.units.pos + '1'] - 30,
      to: data[data.axis.units.pos + '1'],
      easing: 'easeOutQuart'
    };

    var pos2Animation = {
      begin: seq * delays,
      dur: durations,
      from: data[data.axis.units.pos + '2'] - 100,
      to: data[data.axis.units.pos + '2'],
      easing: 'easeOutQuart'
    };

    var animations = {};
    animations[data.axis.units.pos + '1'] = pos1Animation;
    animations[data.axis.units.pos + '2'] = pos2Animation;
    animations['opacity'] = {
      begin: seq * delays,
      dur: durations,
      from: 0,
      to: 1,
      easing: 'easeOutQuart'
    };

    data.element.animate(animations);
  }
});

// For the sake of the example we update the chart every time it's created with a delay of 10 seconds
chart.on('created', function() {
  if(window.__exampleAnimateTimeout) {
    clearTimeout(window.__exampleAnimateTimeout);
    window.__exampleAnimateTimeout = null;
  }
  window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 12000);
}); 
   </script>
  </div>
 </div>


 <div class="row">
    <div class="input-field col s6">
      <input class="btn" type="submit" name="paiement_method" value="Search" >
    </div>  
 </div>

  </form>

</div>
</div>

