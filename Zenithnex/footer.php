</main>




</div>

<footer class="app-footer">
  <a href="#">ZenithNEX</a> &copy; 2017
  <span class="float-right"> <a href="contactus.php">Contact-US</a>
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


      <!-- Plugins and scripts required by all views -->
      <script src="js/chart.min.js"></script>

      <!-- GenesisUI main scripts -->

      <script src="js/app.js"></script>
      <script type="text/javascript" src="js/sails.io.js"></script>
      <script type="text/javascript">
        // Addedd  WEB Socket////


    // Get All Details BID GDS   ///


    $(document).ready(function(){
      io.sails.url = 'http://192.168.1.16:1338';
      window.ioo = io;
      io.socket.on('GDS_BID_ADDED', function bidCreated(data){
        io.socket.get(url_api+'/tradegdsmarket/getAllBidGDS',function(err,data){
          $('#bid_gdsbtc').empty();
          for (var j = 0; j < 10; j++){


            if(j==data.body.bidsGDS.length) break;


            $('#bid_gdsbtc').append('<tr><td>' + data.body.bidsGDS[j].bidAmountBTC + '</td><td>' + data.body.bidsGDS[j].bidAmountGDS + '</td><td>' + data.body.bidsGDS[j].bidRate + '</td></tr>')

          }
        });

      });

    })
      // Get All Details ASK GDS  ///

      $(document).ready(function(){
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

        });
        
      })


      // Get All Details BID BCH  ///

      $(document).ready(function(){
        io.sails.url = 'http://192.168.1.16:1338';
        window.iob = io;
        io.socket.on('BCH_BID_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradebchmarket/getAllBidBCH',function(err,data){
            $('#bid_btc_bch').empty();
            for (var j = 0; j < 10; j++){


              if(j==data.body.bidsBCH.length) break;


              $('#bid_btc_bch').append('<tr><td>' + data.body.bidsBCH[j].bidAmountBTC + '</td><td>' + data.body.bidsBCH[j].bidAmountBCH + '</td><td>' + data.body.bidsBCH[j].bidRate + '</td></tr>')

            }
          });

        });
        
      })

      // Get All Details ASK BCH  ///

      $(document).ready(function(){
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioa = io;
        io.socket.on('BCH_ASK_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradebchmarket/getAllASKBCH',function(err,data){
            $('#ask_btc_bch').empty();
            for (var j = 0; j < 10; j++){


              if(j==data.body.asksBCH.length) break;


                    $('#ask_btc_bch').append('<tr><td>' + data.body.asksBCH[j].askAmountBTC + '</td><td>' + data.body.asksBCH[j].askAmountBCH + '</td><td>' + data.body.asksBCH[j].askRate + '</td></tr>')

            }
          });

        });
        
      })



// Get All Details BID EBT ///


