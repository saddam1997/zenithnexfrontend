<?php
ob_start();
include 'header.php';
page_protect();
if (!isset($_SESSION['user_id'])) {
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
                        <div class="col-md-8">
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
                                                            <th>Vol(BCH)</th>
                                                            <th>Bid(BTC)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="bid_btc_bch">

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
                                                            <th>Total(BTC)</th>

                                                            <th>Vol(BCH)</th>
                                                            <th>Ask(BTC)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="ask_btc_bch">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="panel panel-default">
                                <div class="panel-heading">Buy Bitcoin Cash
                                 <span class="pull-right"> Available Balance: <span id ="avalBTCBalance"></span>BTC <br> Freeze Balance: <span id="freezeBTCBalance"></span>BTC
                             </div>
                             <div class="panel-body">


                                <div class="input-group margin-top">
                                    <span class="input-group-addon">Units</span>
                                    <input type="number" step="0.00001" onkeyup="bidAmountBTC()" name="bidAmountBCH"
                                    id="bidAmountBCH" class="form-control txt"
                                    aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-addon">BCH</span>
                                </div>
                                <div class="input-group margin-top">
                                    <span class="input-group-addon">Bid &nbsp;&nbsp;</span>
                                    <input type="number" step="0.00001" onkeyup="bidAmountBTC()" name="bidRate"
                                    id="bidRateBCH" class="form-control txt"
                                    aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-addon">BTC</span>
                                </div>
                                <div class="input-group margin-top">
                                    <span class="input-group-addon">Total</span>
                                    <input type="number" step="0.00001" name="bidAmountBTC" id="bidAmountBTC"
                                    class="form-control bidAmountBTC1"
                                    aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-addon">BTC</span>
                                </div>
                                <div class="row">
                                    <button onclick="buy_data_bch();" class="btn btn-success btn-sm col-xs-3"
                                    type="button" id="butval">Buy
                                </button>
                                <div id="error_message1" class="pull-right" style="color: red; margin-top: 20px;"></div>

                            </div>


                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">Sell Bitcoin Cash
                            <span class="pull-right" > Available Balance:<span id ="avalBCHBalance"></span>BCH <br> Freeze Balance: <span id="freezeBCHBalance"></span>BCH</span>
                        </div>
                        <div class="panel-body">

                            <div class="input-group margin-top">
                                <span class="input-group-addon">Units</span>
                                <input type="number" step="0.00001" id="askBCHAmount" name="askAmountBCH"
                                onkeyup="askBTCAmount()" class="form-control"
                                aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon">BCH</span>
                            </div>
                            <div class="input-group margin-top">
                                <span class="input-group-addon">Ask &nbsp;</span>
                                <input type="number" step="0.00001" onkeyup="askBTCAmount()" name="askRate"
                                id="askRateBCH" class="form-control"
                                aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon">BTC</span>
                            </div>
                            <div class="input-group margin-top">
                                <span class="input-group-addon">Total</span>
                                <input ttype="number" step="0.00001" id="askBTCAmount" name="askAmountBTC"
                                class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon">BTC</span>
                            </div>
                            <div class="row">
                                <button onclick="sell_data();" class="btn btn-success btn-sm col-xs-3"
                                type="button" id="butval">Sell
                            </button>
                            <div id="error_message" class="pull-right" style="color: red; margin-top: 20px;"></div>
                        </div>


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
                        <th>UNITS FILLED BCH</th>
                        <th>ACTUAL RATE</th>
                        <th>UNITS TOTAL BCH</th>
                        <th>UNITS TOTAL BTC</th>
                        <th>ACTION</th>
                    </tr>
                </thead>

                <tbody id="open_bid_bch">

                </tbody>
                <tbody id="open_ask_bch">

                </tbody>
            </table>
        </div>

        <h2>My order history</h2>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ORDER DATE</th>
                        <th>BID/ASK</th>
                        <th>UNITS FILLED BCH</th>
                        <th>ACTUAL RATE</th>
                        <th>UNITS TOTAL BCH</th>
                        <th>UNITS TOTAL BTC</th>
                    </tr>
                </thead>

                <tbody id="market_bid_bch">

                </tbody>
                <tbody id="market_ask_bch">

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</div>



</div>
</div>

<?php
include 'footer.php';
?>



<script>

    function bidAmountBTC() {
        var a = document.getElementById('bidAmountBCH').value;
        var b = document.getElementById('bidRateBCH').value;
        var result = parseFloat(a) * parseFloat(b);
        if (!isNaN(result)) {
            document.getElementById('bidAmountBTC').value = result;
        }
    }
    function askBTCAmount() {
        var a = document.getElementById('askBCHAmount').value;
        var b = document.getElementById('askRateBCH').value;
        var result = parseFloat(a) * parseFloat(b);
        if (!isNaN(result)) {
            document.getElementById('askBTCAmount').value = result;
        }
    }


    function del(bidIdBCH,bidownerId) {

        if (confirm("Do You Want To Delete!")) {
            $.ajax({
                type: "POST",
                url: url_api + '/tradebchmarket/removeBidBCHMarket',
                data: {
                    "bidIdBCH": bidIdBCH,
                    "bidownerId": bidownerId
                },
                success: function(result){
                    alert('Data Delete Successfully');

                }
            });
        }
    }
    function del_ask(askIdBCH,askownerId) {
        if (confirm("Do You Want To Delete!")) {
            $.ajax({
                type: "POST",
                url: url_api + '/tradebchmarket/removeAskBCHMarket',
                data: {
                    "askIdBCH":askIdBCH,
                    "askownerId":askownerId

                },
                success: function(result){
                    alert('Data Delete Successfully');

                }
            });
        }
    }

    /*all data details*/
    $.ajax({
        type: "POST", url: url_api+ "/user/getAllDetailsOfUser",
        data: {
            userMailId: '<?php echo $user_session;?>'
        },
        cache: false, success: function(res)
        {



            bid=res.user.bidsBCH;
            ask=res.user.asksBCH;

            var finalObj = bid.concat(ask);

            $('#avalBCHBalance').append(res.user.BCHbalance+" ");
            $('#freezeBCHBalance').append(res.user.FreezedBCHbalance+" ");

            $('#avalBTCBalance').append(res.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(res.user.FreezedBTCbalance+" ");

            for( var i=0; i<finalObj.length; i++)
            {
                if(finalObj[i].status == 2 ){
                    if(finalObj[i].bidAmountBCH){
                        $('#open_bid_bch').append('<tr><td>'
                            +finalObj[i].createdAt+
                            '</td><td>BID</td><td>'
                            +finalObj[i].bidAmountBCH+
                            '</td><td>'
                            +finalObj[i].bidRate+
                            '</td><td>'
                            +finalObj[i].totalbidAmountBCH+
                            '</td><td>'
                            +finalObj[i].totalbidAmountBTC+
                            '</td><td><a class="text-danger" onclick="del(id='+finalObj[i].id +',ownwe='+finalObj[i].bidownerBCH+');"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a></td></tr>');
                    }
                    else{
                        $('#open_ask_bch').append('<tr><td>'
                            +finalObj[i].createdAt+
                            '</td><td>ask</td><td>'
                            +finalObj[i].askAmountBCH+
                            '</td><td>'
                            +finalObj[i].askRate+
                            '</td><td>'
                            +finalObj[i].totalaskAmountBCH+
                            '</td><td>'
                            +finalObj[i].totalaskAmountBTC+
                            '</td><td><a class="text-danger" onclick="del_ask(id='+finalObj[i].id+',askownerBCH='+finalObj[i].askownerBCH+');" ><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                            '</td></tr>');
                    }
                }
                else {
                    if(finalObj[i].bidAmountBCH){
                        $('#market_bid_bch').append('<tr><td>'
                            +finalObj[i].createdAt+
                            '</td><td>BID</td><td>'
                            +finalObj[i].bidAmountBCH+
                            '</td><td>'
                            +finalObj[i].bidRate+
                            '</td><td>'
                            +finalObj[i].totalbidAmountBCH+
                            '</td><td>'
                            +finalObj[i].totalbidAmountBTC+
                            '</td></tr>');
                    }
                    else{
                        $('#market_ask_bch').append('<tr><td>'
                            +finalObj[i].createdAt+
                            '</td><td>ask</td><td>'
                            +finalObj[i].askAmountBCH+
                            '</td><td>'
                            +finalObj[i].askRate+
                            '</td><td>'
                            +finalObj[i].totalaskAmountBCH+
                            '</td><td>'
                            +finalObj[i].totalaskAmountBTC+
                            '</td></tr>');
                    }
                }
            }

        },
        error: function(err){

        }
    });

    /*asks data details BCH*/

    $(document).ready(function(){
        /*asks data details BCH*/

        ioa.socket.get(url_api+'/tradebchmarket/getAllAskBCH',function(err,data)
        {

            if(data.body.statusCode!=200) return;

            var ask_orders = data.body;

            $('#ask_btc_bch').empty();
            $('#ask_current_BCH').empty();
            if(ask_orders.asksBCH.length>0)
            {
                $('#ask_current_BCH').append(" &nbsp;"+ask_orders.asksBCH[0].askRate+"");

                console.log(data.body.asksBCH.length);

                for (var i = 0; i < 10; i++) {
                    if(i==ask_orders.asksBCH.length) break;


                    $('#ask_btc_bch').append('<tr><td>' + ask_orders.asksBCH[i].askAmountBTC + '</td><td>' + ask_orders.asksBCH[i].askAmountBCH + '</td><td>' + ask_orders.asksBCH[i].askRate + '</td></tr>')
                }

            }

        });

        /*Bid Data details BCH*/
        iob.socket.get(url_api+'/tradebchmarket/getAllBidBCH',function(err,data)
        {
            if(data.body.statusCode!=200) return;
            var bid_orders = data.body;
            $('#bid_btc_bch').empty();
            $('#bid_current_BCH').append(" &nbsp;"+bid_orders.bidsBCH[0].bidRate+"");
            console.log("!!!!"+ data.body.bidsBCH.length);
            console.log("working here");
            for (var i = 0; i < 10; i++) {
                if(i==bid_orders.bidsBCH.length) break;
                $('#bid_btc_bch').append('<tr><td>' + bid_orders.bidsBCH[i].bidAmountBTC + '</td><td>' + bid_orders.bidsBCH[i].bidAmountBCH + '</td><td>' + bid_orders.bidsBCH[i].bidRate + '</td></tr>')
            }
        });


        /*asks data details GDS*/
        iob.socket.get(url_api+'/tradegdsmarket/getAllAskGDS',function(err,data)
        {

            if(data.body.statusCode!=200) return;
            var ask_orders = data.body;

            if(ask_orders.asksGDS && ask_orders.asksGDS.length>0){
                $('#ask_current_GDS').append(" &nbsp;"+ask_orders.asksGDS[0].askRate+"");
            }


        });
        /*Bids data details GDS*/
        iob.socket.get(url_api+'/tradegdsmarket/getAllBidGDS',function(err,data)
        {

            if(data.body.statusCode!=200) return;

            var bid_orders = data.body;

            if(bid_orders.bidsGDS &&  bid_orders.bidsGDS.length>0){
             $('#bid_current_GDS').append(" &nbsp;"+bid_orders.bidsGDS[0].bidRate+"");
             $('#bid_gdsbtc').empty();
             for (var i = 0; i < 10; i++) {
                if(i==bid_orders.bidsGDS.length) break;

                $('#bid_gdsbtc').append('<tr><td>' + bid_orders.bidsGDS[i].bidAmountBTC + '</td><td>' + bid_orders.bidsGDS[i].bidAmountGDS + '</td><td>' + bid_orders.bidsGDS[i].bidRate + '</td></tr>')
            }

            }

        });

        /*asks data details EBT*/
        iob.socket.get(url_api+'/tradeebtmarket/getAllAskEBT',function(err,data)
        {

            if(data.body.statusCode!=200) return;

            var ask_orders = data.body;

            if(ask_orders.asksEBT && ask_orders.asksEBT.constructor === Array && ask_orders.asksEBT.length>0)
            {

                 $('#ask_current_EBT').append(" &nbsp;"+ask_orders.asksEBT[0].askRate+"");

             }

         });

        /*bids data details EBT*/
        iob.socket.get(url_api+'/tradeebtmarket/getAllBidEBT',function(err,data)
        {

            if(data.body.statusCode!=200) return;

            var bid_orders = data.body;

            if( bid_orders.bidsEBT && bid_orders.bidsEBT.constructor === Array && bid_orders.bidsEBT.length>0)
            {
                $('#bid_current_EBT').append(" &nbsp;"+bid_orders.bidsEBT[0].bidRate+"");

            }

        });


        /**********************buy data*********************************************************************************/

    });

    function buy_data_bch() {

        var bidAmountBCH = document.getElementById('bidAmountBCH').value;
        var bidRateBCH = document.getElementById('bidRateBCH').value;
        var bidAmountBTC = document.getElementById('bidAmountBTC').value;

        var bidownerId=user_details.id;
        var spendingPassword='12';

        var json_bid_bch = {
          "bidAmountBTC":bidAmountBTC,
          "bidAmountBCH":bidAmountBCH,
          "bidRate":bidRateBCH,
          "bidownerId":bidownerId,
          "spendingPassword":spendingPassword
      }

      $.ajax({
        type: "POST",
        contentType: "application/json",
        url: url_api+"/tradebchmarket/addBidBCHMarket",
        data: JSON.stringify(json_bid_bch),
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

        var askBCHAmount = document.getElementById('askBCHAmount').value;
        var askRateBCH = document.getElementById('askRateBCH').value;
        var askBTCAmount = document.getElementById('askBTCAmount').value;
        var bidownerId=user_details.id;
        var spendingPassword='12';

        var json_ask_bch = {
          "askAmountBTC":askBTCAmount,
          "askAmountBCH":askBCHAmount,
          "askRate":askRateBCH,
          "askownerId":bidownerId,
          "spendingPassword":spendingPassword
      }


          $.ajax({
            type: "POST",
            contentType: "application/json",
            url: url_api+"/tradebchmarket/addAskBCHMarket",
            data: JSON.stringify(json_ask_bch),
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
