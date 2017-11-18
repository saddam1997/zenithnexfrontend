<?php
error_reporting(1);
session_start();


$success = $_GET['m'];
$forget = $_GET['f'];


if(isset($_POST['btnlogin']))
{
//  var_dump($_POST);
  $email_id = $_POST['email'];
  $password = $_POST['emailpassword'];
  

$postData = array(
   "email" => $email_id,
        "password" => $password
  );

// Create the context for the request
$context = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($postData)
    )
  ));
include_once('common.php');

$response = file_get_contents($url_api.'/auth/authentcate', FALSE, $context);

if($response === FALSE){
  die('Error');
}


$responseData = json_decode($response, TRUE);

$message = $responseData['message'];
$_SESSION["user_id"] = $responseData['user']['id'];
$_SESSION["user_session"] = $responseData['user']['email'];
$_SESSION['is_email_verify'] = $responseData['user']['verifyEmail'];
$_SESSION['user_admin'] = $responseData['user']['isAdmin'];
$_SESSION['BCHAddress'] = $responseData['user']['userBCHAddress'];
$_SESSION['BTCAddress'] = $responseData['user']['userBTCAddress'];
$_SESSION['GDSAddress'] = $responseData['user']['userGDSAddress'];
$_SESSION['EBTAddress'] = $responseData['user']['userEBTAddress'];
$_SESSION['BTCbalance'] = $responseData['user']['BTCMainbalance'];
$_SESSION['BCHbalance'] = $responseData['user']['BCHMainbalance'];
$_SESSION['GDSbalance'] = $responseData['user']['GDSMainbalance'];
$_SESSION['EBTbalance'] = $responseData['user']['EBTMainbalance'];
$_SESSION['BTCtradebalance'] = $responseData['user']['BTCbalance'];
$_SESSION['BCHtradebalance'] = $responseData['user']['BCHbalance'];
$_SESSION['GDStradebalance'] = $responseData['user']['GDSbalance'];
$_SESSION['EBTtradebalance'] = $responseData['user']['EBTbalance'];
$_SESSION['BTCfreezebalance'] = $responseData['user']['FreezedBTCbalance'];
$_SESSION['BCHfreezebalance'] = $responseData['user']['FreezedBCHbalance'];
$_SESSION['GDSfreezebalance'] = $responseData['user']['FreezedGDSbalance'];
$_SESSION['EBTfreezebalance'] = $responseData['user']['FreezedEBTbalance'];



if(isset($responseData['user']))
{
  
  header("location:index.php");
}

}

?>


<!DOCTYPE html>
<!-- saved from url=(0029)https://www.luno.com/en/login -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
    
<title>Sign in | ZenithNEX</title>


<script type="text/javascript" async="" src="assets/insight.min.js"></script><script async="" src="assets/analytics.js"></script><script src="assets/bugsnag-3.min.js" data-apikey="3cc67afdb6dd450441bc9023b5262f26" data-appversion="71d1732"></script>




<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="referrer" content="origin-when-cross-origin">

<link rel="apple-touch-icon-precomposed" sizes="152x152" href="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/common/img/favicon-152x152.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/common/img/favicon-144x144.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/common/img/favicon-120x120.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/common/img/favicon-114x114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/common/img/favicon-72x72.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/common/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/common/img/favicon-16x16.png">
<meta name="theme-color" content="#12326B">



<link rel="alternate" hreflang="en" href="ZenithNEX.com/login.html">


<meta name="description" content="Welcome back to Luno! Log in to your account to send, receive, buy or sell Bitcoin.">


<meta property="og:locale" content="en">
<meta property="og:type" content="website">
<meta property="og:title" content="Sign in | ZenithNEX">


<meta property="og:site_name" content="Luno">
<meta property="og:image" content="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/common/img/default_og_image.png">



<link href="assets/css" rel="stylesheet">
<link rel="stylesheet" href="assets/bootstrap.min.css">
<link rel="stylesheet" href="assets/website.css">


  <link href="assets/css(1)" rel="stylesheet">
</head>
<body id="o-wrapper" class="o-wrapper ln-account-body">


<nav class="navbar navbar-fixed-top ln-navbar">

  <div class="container-fluid page-banner collapse">
    ZenithNEX
    <a href="ZenithNEX.com/blog/en/">Read more</a>
    <a href="ZenithNEX.com" class="close">×</a>
  </div>

  <div class="container-fluid">
    <div class="navbar-header">
      <a id="sidenav-button--slide-left" class="ln-menu sidenav-button--slide-left" href="javascript:void(0)">
        
        <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 0h24v24H0z" fill="none"></path>
          <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
        </svg>
      </a>
      <a class="ln-logo" href="ZenithNEX.com/">
		<!-- <p>ZenithNEX</p> -->
      </a>
    </div>
    <div class="hidden-xs">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="loginnew.php">Sign In</a></li>
        <li><a href="signupnew.php" class="btn btn-primary ln-btn-sm">Sign Up</a></li>
      </ul>
      
<!--
      <ul class="nav navbar-nav navbar-right">
        <li><a class="btc-price" href="ZenithNEX.com/en/price">BTC/INR 398,423</a></li>
        
      </ul>
-->
    </div>
  </div>
