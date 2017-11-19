<?php
ob_start();
include 'header.php';
/*-----------Add Session-----------*/
page_protect();
if (!isset($_SESSION['user_id'])) {
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


$response = file_get_contents($url_api.'/user/getAllDetailsOfUser', false, $context);

if ($response === false) {
    die('Error');
}



$responseData = json_decode($response, true);



if (isset($responseData['user'])) {
    $btc_balance = $responseData['user']['BTCbalance'];
    $bcc_balance = $responseData['user']['BCHbalance'];
    $gds_balance = $responseData['user']['GDSbalance'];
    $ebt_balance = $responseData['user']['EBTbalance'];

    $user_BTCtradebalance = $responseData['user']['BTCMainbalance'];
    $user_BCHtradebalance = $responseData['user']['BCHMainbalance'];
    $user_GDStradebalance = $responseData['user']['GDSMainbalance'];
    $user_EBTtradebalance = $responseData['user']['EBTMainbalance'];

    $user_BTCfreezebalance = $responseData['user']['FreezedBTCbalance'];
    $user_BCHfreezebalance = $responseData['user']['FreezedBCHbalance'];
    $user_GDSfreezebalance = $responseData['user']['FreezedGDSbalance'];
    $user_EBTfreezebalance = $responseData['user']['FreezedEBTbalance'];

    $total_BTC = $user_BTCtradebalance + $user_BTCfreezebalance;
    $total_BCH = $user_BCHtradebalance + $user_BCHfreezebalance;
    $total_GDS = $user_GDStradebalance + $user_GDSfreezebalance;
    $total_EBT = $user_EBTtradebalance + $user_EBTfreezebalance;

    $depositwithdraws = $responseData['user']['tradebalanceorderDetails'];
    $depositwithdraw = array_reverse($depositwithdraws);
}


/// Deposit BTC ///
if (isset($_POST['btnbtcdeposit'])) {
    $Spassword = $_POST['btcdeposit'];
    $btcammount = $_POST['btcdepositammount'];

    $postData = array(
    "userMailId"=>$user_session,
    "btcamount"=>$btcammount,
    "spendingPassword"=>$Spassword

    );

    // Create the context for the request
    $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => "Content-Type: application/json\r\n",
      'content' => json_encode($postData)
      )
    ));


    $response = file_get_contents($url_api.'/depositeintrade/depositeInWalletBTC', false, $context);


    if ($response === false) {
        die('Error');
    }


    $responseData = json_decode($response, true);


    if ($responseData['statusCode']==200) {
        $message = "Balance Update Successfully!!";
    } else {
        $error = $responseData['message'];
    }
}

//Deposit BCH//

if (isset($_POST['btnbccdeposit'])) {
    $Spassword = $_POST['bccdeposit'];
    $bccammount = $_POST['bccdepositammount'];

    $postData = array(
    "userMailId"=>$user_session,
    "bchamount"=>$bccammount,
    "spendingPassword"=>$Spassword

    );

    // Create the context for the request
    $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => "Content-Type: application/json\r\n",
      'content' => json_encode($postData)
      )
    ));


    $response = file_get_contents($url_api.'/depositeintrade/depositeInWalletBCH', false, $context);

    if ($response === false) {
        die('Error');
    }


    $responseData = json_decode($response, true);


    if ($responseData['statusCode']==200) {
        $message = "Balance Update Successfully!!";
    } else {
        $error = $responseData['message'];
    }
}
//Deposit GDS//
if (isset($_POST['btngdsdeposit'])) {
    $Spassword = $_POST['gdsdeposit'];
    $gdsammount = $_POST['gdsdepositammount'];

    $postData = array(
    "userMailId"=>$user_session,
    "gdsamount"=>$gdsammount,
    "spendingPassword"=>$Spassword

    );

    // Create the context for the request
    $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => "Content-Type: application/json\r\n",
      'content' => json_encode($postData)
      )
    ));


    $response = file_get_contents($url_api.'/depositeintrade/depositeInWalletGDS', false, $context);

    if ($response === false) {
        die('Error');
    }


    $responseData = json_decode($response, true);


    if ($responseData['statusCode']==200) {
        $message = "Balance Update Successfully!!";
    } else {
        $error = $responseData['message'];
    }
}
//Deposit EBT//
if (isset($_POST['btnebtdeposit'])) {
    $Spassword = $_POST['ebtdeposit'];
    $ebtammount = $_POST['ebtdepositammount'];

    $postData = array(
    "userMailId"=>$user_session,
    "ebtamount"=>$ebtammount,
    "spendingPassword"=>$Spassword

    );

    // Create the context for the request
    $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => "Content-Type: application/json\r\n",
      'content' => json_encode($postData)
      )
    ));


    $response = file_get_contents($url_api.'/depositeintrade/depositeInWalletEBT', false, $context);

    if ($response === false) {
        die('Error');
    }


    $responseData = json_decode($response, true);


    if ($responseData['statusCode']==200) {
        $message = "Balance Update Successfully!!";
    } else {
        $error = $responseData['message'];
    }
}


