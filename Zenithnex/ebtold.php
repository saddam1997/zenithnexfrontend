<?php
ob_start();
include 'header.php';
page_protect();
if(!isset($_SESSION['user_id']))
{
  header("location:logout.php");
}
$user_session = $_SESSION['user_session'];
ob_end_flush();
?>


<style>

    #top, #middle, #bottom {
        position:absolute;
    }

    #top {
        height:50px;
        width:100%;
        

        margin-left:70px;
        margin-top:10px;
    }
    #middle {
        top: 10px;
        bottom:50px;
        width:100%;
        margin-bottom:50px;
        color:blue;

    }
    #bottom {
        margin-bottom: -20px;
        bottom:0;
        height:50px;
        width:100%;

        margin-left:70px;
    }
</style>

<div id="asks_orders"></div>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-sm-12 col-md-12">

                <div class="tab-content" id="myTabContent">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="row">


                              <div class="col-2">
                                <div id="top" class="text-danger">Ask<span id="ask_current_BCH"></span></div>
                                <div id="middle"><a href="markettrade.php">BCH-BTC</a></div>
                                <div id="bottom" class="" style="color: #3c763d">Bid<span id="bid_current_BCH"></span></div>
                            </div>
                            <div class="col-2">
                                <div id="top" class="text-danger">Ask<span id="ask_current_GDS"></span></div>
                                <div id="middle"><a href="gds.php">GDS-BTC</a></div>
                                <div id="bottom" style="color: #3c763d">Bid<span id="bid_current_GDS"></span></div>
                            </div>
                            <div class="col-2">
                                <div id="top" class="text-danger">Ask<span id="ask_current_EBT"></span></div>
                                <div id="middle"><a href="ebt.php">EBT-BTC</a></div>
                                <div id="bottom" style="color: #3c763d">Bid<span id="bid_current_EBT"></span></div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">BID ORDERS</div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped order-table table-hover">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Total(BTC)</th>
                                                            <th>Vol(EBT)</th>
                                                            <th>Bid(BTC)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bid_ebtbtc">

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
                                                            <th>Vol(EBT)</th>
                                                            <th>Total(BTC)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="ask_btc_ebt">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-4">

                            <div class="panel panel-default">
                                <div class="panel-heading">Buy Ebittree Coin
                                    <span class="pull-right" > Available Balance: <span id ="avalBTCBalance"></span>BTC <br> Freeze Balance: <span id="freezeBTCBalance"></span>BTC</span>
                                </div>
                                <div class="panel-body">


                                    <div class="input-group margin-top">
                                        <span class="input-group-addon">Units</span>
                                        <input type="number" step="0.00001" onkeyup="sum_EBT()" name="bidAmountEBT"
                                        id="bidAmountEBT" class="form-control txt"
                                        aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-addon">EBT</span>
                                    </div>
                                    <div class="input-group margin-top">
                                        <span class="input-group-addon">Bid &nbsp;&nbsp;</span>
                                        <input type="number" step="0.00001" onkeyup="sum_EBT()" name="bidRate"
                                        id="bidRate" class="form-control txt"
                                        aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-addon">BTC</span>
                                    </div>
                                    <div class="input-group margin-top">
                                        <span class="input-group-addon">Total</span>
                                        <input type="number" step="0.00001" name="bidAmountBTC" id="bidAmountBTC"
                                        class="form-control sum1"
                                        aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-addon">BTC</span>
                                    </div>
                                    <div class="row">
                                        <button onclick="buy_data();" class="btn btn-success btn-sm col-xs-3"
                                        type="button" id="butval">Buy
                                    </button>
                                    <div id="error_message1" class="pull-right" style="color: red; margin-top: 20px;"></div>
                                    <!-- <input class="btn btn-success col-xs-3 btn-sm" id="reset" type="button"  value="RESET"> -->
                                </div>


                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">Sell Ebittree Coin
                                <span class="pull-right" > Available Balance:<span id ="avalEBTBalance"></span>EBT <br> Freeze Balance: <span id="freezeEBTBalance"></span>EBT</span>
                            </div>
                            <div class="panel-body">

                                <div class="input-group margin-top">
                                    <span class="input-group-addon">Units</span>
                                    <input type="number" step="0.00001" id="askAmountEBT" name="askAmountEBT"
                                    onkeyup="sumsell()" class="form-control"
                                    aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-addon">EBT</span>
                                </div>
                                <div class="input-group margin-top">
                                    <span class="input-group-addon">Ask &nbsp;</span>
                                    <input type="number" step="0.00001" onkeyup="sumsell()" name="askRate"
                                    id="askRate" class="form-control"
                                    aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-addon">BTC</span>
                                </div>
                                <div class="input-group margin-top">
                                    <span class="input-group-addon">Total</span>
                                    <input ttype="number" step="0.00001" id="askAmountBTC" name="askAmountBTC"
                                    class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-addon">BTC</span>
                                </div>
                                <div class="row">
                                    <button onclick="sell_data();" class="btn btn-success btn-sm col-xs-3"
                                    type="button" id="butval">Sell
                                </button>
                                <div id="error_message" class="pull-right" style="color: red; margin-top: 20px;"></div>
                            </div>
                            <!-- <input class="btn btn-success btn-sm" type="reset" onclick="WebSocketTest()" value="RESET"> -->

                        </div>
                    </div>


                </div>
            </div>


            <h2>Open Oders</h2>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ORDER DATE</th>
                            <th>BID/ASK</th>
                            <th>UNITS FILLED EBT</th>
                            <th>ACTUAL RATE</th>
                            <th>UNITS TOTAL EBT</th>
                            <th>UNITS TOTAL BTC</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody id="bid_buy">

                    </tbody>
                    <tbody id="bid_ask">

                    </tbody>
                </table>
            </div>
            <h2>Market</h2>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ORDER DATE</th>
                            <th>BID/ASK</th>
                            <th>UNITS FILLED EBT</th>
                            <th>ACTUAL RATE</th>
                            <th>UNITS TOTAL EBT</th>
                            <th>UNITS TOTAL BTC</th>
                        </tr>
                    </thead>

                    <tbody id="market_bid_buy">

                    </tbody>
                    <tbody id="market_bid_ask">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php
