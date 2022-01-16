<?php
/*

$tab_value             = Array(); // Where data for xml corresponding to language are saved

/* This function will treat the variable $xml  for the file home  */     
 function language_xml_index($xml,$lang)                                                     // Sorting the tag Sport
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
          $tab_index['title']               = $language->title."";
          $tab_index['subtitle']            = $language->subtitle."";
          $tab_index['text1_title']         = $language->text1_title."";
          $tab_index['text1_title_desc']    = $language->text1_title_desc."";
          $tab_index['text2_title']         = $language->text2_title."";
          $tab_index['text2_title_desc']    = $language->text2_title_desc."";
        } // end of english case          
      }    
    }
   } 
  return($tab_index);                                      
 }

 switch ($action)
 {                    
  default:
  

  // Case 1 : language equals english or nothing 
  
  // Case file : loading xml tag for the page     
  $file      ="lang/lang_index.xml";    
  $xml       =get_array_xml($file); 
  

  // Sorting the xml file, which becomes a tree, 
  // english
  $tab_value =language_xml_index($xml,"english");          
 
  // french
  $pos = strpos($actual_link, "lang=fr"); 
  
  if ((isset($pos) && $pos!==false))
  {   
   $tab_value=language_xml_index($xml,"french"); 
  } 
}  
*/
?>