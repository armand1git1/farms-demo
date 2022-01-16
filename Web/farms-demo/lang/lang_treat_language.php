<?php                             
/* 
leppidja 2011, freelance Analyst/Programmer
leppidja_stock_sale 
*/
//set_time_limit(0);  
       
class     treat_xml
{    
protected    $tb;

public function __construct() 
{             
 $this->tb         = array();                                 //Initialize the Array
 $this->thelanguage=$thelanguage;       
}

public function get_array_xml($lang,$file)
{
if (isset($file))
{
 $index_menu       =strpos($file,"menu");                      // checking if the file name contains the character "lss_menu"  
 if ((isset($index_menu) && $index_menu!==FALSE))
 {
 $indice           ="menu";  
 }
 
 $index_index      =strpos($file,"index");                      // checking if the file name contains the character "lss_menu"  
 if ((isset($index_index) && $index_index!==FALSE))
 {
 $indice           ="index";  
 }   
}   
$this->tb[1]       =$file;                                            
for ($i=1; $i<=count($this->tb); $i++)        
{                                                    
$fn                =$this->tb[$i];                            // name of file                           

 if(file_exists($fn) && filesize($fn)>0)                      // if file exits and the file's size is more than zero 
 {    
  $xml = simplexml_load_file($fn);                             
  /* Calling the function that will treat the container of the variable xml, by passing the $xml as variable */
  $tab=$this->language_en_xml_tag_lang($xml,$lang,$indice);           // Sorting the xml file, which is become a tree
 }            
}
return($tab);
}
        
/* This function will treat the variable $xml  for the file home  */     
public function language_en_xml_tag_lang($xml,$lang,$indice)                                                     // Sorting the tag Sport
{   
 $tab_index    =Array();               
 if (isset($xml))
 {  
  if (isset($lang)) 
  {
   if(isset($indice) && ($indice=="lss_index"))                 // index page 
   {     
    foreach($xml->$lang as $k1=>$language) 
    {                     
      if(isset($language))
      {             
       foreach($language->home as $k2=>$home)  
       {
        if (isset($home))                                         // Case english language
        {   
      $tab_index['connexion']= $home->Connexion->attributes()->name."";
      $tab_index['login']    = $home->login->attributes()->name."";
      $tab_index['password'] = $home->password->attributes()->name."";      
      $tab_index['forget']   = $home->forget->attributes()->name."";
        }      
       } // end of english case     
      }    
    }
   }
  
  /*
  if(isset($indice) && ($indice=="lss_menu"))                  // home page 
  {   
  foreach($xml->$lang as $k1=>$language) 
  {                     
   if(isset($language))
   {             
    foreach($language->menu as $k2=>$menu)  
    {
     if (isset($menu))                                          // Case english language
     {   
      $tab_index["home"]      = $menu->home->attributes()->name."";    // Case home 
      // Case suppliers :      
      $tab_index["suppliers"]["prop0"]    = $menu->suppliers->attributes()->name."";
      if (isset($tab_index["suppliers"]["prop0"]))
      {                     
       foreach($menu->suppliers as $k3=>$suppliers)    
       {  
        if(isset($suppliers))  
        {    
         $tab_index["suppliers"]["prop1"]= $suppliers->add->attributes()->name."";   //CaseAdd 
         $tab_index["suppliers"]["prop2"]= $suppliers->update->attributes()->name."";//caseupdat
         $tab_index["suppliers"]["prop3"]= $suppliers->delete->attributes()->name."";//casedelet
         $tab_index["suppliers"]["prop4"]= $suppliers->consult->attributes()->name."";
         }
       }       
      }              
      //Case : product
      $tab_index["product"]["prop0"]      = $menu->product->attributes()->name."";      
      if (isset($tab_index["product"]["prop0"]))
      {
       foreach($menu->product as $k3=>$product)    
       {
        if (isset($product))   
        { 
         $tab_index["product"]["prop1"] = $product->add->attributes()->name."";    //Case:Add   
         $tab_index["product"]["prop2"] = $product->update->attributes()->name.""; //CaseUpdate
         $tab_index["product"]["prop3"] = $product->delete->attributes()->name.""; //CaseDelete
         $tab_index["product"]["prop4"] = $product->consult->attributes()->name."";    
        }  
       }   
      }
      
      $tab_index["order"]["prop0"]      = $menu->order->attributes()->name."";     //Case :order
      if (isset($tab_index["order"]["prop0"]))  
      {
       foreach($menu->order as $k4=>$order)    
       {
        if (isset($order))
        {
         $tab_index["order"]["prop1"] = $order->add->attributes()->name."";    //Case:Add   
         $tab_index["order"]["prop2"] = $order->update->attributes()->name.""; //CaseUpdate
         $tab_index["order"]["prop3"] = $order->delete->attributes()->name.""; //CaseDelete
         $tab_index["order"]["prop4"] = $order->consult->attributes()->name."";       
         $tab_index["order"]["prop5"] = $order->print->attributes()->name."";         
        }    
       }
      }
      
      $tab_index["sale"]["prop0"]      = $menu->sale->attributes()->name."";     //Case :sale
      if (isset($tab_index["sale"]["prop0"]))  
      {
       foreach($menu->sale as $k5=>$sale)    
       {
        if (isset($sale))
        {
         $tab_index["sale"]["prop1"] = $sale->cash->attributes()->name."";  //Case: cash
         $tab_index["sale"]["prop2"] = $sale->ccard->attributes()->name.""; //Case: Ccard
         $tab_index["sale"]["prop3"] = $sale->check->attributes()->name.""; //Case: Check
         $tab_index["sale"]["prop4"] = $sale->online->attributes()->name."";//case: Online     
        }    
       }
      }
     // Case : State of activity  
     $tab_index["state"]             = $menu->state->attributes()->name.""; 
    
     // Case : parameters   
     $tab_index["params"]            = $menu->params->attributes()->name.""; 
     }      
    } // end of english case     
   }    
  }   
  } */
  }
 } 
return($tab_index);  
}                                    
}


$tab_class=new treat_xml();
$tab_value=$tab_class->get_array_xml("greek","lss_menu.xml");           
print_r($tab_value);

?>      