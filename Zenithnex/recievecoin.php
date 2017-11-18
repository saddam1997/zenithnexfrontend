<?php 
	include 'header2.php';
 	include_once('common.php');
    //ALTER TABLE `users` ADD `otp_value` VARCHAR(500) NULL DEFAULT '' AFTER `authused`, ADD `is_email_verify` TINYINT NULL DEFAULT '0' AFTER `otp_value`;

    page_protect();
    if(!isset($_SESSION['user_id']))
    {
        logout();
    }

    $otp_value = "";

    $user_session = $_SESSION['user_session'];
    $user_current_balance = 0;
    $new_address = "";
    $client = "";
    if(_LIVE_)
    {
        $client_BCH = new Client($rpc_host_BCH, $rpc_port_BCH, $rpc_user_BCH, $rpc_pass_BCH);
        if(isset($client_BCH))
        {
            $new_address = $client_BCH->getAddress($user_session);
            $user_current_balance = $client_BCH->getBalance($user_session) - $fee;
		
        }
    }
?>

<br><br><br><br><br>
<form >
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center" style="width: 1049px;">
            <div class="col-sm-10 col-md-6 text-center">
                <div class="card text-white bg-success">
                    <div class="card-header text-center">
                        <h1>Receive BCC<br>

                        </h1>
                        <span class="text-muted">Receive BCC to this address</span>
                    </div>
                    <div class="card-body text-center bg-white text-success">
                        <a href="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $new_address?>">
                                                <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $new_address?>" 
                                                alt="QR Code" style="width:200px;border:0;"/></a>
                        <span><?php echo $new_address;?></span> 
                    </div>
                </div>

                
            </div>
        </div>
    </div>

</div>
</form>

<?php 
    include 'footer.php';

?>
