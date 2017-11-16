$('document').ready(function()
{
    /* validation */
    $("#login-form").validate({
        rules:
        {
            
           
            user_email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },
        },
        messages:
        {
            
            user_email: "Enter a Valid Email",
            password:{
                required: "Provide a Password",
            }
              
        },
        submitHandler: submitForm
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
        var data = $("#login-form").serialize();

        $.ajax({

            type : 'POST',
            url  : 'login.php',
            data : data,
            beforeSend: function()
            {
                $("#error").fadeOut();
                $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success :  function(data)
            {
                
                if(data=="login")
                {

                    $("#btn-submit").html('login');
                    window.location="index.php";
                  
                }
                else{

                    $("#error").fadeIn(1000, function(){

                        $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

                        $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Login');

                    });

                }
            }
        });
        return false;
    }
    /* form submit */

});