<?php 
ob_start();
	include 'common.php';

page_protect();
if(!isset($_SESSION['user_id']))
{
	header("location:logout.php");
}
$user_session = $_SESSION['user_session'];



if(isset($_GET['s']))
{
//	var_dump($_POST);
	$message = $_GET['s'];
}

	include 'header2.php';
	 ob_end_flush();
?>
	
<div class="container-fluid">
    <div class="animated fadeIn">
    	<div class="row " >
		    <div class="col-sm-12 col-md-12">
		    	<form action="successsend.php" method="post">
			    	<div class="card text-white bg-success">
		                <div class="card-header text-center">
		                    <h1>Withdrawl Response</h1>
		                </div>
		                <div class="card-body bg-white text-center text-success">
		                    <?php if(!empty($message)){ ?>
								<label>The transcation has been successfully intiatived. <?php echo $message;?></label>
							<?php 
							} else { 
							?>
								<label class="text-warning">There is some issue in processng your transcation. Please try after some time</label>
							<?php
							}
							?>
		                </div>
		                
		            </div>
		        </form>
		    </div>
		</div>
    </div>
</div>

<?php 
	include 'footer.php';
?>
