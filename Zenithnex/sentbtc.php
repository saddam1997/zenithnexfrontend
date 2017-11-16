
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


$response = file_get_contents('http://192.168.1.15:1338/usertransaction/getTxsListBTC', FALSE, $context);

if($response === FALSE){
  die('Error');
}


$responseData = json_decode($response, TRUE);


if(isset($responseData['tx']))
{

    
    $transactionList_BTC = $responseData['tx'];

    }

  
?>
<?php
  
include 'header2.php';
?>
<div class="container-fluid">
  <div class="animated fadeIn">
    
        <div class="card marginTop25">
          <div class="card-header bg-success" style="font-size: 20px;padding: 1.5rem;">
        Your Transactions   
            <div style="float: right" >
         <a type="button" href="transactionsbtc.php" style="font-size:20px;"class="btn btn-default" id="Type_All">All</a>
         <a type="button" href="sentbtc.php" style="font-size:20px;" class="btn btn-default" id="Type_Sent">Sent</a>
         <a type="button" href="recievedbtc.php" style="font-size:20px;" class="btn btn-default" id="Type_Receive">Received</a>
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
                  
                               if(count($transactionList_BTC)>0)
                                {
                                   foreach(array_reverse($transactionList_BTC) as $transaction) 
                                   {
                                        if($transaction['category']=="send")
                                        {
                                            $tx_type = '<b style="color: #FF0000;">Sent</b>'; 
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
                                }
                                else if((count($transactionList_BTC)== 0))
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
     
<br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
  include 'footer.php';
?>