$(document).ready(function(){
  io.sails.url = 'http://192.168.1.16:1338';
  window.ioe = io;
  io.socket.on('EBT_BID_ADDED', function bidCreated(data){
    io.socket.get(url_api+'/tradeebtmarket/getAllBidEBT',function(err,data){
      $('#bid_ebtbtc').empty();
      for (var j = 0; j < 10; j++){


        if(j==data.body.bidsEBT.length) break;


        $('#bid_ebtbtc').append('<tr><td>' + data.body.bidsEBT[j].bidAmountBTC + '</td><td>' + data.body.bidsEBT[j].bidAmountEBT + '</td><td>' + data.body.bidsEBT[j].bidRate + '</td></tr>')

      }
    });

  });

})

 // Get All Details ASK EBT ///

      $(document).ready(function(){
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioae = io;
        io.socket.on('EBT_ASK_ADDED', function bidCreated(data){
          io.socket.get(url_api+'/tradeebtmarket/getAllASKEBT',function(err,data){
            $('#ask_btc_ebt').empty();
            for (var j = 0; j < 10; j++){


              if(j==data.body.asksEBT.length) break;


                    $('#ask_btc_ebt').append('<tr><td>' + data.body.asksEBT[j].askAmountBTC + '</td><td>' + data.body.asksEBT[j].askAmountEBT + '</td><td>' + data.body.asksEBT[j].askRate + '</td></tr>')

            }
          });

        });
        
      })


  // Remove Web Socket ///


  // Get All Details BID GDS   ///


      $(document).ready(function(){
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

        });

      })
      // Get All Details ASK GDS  ///

      $(document).ready(function(){
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

        });
        
      })


      // Get All Details BID BCH  ///

      $(document).ready(function(){
        io.sails.url = 'http://192.168.1.16:1338';
        window.iob = io;
        io.socket.on('BCH_BID_DESTROYED', function bidCreated(data){

          io.socket.get(url_api+'/tradebchmarket/getAllBidBCH',function(err,data){
            $('#bid_btc_bch').empty();
            console.log(data.body.bidsBCH.length);
            for (var j = 0; j < 10; j++){



              if(j==data.body.bidsBCH.length) break;


              $('#bid_btc_bch').append('<tr><td>' + data.body.bidsBCH[j].bidAmountBTC + '</td><td>' + data.body.bidsBCH[j].bidAmountBCH + '</td><td>' + data.body.bidsBCH[j].bidRate + '</td></tr>')

            }
          });

        });
        
      })

      // Get All Details ASK BCH  ///

      $(document).ready(function(){
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioa = io;
        io.socket.on('BCH_ASK_DESTROYED', function bidCreated(data){
          io.socket.get(url_api+'/tradebchmarket/getAllASKBCH',function(err,data){
            $('#ask_btc_bch').empty();
            for (var j = 0; j < 10; j++){


              if(j==data.body.asksBCH.length) break;


                    $('#ask_btc_bch').append('<tr><td>' + data.body.asksBCH[j].askAmountBTC + '</td><td>' + data.body.asksBCH[j].askAmountBCH + '</td><td>' + data.body.asksBCH[j].askRate + '</td></tr>')

            }
          });

        });
        
      })



// Get All Details BID EBT ///


$(document).ready(function(){
  io.sails.url = 'http://192.168.1.16:1338';
  window.ioe = io;
  io.socket.on('EBT_BID_DESTROYED', function bidCreated(data){
    io.socket.get(url_api+'/tradeebtmarket/getAllBidEBT',function(err,data){
      $('#bid_ebtbtc').empty();
      for (var j = 0; j < 10; j++){

        if(j==data.body.bidsEBT.length) break;

        $('#bid_ebtbtc').append('<tr><td>' + data.body.bidsEBT[j].bidAmountBTC + '</td><td>' + data.body.bidsEBT[j].bidAmountEBT + '</td><td>' + data.body.bidsEBT[j].bidRate + '</td></tr>')

      }
    });

  });

})

 // Get All Details ASK EBT ///

      $(document).ready(function(){
        io.sails.url = 'http://192.168.1.16:1338';
        window.ioae = io;
        io.socket.on('EBT_ASK_DESTROYED', function bidCreated(data){
          io.socket.get(url_api+'/tradeebtmarket/getAllASKEBT',function(err,data){
            $('#ask_btc_ebt').empty();
            for (var j = 0; j < 10; j++){


              if(j==data.body.asksEBT.length) break;


                    $('#ask_btc_ebt').append('<tr><td>' + data.body.asksEBT[j].askAmountBTC + '</td><td>' + data.body.asksEBT[j].askAmountEBT + '</td><td>' + data.body.asksEBT[j].askRate + '</td></tr>')

            }
          });

        });
        
      })


</script>

<script>
 $.ajax({ 
  type: "POST", 
  url: url_api+"/user/getAllDetailsOfUser", 
  data: {
    userMailId: '<? echo $user_session;?>'
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
