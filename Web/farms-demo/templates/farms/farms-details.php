<form action="" method="post" name="add_customer">
	<div class="row">
  <div id="div_1" class="container">
  <h5 class="header center section-title">
  <?php 
  // Display title    
      if (isset($tab_value['subtitle2'])) echo $tab_value['subtitle2'];         
  ?> 
  </h5>

  <?php // print_r($_SESSION['list_transactions']); ?>
  
  	
    <h5><?php if (isset($tab_value['sub_sub_title1'])) echo $tab_value['sub_sub_title1'];?></h5>
      
    <div class="row">

     <div class="input-field col s6">      
         
        <input id="momo_status" type="text" class="validate" disabled  name="momo_status"  value="<?php if (isset($info_usr_transact->transactionStatus->status)) echo $info_usr_transact->transactionStatus->status; //if (isset($transaction[$id]['transactionStatus'])) echo $transaction[$id]['transactionStatus']['status']; ?>">
        <label for="momo_status"><?php if (isset($tab_value['charac2'])) echo $tab_value['charac2']; ?></label>
      </div>



      <div class="input-field col s6">              
        <input id="sender_momo_id" type="text" class="validate" disabled  name="sender_momo_id"  value="<?php if (isset($info_usr_transact->sendBankAccount->mobileMoneyId)) echo $info_usr_transact->sendBankAccount->mobileMoneyId; //if (isset($transaction[$id]['sendBankAccount']['mobileMoneyId'])) echo $transaction[$id]['sendBankAccount']['mobileMoneyId']; ?>">
        <label for="sender_momo_id"><?php if (isset($tab_value['details1'])) echo $tab_value['details1']; ?></label>
      </div>

      <div class="input-field col s6">
        <input id="momo_date" type="text" class="validate" disabled name="momo_date"  value="<?php if (isset($info_usr_transact->createDate)) echo strftime("%a, %d %b %g - %Hh %M", strtotime($info_usr_transact->createDate));   //if (isset($transaction[$id]['createDate'])) echo strftime("%a, %d %b %g - %Hh %M", strtotime( $transaction[$id]['createDate']));  ?>">
        <label for="momo_date"><?php if (isset($tab_value['charac1'])) echo $tab_value['charac1'];?></label>
      </div>

      <div class="input-field col s6">
        <input id="momo_bank_method" type="text" class="validate" disabled name="momo_bank_method" value="<?php if (isset($info_usr_transact->sendBankAccount->bankMethod)) echo $info_usr_transact->sendBankAccount->bankMethod;  //if (isset($transaction[$id]['sendBankAccount']['bankMethod'])) echo $transaction[$id]['sendBankAccount']['bankMethod'];  ?>">
        <label for="momo_bank_method"><?php if (isset($tab_value['details3'])) echo $tab_value['details3'];?></label>
      </div>

      <div class="input-field col s6">
        <input id="transac_amount" type="text" class="validate" disabled name="transac_amount" value="<?php if (isset($info_usr_transact->amount)) echo $info_usr_transact->amount.' xaf';   //if (isset($transaction[$id]['amount'])) echo $transaction[$id]['amount'].' xaf'; ?>">
        <label for="transac_amount"><?php if (isset($tab_value['details4'])) echo $tab_value['details4'];?></label>
      </div>
    </div>


    <h5><?php if (isset($tab_value['sub_sub_title2'])) echo $tab_value['sub_sub_title2'];?></h5>    
    <div class="row">
      <div class="input-field col s6">
        <input id="sender_infos" type="tel" class="validate" name="sender_infos" disabled value="<?php if (isset($info_usr_transact->sendBankAccount->owner)) echo $info_usr_transact->sendBankAccount->owner; //if (isset($transaction[$id]['senderAccount']['idCards'])) echo $transaction[$id]['senderAccount']['idCards'][0]['firstName']." ".$transaction[$id]['senderAccount']['idCards'][0]['lastName']; ?>">
        <label for="sender_infos"><?php if (isset($tab_value['details5'])) echo $tab_value['details5'];?></label>
      </div>
      <div class="input-field col s6">
        <input id="sender_email" type="email" class="validate" name="sender_email" disabled value="<?php if (isset($info_usr_transact->senderAccount->email)) echo $info_usr_transact->senderAccount->email; //if (isset($transaction[$id]['senderAccount']['email'])) echo $transaction[$id]['senderAccount']['email']; ?>">
        <label for="sender_email" data-error="wrong" data-success="right"><?php if (isset($tab_value['details6'])) echo $tab_value['details6'];?></label>
      </div>
    </div>

    <h5><?php if (isset($tab_value['sub_sub_title3'])) echo $tab_value['sub_sub_title3'];?></h5>
    <div class="row">
      <div class="input-field col s6">
        <input id="receiver_momo_id" type="text" class="validate" name="receiver_momo_id" disabled value="<?php if (isset($info_usr_transact->receiveBankAccount->mobileMoneyId)) echo $info_usr_transact->receiveBankAccount->mobileMoneyId; //if (isset($transaction[$id]['receiverAccount'])) echo $transaction[$id]['receiverAccount']['bankAccounts'][0]['mobileMoneyId']; ?>">
        <label for="receiver_momo_id"><?php if (isset($tab_value['details1'])) echo $tab_value['details1'];?></label>
      </div>

      
      <div class="input-field col s6">
        <input id="receiver_bank_method" type="text" class="validate" name="receiver_bank_method" disabled  value="<?php if (isset($info_usr_transact->receiveBankAccount->bankMethod)) echo $info_usr_transact->receiveBankAccount->bankMethod; //if (isset($transaction[$id]['receiverAccount'])) echo $transaction[$id]['receiverAccount']['bankAccounts'][0]['bankMethod'];  ?>">
        <label for="receiver_bank_method"><?php if (isset($tab_value['details3'])) echo $tab_value['details3'];?></label>
      </div>
    </div>
    

    <div class="row">      
      <div class="input-field col s6">
        <input id="momo_receiver_owner" type="text" class="validate" name="momo_receiver_owner" disabled value="<?php if (isset($info_usr_transact->receiveBankAccount->owner)) echo $info_usr_transact->receiveBankAccount->owner; //if (isset($transaction[$id]['receiverAccount'])) echo $transaction[$id]['receiverAccount']['firstName'].' '.$transaction[$id]['receiverAccount']['lastName']; ?>">
        <label for="momo_receiver_owner"><?php if (isset($tab_value['details2'])) echo $tab_value['details2'];?></label>
      </div>

      <div class="input-field col s6">
        <input id="momo_receiver_mail" type="text" class="validate" name="momo_receiver_mail"  disabled  value="<?php  if (isset($info_usr_transact->receiverAccount->email)) echo $info_usr_transact->receiverAccount->email;  //if (isset($transaction[$id]['receiverAccount']['email'])) echo $transaction[$id]['receiverAccount']['email']; ?>">
        <label for="momo_receiver_mail"><?php if (isset($tab_value['details6'])) echo $tab_value['details6'];?></label>
      </div>
    </div>


   
    
    <!--
    <div class="row">
          <input type="submit" class="btn" name="action_customer" value="<?php if (isset($button_val)) echo $button_val;?> " />
      <input type="hidden" name="customer_id" />
    </div>
    -->
  </div>
  </div>
  </form>