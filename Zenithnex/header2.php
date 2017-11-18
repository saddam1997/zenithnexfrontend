<?php 
include_once('common.php');
page_protect();
if(!isset($_SESSION['user_id']))
{
	header("location:logout.php");
}
$user_session = $_SESSION['user_session'];
$postData = array(
  "userMailId"=> $user_session

  );

// Create the context for the request
$context = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($postData)
    )
  ));


$response1 = file_get_contents($url_api.'/usertransaction/getBalBTC', FALSE, $context);
$response2 = file_get_contents($url_api.'/usertransaction/getBalBCH', FALSE, $context);
$response3 = file_get_contents($url_api.'/usertransaction/getBalGDS', FALSE, $context);
$response4 = file_get_contents($url_api.'/usertransaction/getBalEBT', FALSE, $context);

if($response1 === FALSE){
  die('Error');
}
if($response2 === FALSE){
  die('Error');
}
if($response3 === FALSE){
  die('Error');
}
if($response4 === FALSE){
  die('Error');
}




$responseData1 = json_decode($response1, TRUE);
$responseData2 = json_decode($response2, TRUE);
$responseData3 = json_decode($response3, TRUE);
$responseData4 = json_decode($response4, TRUE);




if(isset($responseData1['user']))
{

  $btc_balance = $responseData1['user']['BTCMainbalance'];
  
  
}
if(isset($responseData2['user']))
{

  
  $bcc_balance = $responseData2['user']['BCHMainbalance'];
  
  

  
}
if(isset($responseData3['user']))
{

  
  $gds_balance = $responseData3['user']['GDSMainbalance'];
  
  

  
}
if(isset($responseData4['user']))
{

  
  $ebt_balance = $responseData4['user']['EBTMainbalance'];
 
}


?>
<?php
include 'header.php';
?>

<div class="app-body">
	<div class="sidebar">
		<nav class="sidebar-nav">
			<ul class="nav">

				<li class="nav-item"><hr>
					<div class="h4" style="margin: 0.5rem">BTC</div>

					<div class=" ">
						<p class="">Balance: <?php echo $btc_balance; ?> BTC</p>
						

						<button data-toggle="tooltip" title="Deposit" ><a style="color:white;" class="" href="addressbtc.php" id="btnreceived">+</a></button>

						<?php

						if($_SESSION['is_email_verify']==1){?>
						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;" class="" href="sendgetbtc.php" id="btnsend">-</a></button>

						<?php } else { ?>
						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;" class="" href="" onclick="alert('Verify Email Id');" id="btnsend">-</a></button>
						<?php } ?>

						<button data-toggle="tooltip" title="History" ><a style="color:white;" class="" href="transactionsbtc.php" id="btnreceived">-></a></button> 
					</div>
				</li>
				<li class="nav-item">
					<hr>
					<div class="h4" style="margin: 0.5rem">BCH</div>

					<div class="">
						<p class="">Balance: <?php echo $bcc_balance ; ?> BCH</p>

						
						<button data-toggle="tooltip" title="Deposit" ><a style="color:white;" class="" href="addressbcc.php" id="btnreceived">+</a></button>

						<?php

						if($_SESSION['is_email_verify']==1){?>
						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;" class="" href="sendgetbcc.php" id="btnsend">-</a></button>

						<?php } else { ?>
						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;" class="" onclick="alert('Verify Email Id');" href="" id="btnsend">-</a></button>
						<?php } ?>

						<button data-toggle="tooltip" title="History" ><a style="color:white;"  class="" href="transactionsbcc.php" id="btnreceived">-></a></button> 
					</div>
				</li>

				
				
				<li class="nav-item">


					<hr>
					<div class="h4" style="margin: 0.5rem">EBT</div>

					<div class=" ">
						<p class="">Balance: <?php echo $ebt_balance; ?> EBT</p>
						
						<button data-toggle="tooltip" title="Deposite" ><a style="color:white;" class="" href="addressebt.php" id="btnreceived">+</a></button>

						<?php

						if($_SESSION['is_email_verify']==1){?>
						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;" class="" href="sendgetebt.php" id="btnsend">-</a></button>

						<?php } else { ?>
						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;"  class="" href=""  onclick="alert('Verify Email Id');" id="btnsend">-</a></button>
						<?php } ?>


						<button data-toggle="tooltip" title="History" ><a style="color:white;" class="" href="transactionsebt.php" id="btnreceived">-></a></button> 
					</div>
				</li>
				<li class="nav-item">
					<hr>
					<div class="h4" style="margin: 0.5rem">GDS</div>

					<div class=" ">
						<p class="">Balance: <?php echo $gds_balance; ?> GDS</p>
						

						<button data-toggle="tooltip" title="Deposit" ><a style="color:white;" class="" href="addressgds.php" id="btnreceived">+</a></button>

						<?php

						if($_SESSION['is_email_verify']==1){?>
						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;" class="" href="sendgetgds.php" id="btnsend">-</a></button>

						<?php } else { ?>
						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;" class="" href="" onclick="alert('Verify Email Id');" id="btnsend">-</a></button>
						<?php } ?>

						<button data-toggle="tooltip" title="Withdraw" ><a style="color:white;" class="" href="transactionsgds.php" id="btnreceived">-></a></button> 
					</div>
					
				</ul>

			</nav>
		</div>
