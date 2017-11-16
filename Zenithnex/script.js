$('document').ready(function()
{
    /* validation */
    $("#signup-form").validate({
        rules:
        {
            
            mpassword: {
                required: true,
                minlength: 2,
                maxlength: 15
            },
            cpassword: {
                required: true,
                equalTo:'#mpassword'
            },
            user_email: {
                required: true,
                email: true
            },
            spassword: {
                required: true,
                minlength: 2,
                maxlength: 15
            },
            scpassword: {
                required: true,
                equalTo: '#spassword'
            },
        },
        messages:
        {
           user_email: "Enter a Valid Email",
            mpassword:{
                required: "Provide a Password",
                minlength: "Password Needs To Be Minimum of 2 Characters"
            },
            
            cpassword:{
                required: "Retype Your Password",
                equalTo: "Password Mismatch! Retype"
            },
            spassword:{
                required: "Provide a Password",
                minlength: "Password Needs To Be Minimum of 2 Characters"
            },
            
            scpassword:{
                required: "Retype Your Password",
                equalTo: "Password Mismatch! Retype"
            }  
     },
        submitHandler: submitForm
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
        var data = $("#signup-form").serialize();

        $.ajax({

            type : 'POST',
            url  : 'registersignup.php',
            data : data,
            beforeSend: function()
            {
                $("#errorsignup").fadeOut();
                $("#btn-Create").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            },
            success :  function(data)
            {
                if(data==1){

                    $("#errorsignup").fadeIn(1000, function(){


                        $("#errorsignup").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry email already taken !</div>');

                        $("#btn-Create").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');
                        
                    });

                }
                else if(data=="registered")
                {

                    $("#btn-Create").html('Signing Up');
                    setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signup-form").load("successreg.php"); }); ',1000);

                }
                else{

                    $("#errorsignup").fadeIn(1000, function(){

                        $("#errorsignup").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

                        $("#btn-Create").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');
                    });

                }
            }
        });
        return false;
    }
    /* form submit */

});