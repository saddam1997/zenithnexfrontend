</main>




</div>

<footer class="app-footer">
  <a href="#">ZenithNEX</a> &copy; 2017
  <span class="float-right"> <a href="contactus.php">Contact-Us</a>
  </span>
</footer>

<!-- Bootstrap and necessary plugins -->
<script src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script src="js/popper.min.js"></script>
<script src="js/pace.min.js"></script>
<script type="text/javascript">

  $('.navbar-toggler').click(function(){

    if ($(this).hasClass('sidebar-toggler')) {
      $('body').toggleClass('sidebar-hidden');
    }

    if ($(this).hasClass('sidebar-minimizer')) {
      $('body').toggleClass('sidebar-minimized');
    }

    if ($(this).hasClass('aside-menu-toggler')) {
      $('body').toggleClass('aside-menu-hidden');
    }

    if ($(this).hasClass('mobile-sidebar-toggler')) {
      $('body').toggleClass('sidebar-mobile-show');
    }

  });
  $('.sidebar-close').click(function(){
    $('body').toggleClass('sidebar-opened').parent().toggleClass('sidebar-opened');
  });
  $('#sendBTC').on('modal', function () {
    $('#sendBTC').modal('show');
    $('.modal fade').toggleClass(".fade.show");

  });
         // $("#submit_otp").click(function(){
         //      var post_Text = $("#otp_value_text").val();
         //      $.post("/BCHwallet/verifyemail.php", {post_Text:post_Text} ,function(resp){
         //          if(resp !== "OK"){
         //              console.log("ERROR OCCURED "+resp);

         //          }
         //      });
         //  });
         function isNumberKey(evt) {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;

          return true;
        }
      </script>


      <!-- GenesisUI main scripts -->

      <script src="js/app.js"></script>
      <script type="text/javascript" src="js/sails.io.js"></script>
      <script type="text/javascript">
        // Addedd  WEB Socket////


    // Get All Details BID GDS   ///


