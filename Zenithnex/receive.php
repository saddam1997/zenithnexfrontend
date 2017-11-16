
<?php
    include 'header.php';

?>
<div class="container-fluid">
	<div class="animated fadeIn">
		<div class="row justify-content-center">
			<div class="col-sm-6 col-md-6 text-center">
	            <div class="card text-white bg-success">
	                <div class="card-header text-center">
                        <h1>Receive BTG<br>

                        </h1>
                        <span class="text-muted">Receive BTG to this address</span>
	                </div>
	                <div class="card-body text-center bg-white text-success">
	                    <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $myAddress?>" 
												alt="QR Code" style="width:150px;border:0;"><br>
						<span><?php echo $myAddress; ?></span> 
	                </div>
	            </div>

				
	        </div>
	    </div>
	</div>

</div>

<?php 
    include 'footer.php';

?>