<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );

  $( function() {
    $( "#datepicker2" ).datepicker();
  } );
  </script>

<div class="row">
<div id="div_1" class="container">
 <form action="" method="post" name="search_trans">

   <?php if(isset($_SESSION['error_transaction']) && (!empty($_SESSION['error_transaction']) && ($_SESSION['error_transaction']==TRUE)))                   {   
  ?>
       <table width="70%" style="margin-left: 70px ">
       
        <?php if(isset($_SESSION['error_transaction']) && $_SESSION['error_transaction']==TRUE) {  ?>
        <tr>
          <td class="text" style="height:3px" width="200" align="center" colspan="4" bgcolor="#26a69a">
            <label  class="darktext" > <?php if (isset($tab_value['details7'])) echo $tab_value['details7'];?>  </label>
          </td>
        </tr>
     <?php  
       if (isset($_SESSION['error_transaction'])) unset($_SESSION['error_transaction']);
      }  ?>
       </table>
  <?php }  ?>





  	<h5 class="header center boutique section-title">List of farms</h5>
  
<div class="row">
      <div class="input-field col s6">      
        <input id="datepicker" type="text" class="validate"  name="date_from" value="<?php if(isset($_POST['date_from'])) {echo $_POST['date_from'];}else{if(isset($_SESSION["date1"])) echo $_SESSION["date1"];}   ?>" autocomplete="off">
        <label for="datepicker">From:(mm/dd/yyyy)</label>
      </div>

      <div class="input-field col s6">
        <input id="datepicker2" type="text" class="validate" name="date_to" value="<?php if(isset($_POST['date_to'])) {echo $_POST['date_to'];}else{if(isset($_SESSION["date2"]))  echo $_SESSION["date2"];} ?>" autocomplete="off">
        <label for="date_to">To:(mm/dd/yyyy)</label>
      </div>
 </div>   

 <div class="row">
      <div class="input-field col s6">      
      Status :&nbsp; 
      <select name="transac_stat" class="text">
        <option value="ANY" <?php if (isset($_POST["transac_stat"]) &&  ($_POST["transac_stat"]=="SELECTED")) echo "selected"; ?>>ANY</option>  
        <?php 
           
          if(isset($list_all_transactions_status) && is_array($list_all_transactions_status)){
             for($i=0; $i<count($list_all_transactions_status); $i++) {   
            ?>      
            <option value="<?php if (isset($list_all_transactions_status[$i])) echo $list_all_transactions_status[$i]; ?>" <?php if (isset($_POST["transac_stat"]) && ($_POST["transac_stat"]==$list_all_transactions_status[$i])) {echo "selected";}else{if(isset($_SESSION["status"]) && ($_SESSION["status"]==$list_all_transactions_status[$i])) echo "selected";} ?>>
                    <?php if  (isset($list_all_transactions_status[$i])) echo $list_all_transactions_status[$i]; ?> 
            </option>
          <?php
            }
          } 
          ?>         
       </select>
       
      </div>

      <div class="input-field col s6">
      Currency :&nbsp; 
      <select name="transac_cur" class="text">
           <option value="any" <?php if (isset($_POST["transac_cur"]) &&  ($_POST["transac_cur"]=="any")) echo "selected"; ?>>Any</option>
           <option value="xaf" <?php if (isset($_POST["transac_cur"]) &&  ($_POST["transac_cur"]=="xaf")) echo "selected"; ?>>XAF</option>
           <option value="eur" <?php if (isset($_POST["transac_cur"]) &&  ($_POST["transac_cur"]=="eur")) echo "selected"; ?>>Eur</option>
           <option value="dollar" <?php if (isset($_POST["transac_cur"]) &&  ($_POST["transac_cur"]=="dollar")) echo "selected"; ?>>Us Dollar</option>
           <option value="gbp" <?php if (isset($_POST["transac_cur"]) &&  ($_POST["transac_cur"]=="gbp")) echo "selected"; ?>>Gbp</option>
       </select> 
      </div>
 </div> 

 <div class="row">
    <div class="input-field col s6">
      <input class="btn" type="submit" name="paiement_method" value="Search" >
    </div>  
 </div> 

     <table style="border-spacing: 0px; width:100%; margin-left:auto;margin-right:auto;">
     <!-- Transactions -->
     <thead>
     <tr>
      <th>
          Id 
     </th>
    
     <th>
          Name
     </th>
    
     <th>
          Description
     </th>
     
     <th>
           Details
     </th>
     
    </tr>
    </thead>

    <tbody>
  
    <?php
         
     // list transactions 
     if (isset($list_all_transactions)) // Checking if the array exists and contains value
     {  
      //print_r($list_all_transactions);       
      $i=0;      

        if (isset($list_all_transactions->_embedded->transactionDetailList)) {
         foreach ($list_all_transactions->_embedded->transactionDetailList as $transaction) 
         {         
         $i++; 
         $transaction->id;
         $style="height: 5px; background-color: #D3D3D3";    
         $result1 =($i % 2);
        if ($result1==True)    $style="height: 5px; background-color: #FFFFFF"; 
   
        $link_transaction_details=$link_transactions."&action=details"."&view=".base64_encode($i); 
     ?>
        <tr style="<?php if (isset($style)) echo $style; ?> ">
         <td style="height:3px; border-radius:0px;" width="50" colspan="1">
         <a href="<?php echo $link_transaction_details; ?>" style="font-weight: bold; color:#000;text-decoration: underline">
          <strong>
           <?php 
              $prefix    ='1000000'; 
              
              if (strlen('100000')>strlen($transaction->id)){
               $nbr_diff =strlen('100000')-strlen($transaction->id); 
               $prefix   =substr($prefix, 0, (strlen('100000')-1));    
               echo $prefix.$transaction->id;
              }else{
                echo $transaction->id;
              }
           ?>
          </strong> 
         </a> 
        </td>

        <td>
          <?php if (isset($transaction->createDate)) echo strftime("%a, %d %b %g - %Hh %M", strtotime($transaction->createDate)); ?>
        </td>

         <td>
           <?php
                 if (isset($transaction->transactionStatus->status)) echo $transaction->transactionStatus->status; 
           ?>
        </td>


 
       </tr>

        <?php        
      }
     }        
    } 
   ?>
    </tbody>
   </table>
   <table style="margin-bottom:10px;align:right;width:100%">
   <tr valign="bottom">
    <td style="text-align: right;" colspan="7">
    
   <?php
 //echo base64_decode($_GET['pg']); echo "==";
       if(isset($list_all_transactions->page->totalPages) && $list_all_transactions->page->totalPages>0) {         
          for($i=1;$i<=$list_all_transactions->page->totalPages;$i++)
          {
           $class ="ui-button-active";
           $link  =$link_transactions."&pg=".base64_encode($i)."";
           if (isset($_GET["srchdate"]))  $link  =$link_transactions."&pg=".base64_encode($i)."&srchdate";           
           if (isset($_GET["srchstatus"]))  $link  =$link_transactions."&pg=".base64_encode($i)."&srchstatus";
           if (isset($_GET["srchstatus"]) && isset($_GET["srchdate"]))  $link  =$link_transactions."&pg=".base64_encode($i)."&srchdate&srchstatus"; 
            if(
                (!isset($_GET['pg']) && $i==1)
                             ||
                  (isset($_GET['pg']) && base64_decode($_GET['pg'])==$i)
              )
            {
             $class="ui-button";
            }        
    ?>
     <a href="<?php echo $link; ?>"><label class="<?php  echo $class; ?>" ><?php echo $i; ?></label></a>&nbsp;
    <?php }                                                           }  ?>

   </td>
  </tr>
  </table>
  </form>

</div>
</div>
