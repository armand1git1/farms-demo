<?php
 function language_xml_login($xml,$lang)                                                     // Sorting the tag Sport
 {
  $tab_index    =Array();
  if (isset($xml))
  {
   if (isset($lang))
   {
     foreach($xml->$lang as $k1=>$language)
     {
       if(isset($language))
       {
          $tab_index['title']                      = $language->title."";
          $tab_index['subtitle']                   = $language->subtitle."";
          $tab_index['subtitle2']                  = $language->subtitle2."";
          $tab_index['charac1']                    = $language->link1."";
          $tab_index['charac2']          		       = $language->link1."";
      }
    }
   }
  return($tab_index);
  }
}

        // Case file : loading xml tag for the page
$file      ="lang/lang_login.xml";
$xml       =get_array_xml($file);


  // Sorting the xml file, which becomes a tree,
  // english
$tab_value =language_xml_login($xml,"english");
  // french
$pos = strpos($actual_link, "lang=fr");

if ((isset($pos) && $pos!==false))
{
   $tab_value=language_xml_login($xml,"french");
}


if(isset($_REQUEST['message']))
$message = $_REQUEST['message'];

$action ="login";
if (isset($_GET['action']) && !empty($_GET['action']))
{
 $action = $_GET['action'];
}

$merchant_ip1          = getRealIpAddr();  // login ip

$msg_invalid1          = "Invalid data !!!";
$msg_psw_invalid       = "Invalid Password !!!";
$msg_psw_invalid_title = "Password and Re-password have to be identical !!!";
$msg_consent_invalid   = "Accept that you have read and agree to Walkap's User Agreement and Privacy Statement. ";
$msg_invalid_login     = "Invalid Email or Password !!!";
$msg_duplicate_mail    = "E-mail already taken !!!";

if($action == 'login')
{
   // Destroy the merchant session if it exists
   if (isset($_SESSION['merchant'])) unset($_SESSION['merchant']); // Destroys session merchnt

   // Replace by a function
   if (isset($_POST["login_user"]))
   {

    $username         = trim($_POST['merchant_email']);
    $password         = trim($_POST['merchant_pasw']);

    $Arr_user         = Array(); // user's data

    $error_login      = FAlSE;  // True
    // Check mail
    $error_mail       = FAlSE;

    if(isset($username) && (error_empty($username)==TRUE)) $error_mail        = error_mail($username);
    // check psw
    $error_psw        = FAlSE;
    if(isset($password) && (error_empty($password)==TRUE))  $error_psw        = TRUE;

    $is_auth = check_auth($username, $password);
    // Because Api is down 
    //$is_auth = TRUE;

    if ($is_auth) {
      @session_start();
      // save token and username in session for call api
      $_SESSION['token']      = base64_encode($username.":".$password);
      $_SESSION['username']   = $username;
      redirectTo('index.php?lang=en&module=transactions');
    }
  }
}


if($action == 'register')
{
   // Replace by a function
   if (isset($_POST["Next"]))
   {
     $lang      =$_GET['lang'];
     // Keeping the first step infos into a session table
     $_SESSION['merchant']['merchant_id']     = max_pk("merchant", "merchant_id");  // merchant id
     if(isset($_POST['merchant_firstname']))  $_SESSION['merchant']['merchant_firstname'] = trim($_POST['merchant_firstname']);
     if(isset($_POST['merchant_lastname']))   $_SESSION['merchant']['merchant_lastname']  = trim($_POST['merchant_lastname']);
     if(isset($_POST['merchant_email']))      $_SESSION['merchant']['merchant_email']     = trim($_POST['merchant_email']);
     if(isset($_POST['merchant_psw']))        $_SESSION['merchant']['merchant_psw']       = trim($_POST['merchant_psw']);

     // Checking erros
     // Check mail is correct in the email format standard
     $error_mail         = FAlSE;
     $error_mail_dupli   = TRUE; // Checking if the email exist already
     $Arr_check_mail_dupl= Array();
     if(isset($_SESSION['merchant']['merchant_email']) && (error_empty($_SESSION['merchant']['merchant_email'])==TRUE))
     {
      $error_mail        = error_mail($_SESSION['merchant']['merchant_email']);
      if($error_mail==TRUE){
      	$Arr_check_mail_dupl  = select_cond_one("merchant","merchant_email",$_SESSION['merchant']['merchant_email'],1); // My values
      	if (!empty($Arr_check_mail_dupl) && count($Arr_check_mail_dupl)>0) $error_mail_dupli=FAlSE;
      }
     }


     // Check name
     $error_name         = FAlSE;
     if(isset($_SESSION['merchant']['merchant_lastname']) && (error_empty($_SESSION['merchant']['merchant_lastname'])==TRUE))
     {
       $error_name       = germanNameTitle(trim($_SESSION['merchant']['merchant_lastname']));
     }

     // Check firstname
     $error_firstname    = FAlSE;
     if(isset($_SESSION['merchant']['merchant_firstname']) && (error_empty($_SESSION['merchant']['merchant_firstname'])==TRUE) )
     {
       $error_firstname  = germanNameTitle($_SESSION['merchant']['merchant_firstname']);
     }

    // Check psw
    // Checking special characters
     $error_psw          = FAlSE;
     if (
     	  (isset($_POST['merchant_psw'])    && error_empty($_POST['merchant_psw']))
     	  	                                &&
     	  (isset($_POST['merchant_repasw']) && error_empty($_POST['merchant_repasw']))
     	)
     {
       if (trim($_POST['merchant_psw']) == trim($_POST['merchant_repasw']))
       {
      $error_psw       = TRUE;
       }
     }

   	 if ($error_mail==TRUE && $error_mail_dupli==TRUE && $error_name==TRUE && $error_firstname==TRUE && $error_psw==TRUE)
   	 {
       redirectTo('index.php?lang=en&module=login&action=register2');
     }
   }
}

