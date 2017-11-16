<?php 
ob_start();
include_once('common.php');
page_protect();
if(!isset($_SESSION['user_id']))
{
	logout();
}
$user_session = $_SESSION['user_session'];
$user_current_balance = 0;


if(isset($_GET['m']))
{
//	var_dump($_POST);
	$message = $_GET['m'];
	
}
$client = "";
if(_LIVE_)
{
	$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
	if(isset($client))
	{
		$transactionList = $client->getTransactionList($user_session);
		$user_current_balance = $client->getBalance($user_session) - $fee;
	}
}
	include 'header.php';
	 ob_end_flush();
?>
	
<div class="container-fluid">
    <div class="animated fadeIn">
    	<div class="row " >
		    <div class="col-sm-12 col-md-12">
		    	<form action="successsend.php" method="post">
			    	<div class="card text-white bg-success">
		                <div class="card-header text-center">
		                    <h1>Withdrawl Response</h1>
		                </div>
		                <div class="card-body bg-white text-center text-success">
		                    <?php if(!empty($message)){ ?>
								<label>The transcation has been successfully intiative. </label>
							<?php 
							} else { 
							?>
								<label class="text-warning">There is some issue in processng your transcation. Please try after some time</label>
							<?php
							}
							?>
		                </div>
		                
		            </div>
		        </form>
		    </div>
		</div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php 
	include 'footer.php';
?>
