<?php
	
	include_once('common.php');

	page_protect();
	if(!isset($_SESSION['user_id']))
	{
		header("location:logout.php");
	}
	$user_session = $_SESSION['user_session'];

	$client = "";
	$wallet_address = "";
	if(_LIVE_)
	{
		$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
		if(isset($client))
		{
			$wallet_address  = $client->getnewaddress($user_session);

		}

	}
	header("Location:myaddress.php?nad=".$wallet_address);
	exit();
?> 