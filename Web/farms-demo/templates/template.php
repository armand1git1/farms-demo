<?php
if (!defined('MAINFILE_INCLUDED'))
{
   die('You cannot access this file directly !');exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="utf-8">
  <meta name="language" content="en">
  <meta http-equiv="content-language" content="fr">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="theme-color" content="#33691e">

  <title>Walkap Services</title>
  <meta name="description" content="Walkap Services fournit les solutions monétiques et les services permettant à ses clients de développer et mettre en œuvre des stratégies de paiement solides et innovantes.">
  <link rel="shortcut icon" type="image/png"   href="images/favicon.png">
  <link rel="apple-touch-icon" sizes="144x144" href="images/logo-144-144.png">
  <link rel="apple-touch-icon" sizes="114x114" href="images/logo-114-114.png">
  <link rel="apple-touch-icon" sizes="72x72"   href="images/logo-72-72.png">
  <link rel="apple-touch-icon" sizes="57x57"   href="images/logo-57-57.png">

  <base href="" target="_self">

  <link rel="stylesheet" href="css/template.css">
  <link rel="stylesheet" href="css/custom.css">

  <link rel="stylesheet" href="http://walkap.net/css/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
  <link rel="stylesheet" href="http://cdn.materialdesignicons.com/1.7.22/css/materialdesignicons.min.css">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Open+Sans' type='text/css' media='all'/>
  <link rel="canonical"  href="#">
  <link rel="alternate"  type="application/rss+xml" title="Walkap Services" href="/feed.xml">

</head>


  <body>
    <div class="navbar">
  <nav>
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?php echo "index.php"; ?>" class="brand-logo hide-on-med-and-down"><img src="images/logo-960-960.png" class="logo-img" width="70" height="55" alt="Logo" />
        <span class="grey-text text-darken-3">Walkap Services</span></a>
        <a href="index.php" class="hide-on-large-only"><img class="responsive-img" src="images/logo-57-57.png" alt="Logo"/></a>
        &nbsp;
      </div>
    </div>
  </nav>
</div>

<div class="page-content">
      <div class="wrapper">
        <section>
  </div>
</section>
<!-- end #header -->
<section id="splash-blue">
  <h4 class="header center section-title"><?php if(isset($title)) echo $title;?> </h4>
</section>
 <section id="benefits">
 <h2 style="margin-left: 10%; color:#000; "> <?php if(isset($title)) echo $title; ?></h2>

  <div class="row" style="text-align: center;">
  <div class="container" style="text-align: center;" >
  <?php if (!(isset($_GET['module']))) { ?>
   <p style="text-align: left">
    “Online payment solutions save people's life “. Mr. Tamo, a university student from Cameroon said it during our first user study regarding online payment solutions in Africa. <br />In fact, by paying online, people will travel less and it will reduce the risks of accident. Such a strong sentence needed an action. Walkap created sentiment analyzer a system which helps to localized our design by collecting people's feelings about any topic online i.e.: <a href="http://ecobank.konguem.eu/"> Read what is said online about Ecobank </a>. It is combined with <a href="http://site.walkap.net/ecobank-challenge/index.php"> customer satisfaction system </a>which collect row data from customer at the exit of any financial agency. Those two systems can contribute efficiently in the development and maintenance phase of any user oriented  Systems such as Walkap.
    Below is the storyline of walkap.
    </p>
  <?php                                 } ?>

   <table style="max-width: 700px; margin-right: 100px">
     <tr height="5px" >
      <td class="text" width="650px" align="center" colspan="4">
        <a href="<?php if (isset($link_home)) echo $link_home; ?>" class="<?php if(isset($home_class)) echo $home_class; ?>">
        <label class="buttontext">Storyline</label></a>
        <a href="<?php if (isset($link_demo)) echo $link_demo; ?>" class="<?php if(isset($demo_class)) echo $demo_class; ?>">
        <label class="buttontext">Demo</label></a>
        <a href="<?php if (isset($link_transactions)) echo $link_transactions; ?>" class="<?php if(isset($transaction_class)) echo $transaction_class; ?>">
        <label class="buttontext">Transactions</label></a>
        <!--
        <a href="<?php // if (isset($link_analytics)) echo $link_analytics; ?>" class="<?php //if(isset($analytics_class)) echo $analytics_class; ?>"><label class="buttontext">Analytic</label></a>
        -->
         &nbsp;
        <a href="<?php if (isset($link_whats_in)) echo $link_whats_in; ?>" class="ui-button" target="_blank" style="margin-left:150px " title="KYCI : know your customer insights">
        <label class="buttontext_red">What's in ?</label></a>
       </td>
     </tr>
   </table>


  <?php /*
  if(isset($_GET['valid'])) {  ?>
   <table width="70%">
     <tr height="5px">
      <td class="text" width="200" align="center" colspan="4" bgcolor="66CDAA">
        <label  class="darktext" > Transaction completed.  </label>
     </td>
     </tr>
   </table>
   <?php }  */?>
 <?php
        if(isset($_SESSION['message']) && $_SESSION['message'])
        {
          echo $_SESSION['message'];
          $_SESSION['message'] = '';
        }

        // CONTENT GOES HERE

        if($global['script_name'] && file_exists(TEMPLATE_DIR . $global['script_name']))
        {
            include_once(TEMPLATE_DIR . $global['script_name']);
        }
?>


 </div>

 <footer class="orange" >
 <div class="footer-copyright" style="vertical-align: bottom; margin-bottom: 2px">
    <div class="container">
    &copy; 2015 - 2020 : Walkap Services
    </div>
  </div>
   </footer>
 </body>

</html>