// Register step 2
if($action == 'register2')
{
   // Country list
   $Arr_countries_list     = select_all("countries"," code",1);
   //print_r($Arr_countries_list);

   if (isset($_POST["register_user"]))
   {
    // merchant details into a session
   	if (isset($_POST["transac_country"]))      $_SESSION['merchant']['merchant_country']  = trim($_POST["transac_country"]); // merchant country
   	if (isset($_POST["merchant_address"]))     $_SESSION['merchant']['merchant_address']  = trim($_POST["merchant_address"]);
   	if (isset($_POST["merchant_postal_code"])) $_SESSION['merchant']['merchant_pos_code'] = trim($_POST["merchant_postal_code"]);
   	if (isset($_POST["merchant_city"]))		     $_SESSION['merchant']['merchant_city']     = trim($_POST["merchant_city"]);
   	if (isset($_POST["merchant_region"]))	     $_SESSION['merchant']['merchant_region']   = trim($_POST["merchant_region"]);
    if (isset($_POST["merchant_phone"]))	     $_SESSION['merchant']['merchant_phone']    = trim($_POST["merchant_phone"]);
    
    $error_address          =FAlSE;
    if(isset($_SESSION['merchant']['merchant_address']))       $error_address = error_empty($_SESSION['merchant']['merchant_address']);
 
    $error_pos_code         =FAlSE;
    if(isset($_SESSION['merchant']['merchant_pos_code']))     $error_pos_code = error_number($_SESSION['merchant']['merchant_pos_code']);

    $error_city             =FAlSE;
    if(isset($_SESSION['merchant']['merchant_city']))         $error_city    = germanNameTitle($_SESSION['merchant']['merchant_city']);

    $error_region           = FAlSE;
    if(isset($_SESSION['merchant']['merchant_region']))       $error_region  = germanNameTitle($_SESSION['merchant']['merchant_region']);

    $error_phone            = FAlSE;
    if(isset($_SESSION['merchant']['merchant_phone']) && error_empty($_SESSION['merchant']['merchant_phone']))  $error_phone = error_number($_SESSION['merchant']['merchant_phone']);
  
    // checking the sent of
    $error_chekbox1         = FAlSE;
    if (isset($_POST['chekbox1']))  $error_chekbox1=TRUE;
    if (($error_address==TRUE) && ($error_pos_code==TRUE) && ($error_city==TRUE) && ($error_region==TRUE) && ($error_phone==TRUE) && ($error_chekbox1==TRUE))
    {
     $data_to_send = '{"username" : "'.$_SESSION['merchant']['merchant_email'].'", "password" : "'.$_SESSION['merchant']['merchant_psw'].'", "email" : "'.$_SESSION['merchant']['merchant_email'].'", "firstName": "'.$_SESSION['merchant']['merchant_firstname'].'", "lastName": "'.$_SESSION['merchant']['merchant_lastname'].'"}';
     $info_user = CallAPI("POST", "", $global['api_url']."/accounts/register", $data_to_send);
     if(!empty($info_user)) {
      // for testing purpose 
      /***  For test */
      $_SESSION['merchant']['merchant_registration_date']= date("Y-m-d h:i:s");   // registration date
      $_SESSION['merchant']['merchant_status']= "Pending";          // Default status
      $merchant_lang        = "en";                                 // merchant language
      if (isset($_GET["lang"]) && !empty($_GET["lang"]))  $merchant_lang =$_GET["lang"];
      $_SESSION['merchant']['merchant_registration_lang']= $merchant_lang;
      $_SESSION['merchant']['merchant_preferred_lang']   = $merchant_lang;
      if (isset($_SESSION['merchant']['merchant_psw']) && !empty($_SESSION['merchant']['merchant_psw'])) {
      $_SESSION['merchant']['merchant_psw']=password_hash($_SESSION['merchant']['merchant_psw'],PASSWORD_BCRYPT);   // hash encryption
      }
      $_SESSION['merchant']['merchant_registration_ip']= $merchant_ip1; // merchant ip
      dbInsert("merchant", $_SESSION['merchant']); // insert data into table merchant
      /***  End test */
      unset($_SESSION['merchant']);  // detruire la session
      redirectTo('index.php?lang=en');
     }
    } 

    /*
   	// Check address
   	 if (($error_address==TRUE) && ($error_pos_code==TRUE) && ($error_city==TRUE) && ($error_region==TRUE) && ($error_phone==TRUE) && ($error_chekbox1==TRUE))
   	 {
       $_SESSION['merchant']['merchant_registration_date']= date("Y-m-d h:i:s");   // registration date
       $_SESSION['merchant']['merchant_status']= "Pending";          // Default status
       $merchant_lang        = "en";                                 // merchant language
       if (isset($_GET["lang"]) && !empty($_GET["lang"]))  $merchant_lang =$_GET["lang"];
       $_SESSION['merchant']['merchant_registration_lang']= $merchant_lang;
       $_SESSION['merchant']['merchant_preferred_lang']   = $merchant_lang;
       if (isset($_SESSION['merchant']['merchant_psw']) && !empty($_SESSION['merchant']['merchant_psw'])) {
       $_SESSION['merchant']['merchant_psw']=password_hash($_SESSION['merchant']['merchant_psw'],PASSWORD_BCRYPT);   // hash encryption
       }
       $_SESSION['merchant']['merchant_registration_ip']= $merchant_ip1; // merchant ip
       dbInsert("merchant", $_SESSION['merchant']); // insert data into table merchant
       unset($_SESSION['merchant']);  // detruire la session
       redirectTo('index.php?lang=en');
     }
     */
   }
}

