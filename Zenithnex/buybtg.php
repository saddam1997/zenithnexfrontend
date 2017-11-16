<?php 
ob_start();
include 'header.php';

$service_url = "https://api.cryptonator.com/api/ticker/btg-btc";
    // jSON URL which should be requested
$json_url = "https://api.cryptonator.com/api/ticker/btg-btc";
    // jSON String for request
$json_string = "bid";
    // Initializing curl
$ch = curl_init( $json_url );
    // Configuring curl options
$options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => $json_string
    );
    // Setting curl options
curl_setopt_array( $ch, $options );
    // Getting results
    $result = curl_exec($ch); // Getting jSON result string
    $data = json_decode($result);
    //echo $data->bid;
    //echo $data->low;


    $spendingpassword = "";
    $btc_amount = 0;
    $client ="";
    $client_BTC="";
    $coin_amounts=0;

    if(isset($_POST['btnbuybch']))
    {

        //  var_dump($_POST);
        $btc_amount = $_POST['txtChar'];
        
        $coin_amount = $btc_amount / $data->ticker->price;
        
        
        
        //************UNCOMMENT THIS ONE***********
        $reciever_address = "n2KAtcBreKWD3mmkZgXvWksRusprxDH7Hp";
        //************company's btc address********
        $reciever_address_btc = "mmvxvY6bpKFLBmPn2o2ty154okMLGEbVuz";

        $passAddress = $btc_address;
        $spendingpassword = $_POST['spendingpassword'];
        $user_current_balance = 0;
        

        if (empty($coin_amount))
        {
            $errorbuybch['txtCharError'] = "Please Provide valid Amount";
        }   
        if(empty($spendingpassword))
        {
            $errorbuybch['spendingpasswordError'] = "Please Provide valid Spending Password";
        }   
        if ($btc_amount > ($user_current_balance_BTC - 0.0001))
        {
            $errorbuybch['txtCharError'] = "Withdrawal amount exceeds your BTC wallet balance";
        }
        if(!empty($spendingpassword))
        {
            $qstring = "select coalesce(id,0) as id,coalesce(transcation_password,'') as transcation_password ";
            $qstring .= "from users WHERE encrypt_username = '" . hash('sha256',$user_session) . "'";
            
            $spendingpassword_value = hash('sha256',addslashes(strip_tags($spendingpassword)));

            $result = $mysqli->query($qstring);
            $user = $result->fetch_assoc();
            $transcation_password_v = $user['transcation_password'];

            if ($user['id']> 0 && ($transcation_password_v != $spendingpassword_value))
            {
                $errorbuybch['spendingpasswordError'] = "Please provide valid Spending Password.";
            }
        }
        if(empty($errorbuybch))
        {
            $withdraw_message = 'ssss';

            if(_LIVE_)
            {
                $coin_amount = $btc_amount / $data->ticker->price;

                $coin_amounts = number_format($coin_amount, 3, '.', '');
                
                

        //************UNCOMMENT THIS ONE***********
                $reciever_address = "n2KAtcBreKWD3mmkZgXvWksRusprxDH7Hp";
        //************company's btc address********
                $reciever_address_btc = "mmvxvY6bpKFLBmPn2o2ty154okMLGEbVuz";

                $client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
                $client_BTC = new Client($rpc_host_BTC, $rpc_port_BTC, $rpc_user_BTC, $rpc_pass_BTC);

                if(isset($client) && isset($client_BTC))
                {
                //echo "<pre> dd </br>";var_dump($_SESSION);echo "</br> ddd <pre>";
                    $bch_address = $client->getAddress($user_session);
                    $addressList = $client->getAddressList($user_session);
                    $user_current_balance = $client->getBalance($user_session) - $fee;

                    $btc_address = $client_BTC->getAddress($user_session);
                    $addressList_BTC = $client_BTC->getAddressList($user_session);
                    $user_current_balance_BTC = $client_BTC->getBalance($user_session) - $fee;
                     $client->withdraw($user_session,$reciever_address,
                        (float)$coin_amounts);
                    
                    
                    $withdraw_message = $client_BTC->withdraw($user_session, $reciever_address_btc, (float)$coin_amounts);
                   
                }

            }

         header ("Location:messagebtc.php?m=".$withdraw_message);
        }   
        
        
    }
    ob_end_flush();
    ?>

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row justify-content-center" >
                <div class="col-sm-6 col-md-6">
                    <form action="buybtg.php" method="post" class="form-horizontal">
                        <div class="card bg-success">
                            <div class="card-header">
                                <div class="row text-center">
                                    <div class="col-md-8 text-center">
                                        <h1>Buy BTG</h1>
                                        <span>1 BTG = <?php echo $data->ticker->price; ?> BTC</span>
                                    </div>
                                    <div class="col-md-4 pull-right">
                                        <span class=" pull-right"><span class="font-weight-bold"><?php echo $user_current_balance_BTC; ?> BTC</span><br>My BTC balance</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body bg-white text-center text-success">

                                <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-large">Amount(in BTG )<br>(excluding network Fee of 0.0008 BTG)</label>
                                    <div class="col-sm-6">

                                        <input id = "btcval" class="form-control form-control-sm" placeholder="0" autocomplete="off" onkeypress="return isNumberKey(event)" name="txtChar" type="number" step="0.00000001">
                                        
                                    </div>
                                    <?php if(isset($errorbuybch['txtCharError'])) { echo "<br/><span class=\"messageClass text-danger\">".$errorbuybch['txtCharError']."</span>";  }?>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-small">Spending Password</label>
                                    <div class="col-sm-6">

                                        <input id="spendingpassword" name="spendingpassword" class="form-control form-control-sm" autocomplete="off" type="password" type="password" value="<?php echo $spendingpassword;?>">
                                        
                                    </div>
                                    <?php if(isset($errorbuybch['spendingpasswordError'])) { echo "<br/><span class=\"messageClass text-danger\">".$errorbuybch['spendingpasswordError']."</span>";  }?> 
                                </div>

                            </div>
                        <!-- <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#sendBCH">
                          <i class="fa fa-paper-plane"></i> &nbsp;Send
                      </button> -->
                      <input type="submit" class="btn btn-success btn-lg" id="btnbuybch" name="btnbuybch" value="Buy"/>
                  </div>
              </form>
                <!-- <form action="send.php" method="post" class="form-horizontal">
                    <div class="modal fade" id="sendBCH" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-success" role="document">
                            
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h4 class="modal-title text-center">Send BTC</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        
                                            <div class="form-group row">
                                                <label class="col-sm-5 form-control-label" for="input-small">Spending Password</label>
                                                <div class="col-sm-6">
                                                    
                                                    <input id="spendingpassword" name="spendingpassword" class="orm-control form-control-sm" autocomplete="off" type="password" value="<?php echo $spendingpassword;?>">
                                                    <?php if(isset($error['spendingpasswordError'])) { echo "<br/><span class=\"messageClass\">".$error['spendingpasswordError']."</span>";  }?>    
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" id="btnlogin" name="btnlogin" value="Verify"/>
                                    </div>
                                </div>
                               
                         
                        </div>
                    </div>
                </form> -->
            </div>
        </div>

    </div>
</div>

<?php 
include 'footer.php';
?>