// Withdraw BTC//

if (isset($_POST['btnbtcwithdraw'])) {
    $Spassword = $_POST['btcwithdraw'];
    $btcammount = $_POST['btcwithdrawammount'];

    $postData = array(
    "userMailId"=>$user_session,
    "btcamount"=>$btcammount,
    "spendingPassword"=>$Spassword

    );

    // Create the context for the request
    $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => "Content-Type: application/json\r\n",
      'content' => json_encode($postData)
      )
    ));


    $response = file_get_contents($url_api.'/depositeintrade/withdrawInWalletBTC', false, $context);

    if ($response === false) {
        die('Error');
    }


    $responseData = json_decode($response, true);


    if ($responseData['statusCode']==200) {
        $message = "Balance Update Successfully!!";
    } else {
        $error = $responseData['message'];
    }
}
//withdraw BCH//
if (isset($_POST['btnbccwithdraw'])) {
    $Spassword = $_POST['bccwithdraw'];
    $bccammount = $_POST['bccwithdrawammount'];

    $postData = array(
    "userMailId"=>$user_session,
    "bchamount"=>$bccammount,
    "spendingPassword"=>$Spassword

    );

    // Create the context for the request
    $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => "Content-Type: application/json\r\n",
      'content' => json_encode($postData)
      )
    ));


    $response = file_get_contents($url_api.'/depositeintrade/withdrawInWalletBCH', false, $context);

    if ($response === false) {
        die('Error');
    }


    $responseData = json_decode($response, true);


    if ($responseData['statusCode']==200) {
        $message = "Balance Update Successfully!!";
    } else {
        $error = $responseData['message'];
    }
}

//Withdraw GDS//
if (isset($_POST['btngdswithdraw'])) {
    $Spassword = $_POST['gdswithdraw'];
    $gdsammount = $_POST['gdswithdrawammount'];

    $postData = array(
    "userMailId"=>$user_session,
    "gdsamount"=>$gdsammount,
    "spendingPassword"=>$Spassword

    );

    // Create the context for the request
    $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => "Content-Type: application/json\r\n",
      'content' => json_encode($postData)
      )
    ));


    $response = file_get_contents($url_api.'/depositeintrade/withdrawInWalletGDS', false, $context);

    if ($response === false) {
        die('Error');
    }


    $responseData = json_decode($response, true);


    if ($responseData['statusCode']==200) {
        $message = "Balance Update Successfully!!";
    } else {
        $error = $responseData['message'];
    }
}

