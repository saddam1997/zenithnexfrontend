<?php 
ob_start();
include 'header.php';
/*-----------Add Session-----------*/
/*page_protect();
if(!isset($_SESSION['user_id']))
{
    header("location:logout.php");
}
$user_session = $_SESSION['user_session'];
$user_current_balance_BTC = $_SESSION['BTCbalance'];

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

$user_session = $_SESSION['user_session'];
$user_current_balance_BTC = $_SESSION['BTCbalance'];

$postData = array(
  "userMailId"=> $user_session,
  
  );

// Create the context for the request
$context = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($postData)
    )
  ));


$response = file_get_contents('http://192.168.1.11:1338/usertransaction/getTxsListBTC', FALSE, $context);

if($response === FALSE){
  die('Error');
}


$responseData = json_decode($response, TRUE);


if(isset($responseData['tx']))
{

    
    $transactionList_BTC = $responseData['tx'];

    }
*/
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

  <div class="container-fluid" style="min-height: 400px">
   <div class="animated fadeIn">
    
    <div class="card marginTop25" >
      <div class="card-header bg-success" style="font-size: 20px;padding: 1.5rem;">
        TRADE ACCOUNT BALANCES
     </div>
     <div class="card-body">
      <table class="table table-responsive table-hover table-outline mb-0">
        <thead class="thead-default">
          <tr>					
           <th class="text-center">TRADE</th>
           <th class="text-center">CURRENCY NAME</th>
           <th class="text-center">SYMBOL</th>
           <th class="text-center">TRADE BALANCE</th>
           <th class="text-center">Freezed BALANCE</th>
           <th class="text-center">TOTAL BALANCE</th>
         </tr>
       </thead>
       <tbody>
        
          <tr>
          <td class="text-center">

             <button data-toggle="tooltip" title="Deposit" ><a style="color:white;" href="#demo">+</a></button>
             <button data-toggle="tooltip" title="Withdraw" >-</button>
             <button data-toggle="tooltip" title="Histroy">-></button>

           </td>
          <td>Bitcoin</td>
          <td class="text-center">BTC</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
        </tr>
         <tr>
          <td class="text-center">

             <button data-toggle="tooltip" title="Deposit">+</button>
             <button data-toggle="tooltip" title="Withdraw">-</button> 
             <button data-toggle="tooltip" title="Histroy">-></button>

           </td>
          <td>Bitcoin Cash</td>
          <td class="text-center">BCC</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
        </tr>
         <tr>
          <td class="text-center">

             <button data-toggle="tooltip" title="Deposit">+</button>
             <button data-toggle="tooltip" title="Withdraw">-</button> 
             <button data-toggle="tooltip" title="Histroy">-></button>

           </td>
          <td>Litecoin</td>
          <td class="text-center">LTC</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
        </tr>
         <tr>
          <td class="text-center">

             <button data-toggle="tooltip" title="Deposit">+</button>
             <button data-toggle="tooltip" title="Withdraw">-</button> 
             <button data-toggle="tooltip" title="Histroy">-></button>

           </td>
          <td>Goods Coin</td>
          <td class="text-center">GDS</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
        </tr>
         <tr>
          <td class="text-center">

             <button data-toggle="tooltip" title="Deposit">+</button>
             <button data-toggle="tooltip" title="Withdraw">-</button> 
             <button data-toggle="tooltip" title="Histroy">-></button>

           </td>
          <td>Ebittree Coin </td>
          <td class="text-center">EBT</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
          <td class="text-center">0.00000000</td>
        </tr>
     
  </tbody>
</table>
</div>
</div> 
</div>


<!--/.row-->
</div>


<div id="demo" class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center"  style="margin: 0 -350px;"  >
            <div  class="col-sm-12 col-md-6">
                <form action="" method="post" class="form-horizontal">
                    <div class="card  bg-success" style="margin:1.5rem -0.5rem;">
                        <div class="card-header">
                            <div class="row text-center">
                                <div class="col-md-8 text-center">
                                    <h1>Deposit BTC</h1>
                                    <span>1 BCC = <?php echo $data->ticker->price; ?> USD</span>
                                </div>
                                <div class="col-md-4 pull-right">
                                    <span class=" pull-right"><span class="font-weight-bold"><?php echo $user_current_balance_BTC; ?> BCC</span><br>My BTC balance</span>
                                </div>
                            </div>
                        </div>
                        <p style="color:red;text-align:center"> <?php if(isset($error)) {echo $error; }?> </p>
                        <div class="card-body bg-white text-center text-success">
                            
                            <div class="form-group row">
                                <label class="col-sm-5 form-control-label" for="input-large">Amount(BCC + network Fee of 0.001)</label>
                                <div class="col-sm-6">

                                    <input id = "btcval" class="form-control form-control-sm" placeholder="0" autocomplete="off" onkeypress="return isNumberKey(event)" name="txtChar" type="number" step="0.00000001">

                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 form-control-label" for="input-small">Spending Password</label>
                                <div class="col-sm-6">

                                    <input id="spendingpassword" name="spendingpassword" class="form-control form-control-sm" autocomplete="off" type="password" value="">

                                </div>

                            </div>
                            
                        </div>
                        <input type="submit" class="btn btn-success btn-lg" id="btnsendbcc" name="btnsendbcc" value="Send"/>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(){
        $("#demo").toggle();
    });
});
</script>
<?php
include 'footer.php';
?>
</html>
