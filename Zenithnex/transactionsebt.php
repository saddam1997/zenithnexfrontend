

<?php 
include_once('common.php');
page_protect();
if(!isset($_SESSION['user_id']))
{
  header("location:logout.php");
}

$user_session = $_SESSION['user_session'];

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


$response = file_get_contents('http://192.168.1.15:1338/usertransaction/getTxsListEBT', FALSE, $context);

if($response === FALSE){
  die('Error');
}


$responseData = json_decode($response, TRUE);


if(isset($responseData['tx']))
{

    
    $transactionList_EBT = $responseData['tx'];

    }
    
  
?>
<?php
  
include 'header2.php';
?>


<form action="transactions.php" method="post">
  <div class="container-fluid" style="min-height: 400px">
   <div class="animated fadeIn">
    
    <div class="card marginTop25" style="width: 1064px;">
      <div class="card-header bg-success" style="font-size: 20px;padding: 1.5rem;">
        Your Transactions
        <div style="float: right" >
         <a type="button" href="transactionsebt.php" style="font-size:20px;"class="btn btn-default" id="Type_All">All</a>
         <a type="button" href="sentebt.php" style="font-size:20px;" class="btn btn-default" id="Type_Sent">Sent</a>
         <a type="button" href="recievedebt.php" style="font-size:20px;" class="btn btn-default" id="Type_Receive">Received</a>
       </div>
     </div>
     <div class="card-body">
      <table class="table table-responsive table-hover table-outline mb-0">
        <thead class="thead-default">
          <tr>          
           <th>Date</th>
           <th>Address</th>
           <th class="text-center">Type</th>
           <th>Amount</th>
           <th class="text-center">Confirmations</th>
           <th>TX</th>
         </tr>
       </thead>
       <tbody>
        <?php
        $bold_txxs = "";
        if(count($transactionList_EBT)>0)
        {
         foreach(array_reverse($transactionList_EBT) as $transaction) { 
          if($transaction['category']=="send") { $tx_type = '<b style="color: #FF0000;">Sent</b>'; } else if($transaction['category']=="receive"){ $tx_type = '<b style="color: #01DF01;">Received</b>'; } else {
            $tx_type = '<b style="color: #01DF01;">Admin</b>';
            $transaction['address'] = 'ZenithNEX ';
            $transaction['confirmations'] = 'Confirmed ';
            $blockchain_url='';
            $transaction['txid']= '';
          }
          echo '<tr>
          <td>'.date('n/j/Y h:i a',$transaction['time']).'</td>
          <td>'.$transaction['address'].'</td>
          <td>'.$tx_type.'</td>
          <td>'.abs($transaction['amount']).'</td>
          <td>'.$transaction['confirmations'].'</td>
          <td colspan=\"3\"><a href="' . $blockchain_url,  $transaction['txid'] . '" target="_blank">Info</a></td>
        </tr>';
      }
    }
    else if((count($transactionList_EBT)== 0))
    {
      echo "<tr><td colspan=\"3\">There is no Transaction exists</td><td></td><td></td><td></td></tr>";
    }
    ?>      
  </tbody>
</table>
</div>
</div> 
</div>


<!--/.row-->
</div>
</form>

<br><br><br>


<?php
include 'footer.php';
?>