$(document).ready( function(){
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioo = io;
        io.socket.on('GDS_BID_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradegdsmarket/getAllBidGDS',function(err,data){
            $('#bid_gdsbtc').empty();
            $('#bid_current_GDS').empty();
            $('#bid_current_GDS').append(" &nbsp;"+data.body.bidsGDS[0].bidRate+"");
            console.log("socket all bids", data);
            for (var j = 0; j < 10; j++){
              if(j==data.body.bidsGDS.length) break;
              $('#bid_gdsbtc').append('<tr><td>' + data.body.bidsGDS[j].bidAmountBTC + '</td><td>' + data.body.bidsGDS[j].bidAmountGDS + '</td><td>' + data.body.bidsGDS[j].bidRate + '</td></tr>');

            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser', { userMailId: '<?php echo $user_session;?>'},function(err,data){
            console.log("sockets all user details for bids",data);
            $('#avalGDSBalance').empty();
            $('#freezeGDSBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#open_bid_gds').empty();
            $('#market_bid_gds').empty();
            $('#avalGDSBalance').append(data.body.user.GDSbalance+" ");
            $('#freezeGDSBalance').append(data.body.user.FreezedGDSbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            for( var j=0; j<data.body.user.bidsGDS.length; j++)
            {
              if(data.body.user.bidsGDS[j].status == 2 ){
                      $('#open_bid_gds').append('<tr><td>'
                          +data.body.user.bidsGDS[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsGDS[j].bidAmountGDS+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].totalbidAmountGDS+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].totalbidAmountBTC+
                          '</td><td><a class="text-danger" onclick="del(id='+data.body.user.bidsGDS[j].id +',bidownerGDS='+data.body.user.bidsGDS[j].bidownerGDS+');"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a></td></tr>');

              }
              else {
                      $('#market_bid_gds').append('<tr><td>'
                          +data.body.user.bidsGDS[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsGDS[j].bidAmountGDS+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].totalbidAmountGDS+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].totalbidAmountBTC+
                          '</td></tr>');

              }
            }
          });

        });
        // Get All Details ASK GDS  ///
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioag = io;
        io.socket.on('GDS_ASK_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradegdsmarket/getAllASKGDS',function(err,data){
            $('#ask_btc_gds').empty();
            for (var j = 0; j < 10; j++){
              if(j==data.body.asksGDS.length) break;
              $('#ask_btc_gds').append('<tr><td>' + data.body.asksGDS[j].askAmountBTC + '</td><td>' + data.body.asksGDS[j].askAmountGDS + '</td><td>' + data.body.asksGDS[j].askRate + '</td></tr>');
              console.log(" data.body.asksGDS[j].askAmountBTC" +  data.body.asksGDS[j].askAmountBTC + "data.body.asksGDS[j].askAmountGDS" + data.body.asksGDS[j].askAmountGDS);

            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser',{ userMailId: '<?php echo $user_session;?>'},function(err,data){
            $('#open_ask_gds').empty();
            $('#market_ask_gds').empty();
            $('#avalGDSBalance').append(data.body.user.GDSbalance+" ");
            $('#freezeGDSBalance').append(data.body.user.FreezedGDSbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            console.log("sockets all user details for asks",data);
            for( var j=0; j<data.body.user.asksGDS.length;j++)
            {
              if(data.body.user.asksGDS[j].status == 2 ){

                      $('#open_ask_gds').append('<tr><td>'
                          +data.body.user.asksGDS[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksGDS[j].askAmountGDS+
                          '</td><td>'
                          +data.body.user.asksGDS[j].askRate+
                          '</td><td>'
                          +data.body.user.asksGDS[j].totalaskAmountGDS+
                          '</td><td>'
                          +data.body.user.asksGDS[j].totalaskAmountBTC+
                          '</td><td><a class="text-danger" onclick="del_ask(id='+data.body.user.asksGDS[j].id+',askownerGDS='+data.body.user.asksGDS[j].askownerGDS+');" ><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                          '</td></tr>');

              }
              else {

                      $('#market_ask_gds').append('<tr><td>'
                          +data.body.user.asksGDS[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksGDS[j].askAmountGDS+
                          '</td><td>'
                          +data.body.user.asksGDS[j].askRate+
                          '</td><td>'
                          +data.body.user.asksGDS[j].totalaskAmountGDS+
                          '</td><td>'
                          +data.body.user.asksGDS[j].totalaskAmountBTC+
                          '</td></tr>');

              }
            }
          });

        });
        // Get All Details BID BCH  ///
        io.sails.url = 'http://192.168.1.16:1338';
        window.iob = io;
        io.socket.on('BCH_BID_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradebchmarket/getAllBidBCH',function(err,data){
            $('#bid_btc_bch').empty();
            $('#bid_current_BCH').empty();
            $('#bid_current_BCH').append(" &nbsp;"+data.body.bidsBCH[0].bidRate+"");
            console.log("socket all bids", data);
            if(data.body.bidsBCH){
              for (var j = 0; j < 10; j++){
                if(j==data.body.bidsBCH.length) break;
                $('#bid_btc_bch').append('<tr><td>' + data.body.bidsBCH[j].bidAmountBTC + '</td><td>' + data.body.bidsBCH[j].bidAmountBCH + '</td><td>' + data.body.bidsBCH[j].bidRate + '</td></tr>');
              }
            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser', { userMailId: '<?php echo $user_session;?>'},function(err,data){
            console.log("sockets all user details for bids",data);
            $('#avalBCHBalance').empty();
            $('#freezeBCHBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#open_bid_bch').empty();
            $('#market_bid_bch').empty();
            $('#avalBCHBalance').append(data.body.user.BCHbalance+" ");
            $('#freezeBCHBalance').append(data.body.user.FreezedBCHbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            for( var j=0; j<data.body.user.bidsBCH.length; j++)
            {
              if(data.body.user.bidsBCH[j].status == 2 ){
                      $('#open_bid_bch').append('<tr><td>'
                          +data.body.user.bidsBCH[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsBCH[j].bidAmountBCH+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].totalbidAmountBCH+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].totalbidAmountBTC+
                          '</td><td><a class="text-danger" onclick="del(id='+data.body.user.bidsBCH[j].id +',ownwe='+data.body.user.bidsBCH[j].bidownerBCH+');"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a></td></tr>');

              }
              else {
                      $('#market_bid_bch').append('<tr><td>'
                          +data.body.user.bidsBCH[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsBCH[j].bidAmountBCH+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].totalbidAmountBCH+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].totalbidAmountBTC+
                          '</td></tr>');

              }
            }
          });

        });
        // Get All Details ASK BCH  ///

        io.sails.url = 'http://192.168.1.16:1338';
        window.ioa = io;
        io.socket.on('BCH_ASK_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradebchmarket/getAllASKBCH',function(err,data){
            console.log("socket all asks", data);
            $('#ask_btc_bch').empty();
            $('#avalBCHBalance').empty();
            $('#freezeBCHBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#ask_current_BCH').empty();
            $('#ask_current_BCH').append(" &nbsp;"+data.body.asksBCH[0].askRate+"");
            if(data.body.asksBCH){
              for (var j = 0; j < 10; j++){
                if(j==data.body.asksBCH.length) break;
                $('#ask_btc_bch').append('<tr><td>' + data.body.asksBCH[j].askAmountBTC + '</td><td>' + data.body.asksBCH[j].askAmountBCH + '</td><td>' + data.body.asksBCH[j].askRate + '</td></tr>');
              }
            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser',{ userMailId: '<?php echo $user_session;?>'},function(err,data){
            $('#open_ask_bch').empty();
            $('#market_ask_bch').empty();
            $('#avalBCHBalance').append(data.body.user.BCHbalance+" ");
            $('#freezeBCHBalance').append(data.body.user.FreezedBCHbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            console.log("sockets all user details for asks",data);
            for( var j=0; j<data.body.user.asksBCH.length;j++)
            {
              if(data.body.user.asksBCH[j].status == 2 ){

                      $('#open_ask_bch').append('<tr><td>'
                          +data.body.user.asksBCH[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksBCH[j].askAmountBCH+
                          '</td><td>'
                          +data.body.user.asksBCH[j].askRate+
                          '</td><td>'
                          +data.body.user.asksBCH[j].totalaskAmountBCH+
                          '</td><td>'
                          +data.body.user.asksBCH[j].totalaskAmountBTC+
                          '</td><td><a class="text-danger" onclick="del_ask(id='+data.body.user.asksBCH[j].id+',askownerBCH='+data.body.user.asksBCH[j].askownerBCH+');" ><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                          '</td></tr>');

              }
              else {

                      $('#market_ask_bch').append('<tr><td>'
                          +data.body.user.asksBCH[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksBCH[j].askAmountBCH+
                          '</td><td>'
                          +data.body.user.asksBCH[j].askRate+
                          '</td><td>'
                          +data.body.user.asksBCH[j].totalaskAmountBCH+
                          '</td><td>'
                          +data.body.user.asksBCH[j].totalaskAmountBTC+
                          '</td></tr>');

              }
            }
          });
        });
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioe = io;
        io.socket.on('EBT_BID_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradeebtmarket/getAllBidEBT',function(err,data){
            $('#bid_btc_ebt').empty();
            $('#bid_current_EBT').empty();
            $('#bid_current_EBT').append(" &nbsp;"+data.body.bidsEBT[0].bidRate+"");
            for (var j = 0; j < 10; j++){
              if(j==data.body.bidsEBT.length) break;
              $('#bid_btc_ebt').append('<tr><td>' + data.body.bidsEBT[j].bidAmountBTC + '</td><td>' + data.body.bidsEBT[j].bidAmountEBT + '</td><td>' + data.body.bidsEBT[j].bidRate + '</td></tr>')

            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser', { userMailId: '<?php echo $user_session;?>'},function(err,data){
            console.log("sockets all user details for bids",data);
            $('#avalEBTBalance').empty();
            $('#freezeEBTBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#open_bid_ebt').empty();
            $('#market_bid_ebt').empty();
            $('#avalEBTBalance').append(data.body.user.EBTbalance+" ");
            $('#freezeEBTBalance').append(data.body.user.FreezedEBTbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            for( var j=0; j<data.body.user.bidsEBT.length; j++)
            {
              if(data.body.user.bidsEBT[j].status == 2 ){
                      $('#open_bid_ebt').append('<tr><td>'
                          +data.body.user.bidsEBT[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsEBT[j].bidAmountEBT+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].totalbidAmountEBT+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].totalbidAmountBTC+
                          '</td><td><a class="text-danger" onclick="del(id='+data.body.user.bidsEBT[j].id +',ownwe='+data.body.user.bidsEBT[j].bidownerEBT+');"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a></td></tr>');

              }
              else {
                      $('#market_bid_EBT').append('<tr><td>'
                          +data.body.user.bidsEBT[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsEBT[j].bidAmountEBT+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].totalbidAmountEBT+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].totalbidAmountBTC+
                          '</td></tr>');

              }
            }
          });
        });

        // Get All Details ASK EBT ///

        io.sails.url = 'http://192.168.1.16:1338';
        window.ioae = io;
        io.socket.on('EBT_ASK_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradeebtmarket/getAllASKEBT',function(err,data){
            $('#ask_btc_ebt').empty();
            $('#avalEBTBalance').empty();
            $('#freezeEBTBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#ask_current_EBT').empty();
            $('#ask_current_EBT').append(" &nbsp;"+data.body.asksEBT[0].askRate+"");
            for (var j = 0; j < 10; j++){
              if(j==data.body.asksEBT.length) break;
                    $('#ask_btc_ebt').append('<tr><td>' + data.body.asksEBT[j].askAmountBTC + '</td><td>' + data.body.asksEBT[j].askAmountEBT + '</td><td>' + data.body.asksEBT[j].askRate + '</td></tr>')

            }

          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser',{ userMailId: '<?php echo $user_session;?>'},function(err,data){
            $('#open_ask_ebt').empty();
            $('#market_ask_ebt').empty();
            $('#avalEBTBalance').append(data.body.user.EBTbalance+" ");
            $('#freezeEBTBalance').append(data.body.user.FreezedEBTbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            console.log("sockets all user details for asks",data);
            for( var j=0; j<data.body.user.asksEBT.length;j++)
            {
              if(data.body.user.asksEBT[j].status == 2 ){

                      $('#open_ask_ebt').append('<tr><td>'
                          +data.body.user.asksEBT[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksEBT[j].askAmountEBT+
                          '</td><td>'
                          +data.body.user.asksEBT[j].askRate+
                          '</td><td>'
                          +data.body.user.asksEBT[j].totalaskAmountEBT+
                          '</td><td>'
                          +data.body.user.asksEBT[j].totalaskAmountBTC+
                          '</td><td><a class="text-danger" onclick="del_ask(id='+data.body.user.asksEBT[j].id+',askownerEBT='+data.body.user.asksEBT[j].askownerEBT+');" ><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                          '</td></tr>');

              }
              else {

                      $('#market_ask_ebt').append('<tr><td>'
                          +data.body.user.asksEBT[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksEBT[j].askAmountEBT+
                          '</td><td>'
                          +data.body.user.asksEBT[j].askRate+
                          '</td><td>'
                          +data.body.user.asksEBT[j].totalaskAmountEBT+
                          '</td><td>'
                          +data.body.user.asksEBT[j].totalaskAmountBTC+
                          '</td></tr>');

              }
            }
          });
        });
       // Remove Web Socket ///
       // Get All Details BID GDS   ///
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioo = io;
        io.socket.on('GDS_BID_DESTROYED', function bidCreated(data){
          io.socket.get(url_api+'/tradegdsmarket/getAllBidGDS',function(err,data){
            $('#bid_gdsbtc').empty();
            for (var j = 0; j < 10; j++){

              if(j==data.body.bidsGDS.length) break;


              $('#bid_gdsbtc').append('<tr><td>' + data.body.bidsGDS[j].bidAmountBTC + '</td><td>' + data.body.bidsGDS[j].bidAmountGDS + '</td><td>' + data.body.bidsGDS[j].bidRate + '</td></tr>')

            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser', { userMailId: '<?php echo $user_session;?>'},function(err,data){
            console.log("sockets all user details for bids",data);
            $('#open_bid_gds').empty();
            $('#avalGDSBalance').empty();
            $('#freezeGDSBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#avalGDSBalance').append(data.body.user.GDSbalance+" ");
            $('#freezeGDSBalance').append(data.body.user.FreezedGDSbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");


            for( var j=0; j<data.body.user.bidsGDS.length; j++)
            {
              if(data.body.user.bidsGDS[j].status == 2 ){
                      $('#open_bid_bch').append('<tr><td>'
                          +data.body.user.bidsGDS[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsGDS[j].bidAmountGDS+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].totalbidAmountGDS+
                          '</td><td>'
                          +data.body.user.bidsGDS[j].totalbidAmountBTC+
                          '</td><td><a class="text-danger" onclick="del(id='+data.body.user.bidsGDS[j].id +',bidownerGDS='+data.body.user.bidsGDS[j].bidownerGDS+');"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a></td></tr>');

              }
            }
          });

        });
      // Get All Details ASK GDS  ///

        io.sails.url = 'http://192.168.1.16:1338';
        window.ioag = io;
        io.socket.on('GDS_ASK_DESTROYED', function bidCreated(data){
          io.socket.get(url_api+'/tradegdsmarket/getAllASKGDS',function(err,data){
            $('#ask_btc_gds').empty();
            for (var j = 0; j < 10; j++){


              if(j==data.body.asksGDS.length) break;


                    $('#ask_btc_gds').append('<tr><td>' + data.body.asksGDS[j].askAmountBTC + '</td><td>' + data.body.asksGDS[j].askAmountGDS + '</td><td>' + data.body.asksGDS[j].askRate + '</td></tr>')

            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser',{ userMailId: '<?php echo $user_session;?>'},function(err,data){
            $('#open_ask_gds').empty();
            $('#avalGDSBalance').empty();
            $('#freezeGDSBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#avalGDSBalance').append(data.body.user.GDSbalance+" ");
            $('#freezeGDSBalance').append(data.body.user.FreezedGDSbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            console.log("sockets all user details for asks",data);
            for( var j=0; j<data.body.user.asksGDS.length;j++)
            {
              if(data.body.user.asksGDS[j].status == 2 ){

                      $('#open_ask_gds').append('<tr><td>'
                          +data.body.user.asksGDS[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksGDS[j].askAmountGDS+
                          '</td><td>'
                          +data.body.user.asksGDS[j].askRate+
                          '</td><td>'
                          +data.body.user.asksGDS[j].totalaskAmountGDS+
                          '</td><td>'
                          +data.body.user.asksGDS[j].totalaskAmountBTC+
                          '</td><td><a class="text-danger" onclick="del_ask(id='+data.body.user.asksGDS[j].id+',askownerGDS='+data.body.user.asksGDS[j].askownerGDS+');" ><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                          '</td></tr>');

              }

            }
          });
        });
      // Get All Details BID BCH  ///

        io.sails.url = 'http://192.168.1.16:1338';
        window.iob = io;
        io.socket.on('BCH_BID_DESTROYED', function bidCreated(data){
          console.log("woriin bid destroyedd");
          io.socket.get(url_api+'/tradebchmarket/getAllBidBCH',function(err,data){
            $('#bid_btc_bch').empty();
            if(data.body.bidsBCH){
              for (var j = 0; j < 10; j++){
                if(j==data.body.bidsBCH.length) break;
                $('#bid_btc_bch').append('<tr><td>' + data.body.bidsBCH[j].bidAmountBTC + '</td><td>' + data.body.bidsBCH[j].bidAmountBCH + '</td><td>' + data.body.bidsBCH[j].bidRate + '</td></tr>')
              }
            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser', { userMailId: '<?php echo $user_session;?>'},function(err,data){
            console.log("sockets all user details for bids",data);
            $('#open_bid_bch').empty();
            $('#avalBCHBalance').empty();
            $('#freezeBCHBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#avalBCHBalance').append(data.body.user.BCHbalance+" ");
            $('#freezeBCHBalance').append(data.body.user.FreezedBCHbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");


            for( var j=0; j<data.body.user.bidsBCH.length; j++)
            {
              if(data.body.user.bidsBCH[j].status == 2 ){
                      $('#open_bid_bch').append('<tr><td>'
                          +data.body.user.bidsBCH[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsBCH[j].bidAmountBCH+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].totalbidAmountBCH+
                          '</td><td>'
                          +data.body.user.bidsBCH[j].totalbidAmountBTC+
                          '</td><td><a class="text-danger" onclick="del(id='+data.body.user.bidsBCH[j].id +',ownwe='+data.body.user.bidsBCH[j].bidownerBCH+');"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a></td></tr>');

              }
            }
          });

        });

        // Get All Details ASK BCH  ///
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioa = io;
        io.socket.on('BCH_ASK_DESTROYED', function bidCreated(data){
          console.log("woriin ask destroyed");
          io.socket.get(url_api+'/tradebchmarket/getAllASKBCH',function(err,data){
            $('#ask_btc_bch').empty();
            if(data.body.asksBCH){
              for (var j = 0; j < 10; j++){
                if(j==data.body.asksBCH.length) break;
                      $('#ask_btc_bch').append('<tr><td>' + data.body.asksBCH[j].askAmountBTC + '</td><td>' + data.body.asksBCH[j].askAmountBCH + '</td><td>' + data.body.asksBCH[j].askRate + '</td></tr>')
              }
            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser',{ userMailId: '<?php echo $user_session;?>'},function(err,data){
            $('#open_ask_bch').empty();
            $('#avalBCHBalance').empty();
            $('#freezeBCHBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#avalBCHBalance').append(data.body.user.BCHbalance+" ");
            $('#freezeBCHBalance').append(data.body.user.FreezedBCHbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            console.log("sockets all user details for asks",data);
            for( var j=0; j<data.body.user.asksBCH.length;j++)
            {
              if(data.body.user.asksBCH[j].status == 2 ){

                      $('#open_ask_bch').append('<tr><td>'
                          +data.body.user.asksBCH[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksBCH[j].askAmountBCH+
                          '</td><td>'
                          +data.body.user.asksBCH[j].askRate+
                          '</td><td>'
                          +data.body.user.asksBCH[j].totalaskAmountBCH+
                          '</td><td>'
                          +data.body.user.asksBCH[j].totalaskAmountBTC+
                          '</td><td><a class="text-danger" onclick="del_ask(id='+data.body.user.asksBCH[j].id+',askownerBCH='+data.body.user.asksBCH[j].askownerBCH+');" ><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                          '</td></tr>');

              }

            }
          });

        });
        // Get All Details ASK EBT ///
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioe = io;
        io.socket.on('EBT_BID_DESTROYED', function bidCreated(data){
          io.socket.get(url_api+'/tradeebtmarket/getAllBidEBT',function(err,data){
            $('#bid_btc_ebt').empty();
            for (var j = 0; j < 10; j++){

              if(j==data.body.bidsEBT.length) break;

              $('#bid_btc_ebt').append('<tr><td>' + data.body.bidsEBT[j].bidAmountBTC + '</td><td>' + data.body.bidsEBT[j].bidAmountEBT + '</td><td>' + data.body.bidsEBT[j].bidRate + '</td></tr>')

            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser', { userMailId: '<?php echo $user_session;?>'},function(err,data){
            console.log("sockets all user details for bids",data);
            $('#open_bid_ebt').empty();
            $('#avalEBTBalance').empty();
            $('#freezeEBTBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#avalEBTBalance').append(data.body.user.EBTbalance+" ");
            $('#freezeEBTBalance').append(data.body.user.FreezedEBTbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");


            for( var j=0; j<data.body.user.bidsEBT.length; j++)
            {
              if(data.body.user.bidsEBT[j].status == 2 ){
                      $('#open_bid_ebt').append('<tr><td>'
                          +data.body.user.bidsEBT[j].createdAt+
                          '</td><td>BID</td><td>'
                          +data.body.user.bidsEBT[j].bidAmountEBT+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].bidRate+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].totalbidAmountEBT+
                          '</td><td>'
                          +data.body.user.bidsEBT[j].totalbidAmountBTC+
                          '</td><td><a class="text-danger" onclick="del(id='+data.body.user.bidsEBT[j].id +',ownwe='+data.body.user.bidsEBT[j].bidownerEBT+');"><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a></td></tr>');
              }
            }
          });

        });

        // Get All Details ASK EBT ///

        io.sails.url = 'http://192.168.1.16:1338';
        window.ioae = io;
        io.socket.on('EBT_ASK_DESTROYED', function bidCreated(data){
          io.socket.get(url_api+'/tradeebtmarket/getAllASKEBT',function(err,data){
            $('#ask_btc_ebt').empty();
            if(data.body.asksEBT){
              for (var j = 0; j < 10; j++){

                if(j==data.body.asksEBT.length) break;
                $('#ask_btc_ebt').append('<tr><td>' + data.body.asksEBT[j].askAmountBTC + '</td><td>' + data.body.asksEBT[j].askAmountEBT + '</td><td>' + data.body.asksEBT[j].askRate + '</td></tr>')

              }
            }
          });
          io.socket.post(url_api+'/user/getAllDetailsOfUser',{ userMailId: '<?php echo $user_session;?>'},function(err,data){
            $('#open_ask_ebt').empty();
            $('#avalEBTBalance').empty();
            $('#freezeEBTBalance').empty();
            $('#avalBTCBalance').empty();
            $('#freezeBTCBalance').empty();
            $('#avalEBTBalance').append(data.body.user.EBTbalance+" ");
            $('#freezeEBTBalance').append(data.body.user.FreezedEBTbalance+" ");

            $('#avalBTCBalance').append(data.body.user.BTCbalance+" ");
            $('#freezeBTCBalance').append(data.body.user.FreezedBTCbalance+" ");
            console.log("sockets all user details for asks",data);
            for( var j=0; j<data.body.user.asksEBT.length;j++)
            {
              if(data.body.user.asksEBT[j].status == 2 ){

                      $('#open_ask_ebt').append('<tr><td>'
                          +data.body.user.asksEBT[j].createdAt+
                          '</td><td>ask</td><td>'
                          +data.body.user.asksEBT[j].askAmountEBT+
                          '</td><td>'
                          +data.body.user.asksEBT[j].askRate+
                          '</td><td>'
                          +data.body.user.asksEBT[j].totalaskAmountEBT+
                          '</td><td>'
                          +data.body.user.asksEBT[j].totalaskAmountBTC+
                          '</td><td><a class="text-danger" onclick="del_ask(id='+data.body.user.asksEBT[j].id+',askownerEBT='+data.body.user.asksEBT[j].askownerEBT+');" ><i class="fa fa-window-close fa-2x" aria-hidden="true"></i></a>'+
                          '</td></tr>');

              }

            }
          });

        });
});
</script>

<script>
 $.ajax({
  type: "POST",
  url: url_api+"/user/getAllDetailsOfUser",
  data: {
    userMailId: '<?php echo $user_session;?>'
  },
  cache: false,
  success: function(res)
  {

    var user_details = res.user;
    window.user_details = user_details;


  },
  error: function(err){

  }
});
</script>

</body>

</html>
