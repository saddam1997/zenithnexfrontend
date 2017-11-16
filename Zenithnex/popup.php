<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- send  id01-->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center">
            <br>
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span> Bitcoin Withdraw
              </div><br>
               
               <div class="form-group">
                <label for="usr">Spending Password:</label>
                <input id="userMailId" type="text" class="form-control" value="" placeholder="Spending Password" >
              </div>
            <div class="form-group">
              <label for="pwd">BTC AMOUNT:</label>
              <input id="btcamount" type="text" class="form-control"  >
            </div> 
            <div class="form-group">
        
        <button style="background-color: #2E4057; color: white;" onclick="bitcoin_deposite_data();" class="form-control">Send</button>
        <div id="error_message"></div>
      </div>
     <br> <br> <br>
    </div>

</div>



<!-- close -->
<!-- send id02-->
<div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center">
            <br>
            <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span> Bitcoin Cash Withdraw
        </div><br>
         <form id="send" action="#" method="post">
         <div class="form-group">
          <label for="usr">Spending Password:</label>
          <input type="text" class="form-control" id="usr" placeholder="Spending Password">
        </div>
      <div class="form-group">
        <label for="pwd">Value:</label>
        <input type="password" class="form-control" id="pwd">
      </div> 
      <div class="form-group">
        
        <input type="submit" style="background-color: #2E4057; color: white;" class="form-control" id="pwd" value="submit">

      </div>
    </form> <br> <br> <br>
    </div>

</div>


<!-- close -->
<!-- model 03 -->

<div id="id03" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center">
            <br>
            <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>Litecoin Withdraw
        </div><br>
         <form id="send" action="#" method="post">
         <div class="form-group">
          <label for="usr">Spending Password:</label>
          <input type="text" class="form-control" id="usr" placeholder="Spending Password">
        </div>
      <div class="form-group">
        <label for="pwd">Value:</label>
        <input type="password" class="form-control" id="pwd">
      </div> 
      <div class="form-group">
        
        <input type="submit" class="form-control" id="pwd" style="background-color: #2E4057; color: white;" value="submit">
      </div>
    </form> <br> <br> <br>
    </div>

</div>

<!-- start 4 -->
<div id="id04" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center">
            <br>
            <span onclick="document.getElementById('id04').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span> Goods Coin Withdraw
        </div><br>
          <div class="form-group">
                <label for="usr">Spending Password:</label>
                <input id="gdscoin_deposite" type="text" class="form-control" value="" placeholder="Spending Password">
              </div>
            <div class="form-group">
              <label for="pwd">BTC AMOUNT:</label>
              <input id="gdscoin_withdrawe" type="text" class="form-control"  >
            </div> 
            <div class="form-group">
        
        <button style="background-color: #2E4057; color: white;" onclick="gds_withdraw_data();" class="form-control">Send</button>
      </div>
    </form> <br> <br> <br>
    </div>

</div>

<!-- send  id05-->
<div id="id05" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center">
            <br>
            <span onclick="document.getElementById('id05').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span> Ebittree Coin Withdraw
        </div><br>
         <div class="form-group">
                <label for="usr">Spending Password:</label>
                <input id="ebtcoin_deposite" type="text" class="form-control" value="" placeholder="Spending Password" >
              </div>
            <div class="form-group">
              <label for="pwd">BTC AMOUNT:</label>
              <input id="ebtcoin_withdrawe" type="text" class="form-control"  >
            </div> 
            <div class="form-group">
        
        <button style="background-color: #2E4057; color: white;" onclick="ebt_withdraw_data();" class="form-control">Send</button>
      </div>
     <br> <br> <br>
    </div>

</div>
