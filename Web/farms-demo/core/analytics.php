<?php
// taking all the submodule of the module


 function language_xml_analytic($xml,$lang)                                                     // Sorting the tag Sport
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
          $tab_index['charac1']                    = $language->charac1."";
          $tab_index['charac2']          		       = $language->charac2."";
          $tab_index['charac3']					           = $language->charac3."";
          $tab_index['charac4']      		           = $language->charac4."";

          $tab_index['charac5']        		         = $language->charac5.""; // Approved
          $tab_index['charac6']    		             = $language->charac6."";
          $tab_index['charac7']         		       = $language->charac7."";
          $tab_index['charac8']                    = $language->charac8."";
          $tab_index['charac9']                    = $language->charac9."";
          $tab_index['charac10']                   = $language->charac10."";
        } // end of english case
      }
    }
   }
  return($tab_index);
 }

 $payment_method     ="";
 $payment_logo       ="";
 $arr_payment_details="";

 
 switch ($action)
 {
  default:
        // Case file : loading xml tag for the page
  $file      ="lang/lang_analytic.xml";
  $xml       =get_array_xml($file);


  // Sorting the xml file, which becomes a tree,
  // english
  $tab_value =language_xml_analytic($xml,"english");

  // french
  $pos = strpos($actual_link, "lang=fr");

  if ((isset($pos) && $pos!==false))
  {
   $tab_value=language_xml_analytic($xml,"french");
  }

  
 }
?>
