<?php 
include_once('common.php');
page_protect();
if(!isset($_SESSION['user_id']))
{
    header("location:logout.php");
}
$user_session = $_SESSION['user_session'];
$errorsend = array();
$transactionList = array();

$user_current_balance = 0;
$reciever_address= "";
$coin_amount = 0;
$trans_desc ="";
$spendingpassword = "";
$user_current_balance2 = 0;
$client = "";
if(_LIVE_)
{
    // $client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
    // if(isset($client))
    // {
    //     $user_current_balance = $client->getBalance($user_session) - $fee;
    //     $user_current_balance2 = $user_current_balance;
    // }
}

if(isset($_POST['btncontact']))
{
    //  var_dump($_POST);
    $coin_amount = $_POST['txtChar'];
    $reciever_address = $_POST['btcaddress'];
    $trans_desc = $_POST['discription'];
    $spendingpassword = $_POST['spendingpassword'];
    $user_current_balance = 0;
    
    if(_LIVE_)
    {
        $client_BCH = new Client($rpc_host_BCH, $rpc_port_BCH, $rpc_user_BCH, $rpc_pass_BCH);
        if(isset($client_BCH))
        {
            $user_current_balance = $client_BCH->getBalance($user_session) - $fee;
        }
    }
    if (empty($reciever_address))
    {
        $errorsend['reciever_addressError'] = "Please Provide valid Address";
    }   
    
    if (empty($coin_amount))
    {
        $errorsend['txtCharError'] = "Please Provide valid Amount";
    }   
    if(empty($spendingpassword))
    {
        $errorsend['spendingpasswordError'] = "Please Provide valid Spending Password";
    }   
    if ($coin_amount > $user_current_balance)
    {
        $errorsend['txtCharError'] = "Withdrawal amount exceeds your wallet balance";
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
            $errorsend['spendingpasswordError'] = "Please provide valid Spending Password.";
        }
    }
    
    if(empty($errorsend))
    {
            $withdraw_message = 'ssss';
            if(_LIVE_)
            {
                $withdraw_message = $client_BCH->withdraw($user_session, $reciever_address, (float)$coin_amount);
                //$withdraw_message = $client->payment($reciever_address,$coin_amount,'from $user_session');
            }
            header("Location:successsend.php?m=".$withdraw_message);
        }   
    }
?>
<?php
	include 'header2.php';
?>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center" style="margin: 0 -350px;" >
            <div class="col-sm-6 col-md-6">
                <form action="send.php" method="post" class="form-horizontal">
                    <div class="card text-white bg-success">
                        <div class="card-header text-center">
                            <h1>Send BTG</h1>
                        </div>
                        <div class="card-body bg-white text-center text-success">
                            
                                <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-small">Receiver Address</label>
                                    <div class="col-sm-6">
                                        <input id="btcaddress"  name ="btcaddress" class="form-control" placeholder="Paste your <?php echo $coin_short;?> Address" autocomplete="off" type="text" value="<?php echo $reciever_address;?>">
                                        <?php if(isset($errorsend['reciever_addressError'])) { echo "<br/><span class=\"messageClass text-danger\">".$errorsend['reciever_addressError']."</span>";  }?>                     
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-large">Amount</label>
                                    <div class="col-sm-6">
                                        
                                        <input id = "btcval" class="form-control form-control-sm" placeholder="0" autocomplete="off" onkeypress="return isNumberKey(event)" name="txtChar" type="text" value ="<?php echo $coin_amount;?>">
                                        <?php if(isset($errorsend['txtCharError'])) { echo "<br/><span class=\"messageClass text-danger\">".$errorsend['txtCharError']."</span>";  }?>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-normal">Description</label>
                                    <div class="col-sm-6">
                                        <textarea id="discription" name ="discription" type="text" class="form-control form-control-sm" placeholder="Description"><?php echo $trans_desc;?></textarea>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-small">Spending Password</label>
                                    <div class="col-sm-6">
                                        
                                        <input id="spendingpassword" name="spendingpassword" class="form-control form-control-sm" autocomplete="off" type="password" value="<?php echo $spendingpassword;?>">
                                        <?php if(isset($errorsend['spendingpasswordError'])) { echo "<br/><span class=\"messageClass text-danger\">".$errorsend['spendingpasswordError']."</span>";  }?>    
                                    </div>
                                </div>
                            
                        </div>
                        <!-- <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#sendBCH">
                          <i class="fa fa-paper-plane"></i> &nbsp;Send
                        </button> -->
                        <input type="submit" class="btn btn-success btn-lg" id="btncontact" name="btncontact" value="Send"/>
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