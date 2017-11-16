
<?php 
include_once('common.php');
page_protect();
if(!isset($_SESSION['user_id']))
{
	header("location:logout.php");
}
$user_session = $_SESSION['user_session'];
$errorcontact = array();
$transactionList = array();

$user_current_balance = 0;
// $user_email= $user_session;
$text_subject = "";
$trans_desc ="";

$client = "";
if(_LIVE_)
{
	// $client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
	// if(isset($client))
	// {
	// 	$user_current_balance = $client->getBalance($user_session) - $fee;
	// }
}

if(isset($_POST['btncontact']))
{
//	var_dump($_POST);
	$text_subject = $_POST['text_subject'];
	$user_email = $_POST['user_email'];
	$trans_desc = $_POST['discription'];
	
	//$user_current_balance = $client->getBalance($user_session) - $fee;
	
	if (empty($user_email))
	{
		$errorcontact['user_emailError'] = "Please Provide valid Email";
	}	
	
	if (empty($text_subject))
	{
		$errorcontact['text_subjectError'] = "Please Provide valid Subject";
	}
	
	
	
	if (empty($trans_desc))
	{
		$errorcontact['discriptionError'] = "Please Provide valid Message";
	}
	
	if(empty($errorcontact))
	{
		
		sendMailToAdmin(ADMIN_EMAIL, $user_email, $text_subject, $trans_desc);
		
		$errorcontact2['user_emailError'] = "Thank you for contacting us. Your request has been submitted to concern person";
		$user_email= $user_session;
		$text_subject = "";
		$trans_desc ="";
	}	
}
?>
<?php 
include 'header.php';
?>
<div class="container-fluid">
	<div class="animated fadeIn">
		<div class="row justify-content-center" >
			<div class="col-sm-6 col-md-8">
				<form action="contactus.php" method="post">
					<div class="card text-white">
						<div class="card-header text-center  bg-success">
							<h1>Get in Touch</h1>
						</div>
						<div class=" col-sm-12 card-body bg-white text-center text-success">
						Please fill out the quick form and we will be in touch with lightning speed.
							<form action="" method="post" class="form-horizontal">
								<div class="form-group row ">
									<input id="user_email"  name ="user_email" class="form-control"	placeholder="Email" autocomplete="off" type="text" value="<?php echo $user_email;?>">
									<?php if(isset($errorcontact['user_emailError'])) { echo "<br/><span class=\"messageClass\">".$errorcontact['user_emailError']."</span>";  }?>	
									<?php if(isset($errorcontact2['user_emailError'])) { echo "<br/><span class=\"messageClass\">".$errorcontact2['user_emailError']."</span>";  }?>
								</div>
								<div class="form-group row">
									<input id = "btcval" class="form-control" placeholder="Subject" autocomplete="off" name="text_subject" type="text" value ="<?php echo $text_subject;?>">
									<?php if(isset($errorcontact['text_subjectError'])) { echo "<br/><span class=\"messageClass\">".$errorcontact['text_subjectError']."</span>";  }?>	
								</div>
								<div class="form-group row">
									<textarea id="discription" name ="discription" type="text" class="form-control" placeholder="Description" rows="4"><?php echo $trans_desc;?></textarea>
									<?php if(isset($errorcontact['discriptionError'])) { echo "<br/><span class=\"messageClass\">".$errorcontact['discriptionError']."</span>";  }?>
								</div>
							</form>
						</div>
						<button  type="submit" class="btn btn-success btn-lg text-center" id="btncontact" name="btncontact">&nbsp;Submit</button>

					</div>
				</form>
			</div>
		</div>

	</div>
</div>


<?php 
include 'footer.php';
?>



