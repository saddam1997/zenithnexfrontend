$('document').ready(function()
{
    /* validation */
    $("#exchangelogin-form").validate({
        rules:
        {


            user_email: {
                required: true,
                email: true
            }
        },
        messages:
        {

            user_email: "Enter a Valid Email"
            
        },
        submitHandler: submitForm
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
        var data = $("#exchangelogin-form").serialize();
        var price = document.getElementById('amount').value;

        $.ajax({

            type : 'POST',
            url  : 'login.php',
            data : data,
            beforeSend: function()
            {
                $("#error").fadeOut();
                $("#btn-exchange").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success :  function(data)
            {

                if(data=="login")
                {

                    $("#btn-exchange").html('login');
                    window.location="exchangebuybtg.php?btg="+price;                  
                }
                else{

                    $("#error").fadeIn(1000, function(){

                        $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

                        $("#btn-exchange").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Login');

                    });

                }
            }
        });
        return false;
    }
    /* form submit */

});