//Withdraw EBT//
if (isset($_POST['btnebtwithdraw'])) {
    $Spassword = $_POST['ebtwithdraw'];
    $ebtammount = $_POST['ebtwithdrawammount'];

    $postData = array(
    "userMailId"=>$user_session,
    "ebtamount"=>$ebtammount,
    "spendingPassword"=>$Spassword

    );

    // Create the context for the request
    $context = stream_context_create(array(
    'http' => array(
      'method' => 'POST',
      'header' => "Content-Type: application/json\r\n",
      'content' => json_encode($postData)
      )
    ));


    $response = file_get_contents($url_api.'/depositeintrade/withdrawInWalletEBT', false, $context);

    if ($response === false) {
        die('Error');
    }


    $responseData = json_decode($response, true);


    if ($responseData['statusCode']==200) {
        $message = "Balance Update Successfully!!";
    } else {
        $error = $responseData['message'];
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#dropdwan').click(function(){
        $("p").toggle();
      });
});
</script>
</head>
<div class="container-fluid" style="min-height: 400px">
 <div class="animated fadeIn">

  <div class="card marginTop25" >
    <div class="card-header bg-success" style="font-size: 20px;padding: 1.5rem;">
      TRADE ACCOUNT BALANCES
      <div style="float: right;color:green;">
        <?php if (isset($message)) {
    echo  "<script type='text/javascript'>alert('$message'); window.location.href='trade.php';</script>";
}
       ?>

     </div>
     <div style="float: right;color:red;">
      <?php if (isset($error)) {
           echo  "<script type='text/javascript'>alert('$error'); window.location.href='trade.php';</script>";
       }

      ?>
    </div>
  </div>

  <div class="card-body">
    <table class="table table-responsive table-hover table-outline mb-0">
      <thead class="thead-default">
        <tr>
         <th class="text-center" style="width: 250px !important;">Trade</th>
         <th class="text-center">Currency Name</th>
         <th class="text-center">Symbol</th>
         <th class="text-center">Wallet Balance</th>
         <th class="text-center">Trade Balance</th>
         <th class="text-center">Freezed Balance</th>
         <th class="text-center">Total Balance</th>
       </tr>
     </thead>
     <tbody>

      <tr>
        <td class="text-center">
          <button  data-toggle="collapse" title="Deposit" data-parent="#accordion" href="#collapse1" class="panel-title right-arrow expand">+</button>
          <button data-toggle="collapse" title="Withdraw" data-parent="#accordion" href="#collapse11" class="panel-title right-arrow expand">-</button>
          <button type="button" title="History" data-toggle="modal" data-target="#myModal">-></button>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Your Trade History</h4>
                </div>
                <div class="modal-body">
                  <table class="table table-responsive table-hover table-outline mb-0">
                    <thead class="thead-default">
                      <tr>
                        <th>Currency Name</th>
                        <th>Ammount</th>
                        <th>Action</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>

                     <?php if (!empty($depositwithdraw)) {
          $i = 0;
          foreach ($depositwithdraw as $value) {
              echo '<tr>

                        <td>'.$value['currencyName'].'</td>
                        <td>'.$value['amount'].'</td>
                        <td>'.$value['action'].'</td>
                        <td>'.$value['updatedAt'].'</td>

                      </tr>';
              if ($i++ == 9) {
                  break;
              }
          }
      } elseif (empty($depositwithdraw)) {
                      echo "There is no Trade History exists ";
                  }


                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>


    </td>

    <td>Bitcoin</td>
    <td class="text-center">BTC</td>
    <td class="text-center"><?php echo $btc_balance; ?></td>
    <td class="text-center"><?php echo $user_BTCtradebalance; ?></td>
    <td class="text-center"><?php echo $user_BTCfreezebalance; ?></td>
    <td class="text-center"><?php echo $total_BTC; ?></td>
  </tr>
  <tr class="panel-collapse collapse" id="collapse1">
    <form method="post">
      <td></td>
      <td></td>
      <td><input name="btcdepositammount" class="form-controll"  value="" placeholder="BTC Ammount" autocomplete="off" onkeypress="return isNumberKey(event)"  type="number" step="0.00000001"></td>
      <td><input type="password" class="form-controll" name="btcdeposit"  value="" placeholder="Spending Password"></td>
      <td><button name="btnbtcdeposit" >Deposit</button></td>
      <td> </td>
      <td></td>
    </form>
  </tr>
  <tr class="panel-collapse collapse" id="collapse11">
    <form method="post">
      <td></td>
      <td></td>

      <td><input  name="btcwithdrawammount"  class="form-controll" value="" placeholder="BTC Ammount" autocomplete="off" onkeypress="return isNumberKey(event)"  type="number" step="0.00000001"></td>

      <td><input type="password" class="form-controll" name="btcwithdraw"  value="" placeholder="Spending Password"></td>

      <td><button name="btnbtcwithdraw">Withdraw</button></td>
      <td></td>
      <td></td>
    </form>
  </tr>


  <tr>
    <td class="text-center">

      <button  data-toggle="collapse" title="Deposit" data-parent="#accordion" href="#collapse2" class="panel-title right-arrow expand">+</button>
      <button data-toggle="collapse" title="Withdraw" data-parent="#accordion" href="#collapse22" class="panel-title right-arrow expand">-</button>
      <button type="button" title="History" data-toggle="modal" data-target="#myModal">-></button>

    </td>

    <td>Bitcoin Cash</td>
    <td class="text-center">BCC</td>
    <td class="text-center"><?php echo $bcc_balance; ?></td>
    <td class="text-center"><?php echo $user_BCHtradebalance; ?></td>
    <td class="text-center"><?php echo $user_BCHfreezebalance; ?></td>
    <td class="text-center"><?php echo $total_BCH; ?></td>
  </tr>
  <tr class="panel-collapse collapse" id="collapse2">
    <form method="post">
      <td></td>
      <td></td>
      <td><input name="bccdepositammount" class="form-controll"  value="" placeholder="BCC Ammount" autocomplete="off" onkeypress="return isNumberKey(event)"  type="number" step="0.00000001"></td>
      <td><input type="password" class="form-controll" name="bccdeposit"  value="" placeholder="Spending Password"></td>
      <td><button name="btnbccdeposit" >Deposit</button></td>
      <td> </td>
      <td></td>
    </form>
  </tr>
  <tr class="panel-collapse collapse" id="collapse22">
    <form method="post">
      <td></td>
      <td></td>

      <td><input  name="bccwithdrawammount" class="form-controll" value="" placeholder="BCC Ammount" autocomplete="off" onkeypress="return isNumberKey(event)"  type="number" step="0.00000001"></td>

      <td><input type="password" class="form-controll" name="bccwithdraw"  value="" placeholder="Spending Password"></td>

      <td><button name="btnbccwithdraw">Withdraw</button></td>
      <td></td>
      <td></td>
    </form>
  </tr>

  <td class="text-center">

   <button  data-toggle="collapse" title="Deposit" data-parent="#accordion" href="#collapse3" class="panel-title right-arrow expand">+</button>
   <button data-toggle="collapse" title="Withdraw" data-parent="#accordion" href="#collapse33" class="panel-title right-arrow expand">-</button>
    <button type="button" title="History" data-toggle="modal" data-target="#myModal">-></button>

 </td>
 <td>Goods Coin</td>
 <td class="text-center">GDS</td>
 <td class="text-center"><?php echo $gds_balance; ?></td>
 <td class="text-center"><?php echo $user_GDStradebalance; ?></td>
 <td class="text-center"><?php echo $user_GDSfreezebalance; ?></td>
 <td class="text-center"><?php echo $total_GDS; ?></td>
