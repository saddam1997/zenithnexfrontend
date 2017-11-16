<?php 
    include 'header.php';
    include_once('common.php');
    //ALTER TABLE `users` ADD `otp_value` VARCHAR(500) NULL DEFAULT '' AFTER `authused`, ADD `is_email_verify` TINYINT NULL DEFAULT '0' AFTER `otp_value`;

    page_protect();
    if(!isset($_SESSION['user_id']))
    {
       header("location:logout.php");
    }

    $otp_value = "";

    $user_session = $_SESSION['user_session'];
    $user_current_balance = 0;
    $new_address = "";
    $client = "";
    if(_LIVE_)
    {
        $client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
        if(isset($client))
        {
            $new_address = $client->getAddress($user_session);
            $user_current_balance = $client->getBalance($user_session) - $fee;
        
        }
    }
?>
<?php
   

?>
<form >
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-6 text-center">
                <div class="card text-white bg-success">
                    <div class="card-header text-center">
                        <h1>Receive BTG<br>

                        </h1>
                        <span class="text-muted">New BTG address</span>
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
