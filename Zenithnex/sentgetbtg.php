
<?php
    include 'header.php';

?>
<div class="container-fluid">
	<div class="animated fadeIn">
		<div class="row justify-content-center">
			<div class="col-sm-6 col-md-6 text-center">
	            <div class="card text-white bg-success">
	                <div class="card-header text-center">
	                    <div class="display-4"><?php echo $newBalance ?> BTC</div><br>
	                    <span><?php echo $currentPrice ?> USD</span>

	                </div>
	                <div class="card-body text-center bg-white text-success">
	                    <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $myAddress?>" 
												alt="QR Code" style="width:150px;border:0;"><br>
						<span><?php echo $myAddress; ?></span> 
	                </div>
	            </div>
	            <!-- Button trigger modal -->
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#buyBTC">
				  <i class="fa fa-paper-plane"></i> &nbsp;Buy
				</button>

				<!-- Modal -->
				
				<div class="modal fade" id="buyBTC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-success" role="document">
				        <div class="modal-content">
				            <div class="modal-header text-center">
				                <h4 class="modal-title text-center">Send BTC</h4>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body">
				                <form action="" method="post" class="form-horizontal">
			                        <div class="form-group row">
			                            <label class="col-sm-5 form-control-label" for="input-small">Amount</label>
			                            <div class="col-sm-6">
			                                <input type="text" id="input-small" name="input-small" class="form-control form-control-sm" placeholder="">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-sm-5 form-control-label" for="input-normal">Description</label>
			                            <div class="col-sm-6">
			                                <input type="text" id="input-small" name="input-small" class="form-control form-control-sm" placeholder="">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-sm-5 form-control-label" for="input-large">Spending Password</label>
			                            <div class="col-sm-6">
			                                <input type="text" id="input-small" name="input-small" class="form-control form-control-sm" placeholder="">
			                            </div>
			                        </div>
			                    </form>
				            </div>
				            <div class="modal-footer">
				            	<span><?php echo "$networkFee"; ?></span>
				                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				                <button type="button" class="btn btn-success"  data-dismiss="modal">Save changes</button>
				            </div>
				        </div>
				        <!-- /.modal-content -->
				    </div>
				    <!-- /.modal-dialog -->
				</div>
				
	        </div>
	    </div>
	    	<div class="card marginTop25">
                <div class="card-header bg-success">
                    <i class="fa fa-align-justify"></i> Transaction
                    <a type="button" href="sentgetbtg.php" class="btn btn-default" id="Type_Sent"  style="float: right;color: white;text-decoration: underline;">Sent</a>
                    <a type="button" href="receivedgetbtg.php" class="btn btn-default" id="Type_Receive"  style="float: right;color: white;text-decoration: underline;">Received</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>Txid</th>
                                <th>Amount</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                                foreach ($array as $item) {
                
                                foreach ($item as $key => $value) {
                                if($key == 'amounts_sent') {
                                foreach($value as $newitem){
                                       echo  '<tr>
                                            <td>'.$newitem['recipient']."</br>".'
                                            </td>
                                             <td>'.$item['txid']."<br/>".'
                                            </td>
                                            <td>'.$newitem['amount']."</br>".'
                                            </td>
                                            <td> Sent
                                            </td>

                                       </tr>';
                             
                        }
                        
                    }
                }

                
            }               
            ?>   
                        </tbody>
                    </table>
                   <!--  <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Prev</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav> -->
                </div>
            </div> 
	</div>

</div>

<?php 
    include 'footer.php';

?>