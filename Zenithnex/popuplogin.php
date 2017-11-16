
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    
    <title>Wallets | <?php echo $coin_fullname;?>(<?php echo $coin_short;?>)</title>
    <!-- Bootstrap Core CSS -->
    <link href="./login/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <meta name="description" content="<?php echo $coin_fullname;?>(<?php echo $coin_short;?>)">
    <link href="./login/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="./login/blue.css" id="theme" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tutorial-22</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="scriptlogin.js"></script>

</head>
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
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
    padding: 16px;
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
    overflow: auto; /* Enable scroll if needed */
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

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
 
  
<section id="wrapper" >
      <div class="login-box card" >
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Login" >&times;</span>
        <div class="card-body" >
 
<div class="signin-form">

    <div class="container">


        <form class="form-signin" method="post" id="register-form">

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
                    <span class="glyphicon glyphicon-log-in"></span> &nbsp; Login
                </button>
            </div>

        </form>

    </div>

</div>

    </section>
</div>

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
<script src="./login/jquery.min.js.download"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="./login/popper.min.js.download"></script>
    <script src="./login/bootstrap.min.js.download"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="./login/jquery.slimscroll.js.download"></script>
    <!--Wave Effects -->
    <script src="./login/waves.js.download"></script>
    <!--Menu sidebar -->
    <script src="./login/sidebarmenu.js.download"></script>
    <!--stickey kit -->
    <script src="./login/sticky-kit.min.js.download"></script>
    <script src="./login/jquery.sparkline.min.js.download"></script>
    <!--Custom JavaScript -->
    <script src="./login/custom.min.js.download"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="./login/jQuery.style.switcher.js.download"></script>

</body>
</html>
