
<?php
    include 'header.php';

?>
<div class="container-fluid">
	<div class="animated fadeIn">
		<div class="row justify-content-center">
            <div class="col-sm-6 col-md-6 text-center">
                <div class="card text-white bg-success">
                    <div class="card-header text-center">
                        <div class="display-4"><?php echo $userBTCBalance; ?> BTC</div><br>
                        <span><?php echo $currentPrice; ?> USD</span>

                    </div>
                    <div class="card-body text-center bg-white text-success">
                        <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $myAddress?>" 
                                                alt="QR Code" style="width:150px;border:0;"><br>
                        <span><?php echo $userBTCaddress; ?></span> 
                    </div>
                </div>
                <!-- Button trigger modal -->
                <a href="buybtg.php" class="btn btn-success btn-lg">
                  <i class="fa fa-paper-plane"></i> &nbsp;Buy BTG</a>
                &nbsp;<a href="sendgetbtc.php" class="btn btn-success btn-lg">
                  <i class="fa fa-paper-plane"></i> &nbsp;Send BTC
                </a>
            </div>
         </form>
            

            </div>
        </div>
	    	<div class="card marginTop25">
                <div class="card-header bg-success">
                    <i class="fa fa-align-justify"></i> Transaction
                    <a href="getbcC.php" class="btn btn-outline-success" id="Type_Sent"  style="float: right;color: white;text-decoration: underline;">Sent</a>
                    <a type="button" href="receivedgetbtg.php" class="btn text-success" id="Type_Receive"  style="float: right;">Received</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Sender's Address</th>
                                <th>Txid</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                                foreach ($array2 as $item) {
                
                                foreach ($item as $key => $value) {
                                if($key == 'amounts_received') {
                                foreach($value as $newitem){
                                       echo  '<tr>
                                            <td>'.$newitem['recipient']."</br>".'
                                            </td>
                                             <td>'.$item['txid']."<br/>".'
                                            </td>
                                            <td>'. convertDateTime($item['time']) . '</td>
                                            <td>'.$newitem['amount']."</br>".'
                                            </td>
                                            <td> Received
                                            </td>
                                       </tr>';
                             
                                        }
                                        
                                    }
                                } 
            }               
            ?>   
                        </tbody>
                    </table>
                </div>
            </div> 
	</div>

</div>

<?php 
    include 'footer.php';

?>