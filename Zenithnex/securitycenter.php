<?php 
error_reporting(1);
session_start();


include_once('common.php');
page_protect();
if(!isset($_SESSION['user_id']))
{
	header("location:logout.php");
	exit;
}
$user_session = $_SESSION['user_session'];

	//...... Update Current Password......//

if(isset($_POST['btnlogin']))
{

	$currentpassword = $_POST['currentpassword'];
	$password = $_POST['signuppassword'];
	$confirmpassword = $_POST['confirmpassword'];

	$postData = array(
		"userMailId"=>$user_session ,
		"currentPassword"=>$currentpassword,
		"newPassword"=>$password,
		"confirmNewPassword"=>$confirmpassword
		);

// Create the context for the request
	$context = stream_context_create(array(
		'http' => array(
			'method' => 'POST',
			'header' => "Content-Type: application/json\r\n",
			'content' => json_encode($postData)
			)
		));


	$response = file_get_contents($url_api.'/user/updateCurrentPassword', TRUE, $context);

	if($response === FALSE){
		die('Error');
	}


	$responseData = json_decode($response, TRUE);

	if($responseData['statusCode']==200){
		$message = $responseData['message'];

	}
	else
	{
		$fail = $responseData['message'];

	}
}

//...... Update Current Spending Password......// 
if(isset($_POST['btnSpending']))
{

	$currentpassword = $_POST['currentspendingpassword'];
	$password = $_POST['spendingpassword'];
	$confirmpassword = $_POST['confirmspendingpassword'];

	$postData = array(
		"userMailId"=>$user_session,
		"currentSpendingPassword"=>$currentpassword,
		"newSpendingPassword"=>$password,
		"confirmNewPassword"=>$confirmpassword
		);

// Create the context for the request
	$context = stream_context_create(array(
		'http' => array(
			'method' => 'POST',
			'header' => "Content-Type: application/json\r\n",
			'content' => json_encode($postData)
			)
		));


	$response = file_get_contents($url_api.'/user/updateCurrentSpendingPassword', TRUE, $context);

	if($response === FALSE){
		die('Error');
	}


	$responseData = json_decode($response, TRUE);

	if($responseData['statusCode']==200){
		$message1 = $responseData['message'];

	}
	else
	{
		$fail1 = $responseData['message'];

	}
}

//...... Email.Verify......//

if(isset($_POST['btnverify']))
{


	$postData = array(
		"userMailId"=>$user_session

		);

// Create the context for the request
	$context = stream_context_create(array(
		'http' => array(
			'method' => 'POST',
			'header' => "Content-Type: application/json\r\n",
			'content' => json_encode($postData)
			)
		));


	$response = file_get_contents($url_api.'/user/sentOtpToEmailVerificatation', TRUE, $context);

	if($response === FALSE){
		die('Error');
	}


	$responseData = json_decode($response, TRUE);

	if($responseData['statusCode']==200){
		$message2 = $responseData['message'];
		header("location:verifyemail.php?m=".$message2);

	}
	else
	{
		$fail2 = $responseData['message'];


	}
}

?>
<?php 
include 'header.php';
?>
<form action="securitycenter.php" method="post">
	<div class="container-fluid">
		<div class="animated fadeIn">
			<div class="row justify-content-center" >
				<div class="col-sm-6 col-md-4">
					<div class="card text-white ">
						<div class="card-header text-center bg-success" style="padding: 1.5rem;">
							<h1>Security Center</h1>
						</div>
						<div class="card-body bg-white text-center text-success" style="margin: 1rem;">
							<span>
								<?php 
								if($_SESSION['is_email_verify']== 1 ){
									echo "<span class=\"text-success\"><i class=\"fa fa-check-circle fa-5x\"></i>" ;
								}
								else { 
									echo "<span class=\"text-danger\"><i class=\"fa fa-warning fa-5x\"></i>" ; 
								} 
								?><br>
								<?php 
								if($_SESSION['is_email_verify']== 0)
								{
									echo "<button id=\"btnverify\" name=\"btnverify\" class=\"btn btn-danger\" type=\"submit\" >
									Not Verified?
								</button>";
							}
							else { 

								echo "<span>Verified" ;
							}


							?>
						</span>
						<p style="color:red;"> <?php if(isset($fail2)) {echo $fail2; }?> </p>
					</div>
					<div class="card-footer bg-success text-center"  >
						<span>Please update your password regularly</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header bg-success" style="padding: 1.5rem;"">
						<strong>Update Login Password</strong>
						<div style="float:right;">
						<p style="color:green;"> <?php if(isset($message)) {echo $message; }?> </p>
						<p style="color:red;"> <?php if(isset($fail)) {echo $fail; }?> </p>
						</div>
					</div>
					
					<div class="card-body">
						<div class="form-group">
							<label class="form-form-control-label" for="inputSuccess1">Current Password</label>
							<input id="currentpassword" name="currentpassword" autocomplete="off" class="form-control" type="password" value="">

						</div>
						<div class="form-group">
							<label class="form-form-control-label" for="inputError1">New Password</label>
							<input  id="signuppassword" name="signuppassword" autocomplete="off" class="form-control" type="password" value="">

						</div>
						<div class="form-group">
							<label class="form-form-control-label" for="inputSuccess1">Confirm Password</label>
							<input id="confirmpassword" name="confirmpassword" class="form-control" autocomplete="off" type="password" value="">

						</div>

					</div>
					<input type="submit" class="btn btn-success btn-lg text-center" id="btnlogin" name="btnlogin" value="Update"/>
				</div>
			</div>
			<!--/.col-->
			<div class="col-sm-6">
				<div class="card">
					<div class="card-header bg-success" style="padding: 1.5rem;">
						<strong>Update Spending Password</strong>
						<div style="float:right;">
						<p style="color:green;"> <?php if(isset($message1)) {echo $message1; }?> </p>
					    <p style="color:red;"> <?php if(isset($fail1)) {echo $fail1; }?> </p>
						</div>
					</div>
					
					<div class="card-body">
						<div class="form-group">
							<label class="form-form-control-label" for="inputSuccess1">Current Password</label>
							<input id="currentspendingpassword" name="currentspendingpassword" class="form-control" autocomplete="off" type="password" value="">

						</div>
						<div class="form-group">
							<label class="form-form-control-label" for="inputError1">New Password</label>
							<input id="spendingpassword" name="spendingpassword" class="form-control" autocomplete="off" type="password" value="">

						</div>
						<div class="form-group">
							<label class="form-form-control-label" for="inputSuccess1">Confirm Password</label>
							<input id="confirmspendingpassword" name="confirmspendingpassword" class="form-control" autocomplete="off" type="password" value="">

						</div>
					</div>
					<input type="submit" class="btn btn-success btn-lg text-center" id="btnSpending" name="btnSpending" value="Update"/>
				</div>
			</div>
			<!--/.col-->
		</div>

	</div>
</div>
</form>
<?php 
include 'footer.php';
?>