</tr>
<tr class="panel-collapse collapse" id="collapse3">
  <form method="post">
    <td></td>
    <td></td>
    <td><input name="gdsdepositammount" class="form-controll"  value="" placeholder="GDS Ammount" autocomplete="off" onkeypress="return isNumberKey(event)"  type="number" step="0.00000001"></td>
    <td><input type="password" class="form-controll" name="gdsdeposit"  value="" placeholder="Spending Password"></td>
    <td><button name="btngdsdeposit" >Deposit</button></td>
    <td> </td>
    <td></td>
  </form>
</tr>
<tr class="panel-collapse collapse" id="collapse33">
  <form method="post">
    <td></td>
    <td></td>

    <td><input  name="gdswithdrawammount" class="form-controll" value="" placeholder="GDS Ammount" autocomplete="off" onkeypress="return isNumberKey(event)"  type="number" step="0.00000001"></td>

    <td><input type="password" class="form-controll" name="gdswithdraw"  value="" placeholder="Spending Password"></td>

    <td><button name="btngdswithdraw">Withdraw</button></td>
    <td></td>
    <td></td>
  </form>
</tr>

<td class="text-center">

 <button  data-toggle="collapse" title="Deposit" data-parent="#accordion" href="#collapse4" class="panel-title right-arrow expand">+</button>
 <button data-toggle="collapse" title="Withdraw" data-parent="#accordion" href="#collapse44" class="panel-title right-arrow expand">-</button>
  <button type="button" title="History" data-toggle="modal" data-target="#myModal">-></button>

</td>
<td>Ebittree Coin </td>
<td class="text-center">EBT</td>
<td class="text-center"><?php echo $ebt_balance; ?></td>
<td class="text-center"><?php echo $user_EBTtradebalance; ?></td>
<td class="text-center"><?php echo $user_EBTfreezebalance; ?></td>
<td class="text-center"><?php echo $total_EBT; ?></td>
</tr>
<tr class="panel-collapse collapse" id="collapse4">
  <form method="post">
    <td></td>
    <td></td>
    <td><input name="ebtdepositammount" class="form-controll"  value="" placeholder="EBT Ammount" autocomplete="off" onkeypress="return isNumberKey(event)"  type="number" step="0.00000001"></td>
    <td><input type="password" class="form-controll" name="ebtdeposit"  value="" placeholder="Spending Password"></td>
    <td><button name="btnebtdeposit" >Deposit</button></td>
    <td> </td>
    <td></td>
  </form>
</tr>
<tr class="panel-collapse collapse" id="collapse44">
  <form method="post">
    <td></td>
    <td></td>

    <td><input  name="ebtwithdrawammount" class="form-controll" value="" placeholder="EBT Ammount" autocomplete="off" onkeypress="return isNumberKey(event)"  type="number" step="0.00000001"></td>

    <td><input type="password" class="form-controll" name="ebtwithdraw"  value="" placeholder="Spending Password"></td>

    <td><button name="btnebtwithdraw">Withdraw</button></td>
    <td></td>
    <td></td>
  </form>
</tr>
</tbody>
</table>
</div>
</div>
</div>


<!--/.row-->
</div>


<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php
include 'footer.php';
?>
