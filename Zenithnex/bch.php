
<?php
ob_start();
include 'header.php';



    ob_end_flush();
    ?>
    <style>
      
      ul li{ list-style-type: none;
        
        float: left;
        margin-left: 20px;
        margin-bottom: 20px;
        margin-top: 20px;
       }
      u{ line-height: 1 !important; }
    </style>

    <div id="asks_orders"></div>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row" >
                <div class="col-sm-12 col-md-12">
                 <ul class="">
                      <li class="nav-item">
                        <a href="markettrade.php">BTC - BCH </a>
                      </li>
                      <li class="nav-item">
                        <a href="gds.php">GDS</a>
                      </li>
                      <li class="nav-item">
                        <a  href="ebt.php">EBT </a>
                     </li>
                      <li class="nav-item">
                        <a  href="bch.php">BCH</a>
                      </li>
                    </ul>
     <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

              <div class="row">
                <div class="col-6">
                      <div class="col-sm-6" style="max-width: 50% !important;">
                        <div class="panel panel-default">
                          <div class="panel-heading">BID ORDERS</div>
                          <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped order-table table-hover">
                                  <thead class="thead-dark">
                                    <tr>
                                      <th>Total(BTC)</th>
                                      <th>Vol(BCH)</th>
                                      <th>Bid(BTC)</th>
                                    </tr>
                                  </thead>
                                  <tbody id="bid_btc">

                                  </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>

                     <div class="col-sm-6">
                       <div class="panel panel-default">
                         <div class="panel-heading">ASK ORDERS</div>
                         <div class="panel-body">
                           <div class="table-responsive">
                             <table class="table table-striped table-hover">
                               <thead>
                                 <tr>
                                   <th>Ask(BTC)</th>
                                   <th>Vol(BCH)</th>
                                   <th>Total(BTC)</th>
                                 </tr>
                               </thead>
                               <tbody id="ask_btc">

                               </tbody>
                             </table>
                           </div>
                         </div>
                       </div>

                    </div>

                </div>

                <div class="col-6">

                       <div class="panel panel-default">
                          <div class="panel-heading">Buy Bitcoin Cash <div class="pull-right">Balance: <?php echo $bal=50;?> BTC</div></div>
                          <div class="panel-body">
                            <fieldset>

                               <div class="input-group margin-top">
                                  <span class="input-group-addon">Units</span>
                                  <input type="number" step="0.00001" onkeyup="sum()" name="bidAmountBCH" id="text1" class="form-control txt" aria-label="Amount (to the nearest dollar)">
                                  <span class="input-group-addon">BCH</span>
                               </div>
                               <div class="input-group margin-top">
                                  <span class="input-group-addon">Bid</span>
                                  <input type="number" step="0.00001" onkeyup="sum()" name="bidRate" id="text2" class="form-control txt" aria-label="Amount (to the nearest dollar)">
                                  <span class="input-group-addon">BTC</span>
                               </div>
                               <div class="input-group margin-top">
                                  <span class="input-group-addon">Total</span>
                                  <input type="number" step="0.00001" name="bidAmountBTC" id="sum" class="form-control sum1" aria-label="Amount (to the nearest dollar)">
                                  <span class="input-group-addon">BTC</span>
                               </div>
                               <div class="row">
                                  <button onclick="buy_data();" class="btn btn-success btn-sm col-xs-3" type="button" id="butval">Buy</button><div id="error_message1" class="pull-right"></div>
                                  <!-- <input class="btn btn-success col-xs-3 btn-sm" id="reset" type="button"  value="RESET"> -->
                              </div>

                            </fieldset>
                          </div>
                        </div>



                      <div class="panel panel-default">
                         <div class="panel-heading">Sell Bitcoin Cash <div class="pull-right">Balance: <?php echo $sel=50;?> BCH</div></div>
                         <div class="panel-body">
                            <fieldset>
                              <div class="input-group margin-top">
                                 <span class="input-group-addon">Units</span>
                                 <input type="number" step="0.00001" id="text3" name="askAmountBCH" onkeyup="sumsell()" class="form-control" aria-label="Amount (to the nearest dollar)">
                                 <span class="input-group-addon">BCH</span>
                              </div>
                              <div class="input-group margin-top">
                                 <span class="input-group-addon">Ask</span>
                                 <input type="number" step="0.00001" onkeyup="sumsell()" name="askRate" id="text4" class="form-control" aria-label="Amount (to the nearest dollar)">
                                 <span class="input-group-addon">BTC</span>
                              </div>
                              <div class="input-group margin-top">
                                 <span class="input-group-addon">Total</span>
                                 <input ttype="number" step="0.00001" id="sumsell" name="askAmountBTC" class="form-control" aria-label="Amount (to the nearest dollar)">
                                 <span class="input-group-addon">BTC</span>
                              </div>
                                <button onclick="sell_data();" class="btn btn-success btn-sm col-xs-3" type="button" id="butval">Sell</button><div id="error_message" class="pull-right"></div>
                                <!-- <input class="btn btn-success btn-sm" type="reset" onclick="WebSocketTest()" value="RESET"> -->
                            </fieldset>
                         </div>
                      </div>


                </div>
              </div>


          <h2>Market</h2>
          <div class="table-responsive">
           <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ORDER DATE</th>
                <th>BID/ASK</th>
                <th>UNITS FILLED BCH</th>
                <th>UNITS TOTAL BCH</th>
                <th>ACTUAL RATE</th>
                <th>ESTIMATED TOTAL BTC</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="bid_buy">

        </tbody>
    </table>
          </div>
         </div>

    </div>