</nav>

    
<nav id="sidenav-menu--slide-left" class="sidenav-menu sidenav-menu--slide-left">
  <div class="ln-sidenav-top">
    <a href="javascript:void(0)" class="sidenav-menu__close ln-close">
      
      
    </a>
    
    <a class="btn btn-primary ln-btn-primary" href="signupnew.php">Get Started</a>
  </div>
  <div class="ln-sidenav-links visible-xs">
    <h4>Account</h4>
    <ul class="nav">
      <li class="nav-item">
        <a href="loginnew.php">Sign In</a>
      </li>
      <li class="nav-item">
        <a href="signupnew.php">Sign Up</a>
      </li>
      
    </ul>
  </div>
  <hr class="ln-divider visible-xs">
  <div class="ln-sidenav-links">
    
	<h4>Resources</h4>
	<ul class="nav">
	  <li class="nav-item">
	    <a href="ZenithNEX.com/blog/en/">Blog</a>
	  </li>
	  <li class="nav-item">
	    <a href="ZenithNEX.com/help/en/">Help Centre</a>
	  </li>
	  <li class="nav-item">
	    <a href="ZenithNEX.com/en/price">Bitcoin Price</a>
	  </li>
	  <li class="nav-item">
	    <a href="ZenithNEX.com/learn/en/">Learning Portal</a>
	  </li>
	  <li class="nav-item">
	    <a href="ZenithNEX.com/en/countries">Fees &amp; Features</a>
	  </li>
	</ul>

  </div>
  <hr class="ln-divider">
  <div class="ln-sidenav-links">
    
	<h4>Products</h4>
	<ul class="nav">
	  <li class="nav-item">
	    <a href="ZenithNEX.com/en/exchange">Exchange</a>
	  </li>
	  <li class="nav-item">
	    <a href="ZenithNEX.com/en/api">API</a>
	  </li>
	</ul>

  </div>
  <hr class="ln-divider">
  <div class="ln-sidenav-links">
    
	<h4>About</h4>
	<ul class="nav">
	  <li class="nav-item">
	    <a href="ZenithNEX.com/en/about">Company</a>
	  </li>
	  <li class="nav-item">
	    <a href="ZenithNEX.com/en/careers">Careers</a>
	  </li>
	</ul>

  </div>
  <hr class="ln-divider">
  
</nav>
<div id="sidenav-mask" class="sidenav-mask"></div>

    
    <div class="ln-account-wrapper">
      

<div class="section">
  <h1 class="ng-binding">Welcome back</h1> 

  <p>
      <img ng-src="https://d32exi8v9av3ux.cloudfront.net/web/71d1732/website/pages/login/email.svg" width="58" height="60" src="assets/email.svg">
  </p>
<p style="color:Green;"> <?php if(isset($success)) {echo $success. " Successfully Signup You Can SignIn Now."; }?> </p>
<p style="color:Green;"> <?php if(isset($forget)) {echo $forget. " You Can SignIn Now."; }?> </p>
<p style="color:red;"> <?php if(isset($message)) {echo $message; }?> </p>
  <form  method="post" class="">

    <div class="form-group">
      <input class="form-control"  type="email" name="email" placeholder="Email address" autofocus="" required="">
    </div>
	<div class="form-group">
      <input class="form-control"  type="password" name="emailpassword" placeholder="Password" autofocus="" required="">
    </div>
	<!-- <div class="ln-captcha">
      <div class="g-recaptcha ng-pristine ng-untouched ng-valid ng-isolate-scope ng-empty" vc-recaptcha="" ng-model="vm.recaptcha" key="vm.recaptchaPublicKey"><div style="width: 304px; height: 78px;"><div><iframe src="./Sign up _ Luno_files/anchor.html" title="recaptcha widget" width="304" height="78" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;  display: none; "></textarea></div></div>
    </div> -->
    <button type="submit" name="btnlogin" class="btn ln-btn-sm btn-primary">Sign In</button>

    <div class="ln-account-secondary-actions">
      <a href="signupnew.php">Sign up</a>
    </div>
    <div class="ln-account-secondary-actions">
      <a href="forgetnew.php">Forget Password</a>
    </div>

  </form>
</div>
    
<script src="assets/deps.min.js"></script>
<script src="assets/website.js"></script>
<script>
  initPageBanner();
  initNavScroll();
  initSideNav();
  initForms();
  initFooter();
  LunoAuth.auth();
</script>




<script src="assets/saved_resource" type="text/javascript"></script><script src="assets/saved_resource(1)" type="text/javascript"></script><img src="https://secure.adnxs.com/seg?t=2&amp;add=7326041,7326073,7326113,7326422,7326428,6991858,6991910,6991857,6991938,7324349,7324371,7324346,7324354,7324358,6992019,6992020,6992021,7326871,7326872,7326877,7324058,7323986,7326540,7326543,7323981,7326047,7326052&amp;redir=https%3A%2F%2Fsecure.adnxs.com%2Fseg%3Fadd%3D%26add_code%3Dwww_luno_com%2Cluno_com%26member%3D232%26redir%3Dhttps%253A%252F%252Fimp2.ads.linkedin.com%252Fl" width="1" height="1" border="0" alt="" style="display: none !important;"></body></html>