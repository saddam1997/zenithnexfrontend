<?php
error_reporting(1);
include_once('common.php');
page_protect();
if (!isset($_SESSION['user_id'])) {
    header("location:logout.php");
}
$user_session = $_SESSION['user_session'];


$postData = array(
  "userMailId"=> $user_session

  );

// Create the context for the request
$context = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($postData)
    )
  ));


$response = file_get_contents($url_api.'/user/getAllDetailsOfUser', false, $context);
$response1 = file_get_contents($url_api.'/usertransaction/getTxsListBTC', false, $context);
$response2 = file_get_contents($url_api.'/usertransaction/getTxsListBCH', false, $context);
$response3 = file_get_contents($url_api.'/usertransaction/getTxsListGDS', false, $context);
$response4 = file_get_contents($url_api.'/usertransaction/getTxsListEBT', false, $context);

if ($response === false) {
    die('Error');
}
if ($response1 === false) {
    die('Error');
}
if ($response2 === false) {
    die('Error');
}
if ($response3 === false) {
    die('Error');
}
if ($response4 === false) {
    die('Error');
}


$responseData = json_decode($response, true);
$responseData1 = json_decode($response1, true);
$responseData2 = json_decode($response1, true);
$responseData3 = json_decode($response1, true);
$responseData4 = json_decode($response1, true);


if (isset($responseData['user'])) {
    $btc_balance = $responseData['user']['BTCMainbalance'];
    $bcc_balance = $responseData['user']['BCHMainbalance'];
    $gds_balance = $responseData['user']['GDSMainbalance'];
    $ebt_balance = $responseData['user']['EBTMainbalance'];

    $user_BTCtradebalance = $responseData['user']['BTCbalance'];
    $user_BCHtradebalance = $responseData['user']['BCHbalance'];
    $user_GDStradebalance = $responseData['user']['GDSbalance'];
    $user_EBTtradebalance = $responseData['user']['EBTbalance'];

    $bccbids = $responseData['user']['bidsBCH'];
    $bccbid = array_reverse($bccbids);
    $gdsbids = $responseData['user']['bidsGDS'];
    $gdsbid = array_reverse($gdsbids);
    $ebtbids = $responseData['user']['bidsEBT'];
    $ebtbid = array_reverse($ebtbids);


    $bccasks = $responseData['user']['asksBCH'];
    $bccask = array_reverse($bccasks);
    $gdsasks = $responseData['user']['asksGDS'];
    $gdsask = array_reverse($gdsasks);
    $ebtasks = $responseData['user']['asksEBT'];
    $ebtask = array_reverse($ebtasks);

    $depositwithdraws = $responseData['user']['tradebalanceorderDetails'];
    $depositwithdraw = array_reverse($depositwithdraws);
}
if (isset($responseData1['tx'])) {
    $transactionList_BTC = $responseData1['tx'];
}
if (isset($responseData2['tx'])) {
    $transactionList_BCH = $responseData2['tx'];
}
if (isset($responseData3['tx'])) {
    $transactionList_GDS = $responseData3['tx'];
}
if (isset($responseData4['tx'])) {
    $transactionList_EBT = $responseData4['tx'];
}



?>
<?php
include 'header.php';
?>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
</head>
<div class="container-fluid">
	<div class="animated fadeIn">
		<div class="row">
            <div class="col-sm-12 col-md-12">
              <ul class="nav nav-tabs">
                <li ><a class="nav-pills nav-link active" data-toggle="tab" href="#home">BCH</a></li>
                <li><a class="nav-pills nav-link" data-toggle="tab" href="#menu1">GDS</a></li>
                <li><a  class="nav-pills nav-link" data-toggle="tab" href="#menu2">EBT</a></li>
              </ul>

              <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                  <h3>BCH</h3>
                  <p><div id="container1"></div></p>
                </div>
                <div id="menu1" class="tab-pane fade">
                  <h3>GDS</h3>
                  <p><div id="container2"></div></p>
                </div>
                <div id="menu2" class="tab-pane fade">
                  <h3>EBT</h3>
                  <p><div id="container3"></div></p>
                </div>
              </div>
            </div>
           <!--  BCH Chart -->