</div>


<script>
 function sum()
 {
   var a=document.getElementById('text1').value;
   var b=document.getElementById('text2').value;
   var result=parseFloat(a) * parseFloat(b);
   if(!isNaN(result))
   {
     document.getElementById('sum').value=result;
   }
 }
</script>
<script>
 function sumsell()
 {
   var a=document.getElementById('text3').value;
   var b=document.getElementById('text4').value;
   var result=parseFloat(a) * parseFloat(b);
   if(!isNaN(result))
   {
     document.getElementById('sumsell').value=result;
   }
 }
</script>

<script>
    function del(uid)
    {
        if(confirm("do u want del?")){
        location.href="del.php?id="+uid
    } }
/*
$("#myHref").on('click', function() {
  alert("inside onclick");
  window.location = "demo.php?mydata='hello Shubham do u want to delete'";
});
*/
</script>

<?php
include 'footer.php';
?>
<script>

/* Bid ask Data get*/
          // setInterval(function(){
            $.ajax({
                url: '<?php echo $bchmarket;?>/tradeuser/addAskBchMarket',
                dataType: 'text',
                type: 'post',
                contentType: 'application/json',
                data: {},
                cache: false,
                success: function(res)
                {
                  //console.log(res);
                  var ask_orders = $.parseJSON(res);
                  console.log(ask_orders);
                  for( var i=0; i<10; i++){

                    $('#ask_btc').append('<tr><td>'+ask_orders.asks[i].askAmountBTC+'</td><td>'+ask_orders.asks[i].askAmountBCH+'</td><td>'+ask_orders.asks[i].askRate+'</td></tr>')
                  }
                }
            });
          // },200000);
            /* Bid Data get*/
        //  setInterval(function(){
            $.ajax({
                url: '<?php echo $bchmarket;?>/tradeuser/addAskBchMarket',
                dataType: 'text',
                type: 'post',
                   cache: false,
                contentType: 'application/json',
                data: {},
                success: function(res)
                {
                  //console.log(res);
                  var bid_orders = $.parseJSON(res);
                  console.log(bid_orders);
                  for( var i=0; i<10; i++){

                    $('#bid_btc').append('<tr><td>'+bid_orders.bids[i].bidAmountBTC+'</td><td>'+bid_orders.bids[i].bidAmountBCH+'</td><td>'+bid_orders.bids[i].bidRate+'</td></tr>')
                  }
                }
            });
