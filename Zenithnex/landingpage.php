<?php
$service_url = "https://cex.io/api/ticker/BCH/BTC";
    // jSON URL which should be requested
$json_url = "https://cex.io/api/ticker/BCH/BTC";
    // jSON String for request
$json_string = "bid";
    // Initializing curl
$ch = curl_init( $json_url );
    // Configuring curl options
$options = array(
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POSTFIELDS => $json_string
  );
    // Setting curl options
curl_setopt_array( $ch, $options );
    // Getting results
    $result = curl_exec($ch); // Getting jSON result string
    $data = json_decode($result);
    //echo $data->bid;
    //echo $data->low;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- Bootstrap Core CSS -->
      <!-- <link href="./login/bootstrap.min.css" rel="stylesheet"> -->
      <!-- Custom CSS -->
      <meta name="description" content="<?php echo $coin_fullname;?>(<?php echo $coin_short;?>)">
      <!-- <link href="./login/style.css" rel="stylesheet"> -->
      <!-- You can change the theme colors from here -->
      <!-- <link href="./login/blue.css" id="theme" rel="stylesheet"> -->
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 
      <title>BTGWallet.io | Zenith Nex</title>

      <!-- Styles -->
      <link href="assets/css/core.min.css" rel="stylesheet">
      <link href="assets/css/thesaas.min.css" rel="stylesheet">
      <link href="assets/css/style.css" rel="stylesheet">
      <!-- Favicons -->
      <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.html">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <link href="css/bootstrap.css" rel="stylesheet" media="screen">
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
      <link href="style.css" rel="stylesheet" type="text/css" media="screen">
      <script type="text/javascript" src="scriptlogin.js"></script>
      <script type="text/javascript" src="script.js"></script>
      <script type="text/javascript" src="exchangelogin.js"></script>
      <script type="text/javascript" src="fpassword.js"></script>

    </head>
    <style>
      /* Full-width input fields */
      input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 0px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }

      /* Set a style for all buttons */
      button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 0px 0;
        border: none;
        cursor: pointer;
        width: 100%;
      }
      .btna
      {
        background-color: #1282A2!important;
        color: white;
        padding: 14px;
        margin-left: 33rem;
        border: none;
        cursor: pointer;
        width: 30%;

      }
      .bt
      {
        background-color: #1282A2!important;
        color: white;
        padding: 14px;
        border: none;
        cursor: pointer;
        width: 30%;

      }

      button:hover {
        opacity: 0.8;
      }

      /* Extra styles for the cancel button */
      .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
      }

      /* Center the image and position the close button */
      .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
      }

      img.avatar {
        width: 40%;
        border-radius: 50%;
      }

      .container {
        padding: 0px;
      }

      span.psw {
        float: right;
        padding-top: 16px;
      }

      /* The Modal (background) */
      .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: auto%; /* Full height */
        /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
      }

      /* Modal Content/Box */
      .modal-content {
        background-color: #fefefe;
        margin: 3% auto 0% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 90%; /* Could be more or less, depending on screen size */

      }

      /* The Close Button (x) */
      .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
      }

      .close:hover,
      .close:focus {
        color: red;
        cursor: pointer;
      }

      /* Add Zoom Animation */
      .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
      }

      @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)} 
        to {-webkit-transform: scale(1)}
      }

      @keyframes animatezoom {
        from {transform: scale(0)} 
        to {transform: scale(1)}
      }

      /* Change styles for span and cancel button on extra small screens */
      @media screen and (max-width: 300px) {
        span.psw {
         display: block;
         float: none;
       }
       .cancelbtn {
         width: 100%;
       }
     }
   </style>
   <body >
    <nav class="topbar topbar-inverse topbar-expand-sm">
      <div class="container">
        <div class="col-md-12">
        <div class="col-md-6">
          <a class="topbar-brand" href="index.php">
            <img class="logo-inverse" src="assets/img/logo-light.png" alt="logo" style="margin-left: 63PX;" width="220px" >
          </a>
        </div>
         <div class="col-md-6">
          <div class="topbar-right" style="float: right;">
          <button class="btn btn-sm btn-white mr-4" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Login</button>
           <button class="btn btn-sm btn-outline btn-white hidden-sm-down"  onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Signup</button>
         </div>
       </div>
      
      </div>
        <div class="topbar-right" style:"text-align: right !important">

          <div id="id02" class="modal">
            <section id="wrapper" >
              <div class="login-box card" >
                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Login" >&times;</span>
                <div class="card-body" >
                  <div class="signin-form">
                    <div class="container">
                      <form class="form-signin" method="post" id="login-form">
                        <h2 class="form-signin-heading">Login</h2><hr />
                        <div id="error">
                        </div>
                        <div class="form-group">
                          <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
                          <span id="check-e"></span>
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                        </div>
                        <hr />
                        <div class="form-group">
                          <button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
                            <span ></span> &nbsp; Login
                          </button>
                        </div>                        
                      </form>
                      <br><br><br>
                      <button class="btn btn-sm" onclick="document.getElementById('id01').style.display='block';document.getElementById('id03').style.display='none'" style="width:auto;color:#2E4057;margin-left: 32rem;margin-top: -5rem;">Signup</button>
                              <button class=" btn btn-sm" onclick="document.getElementById('id04').style.display='block';document.getElementById('id03').style.display='none'" style="width:auto;color:#2E4057;margin-left: 32rem;margin-top: -5rem;">Forget Password</button>
                    </div>
                  </div>
                </section>
              </div>
             
              <div id="id01" class="modal">
                <section id="wrapper" >
                  <div class="login-box card" >
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Login" >&times;</span>
                    <div class="card-body" >
                    <br><br><br><br>

                      <div class="signup-form">
                        <form class="form-signin" method="post" id="signup-form">
                          <h2 class="form-signin-heading">Sign Up</h2><hr />
                          <div id="errorsignup">
                          </div>
                          <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
                            <span id="check-e"></span>
                          </div>
                          <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="mpassword" id="mpassword" />
                          </div>
                          <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" id="cpassword" />
                          </div>
                          <div class="form-group">
                            <input type="password" class="form-control" placeholder="Spending Password" name="spassword" id="spassword" />
                          </div>
                          <div class="form-group">
                            <input type="password" class="form-control" placeholder="Spending Confirm Password" name="scpassword" id="scpassword" />
                          </div>
                          <hr />
                          <div class="form-group">
                            <button type="submit" class="btn btn-default" name="btn-Create" id="btn-Create">
                              <span ></span> &nbsp; Create Account
                            </button>
                          </div>
                        </form>
                       <br><br>
                        <button class="btn btn-sm"onclick="document.getElementById('id02').style.display='block';document.getElementById('id01').style.display='none'" style="width:auto;color:#2E4057;margin-left: 65rem;margin-top: -5rem;">Already Signup | Login </button>
                      </div>
                      <br>
                    </section>
                  </div>
                  <div id="id03" class="modal">
                    <section id="wrapper">
                      <div class="login-box card">
                        <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Login" >&times;</span>
                        <div class="card-body" >
                          <div class="exchange-form">
                            <div class="container">
                              <form class="form-signin" method="post" id="exchangelogin-form">
                                <h2 class="form-signin-heading">Login</h2><hr />
                                <div id="error">
                                </div>
                                <div class="form-group">
                                  <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
                                  <span id="check-e"></span>
                                </div>
                                <div class="form-group">
                                  <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                                </div>
                                <hr />
                                <input type="hidden" id="amount" name="amount" value="">
                                <div class="form-group">
                                  <button type="submit" class="btn btn-default" name="btn-exchange" id="btn-exchange">
                                    <span></span> &nbsp; Login
                                  </button>
                                </div>
                              </form>
                              <button class="" onclick="document.getElementById('id01').style.display='block';document.getElementById('id03').style.display='none'" style="width:auto;color:#2E4057;margin-left: 65rem;">Signup</button>
                              <button class=" " onclick="document.getElementById('id04').style.display='block';document.getElementById('id03').style.display='none'" style="width:auto;color:#2E4057;margin-left: 65rem;">Forget Password</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <div id="id04" class="modal">
                <section id="wrapper" >
                  <div class="login-box card" >
                    <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Login" >&times;</span>
                    <div class="card-body" >
                    <br><br><br><br>
                      <div class="fpassword-form">
                        <div class="container">
                          <form class="form-signin" method="post" id="fpassword-form">
                            <h2 class="form-signin-heading">Forget Password</h2><hr />
                            <div id="errorfpassword">
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
                              <span id="check-e"></span>
                            </div>
                            <hr />
                            <div class="form-group">
                              <button type="submit" class="btn btn-default" name="btn-fpassword" id="btn-fpassword">
                                <span ></span> &nbsp; Send
                              </button>
                            </div>
                          </form>
                          <br><br><br><br>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </nav>
          <!-- END Topbar -->

          <!-- Header -->
          <header class="header header-inverse h-fullscreen p-0 bg-primary overflow-hidden" style="background-color: #003249 !important; background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover; height:530px;">
            <canvas class="constellation"></canvas>

            <div class="container text-center">

              <div class="row h-full align-items-center">
                <div class="col-12 col-md-8 offset-md-2">

                  <h1 class="display-4">Built for Bitcoin Gold!</h1>
                  <br>
                  <p class="lead text-white fs-20">Utilising the best of minds in crypto-currency world, we bring you the first official Bitcoin Gold Wallet as a Service solution offered by Bitcoin Gold Foundation. Register now on BTGWallet.io</p>
                  <br>
                </header>
                <!-- END Header -->
                <script type="text/javascript">
                  function sum()
                  {
                   var num1 = document.myform.number1.value;
                   var num2 = <?php echo $data->ask; ?>;
                   var sum = parseFloat(num1) / parseFloat(num2);
                   document.getElementById('add').value = sum;
                 }
               </script>
               <br>
                <!-- <FORM NAME="myform" method="post">
                  <div class="col-xs-12"  style="text-align: center; color: #1544c0;">Transfer from one wallet to another within seconds. It's that simple.</div><br><br>
                  <div class="col-xs-2 col-sm-2"></div>
                   <div class="col-xs-4 col-sm-3">
                     <div class="form-group input-group">
                      <span class="input-group-addon">You have</span>
                       <input class="input-group-addon" type="text" NAME="number1"
                       id="number1" VALUE="" onKeyup="sum()">
                       <span id="btc" class="input-group-addon">BTC</span>
                     </div>
                   </div>
                    </div>
                     <div class="col-xs-4 col-sm-2">
                     <input class="btn btn-white mr-4" style="width:70%; margin-left: 30px; margin-top: 5px;" Value="->|<-" type="button" name="check1" onclick="copyTextValue(this); copyDivValue(this);"/>
                  </div>
                   <div class="col-xs-4 col-sm-3">
                    <div class="form-group input-group">
                      <span class="input-group-addon">You Get</span>
                      <input class="input-group-addon" type="text" ID="add" NAME="result" VALUE="">
                      <span id="bcc" class="input-group-addon">BTG</span>
                    </div>
                  </div>
                <br>
                </FORM>
                 <button class="btn btn-sm btn-white mr-4" onclick="document.getElementById('id03').style.display='block'" id="exchange" style="width:auto; margin-top: -16px;">Exchange</button>
                 -->
              
              <!-- Main container -->
             
      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Features
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <section class="section">
        <header class="section-header mb-0">
                <h1 style="padding: 20px; margin-top: 70px;"> Features </h1>
              </header>
              <main class="main-content">
        <div class="container">
          <div class="row gap-y">
            <div class="col-12 col-md-6 col-xl-6">
              <div class="flexbox gap-items-6">
                <div style="width:100px;height:100px;">
                 <img src="assets/img/email.png" alt="logo">
               </div>
               <div>
                <h5>Swift Transactions</h5>
                <p>The block completion rate is faster. Congestion free transactions eco-system!</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-6">
            <div class="flexbox gap-items-6">
              <div style="width:100px;height:100px;">
               <img src="assets/img/budget.png" alt="logo">
             </div>

             <div>
              <h5>Low Cost</h5>
              <p>UAHF with 8 MB block size makes BTG the cheapest means of money transfer.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-6">
          <div class="flexbox gap-items-6">
            <div style="width:100px;height:100px;">
              <img src="assets/img/circle-between-hands.png" alt="logo">
            </div>
            <div>
              <h5>Replay and Wipeout protection</h5>
              <p>BTGWallet.io will ensure the working of two chains in a peaceful, optimized way.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-6">
          <div class="flexbox gap-items-6">
            <div style="width:100px;height:100px;">
             <img src="assets/img/new.png" alt="logo">
           </div>

           <div>
            <h5>New SigHash type</h5>
            <p>No more Quadratic Hashing problem. Newer Signature models are being used to ensure secure transfer of coins.</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-6">
        <div class="flexbox gap-items-6">
          <div style="width:100px;height:100px;">
           <img src="assets/img/happiness.png" alt="logo">
         </div>
         <div>
          <h5>Great future expediencies</h5>
          <p>With its soaring values in first few days of launch, BTG has gained a great momentum by directly entering the cryptocurrency market at the third position.</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
      <div class="flexbox gap-items-6">
        <div style="width:100px;height:100px;">
          <img src="assets/img/worker-digging-a-hole.png" alt="logo">
        </div>
        <div>
          <h5>Ease in mining</h5>
          <p>Difficulty Rate reduction in coming weeks will ease the mining process!</p>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | CTA
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <section class="section section-inverse py-40" style="background-color:#003249">
        <div class="container">
          <div class="row gap-y align-items-center">
            <div class="col-12 col-md-9">
              <h4 class="fw-300 mb-0">Want a bite of BTG? You're in the right place!</h4>
            </div>

            <div class="col-12 col-md-3">
              <button class="btn btn-sm btn-white mr-4" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">GET STARTED</button>
            </div>
          </div>
        </div>
      </section>
      <!-- Footer -->
      <footer class="site-footer">
        <div class="container">
          <div class="row gap-y align-items-center">
            <div class="col-12 col-lg-3">
              <p class="text-center text-lg-left">
                <a href="landingpage.php"><img src="assets/img/logoblck.png" alt="logo"></a>
              </p>
            </div>
            <div class="col-12 col-lg-3"></div>
            <div class="col-12 col-lg-3"></div>
            <div class="col-12 col-lg-3">
              <a href="http://btgwallet.io/"><p><b  style="font-size: small">&copy; btgwallet.io, All rights reserved.</b></p></a>
            </div>
          </div>
        </div>
      </footer>
      <!-- END Footer -->
    </main>
    <!-- END Main container -->
    <!-- Footer -->
    

    <script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
// Get the modal
var modal = document.getElementById('id03');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
// Get the modal
var modal = document.getElementById('id04');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
  $(document).ready(function () { 
    $('#exchange').click(function () { 
      var text = $('#add').val();
      $('#amount').html($('#amount').val(text)); 
      $('#add').val(); });
  });
</script>
<script>

function copyTextValue(bf) {
  var text1 = document.getElementById("add").value;
  var text2 = document.getElementById("number1").value;
  document.getElementById("number1").value = text1;
  document.getElementById("add").value = text2;
}
function copyDivValue(bf) {
  var text1 = document.getElementById("btc").innerHTML;
  var text2 = document.getElementById("bcc").innerHTML;
  
  
  document.getElementById("bcc").innerHTML = text1;
  document.getElementById("btc").innerHTML = text2;
  
}
</script>
</body>
</html>
