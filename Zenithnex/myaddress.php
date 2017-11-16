<?php 
	include_once('common.php');
	page_protect();
	if(!isset($_SESSION['user_id']))
	{
		header("location:logout.php");
	}
	$user_session = $_SESSION['user_session'];
	$error = array();
	$addressList = array();
	$new_address = "";
	
	$user_current_balance = 0;
	if(isset($_GET['nad']))
	{
		$new_address = $_GET['nad'];
	
	}
	$client = "";
	if(_LIVE_)
	{
		$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
		if(isset($client))
		{
			//echo "<pre> dd </br>";var_dump($_SESSION);echo "</br> ddd <pre>";
			$addressList = $client->getAddressList($user_session);
			$user_current_balance = $client->getBalance($user_session) - $fee;
			
		}
	}
?>
<?php 
	include 'header.php';
?>
	
<div class="container-fluid">
    <div class="animated fadeIn">
    	<div class="row justify-content-center" >
	    	<!-- <div class="col-sm-6 col-md-8">
	            <div class="card text-white ">
	                <div class="card-header text-center bg-success">
	                    <h1>My BCC Addresses<br><small class="text-muted"><small><small>Use These addresses to send and receive BCC</small></small></small></h1>
	                </div>
	                <a href="genratenewaddress.php" type="button" class="btn btn-outline-success btn-block text-center">Create New BCC address</a>
	            </div>
	        </div> -->
	        <div class="col-sm-6 col-md-4" id="NewBccAddress">
	            <div class="card text-center" style="padding:10px;">
	                    <h6>New BTG Addresses<br><small class="text-muted"></h6>
	                    <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $new_address?>" alt="QR Code" style="width:60px;border:0;">
	                    <p style="padding-top: 1em;"><?php echo $new_address;?></p>
	            </div>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="col-lg-12">
	            <div class="card">
	                <div class="card-header bg-success" style="font-size: 20px;padding-top: 1.5rem;">
	                    BTG Addresses
	                    <a href="genratenewaddress.php" type="button" class="btn btn-default" style="float: right;font-size: 20px;">Create New BTG address</a>
	                </div>
	                <div class="card-body">
                    <table class="table table-responsive table-hover table-outline mb-0">
	                        <thead class="thead-default">
	                            <tr>
	                                <th>Addresses</th>
	                                <th>Label</th>
	                            </tr>
	                        </thead>
	                        <tbody class="black-text">
	                        	<?php								
									if(!empty($new_address))
									{
										"<tr><td> <strong>".$new_address."</strong><span class=\"badge badge-success\"> New<span></td>"
									?>											
									<!-- <td colspan="2"><a href="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $new_address. "image"?>">
										<img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $new_address?>" alt="QR Code" style="width:60px;border:0;"></td><tr> -->
								<?php								}
									if(count($addressList)>0)
									{
										foreach ($addressList as $address)
										{	
											echo "<tr><td>".$address."</td>";
								?>
									<td colspan="2"><a href="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $address?>">
									<img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $address?>" alt="QR Code" style="width:60px;border:0;"></td><tr>
								<?php
										}
									}
									else if((count($addressList)== 0) && empty($new_address))
									{
										echo "<tr><td colspan=\"3\">There is no Address exists</td></tr>";
									}
								?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
</div>

<br><br><br><br>
<?php 
	include 'footer.php';
?>
<script>
	if(location.search != "")
		getNewBccAddress();

	function getNewBccAddress()
	{
		document.getElementById('NewBccAddress').style.display = "block";
	}
</script>


