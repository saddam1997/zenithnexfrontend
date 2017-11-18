<?php
ob_start();
include 'header.php';
ob_end_flush();
?>


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>



<!-- <button id="large">Large</button>
<button id="small">Small</button>
<button id="auto">Auto</button> -->
<div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">BCH</a></li>
                <li><a data-toggle="tab" href="#menu1">GDS</a></li>
                <li><a data-toggle="tab" href="#menu2">EBT</a></li>
              </ul>

              <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                  <h3>BCH</h3>
                  <p><div id="container"></div></p>
                </div>
                <div id="menu1" class="tab-pane fade">
                  <h3>GDS</h3>
                  <p><div id="container"></div></p>
                </div>
                <div id="menu2" class="tab-pane fade">
                  <h3>EBT</h3>
                  <p><div id="container"></div></p>
                </div>

              </div>
            </div>
           
        </div>
</div>
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
        console.log(temp[i].bidRate)
      }
    console.log('arrayObject  ' + JSON.stringify(arrayObject));
    // Create the chart
      Highcharts.stockChart('container', {


        title: {
            text: 'AAPL stock price by minute'
        },

        subtitle: {
            text: 'Using explicit breaks for nights and weekends'
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
<?php
include 'footer.php';
?>



           




