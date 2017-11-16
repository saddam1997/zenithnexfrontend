<?php 
include_once('common.php');
include 'header.php';

page_protect();
if(!isset($_SESSION['user_id']))
{
	header("location:logout.php");
}
$error = array();
$userList = array();
$new_address = "";
$user_session = $_SESSION['user_session'];
$user_current_balance = 0;
if(isset($_GET['nad']))
{
	$new_address = $_GET['nad'];
}
$client = "";
if(_LIVE_)
{
	$client = new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
	if(isset($client))
	{
		//echo "<pre> dd </br>";var_dump($_SESSION);echo "</br> ddd <pre>";
		$user_current_balance = $client->getBalance($user_session) - $fee;
	}
}

$qstring = "select coalesce(id,0) as id, coalesce(username,'') as username, coalesce(`date`,now()) as `date`, coalesce(admin,0) as admin, 
coalesce(locked, 0) as locked, coalesce(ip,'') as ip from users ";

$result	= $mysqli->query($qstring);
while ($user = $result->fetch_assoc())
{
	$userList[] = $user;
}

?>
<!DOCTYPE html>
<html>

<body>
	<div>
		<form action="myaddress.php" method="post">
				<div class="card-body">
							<table class="table table-responsive table-hover table-outline mb-0">
								<thead class="thead-default">
									<tr>
										<th>Username</th>
										<th>Created</th>
										<th>Is admin?</th>
										<th>Is locked?</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php								

									if(count($userList)>0)
									{
										
										foreach ($userList as $userValue)
										{
											?>											<tr>
											<td><?php echo $userValue['username'];?></td>
											<td><?php echo $userValue['date'];?></td>
											<td><?php if($userValue['admin']== 1) { ?>										   
												<strong>Yes</strong> <a href="updatea.php?m=0&i=<?php echo $userValue['id']; ?>">De-admin</a> <?php } else { ?> 
												No <a href="updatea.php?m=<?php echo rand(1,10000);?>&i=<?php echo $userValue['id'] ;?>">Make admin</a> <?php } ?></td>
												<td><?php if($userValue['locked']== 1) { ?>										   
													<strong>Yes</strong> 
													<a href="updatel.php?m=0&i=<?php echo $userValue['id']; ?>">Unlock</a> <?php } else { ?> 
													No <a href="updatel.php?m=<?php echo rand(1,10000);?>&i=<?php echo $userValue['id']; ?>">Lock</a> <?php } ?></td>
													<td><a href="infodel.php?&m=<?php echo rand(1,10000);?>&i=<?php echo $userValue['id']; ?>" 
														onclick="return confirm('Are you sure you really want to delete user <?php echo  $userValue['username']." ";?>id =<?php echo $userValue['id']; ?>');">
														Delete</a></td>
													</tr>
													<?php											
												}											
											}
											else if(count($userList)== 0)
											{
												echo "<tr><td colspan=\"3\">There is no Address exists</td></tr>";
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
				</form>
			</div>
		</div>
		
	</body>
	</html>