//           // },200000);
// <a href="javascript:void;" data-bidAmountBTC="'+bid_orders.bids[i].bidAmountBTC+'" data-bidAmountBCH="'+bid_orders.bids[i].bidAmountBCH+'" data-bidRate="'+bid_orders.bids[i].bidRate+'" >click</a>
            /* Bid Buy*/

              function buy_data(){
                var txt1=document.getElementById('text1').value;
                var txt2=document.getElementById('text2').value;
                var sum=document.getElementById('sum').value;
                alert(txt1+''+txt2+''+sum);
                val=<?php echo $bal;?>;
                if(val==sum && sum >= 0.001 || val >= sum && sum >= 0.001){
                  $.post("<?php echo $url_api?>/bid/addBid",
                    {

                      "bidAmountBTC":txt1,
                     "bidAmountBCH":txt2,
                     "bidRate":sum,
                     "bidownerId":"1",
                     "currentBidRateOfServer":"0.1317",
                     "spendingPassword":"12"
                    },
                      function(data){
                          $('#error_message1').html('Balance send successfull!');

                      });
                  }
                  else {
                  $('#error_message1').html('Balance not sufficiant!');
                  }

              }

              function sell_data(){
                var txt3=document.getElementById('text3').value;
                var txt4=document.getElementById('text4').value;
                var sumsell=document.getElementById('sumsell').value;
                val=<?php echo $sel;?>;
                if(val==sumsell && sumsell >= 0.001 || val >= sumsell && sumsell >= 0.001){
                $.post('<?php echo $bchmarket;?>/tradeuser/addAskBchMarket',
                  {
                          "askAmountBTC":txt3,
                          "askAmountBCH":txt4,
                          "askRate":sumsell,
                          "askownerId":"1",
                          "currentAskrateOfServer":"0.13133844",
                          "spendingPassword":"12"
                  },
                  function(data){
                      $('#error_message').html('Sell send successfull!');

                  });
                }
                else {
                $('#error_message').show('Sell not send successfull!',1000);
                }
              }


            /*Buy and sell*/

            $.ajax({
                url: '<?php echo $bchmarket;?>/tradeuser/addAskBchMarket',
                dataType: 'text',
                type: 'post',
                contentType: 'application/json',
                data: {},
                success: function(res)
                {
                  //console.log(res);
                  var bid_orders = $.parseJSON(res);
                  console.log(bid_orders);
                  for( var i=0; i<10; i++){
                    $('#bid_buy').append('<tr><td>'+bid_orders.bids[i].bidAmountBTC+'</td><td>'+bid_orders.bids[i].bidAmountBCH+'</td><td>'+bid_orders.bids[i].bidRate+'</td><td>'+bid_orders.bids[i].bidRate+'</td><td>'+bid_orders.bids[i].bidRate+'</td><td>'+bid_orders.bids[i].bidRate+'</td><td><a class="btn btn-danger" onclick="del('+bid_orders.bids[i].bidownerId+');" href="javascript:void;">Remove</a></td></tr>');
                  }
                }
            });

    console.log('working');
</script>
<script>
 function bid_insert()
 {
 $('#text1').val($(this).data('bidAmountBTC'));
 $('#text2').val($(this).data('bidAmountBCH'));
 }


function WebSocketTest()
         {
            if ("WebSocket" in window)
            {
               alert("WebSocket is supported by your Browser!");

               // Let us open a web socket
               var ws = new WebSocket("ws://192.168.0.101:1338/bid/getAllBid");

               ws.onopen = function()
               {
                  // Web Socket is connected, send data using send()
                  ws.send("Message to send");
                  alert("Message is sent...");
               };

               ws.onmessage = function (evt)
               {
                  var received_msg = evt.data;
                  console.log(evt);
               };

               // ws.onclose = function()
               // {
               //    alert("Connection is closed...");
               // };

               // window.onbeforeunload = function(event) {
               //    socket.close();
               // };
            }

            else
            {
               // The browser doesn't support WebSocket
               alert("WebSocket NOT supported by your Browser!");
            }
         }
 </script>