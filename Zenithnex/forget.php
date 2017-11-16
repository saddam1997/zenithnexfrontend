<?php 
include_once('common.php');
$allowed = array(".", "-", "_");
$email_id ="";

//echo "           =>>>>>>> ".hash('sha256',addslashes(strip_tags($email_id)));
//echo "</br>           =>>>>>>> ".hash('sha256',addslashes(strip_tags($password)));
$error = array();
if(isset($_POST['btnforget']))
{
//  var_dump($_POST);
    $email_id = $_POST['txtEmailID'];
     
    if (empty($email_id))
    {
        $error['emailError'] = "Please Provide valid email id";
    }   
    elseif (!isEmail($email_id))
    {
        $error['emailError'] = "Please Provide valid email id";
    }

    if(empty($error))
    {
        $email_id = $mysqli->real_escape_string(strip_tags($email_id));
        
        $qstring = "select coalesce(id,0) as id, coalesce(username,'') as username
                    from users WHERE encrypt_username = '" . hash('sha256',$email_id) . "'";
        
        $result = $mysqli->query($qstring);
        $user = $result->fetch_assoc();
        //var_dump($user);
        
        
        if (($user) && ($user['id'] > 0 ))
        {
            $new_password = "s!w@".rand(0,100000);
            $password_value = hash('sha256',addslashes(strip_tags($new_password)));
            $sub =" Password Recovery Mail";
            $message_body =" Dear User \n";
            $message_body .= " Your recovery password is $new_password \n\n";
            $message_body .= " Please login and change it immediately\n\n";
            $message_body .= " Thanks \n";
            $message_body .= " Administrator";
            
            $qstring = "update users set `password` ='".$password_value."'"; 
            $qstring .= " WHERE encrypt_username = '" . hash('sha256',$email_id) . "' and id = ".$user['id'] ;
        
            $result2    = $mysqli->query($qstring);
    //      $user2 = $result2->fetch_assoc();
            
            $error['emailError2'] = "An Email has been send to your email id. ";

            sendpmail($email_id,$sub,$message_body);
        }
        else
        {
            $error['emailError'] = "the Provided email_id  is not registered with us";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="gr__wrappixel_com"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body data-gr-c-s-loaded="true">
    
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(./img/1.jpg);">        
            <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material"  action="forget.php" method="post">
                    <h3 class="box-title m-b-20">Recover Password</h3>
                    
                    <div class="form-group">
                      <label class=" form-control-label" for="input-small">Registered Email ID</label>
                      <div class="col-xs-12">
                       <input id="txtEmailID" name="txtEmailID" class="form-control"  type="text"   value="<?php echo $email_id;?>">     <?php if(isset($error['emailError'])) { echo "<br/><span class=\"messageClass\">".$error['emailError']."</span>";  }?>  
                            <?php if(isset($error['emailError2'])) { echo "<br/><span class=\"messageClass2\">".$error['emailError2']."</span>";  }?>
                      </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button type="submit" class=" btn btn-success" id="btnforget" name="btnforget" value="Recover">Recover</button>
                      </div>
                    </div>
                  </form>
            </div>
          </div>
        </div>
        
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
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