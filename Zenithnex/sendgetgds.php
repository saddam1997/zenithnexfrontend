<?php 
ob_start();
include 'header2.php';
/*-----------Add Session-----------*/
page_protect();
if(!isset($_SESSION['user_id']))
{
    header("location:logout.php");
}
$user_session = $_SESSION['user_session'];
$user_current_balance_GDS = $_SESSION['GDSbalance'];


    if(isset($_POST['btnsendgds']))
    {

        //  var_dump($_POST);

        $reciever_address = $_POST['gdsaddress'];
        $coin_amount = $_POST['txtChar'];
        $spendingpassword = $_POST['spendingpassword'];


        $postData = array(
            "userMailId"=> $user_session,  
            "amount"=> $coin_amount, 
            "spendingPassword"=>$spendingpassword,  
            "recieverGDSCoinAddress"=> $reciever_address,   
            "commentForReciever"=> "Comment for Reciever",   
            "commentForSender"=> "Comment for sender"  
            );

// Create the context for the request
        $context = stream_context_create(array(
          'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($postData)
            )
          ));


        $response = file_get_contents('http://192.168.1.15:1338/usertransaction/sendGDS', FALSE, $context);

        if($response === FALSE){
          die('Error');
      }


      $responseData = json_decode($response, TRUE);

      $message = "Success";
      if(isset($responseData['user']))
      {

          header("location:successsend.php?s=".$message);
      }
      else
      {
        $error = $responseData['message'];
    }

}



ob_end_flush();
?>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row justify-content-center"  style="margin: 0 -350px;"  >
            <div class="col-sm-12 col-md-6">
                <form action="" method="post" class="form-horizontal">
                    <div class="card  bg-success">
                        <div class="card-header">
                            <div class="row text-center">
                                <div class="col-md-8 text-center">
                                    <h1>Send GDS</h1>
                                    
                                </div>
                                <div class="col-md-4 pull-right">
                                    <span class=" pull-right"><span class="font-weight-bold"><?php echo $user_current_balance_GDS; ?> GDS</span><br>My GDS balance</span>
                                </div>
                            </div>
                        </div>

                    <p style="color:red;text-align:center"> <?php if(isset($error)) {echo $error; }?> </p>
                        <div class="card-body bg-white text-center text-success">
                                <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-small">Receiver Address</label>
                                    <div class="col-sm-6">
                                        <input id="gdsaddress"  name ="gdsaddress" class="form-control" placeholder="Paste your <?php echo $coin_short;?> Address" autocomplete="off" type="text" value="">
                                                            
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-large">Amount(GDS + network Fee of 0.001)</label>
                                    <div class="col-sm-6">
                                        
                                        <input id = "gdsval" class="form-control form-control-sm" placeholder="0" autocomplete="off" onkeypress="return isNumberKey(event)" name="txtChar" type="number" step="0.00000001">
                                        
                                    </div>
                                    
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-5 form-control-label" for="input-small">Spending Password</label>
                                    <div class="col-sm-6">
                                        
                                        <input id="spendingpassword" name="spendingpassword" class="form-control form-control-sm" autocomplete="off" type="password" value="">
                                         
                                    </div>
                                    
                                </div>
                            
                        </div>
                        <input type="submit" class="btn btn-success btn-lg" id="btnsendgds" name="btnsendgds" value="Send"/>
                    </div>
                </form>
              
            </div>
        </div>

    </div>
</div>

<?php 
    include 'footer.php';
?>

