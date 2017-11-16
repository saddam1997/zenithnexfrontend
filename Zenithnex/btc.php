l<?php
include('common.php');

page_protect();
if(!isset($_SESSION['user_id']))
{
    header("location:logout.php");
}
$user_session = $_SESSION['user_session'];
$error = array();
$addressList = array();
$new_address = "";
$user_email= $user_session;
$user_current_balance = 0;
if(isset($_GET['nad']))
{
    $new_address = $_GET['nad'];

}
$clientbtc = "";
$client = "";

if(_LIVE_)
{
    
    $client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
    
        $userBTCBalance = $client->getBalance($user_session);

        $user_current_balance = $client->getBalance($user_session);
}

?>
<!DOCTYPE html>
<html lang="en">

                   <div class="row balance-div">
                    <div class="col-md-8">
                    
                    <div class="col-md-4">
                    <span class="balance-text"> <?php echo $user_current_balance." " . $coin_short;?></span> <span class="balance-text">| </span>
                    <span class="balance-text"> <?php echo $userBTCBalance ?> BTC
                  </span>
              </div>
          </div>
          </div>
          </html>