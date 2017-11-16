<?php 
include_once('common.php');
$allowed = array(".", "-", "_");
$email_id ="";

//echo "           =>>>>>>> ".hash('sha256',addslashes(strip_tags($email_id)));
//echo "</br>           =>>>>>>> ".hash('sha256',addslashes(strip_tags($password)));
$error = array();
if(isset($_POST['btnforget']))
{
//	var_dump($_POST);
	$email_id = $_POST['txtEmailID'];
	 
	if (empty($email_id))
	{
		$error['emailError'] = "Please Provide valid email id";
	}	
	elseif (!isEmail($email_id))
	{
		$error['emailError'] = "Please Provide valid email id";
	}

	if(empty($error))
	{
		$email_id = $mysqli->real_escape_string(strip_tags($email_id));
		
		$qstring = "select coalesce(id,0) as id, coalesce(username,'') as username
					from users WHERE encrypt_username = '" . hash('sha256',$email_id) . "'";
		
		$result	= $mysqli->query($qstring);
		$user = $result->fetch_assoc();
		//var_dump($user);
		
		
		if (($user) && ($user['id'] > 0 ))
		{
			$new_password = "s!w@".rand(0,100000);
			$password_value = hash('sha256',addslashes(strip_tags($new_password)));
			$sub =" Password Recovery Mail";
			$message_body =" Dear User \n";
			$message_body .= " Your recovery password is $new_password \n\n";
			$message_body .= " Please login and change it immediately\n\n";
			$message_body .= " Thanks \n";
			$message_body .= " Administrator";
			
			$qstring = "update users set `password` ='".$password_value."'"; 
			$qstring .= " WHERE encrypt_username = '" . hash('sha256',$email_id) . "' and id = ".$user['id'] ;
		
			$result2	= $mysqli->query($qstring);
	//		$user2 = $result2->fetch_assoc();
			
			$error['emailError2'] = "An Email has been send to your email id. ";

			sendpmail($email_id,$sub,$message_body);
		}
		else
		{
			$error['emailError'] = "the Provided email_id  is not registered with us";
		}
	}
}
//var_dump($_SESSION);
?>
<?php 
	include 'header.php'
?>
<form action="forget.php" method="post">
	<div class="container-fluid">
	    <div class="animated fadeIn">
	    	<div class="row justify-content-center" >
		    	<div class="col-sm-6 col-md-4">
		            <div class="card text-white bg-success">
		                <div class="card-header text-center">
		                    <h4 class="modal-title text-center">Forget Password?<small><small>&nbsp; OTP has been send on your email</small></small></h4>
		                </div>
		                <div class="card-body bg-white text-center text-success">
		                    <div class="form-group row">
	                            <label class="col-sm-5 form-control-label" for="input-small">Registered Email ID</label>
	                            <div class="col-sm-6">
	                                <input id="txtEmailID" name="txtEmailID" class="form-control"  type="text"	value="<?php echo $email_id;?>">						
									<?php if(isset($error['emailError'])) { echo "<br/><span class=\"messageClass\">".$error['emailError']."</span>";  }?>	
									<?php if(isset($error['emailError2'])) { echo "<br/><span class=\"messageClass2\">".$error['emailError2']."</span>";  }?>
	                            </div>
	                            
	                        </div>
                        
		                </div>
		                <div class="card-footer bg-success text-center">
	                	
                		
                		<button type="submit" class=" btn btn-success" id="btnforget" name="btnforget" value="Send"/>
	                </div>
		            </div>
		        </div>
		    </div>
	    </div>
	</div>
</form>
<?php
	include 'footer.php'
?>