<script>
$.getJSON(url_api + '/tradebchmarket/getAllBidBCH', function (data) {
    var datanew = [];
   //console.log(data);
     /* var bid_orders = $.parseJSON(data);
    for(var i = 0; i < data.length ; i++){
           console.log('jfd' + bid_orders.bidsBCH[i].bidRate + bid_orders.bidsBCH[i].createdAt);
    }*/
    var arrayObject = [];
    var  temp =data.bidsBCH;
    var date = 1317888000000;
      for (var i = 0; i < temp.length; i++) {

        date = date + 60000;
        arrayObject.push([date , temp[i].bidRate]);

      }

    // Create the chart
      Highcharts.stockChart('container1', {


        title: {
            text: 'BCH Price'
        },

        subtitle: {
            text: 'Bitcoin Cash Price Chart'
        },

        xAxis: {
            breaks: [{ // Nights
                from: Date.UTC(2011, 9, 6, 16),
                to: Date.UTC(2011, 9, 7, 8),
                repeat: 24 * 36e5
            }, { // Weekends
                from: Date.UTC(2011, 9, 7, 16),
                to: Date.UTC(2011, 9, 10, 8),
                repeat: 7 * 24 * 36e5
            }]
        },

        rangeSelector: {
            buttons: [{
                type: 'hour',
                count: 1,
                text: '1h'
            }, {
                type: 'day',
                count: 1,
                text: '1D'
            }, {
                type: 'all',
                count: 1,
                text: 'All'
            }],
            selected: 1,
            inputEnabled: false
        },

        series: [{
            name: 'BCH',
            type: 'area',
            data: arrayObject,
            gapSize: 5,
            tooltip: {
                valueDecimals: 2
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                },
                stops: [
                    [0, Highcharts.getOptions().colors[0]],
                    [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            threshold: null
        }]
    });


    $('#small').click(function () {
        chart.setSize(400);
    });

    $('#large').click(function () {
        chart.setSize(800);
    });

    $('#auto').click(function () {
        chart.setSize(null);
    });
});

</script>

<!-- GDS Chart -->
<script>
$.getJSON(url_api + '/tradegdsmarket/getAllBidGDS', function (data) {
    var datanew = [];
   //console.log(data);
     /* var bid_orders = $.parseJSON(data);
    for(var i = 0; i < data.length ; i++){
           console.log('jfd' + bid_orders.bidsBCH[i].bidRate + bid_orders.bidsBCH[i].createdAt);
    }*/
    var arrayObject = [];
    var  temp =data.bidsGDS;
    var date = 1317888000000;
      for (var i = 0; i < temp.length; i++) {

        date = date + 60000;
        arrayObject.push([date , temp[i].bidRate]);

      }

    // Create the chart
      Highcharts.stockChart('container2', {


        title: {
            text: 'GDS Price'
        },

        subtitle: {
            text: 'Goods Coin Price Chart'
        },

        xAxis: {
            breaks: [{ // Nights
                from: Date.UTC(2011, 9, 6, 16),
                to: Date.UTC(2011, 9, 7, 8),
                repeat: 24 * 36e5
            }, { // Weekends
                from: Date.UTC(2011, 9, 7, 16),
                to: Date.UTC(2011, 9, 10, 8),
                repeat: 7 * 24 * 36e5
            }]
        },

        rangeSelector: {
            buttons: [{
                type: 'hour',
                count: 1,
                text: '1h'
            }, {
                type: 'day',
                count: 1,
                text: '1D'
            }, {
                type: 'all',
                count: 1,
                text: 'All'
            }],
            selected: 1,
            inputEnabled: false
        },

        series: [{
            name: 'GDS',
            type: 'area',
            data: arrayObject,
            gapSize: 5,
            tooltip: {
                valueDecimals: 2
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                },
                stops: [
                    [0, Highcharts.getOptions().colors[0]],
                    [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            threshold: null
        }]
    });


    $('#small').click(function () {
        chart.setSize(400);
    });

    $('#large').click(function () {
        chart.setSize(800);
    });

    $('#auto').click(function () {
        chart.setSize(null);
    });
});

</script>
<!-- EBT Chart -->
<script>
$.getJSON(url_api + '/tradeebtmarket/getAllBidEBT', function (data) {
    var datanew = [];
   //console.log(data);
     /* var bid_orders = $.parseJSON(data);
    for(var i = 0; i < data.length ; i++){
           console.log('jfd' + bid_orders.bidsBCH[i].bidRate + bid_orders.bidsBCH[i].createdAt);
    }*/
    var arrayObject = [];
    var  temp =data.bidsEBT;
    var date = 1317888000000;
      for (var i = 0; i < temp.length; i++) {

        date = date + 60000;
        arrayObject.push([date , temp[i].bidRate]);

      }

    // Create the chart
      Highcharts.stockChart('container3', {


        title: {
            text: 'EBT Price'
        },

        subtitle: {
            text: 'EBT Classic Price Chart'
        },

        xAxis: {
            breaks: [{ // Nights
                from: Date.UTC(2011, 9, 6, 16),
                to: Date.UTC(2011, 9, 7, 8),
                repeat: 24 * 36e5
            }, { // Weekends
                from: Date.UTC(2011, 9, 7, 16),
                to: Date.UTC(2011, 9, 10, 8),
                repeat: 7 * 24 * 36e5
            }]
        },

        rangeSelector: {
            buttons: [{
                type: 'hour',
                count: 1,
                text: '1h'
            }, {
                type: 'day',
                count: 1,
                text: '1D'
            }, {
                type: 'all',
                count: 1,
                text: 'All'
            }],
            selected: 1,
            inputEnabled: false
        },

        series: [{
            name: 'EBT',
            type: 'area',
            data: arrayObject,
            gapSize: 5,
            tooltip: {
                valueDecimals: 2
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                },
                stops: [
                    [0, Highcharts.getOptions().colors[0]],
                    [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            threshold: null
        }]
    });


    $('#small').click(function () {
        chart.setSize(400);
    });

    $('#large').click(function () {
        chart.setSize(800);
    });

    $('#auto').click(function () {
        chart.setSize(null);
    });
});

</script>
			<div class="col-md-6">
        <div class="card style" >
          <div class="card-header bg-success">
            <div class="h4 font-weight-normal">Your Balances</div>
          </div>
          <div class="card-body">
            <table class="table table-responsive table-hover table-outline mb-0">
              <thead class="thead-default">
                <tr>
                  <th>Currency</th>
                  <th>Main Balance</th>
                  <th>Trade Balance</th>

                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>BTC</td>
                  <td><?php echo $btc_balance ;?></td>
                  <td><?php echo $user_BTCtradebalance; ?></td>
                </tr>
                <tr>
                  <td>BCH</td>
                  <td><?php echo $bcc_balance ;?></td>
                  <td><?php echo $user_BCHtradebalance; ?></td>
                </tr>
                <tr>
                  <td>GDS</td>
                  <td><?php echo $gds_balance ;?></td>
                  <td><?php echo $user_GDStradebalance; ?></td>
                </tr>
                <tr>
                  <td>EBT</td>
                  <td><?php echo $ebt_balance ;?></td>
                  <td><?php echo $user_EBTtradebalance; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card style" >
         <div class="card-header bg-success">
          <div class="h4 font-weight-normal">Open Orders</div>
        </div>
        <div class="card-body">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active tab-a" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Open BID</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  tab-a" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Open ASK</a>
            </li>

          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-content">
              <div  class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <table class="table table-responsive table-hover table-outline mb-0">
                  <thead class="thead-default">
                    <tr>

                      <th>Market</th>
                      <th>Amount</th>
                      <th>BID</th>
                      <th>Total BTC</th>
                      <th>Status</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                     <!--  BCH BID -->
                     <td><a href="markettrade.php">BCH/BTC</a></td>
                     <td><?php if (!empty($bccbid)) {
    echo $bccbid[0]['bidAmountBCH'];
} else {
                          echo "<td colspan=\"3\">There is no BID exists</td>";
                      }
                      ?></td>
                      <td><?php if (!empty($bccbid)) {
                          echo $bccbid[0]['bidRate'];
                      }
                        ?></td>
                        <td><?php if (!empty($bccbid)) {
                            echo $bccbid[0]['bidAmountBTC'];
                        }
                          ?></td>
                          <td><?php if (!empty($bccbid)) {
                              echo $bccbid[0]['statusName'];
                          }
                            ?></td>
                          </tr>
                          <!--  GDS BID -->
                          <tr>
                            <td><a href="gds.php">GDS/BTC</a></td>
                            <td><?php if (!empty($gdsbid)) {
                                echo $gdsbid[0]['bidAmountGDS'];
                            } else {
                                  echo "<td colspan=\"3\">There is no BID exists</td>";
                              }
                              ?></td>
                              <td><?php if (!empty($gdsbid)) {
                                  echo $gdsbid[0]['bidRate'];
                              }
                                ?></td>
                                <td><?php if (!empty($gdsbid)) {
                                    echo $gdsbid[0]['bidAmountBTC'];
                                }
                                  ?></td>
                                  <td><?php if (!empty($gdsbid)) {
                                      echo $gdsbid[0]['statusName'];
                                  }
                                    ?></td>
                                  </tr>
                                  <!--  EBT BID -->
                                  <tr>
                                    <td><a href="ebt.php">EBT/BTC</a></td>
                                    <td><?php if (!empty($ebtbid)) {
                                        echo $ebtbid[0]['bidAmountEBT'];
                                    } else {
                                          echo "<td colspan=\"3\">There is no BID exists</td>";
                                      }
                                      ?></td>
                                      <td><?php if (!empty($ebtbid)) {
                                          echo $ebtbid[0]['bidRate'];
                                      }
                                        ?></td>
                                        <td><?php if (!empty($ebtbid)) {
                                            echo $ebtbid[0]['bidAmountBTC'];
                                        }
                                          ?></td>
                                          <td><?php if (!empty($ebtbid)) {
                                              echo $ebtbid[0]['statusName'];
                                          }
                                            ?></td>
                                          </tr>

                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                      <table class="table table-responsive table-hover table-outline mb-0">
                                        <thead class="thead-default">
                                          <tr>

                                            <th>Market</th>
                                            <th>Amount</th>
                                            <th>ASK</th>
                                            <th>Total BTC</th>
                                            <th>Status</th>

                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                           <!--  BCH Ask -->
                                           <td><a href="markettrade.php">BCH/BTC</a></td>
                                           <td><?php if (!empty($bccask)) {
                                                echo $bccask[0]['askAmountBCH'];
                                            } else {
                                                echo "<td colspan=\"3\">There is no ASK exists</td>";
                                            }
                                            ?></td>
                                            <td><?php if (!empty($bccask)) {
                                                echo $bccask[0]['askRate'];
                                            }
                                              ?></td>
                                              <td><?php if (!empty($bccask)) {
                                                  echo $bccask[0]['askAmountBTC'];
                                              }
                                                ?></td>
                                                <td><?php if (!empty($bccask)) {
                                                    echo $bccask[0]['statusName'];
                                                }
                                                  ?></td>
                                                </tr>
                                                <!--  GDS ASK -->
                                                <tr>
                                                  <td><a href="gds.php">GDS/BTC</a></td>
                                                  <td><?php if (!empty($gdsask)) {
                                                      echo $gdsask[0]['askAmountGDS'];
                                                  } else {
                                                        echo "<td colspan=\"3\">There is no ASK exists</td>";
                                                    }
                                                    ?></td>
                                                    <td><?php if (!empty($gdsask)) {
                                                        echo $gdsask[0]['askRate'];
                                                    }
                                                      ?></td>
                                                      <td><?php if (!empty($gdsask)) {
                                                          echo $gdsask[0]['askAmountBTC'];
                                                      }
                                                        ?></td>
                                                        <td><?php if (!empty($gdsask)) {
                                                            echo $gdsask[0]['statusName'];
                                                        }
                                                          ?></td>
                                                        </tr>
                                                        <!--  EBT ASk -->
                                                        <tr>
                                                          <td><a href="ebt.php">EBT/BTC</a></td>
                                                          <td><?php if (!empty($ebtask)) {
                                                              echo $ebtask[0]['askAmountEBT'];
                                                          } else {
                                                                echo "<td colspan=\"3\">There is no ASK exists</td>";
                                                            }
                                                            ?></td>
                                                            <td><?php if (!empty($ebtask)) {
                                                                echo $ebtask[0]['askRate'];
                                                            }
                                                              ?></td>
                                                              <td><?php if (!empty($ebtask)) {
                                                                  echo $ebtask[0]['askAmountBTC'];
                                                              }
                                                                ?></td>
                                                                <td><?php if (!empty($ebtask)) {
                                                                    echo $ebtask[0]['statusName'];
                                                                }
                                                                  ?></td>
                                                                </tr>

                                                              </tbody>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>


                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="card style" style="min-height: 269px;">
                                                    <div class="card-header bg-success">
                                                      <div class="h4 font-weight-normal">Last Deposit/Withdraw</div>
                                                    </div>
                                                    <div class="card-body">
                                                      <table class="table table-responsive table-hover table-outline mb-0">
                                                        <thead class="thead-default">
                                                          <tr>
                                                            <th>Currency Name</th>
                                                            <th>Ammount</th>
                                                            <th>Action</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>

                                                         <?php if (!empty($depositwithdraw)) {
                                                                      $i = 0;
                                                                      foreach ($depositwithdraw as $value) {
                                                                          echo '<tr>

                                                            <td>'.$value['currencyName'].'/BTC</td>
                                                            <td>'.$value['amount'].'</td>
                                                            <td>'.$value['action'].'</td>

                                                          </tr>';
                                                                          if ($i++ == 3) {
                                                                              break;
                                                                          }
                                                                      }
                                                                  }

                                                      ?>
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="card style" >
                                                <div class="card-header bg-success">
                                                  <div class="h4 font-weight-normal">Last Transaction</div>
                                                </div>
                                                <div class="card-body">
                                             <table class="table table-responsive table-hover table-outline mb-0">
                                                    <thead class="thead-default">

                                                        <tr>
                                                          <th>Currency Name</th>
                                                          <th>Date</th>

                                                          <th>Type</th>
                                                          <th>Amount</th>
                                                          <th>Confirmations</th>

                                                        </tr>


                                                    </thead>
                                                    <tbody>
                                                      <!-- Transaction list BTC -->
                                                      <tr>
                                                        <td>BTC</td>

                                                        <?php
                                                        $bold_txxs = "";
                                                        if (count($transactionList_BTC)>0) {
                                                            $i = 0;
                                                            foreach (array_reverse($transactionList_BTC) as $transaction) {
                                                                if ($transaction['category']=="send") {
                                                                    $tx_type = '<b style="color: #FF0000;">Sent</b>';
                                                                } elseif ($transaction['category']=="receive") {
                                                                    $tx_type = '<b style="color: #01DF01;">Received</b>';
                                                                } else {
                                                                    $tx_type = '<b style="color: #01DF01;">Admin</b>';

                                                                    $transaction['confirmations'] = 'Confirmed ';
                                                                }
                                                                echo
                                                            '<td>'.date('n/j/Y h:i a', $transaction['time']).'</td>

                                                            <td>'.$tx_type.'</td>
                                                            <td>'.abs($transaction['amount']).'</td>
                                                            <td>'.$transaction['confirmations'].'</td>';
                                                                if ($i++ == 0) {
                                                                    break;
                                                                }
                                                            }
                                                        } elseif ((count($transactionList_BTC)== 0)) {
                                                            echo "<td colspan=\"3\">There is no Transaction exists</td>";
                                                        }
                                                        ?>

                                                      </tr>
                                                      <!-- Transaction list BCH -->
                                                      <tr>
                                                        <td>BCH</td>

                                                        <?php
                                                        $bold_txxs = "";
                                                        if (count($transactionList_BCH)>0) {
                                                            $i = 0;
                                                            foreach (array_reverse($transactionList_BCH) as $transaction) {
                                                                if ($transaction['category']=="send") {
                                                                    $tx_type = '<b style="color: #FF0000;">Sent</b>';
                                                                } elseif ($transaction['category']=="receive") {
                                                                    $tx_type = '<b style="color: #01DF01;">Received</b>';
                                                                } else {
                                                                    $tx_type = '<b style="color: #01DF01;">Admin</b>';

                                                                    $transaction['confirmations'] = 'Confirmed ';
                                                                }
                                                                echo
                                                            '<td>'.date('n/j/Y h:i a', $transaction['time']).'</td>

                                                            <td>'.$tx_type.'</td>
                                                            <td>'.abs($transaction['amount']).'</td>
                                                            <td>'.$transaction['confirmations'].'</td>';
                                                                if ($i++ == 0) {
                                                                    break;
                                                                }
                                                            }
                                                        } elseif ((count($transactionList_BCH)== 0)) {
                                                              echo "<td colspan=\"3\">There is no Transaction exists</td>";
                                                          }
                                                          ?>


                                                        </tr>
                                                        <!-- Transaction list GDS -->
                                                        <tr>
                                                          <td>GDS</td>

                                                          <?php
                                                          $bold_txxs = "";
                                                          if (count($transactionList_GDS)>0) {
                                                              $i = 0;
                                                              foreach (array_reverse($transactionList_GDS) as $transaction) {
                                                                  if ($transaction['category']=="send") {
                                                                      $tx_type = '<b style="color: #FF0000;">Sent</b>';
                                                                  } elseif ($transaction['category']=="receive") {
                                                                      $tx_type = '<b style="color: #01DF01;">Received</b>';
                                                                  } else {
                                                                      $tx_type = '<b style="color: #01DF01;">Admin</b>';

                                                                      $transaction['confirmations'] = 'Confirmed ';
                                                                  }
                                                                  echo '
                                                              <td>'.date('n/j/Y h:i a', $transaction['time']).'</td>

                                                              <td>'.$tx_type.'</td>
                                                              <td>'.abs($transaction['amount']).'</td>
                                                              <td>'.$transaction['confirmations'].'</td>

                                                              ';
                                                                  if ($i++ == 0) {
                                                                      break;
                                                                  }
                                                              }
                                                          } elseif ((count($transactionList_GDS)== 0)) {
                                                                echo "<td colspan=\"3\">There is no Transaction exists</td>";
                                                            }
                                                            ?>


                                                          </tr>
                                                          <!-- Transaction list EBT -->
                                                          <tr>
                                                            <td>EBT</td>

                                                            <?php
                                                            $bold_txxs = "";
                                                            if (count($transactionList_EBT)>0) {
                                                                $i = 0;
                                                                foreach (array_reverse($transactionList_EBT) as $transaction) {
                                                                    if ($transaction['category']=="send") {
                                                                        $tx_type = '<b style="color: #FF0000;">Sent</b>';
                                                                    } elseif ($transaction['category']=="receive") {
                                                                        $tx_type = '<b style="color: #01DF01;">Received</b>';
                                                                    } else {
                                                                        $tx_type = '<b style="color: #01DF01;">Admin</b>';

                                                                        $transaction['confirmations'] = 'Confirmed ';
                                                                    }
                                                                    echo '
                                                                <td>'.date('n/j/Y h:i a', $transaction['time']).'</td>

                                                                <td>'.$tx_type.'</td>
                                                                <td>'.abs($transaction['amount']).'</td>
                                                                <td>'.$transaction['confirmations'].'</td>

                                                                ';
                                                                    if ($i++ == 0) {
                                                                        break;
                                                                    }
                                                                }
                                                            } elseif ((count($transactionList_EBT)== 0)) {
                                                                  echo "<td colspan=\"3\">There is no Transaction exists</td>";
                                                              }
                                                              ?>


                                                            </tr>
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
                                          </html>