include 'footer.php';
?>



<script>




    function sum_EBT() {
        var a = document.getElementById('bidRate').value;
        var b = document.getElementById('bidAmountEBT').value;
        var result = parseFloat(a) * parseFloat(b);
        if (!isNaN(result)) {
            document.getElementById('bidAmountBTC').value = result;
        }
    }
    function sumsell() {
        var a = document.getElementById('askRate').value;
        var b = document.getElementById('askAmountEBT').value;
        var result = parseFloat(a) * parseFloat(b);
        if (!isNaN(result)) {
            document.getElementById('askAmountBTC').value = result;
        }
    }

    function del(uid,bchbid) {
        if (confirm("Do You Want To Delete!")) {
            var dataString = 'bidownerBCH='+ uid + '&id='+ bchbid;
            $.ajax({
                type: "POST",
                url: url_api+"/tradebchmarket/removeBidBCHMarket",
                data: datastring,
                success: function(result){
                    alert('Data Delete successfull');
                }
            });
        }
    }
    function del_ask(uid,ebtbid) {
        if (confirm("Do You Want To Delete!")) {
                       //var dataString = 'bidownerBCH='+ uid + '&id='+ bchbid;
                       $.ajax({
                        type: "POST",
                        url: url_api+"/tradeebtmarket/removeAskEBTMarket",
                        data: {
                         "askIdEBT":ebtbid,
                         "askownerId":uid
                     },
                     success: function(result){
                        alert('Data Delete successfull');
                    }
                });
                   }
               }


               /*asks data details BCH*/
               $(document).ready(function(){

                ioe.socket.get(url_api+'/tradebchmarket/getAllAskBCH',function(err,data)
                {

                    if(data.body.statusCode!=200) return;

                    var ask_orders = data.body;

                    if(ask_orders.asksBCH.length>0)
                    {
                        $('#ask_current_BCH').append(" &nbsp;"+ask_orders.asksBCH[0].askRate+"");

                    }

                });

                /*Bid Data details BCH*/
                ioe.socket.get(url_api+'/tradebchmarket/getAllBidBCH',function(err,data)
                {

                    if(data.body.statusCode!=200) return;
                    var bid_orders = data.body;

                    $('#bid_current_BCH').append(" &nbsp;"+bid_orders.bidsBCH[0].bidRate+"");
                    for (var i = 0; i < 10; i++) {
                        if(i==bid_orders.bidsBCH.length) break;

                        $('#bid_btc').append('<tr><td>' + bid_orders.bidsBCH[i].bidAmountBTC + '</td><td>' + bid_orders.bidsBCH[i].bidAmountBCH + '</td><td>' + bid_orders.bidsBCH[i].bidRate + '</td></tr>')
                    }

                });


                /*asks data details GDS*/ 
                ioe.socket.get(url_api+'/tradegdsmarket/getAllAskGDS',function(err,data)
                {

                    if(data.body.statusCode!=200) return;
                    var ask_orders = data.body;

                    if(ask_orders.asksGDS && ask_orders.asksGDS.length>0){
                        $('#ask_current_GDS').append(" &nbsp;"+ask_orders.asksGDS[0].askRate+"");
                    }

                    for (var i = 0; i < 10; i++) {
                        if(i==ask_orders.asksGDS.length) break;

                        $('#ask_btc').append('<tr><td>' + ask_orders.asksGDS[i].askAmountBTC + '</td><td>' + ask_orders.asksGDS[i].askAmountGDS + '</td><td>' + ask_orders.asksGDS[i].askRate + '</td></tr>')
                    }

                });

                /*Bids data details GDS*/
                ioe.socket.get(url_api+'/tradegdsmarket/getAllBidGDS',function(err,data)
                {



                    if(data.body.statusCode!=200) return;


                    var bid_orders = data.body;


                    if(bid_orders.bidsGDS &&  bid_orders.bidsGDS.length>0){
                     $('#bid_current_GDS').append(" &nbsp;"+bid_orders.bidsGDS[0].bidRate+"");
                     for (var i = 0; i < 10; i++) {
                        if(i==bid_orders.bidsGDS.length) break;

                        $('#bid_gdsbtc').append('<tr><td>' + bid_orders.bidsGDS[i].bidAmountBTC + '</td><td>' + bid_orders.bidsGDS[i].bidAmountGDS + '</td><td>' + bid_orders.bidsGDS[i].bidRate + '</td></tr>')
                    }

                }

            });
                /*asks data details EBT*/

                ioae.socket.get(url_api+'/tradeebtmarket/getAllAskEBT',function(err,data)
                {
                    console.log(data.body);

                    if(data.body.statusCode!=200) return;


                    var ask_orders = data.body;

                    if(ask_orders.asksEBT && ask_orders.asksEBT.constructor === Array && ask_orders.asksEBT.length>0)
                    {

                       $('#ask_current_EBT').append(" &nbsp;"+ask_orders.asksEBT[0].askRate+"");
                        $('#ask_btc_ebt').empty();


                       for (var i = 0; i < 10; i++) {

                        if(i==ask_orders.asksEBT.length) break;

                        $('#ask_btc_ebt').append('<tr><td>' + ask_orders.asksEBT[i].askAmountBTC + '</td><td>' + ask_orders.asksEBT[i].askAmountEBT + '</td><td>' + ask_orders.asksEBT[i].askRate + '</td></tr>')
                    }
                }

            });

                /*bids data details EBT*/
                ioe.socket.get(url_api+'/tradeebtmarket/getAllBidEBT',function(err,data)
                {

                    if(data.body.statusCode!=200) return;

                    var bid_orders = data.body;

                    if( bid_orders.bidsEBT && bid_orders.bidsEBT.constructor === Array && bid_orders.bidsEBT.length>0)
                    {
                        $('#bid_current_EBT').append(" &nbsp;"+bid_orders.bidsEBT[0].bidRate+"");
                        $('#bid_ebtbtc').empty();
                        for (var i = 0; i < 10; i++) {
                            if(i==bid_orders.bidsEBT.length) break;

                            $('#bid_ebtbtc').append('<tr><td>' + bid_orders.bidsEBT[i].bidAmountBTC + '</td><td>' + bid_orders.bidsEBT[i].bidAmountEBT + '</td><td>' + bid_orders.bidsEBT[i].bidRate + '</td></tr>')
                        }

                    }

                });

                /*all data details*/
                $.ajax({ 
                    type: "POST", url: url_api+"/user/getAllDetailsOfUser", 
                    data: {
                        userMailId: '<? echo $user_session;?>'
                    }, 
                    cache: false, success: function(res)
                    { 

                        bid=res.user.bidsEBT;
                        ask=res.user.asksEBT;
                        var finalObj = bid.concat(ask);
                        $('#avalEBTBalance').append(res.user.EBTbalance+" ");
                        $('#freezeEBTBalance').append(res.user.FreezedEBTbalance+" ");

                        $('#avalBTCBalance').append(res.user.BTCbalance+" ");
                        $('#freezeBTCBalance').append(res.user.FreezedBTCbalance+" ");

                        //console.log("bid :: "+bid);
                        //console.log("ask :: "+ask);
                        //console.log(JSON.stringify(finalObj));
                        for( var i=0; i<finalObj.length; i++)
                        {
                            if(finalObj[i].status == 2 ){
                                if(finalObj[i].bidAmountEBT){
                                  $('#bid_buy').append('<tr><td>'
                                    +finalObj[i].createdAt+
                                    '</td><td>BID</td><td>'
                                    +finalObj[i].bidAmountEBT+
                                    '</td><td>'
                                    +finalObj[i].bidRate+
                                    '</td><td>'
                                    +finalObj[i].totalbidAmountBTC+
                                    '</td><td><a class="text-danger"  onclick="del(id='+finalObj[i].id+',bidownerBCH='+finalObj[i].bidownerEBT+');" href="javascript:void;"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                                    '</td></tr>');
                              }
                              else{
                                $('#bid_buy').append('<tr><td>'
                                    +finalObj[i].createdAt+
                                    '</td><td>ASK</td><td>'
                                    +finalObj[i].askAmountEBT+
                                    '</td><td>'
                                    +finalObj[i].askRate+
                                    '</td><td>'
                                    +finalObj[i].totalaskAmountEBT+
                                    '</td><td><a class="text-danger"  onclick="del_ask(id='+finalObj[i].id+',bidownerBCH='+finalObj[i].askownerEBT+');" href="javascript:void;"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                                    '</td></tr>');
                            }
                        }
                        else
                        {
                            if(finalObj[i].bidAmountEBT){
                              $('#market_bid_buy').append('<tr><td>'
                                +finalObj[i].createdAt+
                                '</td><td>BID</td><td>'
                                +finalObj[i].bidAmountEBT+
                                '</td><td>'
                                +finalObj[i].bidRate+
                                '</td><td>'
                                +finalObj[i].totalbidAmountBTC+
                                '</td><td><a class="text-danger"  onclick="del(id='+finalObj[i].id+',bidownerBCH='+finalObj[i].bidownerEBT+');" href="javascript:void;"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                                '</td></tr>');
                          }
                          else{
                            $('#market_bid_buy').append('<tr><td>'
                                +finalObj[i].createdAt+
                                '</td><td>ASK</td><td>'
                                +finalObj[i].askAmountEBT+
                                '</td><td>'
                                +finalObj[i].askRate+
                                '</td><td>'
                                +finalObj[i].totalaskAmountBTC+
                                '</td><td><a class="text-danger" onclick="del_ask(id='+finalObj[i].id+',bidownerBCH='+finalObj[i].askownerEBT+');" href="javascript:void;"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                                '</td></tr>');
                        }
                    }
                }

            }, 
            error: function(err){ 

            } 
        });


});
/**********************buy data*********************************************************************************/
function buy_data() {


    var bidRate = document.getElementById('bidRate').value;
    var bidAmountEBT = document.getElementById('bidAmountEBT').value;
    var bidAmountBTC = document.getElementById('bidAmountBTC').value;
    var bidownerId=user_details.id;
    var spendingPassword='12';
    
    var json_bid_ebt = {
      "bidAmountBTC":bidAmountBTC,
      "bidAmountEBT":bidAmountEBT,
      "bidRate":bidRate,
      "bidownerId":bidownerId,
      "spendingPassword":spendingPassword
  }

  $.ajax({
    type: "POST",
    contentType: "application/json",
    url: url_api+"/tradeebtmarket/addBidEBTMarket",
    data: JSON.stringify(json_bid_ebt),
    success: function(result){
        console.log(result);
        $('#error_message1').empty();
        if (result.statusCode!=200)
                {
                    $('#error_message1').append(" &nbsp;"+result.message+"");
                }

    }
});


}

function sell_data() 
{
    
    var askAmountEBT = document.getElementById('askAmountEBT').value;
    var askRate = document.getElementById('askRate').value;
    var askAmountBTC = document.getElementById('askAmountBTC').value;
    var bidownerId=user_details.id;
    console.log(bidownerId);
    var spendingPassword='12';

    var json_ask_ebt = {
      "askAmountBTC":askAmountBTC,
      "askAmountEBT":askAmountEBT,
      "askRate":askRate,
      "askownerId":bidownerId,
      "spendingPassword":spendingPassword
  }

  $.ajax({
    type: "POST",
    contentType: "application/json",
    url: url_api+"/tradeebtmarket/addAskEBTMarket",
    data: JSON.stringify(json_ask_ebt),
    success: function(result){
        console.log(result);
        $('#error_message').empty();
        if (result.statusCode!=200)
                {
                    $('#error_message').append(" &nbsp;"+result.message+"");
                }

    }
});

}

</script>





