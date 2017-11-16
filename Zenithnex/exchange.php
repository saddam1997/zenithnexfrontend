
<html>
<body>
<script>

function copyTextValue(bf) {
  var text1 = document.getElementById("Name1").value;
  var text2 = document.getElementById("Name2").value;
  
  document.getElementById("Name1").value = text2;
  document.getElementById("Name2").value = text1;
  
}
</script>
<script>

function copyDivValue(bf) {
  var text1 = document.getElementById("btc").innerHTML;
  var text2 = document.getElementById("bcc").innerHTML;
  
  
  document.getElementById("bcc").innerHTML = text1;
  document.getElementById("btc").innerHTML = text2;
  
}
</script>
<input type="button" name="check1"  onclick="copyTextValue(this); copyDivValue(this);" />

<input id="Name1" value=""><span id ="bcc" >BCC</span>

<input id="Name2" value=""><span id ="btc" >BTC</span>
</body>
</html>