// forgot password work
else if($action=='forgot')
{
	$username = dbOutput($_POST['username']);
	$userCount = dbRecordCheck(TABLE_EXHIBITORS, 'email', "email='$username'");

	if($userCount > 0)
	{
	  if($userCount == 1)
	  {
	    $newPassword = createRandomValue(8);
	    $updateData['ex_pass'] = md5($newPassword);
	    dbUpdate(TABLE_EXHIBITORS, $updateData, "email='$username'");

	    $sql = 'SELECT exhibitor_id,show_id FROM ' . TABLE_EXHIBITORS . " WHERE email='$username'";
	    $query = dbQuery($sql);
	    $result = mysql_fetch_array($query);
	    $exhibitor_id = $result['exhibitor_id'];

	    $showInfo = getShowInfo($result['show_id']);

	    $emailBody = '';
      $emailBody .= "Your Password for the show " . $showInfo['show_name'] . " has been reset.\n\n";

      $emailBody .= "Your Password: " . $newPassword . "\n\n";

      $emailBody .= "To login please follow the link below.  \n\n";
      $emailBody .= "http://www.exhibitorcd.com/landing/?uid=" . $exhibitor_id . "\n\n";



      $emailSubject = '[' . $showInfo['show_name'] . '] Exhibitor Password Reset';

      mail($username, $emailSubject, $emailBody, 'From: ' . $showInfo['contact_email']);

	  if(SITE_MODE == 'TEST')
      {
        $fp = fopen('exhibit_pass_' . $exhibitor_id . '.txt', 'w');
        fwrite($fp, $emailBody);
        fclose($fp);
      }
	    redirectTo('password_forgotten.php?action=success&uid='.$exhibitor_id);
	  }
	  else
	  {

	  }
	}
	else
	{
		$adminMessage = '<span class="errorBox"><span class="errorText">Error: </span>Wrong Email Address !!!</span>';
	}
}
?>
