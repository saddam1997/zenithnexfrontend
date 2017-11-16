<html>
<head>
 <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</head>
<script>
$.ajax({
                url: 'http://192.168.0.101:1338/ask/getAllAsk',
                dataType: 'text',
                type: 'post',
                contentType: 'application/json',
                data: {},
                success: function(res)
                {
                  //console.log(res);
                  var ask_orders = $.parseJSON(res);
                  alert(data);
                  for( var i=0; i<res.length; i++){
                    $('#asks_orders').append('<div class="name">'+ask_orders[i].askRate+'</div>');
                  }
                }
            });

</script>
</html>