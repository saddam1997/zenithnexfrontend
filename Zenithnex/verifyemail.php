<?php 
include_once('common.php');
error_reporting(0);
//ALTER TABLE `users` ADD `otp_value` VARCHAR(500) NULL DEFAULT '' AFTER `authused`, ADD `is_email_verify` TINYINT NULL DEFAULT '0' AFTER `otp_value`;
$success = $_GET['m'];
session_start();
page_protect();
if(!isset($_SESSION['user_id']))
{
	header("location:logout.php");
}
$user_session = $_SESSION['user_session'];



if(isset($_POST['submit_otp']))
{
//  var_dump($_POST);
  $otp = $_POST['otp_value_text'];
  


$postData = array(
  "userMailId"=> $user_session ,
  "otp"=> $otp
  
  );

// Create the context for the request
$context = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($postData)
    )
  ));


$response = file_get_contents('http://192.168.1.15:1338/user/updateUserVerifyEmail', FALSE, $context);

if($response === FALSE){
  die('Error');
}


$responseData = json_decode($response, TRUE);

if(isset($responseData['user']))
{


$_SESSION['is_email_verify']=$responseData['user']['verifyEmail'];
header("location:securitycenter.php");

 
}
else
{
	$message = $responseData['message'];
}

}
?>
<?php 
	include 'header.php';
?>
<br><br><br><br><br>
<form action="verifyemail.php" method="post">
	<div class="container-fluid">
	    <div class="animated fadeIn">
	    	<div class="row justify-content-center" >
		    	<div class="col-sm-6 col-md-4">
		            <div class="card text-white bg-success">
		                <div class="card-header text-center">
		                    <h4 class="modal-title text-center">Enter OTP</h4>
		                    <p style="color:Green;"> <?php if(isset($success)) {echo $success; }?> </p>
		                    <p style="color:red;"> <?php if(isset($message)) {echo $message; }?> </p>
		                    <p style="color:green;"> <?php if(isset($verify)) {echo $verify; }?> </p>
		                </div>
		                <div class="card-body bg-white text-center text-success">
		                    <div class="form-group row">
	                            <label class="col-sm-5 form-control-label" for="input-small">Enter OTP</label>
	                            <div class="col-sm-6">
	                                <input id="otp_value_text" name="otp_value_text" autocomplete="off" class="form-control form-control-sm" type="text" value="" placeholder="OTP Value">
	                            </div>
	                            
	                        </div>
                        
		                </div>
		                <div class="card-footer bg-success text-center">
                		<button type="submit" class="btn btn-success"  id="submit_otp" name="submit_otp">Verify</button>
	                </div>
		            </div>
		        </div>
		    </div>
	    </div>
	</div>
</form>
<br><br><br><br><br><br>

<?php 
	include 'footer.php';
?>
