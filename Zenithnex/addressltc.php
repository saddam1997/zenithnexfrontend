<?php 
	include 'header2.php';
 	include_once('common.php');
    //ALTER TABLE `users` ADD `otp_value` VARCHAR(500) NULL DEFAULT '' AFTER `authused`, ADD `is_email_verify` TINYINT NULL DEFAULT '0' AFTER `otp_value`;

    page_protect();
    if(!isset($_SESSION['user_id']))
    {
        logout();
    }

    $user_session = $_SESSION['user_session'];
    $user_current_balance = 0;
    $new_address = "";
    $user_current_balance_LTC = 0;
    $new_address_LTC = "";
    $client = "";
    $client_LTC = "";
    if(_LIVE_)
    {
        
        $client_LTC = new Client($rpc_host_LTC, $rpc_port_LTC, $rpc_user_LTC, $rpc_pass_LTC);
        if(isset($client) && isset($client_LTC))
        {
            

            $new_address_LTC = $client_LTC->getAddress($user_session);
            $user_current_balance_LTC = $client_LTC->getBalance($user_session) - $fee;
		    
        }
    }
?>

<br><br><br><br><br>
<form >
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center" style="width: 1049px;">
            <div class="col-sm-6 col-md-6 text-center">
                <div class="card text-white bg-success">
                    <div class="card-header text-center">
                        <h1>Receive LTC<br>

                        </h1>
                        <span class="text-muted">Receive LTC to this address</span>
                    </div>
                    <div class="card-body text-center bg-white text-success">
                        <a href="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $new_address_LTC;?>">
                                                <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $new_address_LTC?>" 
                                                alt="QR Code" style="width:200px;border:0;"/></a><br>
                        <h4><?php echo $new_address_LTC;?></h4> 
                    </div>
                </div>

                
            </div>
        </div>
    </div>

</div>
</form>
<br><br><br><br><br>
<?php 
    include 'footer.php';

?>
