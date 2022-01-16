<?php
// taking all the submodule of the module  


 $payment_method    ="";
 $payment_logo      ="";
 $arr_payment_details=""; 
 $arr_feed          = Array();
 if (isset($_GET['val'])) 
 { 
     $payment_method    = base64_decode($_GET['val']); 
     if($payment_method=="mastercard")  $payment_logo="images/demos/logo_mastercard.PNG";
     if($payment_method=="visa")        $payment_logo="images/demos/logo_visa.PNG";
     if($payment_method=="paypal")      $payment_logo="images/demos/logo_paypal.PNG";
     if($payment_method=="orange")      $payment_logo="images/demos/logo_orange_money.PNG";
     if($payment_method=="MTN")         $payment_logo="images/demos/logo_mtn_mobile_money.PNG";   
 }  


 switch ($action)
 {                    
  default:
  $arr_feed            = Array();  
  if(isset($_POST['paiement_id']))
  {
   // List of the transactions in the database. 
   $list_transactions  =  selectAll("transactions"); 
   // Information regarding the chosen payment method 
   $payment_details    =  select_cond_one("payment_method","company_acquirer",$payment_method,$cond=0,$order='added'); 
      
   // Check mail
   $error_mail         = False;     
   if(isset($_POST['mail_destinataire']) && trim($_POST['mail_destinataire'])!="")
   {
     $error_mail         = error_mail($_POST['mail_destinataire']);       
   }   

   // Check phone number
   $error_phone        = False;      
   if(isset($_POST['telephone_destinataire']) && error_empty($_POST['telephone_destinataire'])) 
   {                     
     $error_phone      = error_number(trim($_POST['telephone_destinataire']));           
   } 
    
   // Check name  
   $error_name         = False;      
   if(isset($_POST['nom_destinataire']) && error_empty($_POST['nom_destinataire'])) 
   {                              
     $error_name       = germanNameTitle(trim($_POST['nom_destinataire']));           
   } 

   $error_firstname    = TRUE;      
   if(isset($_POST['prenom_destinataire'])) 
   {                              
     $error_firstname  = germanNameTitle(trim($_POST['prenom_destinataire']));           
   } 

   // Check address 
   $error_address1     = False;      
   if(isset($_POST['address_destinataire1']) && error_empty($_POST['address_destinataire1'])) 
   {                          
      $error_address1   = valAdress(trim($_POST['address_destinataire1']));           
   } 

   $error_address2     = TRUE;      
   if(isset($_POST['address_destinataire2']) && error_empty($_POST['address_destinataire2'])) 
   {                              
     $error_address2   = valAdress(trim($_POST['address_destinataire2']));           
   } 

   $error_valid        = False;       
   if ( 
        ($error_mail==TRUE && $error_phone==TRUE && $error_name==TRUE && $error_firstname==TRUE) 
                                                 &&
        ($error_firstname==TRUE && $error_address1==TRUE && $error_address2==TRUE)                                                    
    ) 
   {
   $error_valid        = TRUE;   
   }  

   if($error_valid==TRUE)   
   {
       
   $error_valid                       = TRUE;     
   $arr_feed["trans_code"]            = 1000000001 + $list_transactions['count']; 
   $arr_feed["transaction_date"]      = date("Y-m-d h:i:s");  
   $arr_feed["payment_method"]        = $payment_details[0]['method']; 
   $arr_feed["card_type"]             = $payment_details[0]['payment_method_label']; 
   $arr_feed["Acquirer_company"]      = $payment_details[0]['company_acquirer']; 
   $arr_feed["gateway"]               = "Walkap Services"; 
   $arr_feed["card_number"]           = $payment_details[0]['card_number']; 
   $arr_feed["exp_month"]             = $payment_details[0]['exp_month'];
   $arr_feed["exp_year"]              = $payment_details[0]['exp_year'];
   $arr_feed["cvv"]                   = $payment_details[0]['cvv2'];
   $arr_feed["amount"]                   = 20000;
   $arr_feed["currency"]              = "XAF";
   $arr_feed["merchant_label"]        = "Walkap Boutiques";
   $arr_feed["order_number"]          = "wdfjdfjfknn3940904049i40";
   $arr_feed["customer_name"]         = dbInput($_POST['nom_destinataire']);
   $arr_feed["customer_firstname"]    = dbInput($_POST['prenom_destinataire']); 
   $arr_feed["customer_phone_number"] = dbInput($_POST['telephone_destinataire']); 
   $arr_feed["customer_email"]        = dbInput($_POST['mail_destinataire']); 
   $arr_feed["customer_address1"]     = dbInput($_POST['address_destinataire1']); 
   $arr_feed["customer_address2"]     = dbInput($_POST['address_destinataire2']); 
   $arr_feed["transaction_status"]    = "Approuvée"; 
     
  
   dbInsert("transactions", $arr_feed); 
   // sending email 
   /*
    $mailer1->From($arr_feed["mail"]);
    $mailer1->to("leppidja@gmail.com");
    $mailer1->Mail->IsHTML(true);
    $mailer1->Mail->Subject .= ": HTML only";        
    $mailer1->Mail->Body = "This is a <b>test message</b> written in HTML. </br>" .
                            "Go to <a href=\"http://phpmailer.sourceforge.net/\">" .
                            "http://phpmailer.sourceforge.net/</a> for new versions of " .
                            "phpmailer.  <p/> Thank you!";
    $mailer1->BuildBody();
    $mailer1->assert($this->Mail->Send(), $this->Mail->ErrorInfo); 
   */     
    redirectTo("index.php?valid");
   }
  } 
 }

/*
 switch ($action)
 {                    
  case "darkcherry":
   $title      ="DarkCherry";     
   $main_title ="<li>Main menu of our application</li><li>Application runs on Android</li>";
   $main_image ="images/imagesdarkcherry/image3.jpg";
      
   $images0    ="images/imagesdarkcherry/image4.jpg";
   $text0      ="<li>Players in action on DarkCherry  </li>"; 
   $images1    ="images/imagesdarkcherry/image3.jpg"; 
   $text1      ="<li>Main menu of our application</li><li>Application runs on Android</li>";
  break;    
 
  case "money_fly":                
   $title      ="Money Fly";
   $main_title ="<li>Main menu of our project</li> <li>It is divided in four modules</li> <li>Envoi Classique is the most important module of the project</li>";
   $main_image ="images/imagesmoneyfly/imagemoney2.jpg";
     
   $images0    ="images/imagesmoneyfly/imagemoney3.jpg";
   $text0      ="<li>Module: Envoi Classique</li> <li>It contains twelve sub module that can be seen on the left of the screen shot</li> <li>Putting the mouse on : Gestion des T R F, diplays the list of operations</li>";    
   $images1    ="images/imagesmoneyfly/imagemoney4.jpg";
   $text1      ="<li>Sub module: Emission de Transert</li> <li>It helps user to manipulate transfert of money between customers </li>";   
   $images2    ="images/imagesmoneyfly/imagemoney1.jpg"; 
   $text2      ="<li>Login page</li>";      
   $images3    ="images/imagesmoneyfly/imagemoney2.jpg"; 
   $text3      ="<li>Main menu of our project</li> <li>It is divided in four modules</li> <li>Envoi Classique is the most important module of the project</li>";   
   break;      
 } 
 */
?>