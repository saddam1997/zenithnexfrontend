    <?php 
	include 'header2.php';
 	include_once('common.php');
    page_protect();
    if(!isset($_SESSION['user_id']))
    {
        logout();
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


$response = file_get_contents($url_api.'/user/getAllDetailsOfUser', FALSE, $context);


if($response === FALSE){
  die('Error');
}



$responseData = json_decode($response, TRUE);



if(isset($responseData['user']))
{

  $btc_address = $responseData['user']['userBTCAddress'];
  


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
                        <h1>Receive BTC<br>

                        </h1>
                        <span class="text-muted">Receive BTC to this address</span>
                    </div>
                    <div class="card-body text-center bg-white text-success">
                        <a href="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $new_address_BTC;?>">
                                                <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $btc_address?>" 
                                                alt="QR Code" style="width:200px;border:0;"/></a><br>
                        <h4><?php echo $btc_address;?></h4> 
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
