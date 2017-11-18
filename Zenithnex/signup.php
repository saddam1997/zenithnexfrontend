<?php 
include 'common.php';
$allowed = array(".", "-", "_");
$email_id = "";
$password = "";
$confirmpassword = "";
$spendingpassword = "";
$confirmspendingpassword = "";

$error = array();
if(isset($_POST['btnsignup']))
{
//  var_dump($_POST);
    $email_id = $_POST['txtEmailID'];
    $password = $_POST['signuppassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $spendingpassword = $_POST['spendingpassword'];
    $confirmspendingpassword = $_POST['confirmspendingpassword'];

    if (empty($email_id))
    {
        $error['emailError'] = "Please Provide valid email id";
    }   
    if(empty($password))
    {
        $error['passwordError'] = "Please Provide valid Password";
    }
    if(empty($confirmpassword))
    {
        $error['confirmpasswordError'] = "Please Provide valid Password";
    }
    else if($confirmpassword != $password)
    {
        $error['confirmpasswordError'] = "Password and Confirm Password Must be same";
    }
    if(empty($spendingpassword))
    {
        $error['spendingpasswordError'] = "Please Provide valid Spending Password";
    }
    if(empty($confirmspendingpassword))
    {
        $error['confirmspendingpasswordError'] = "Please Provide valid Spending Password";
    }
    else if($confirmspendingpassword != $spendingpassword)
    {
        $error['confirmpasswordError'] = "Spending Password and Confirm Password Must be same";
    }
    
    if (!isEmail($email_id))
    {
        $error['emailError'] = "Please Provide valid email id";
    } 

        
        
    
   

    $email_id = $mysqli->real_escape_string(strip_tags($email_id));
    $password_value = hash('sha256',addslashes(strip_tags($password)));
    $qstring = "select coalesce(id,0) as id
                from users WHERE encrypt_username = '" . hash('sha256',$email_id) . "'";
    $result = $mysqli->query($qstring);
    $user = $result->fetch_assoc();
    //var_dump($user);

    if ($user['id']> 0)
    {
        $error['emailError'] = "User with email id ". $email_id ." already exist.";
    }

    if(empty($error))
    {
    	$block_io->get_new_address(array('label' => $email_id));
        $email_id = $mysqli->real_escape_string(strip_tags($email_id));
        $password_value = hash('sha256',addslashes(strip_tags($password)));
        $spendingpassword_value = hash('sha256',addslashes(strip_tags($spendingpassword)));

        
        $qstring = "insert into `users`( `date`, `ip`, `username`, 
        `encrypt_username`, `password`, `transcation_password`, 
        `email`) values (";
        $qstring .= "now(), ";
        $qstring .= "'".$_SERVER['REMOTE_ADDR']."', ";
        $qstring .= "'".$email_id."', ";
        $qstring .= "'".hash('sha256',$email_id)."', ";
        $qstring .= "'".$password_value."', ";
        $qstring .= "'".$spendingpassword_value."', ";
        $qstring .= "'".$email_id."') ";
    //  echo $qstring;
        $result2    = $mysqli->query($qstring);
        
        if ($result2)
        {
            //  $user2 = $result2->fetch_assoc();
            //var_dump($user);
            //  header("Location:login.php");
            $email_id = "";
            $password = "";
            $confirmpassword = "";
            $spendingpassword = "";
            $confirmspendingpassword = "";
            $error['emailError2'] = "Your Account has successfully register. Please Login to continue";
        }
    }
}       
?>
<!DOCTYPE html>
<html lang="en" class="gr__wrappixel_com">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $coin_fullname;?>(<?php echo $coin_short;?>)">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <title>Wallets | <?php echo $coin_fullname;?>(<?php echo $coin_short;?>)</title>
    <!-- Bootstrap Core CSS -->
    <link href="./login/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(./img/1.jpg);background-size: contain;background-position-x: -134px;">
  <div class="login-box card">
    <div class="card-body">
      <form  method="post" action="signup.php" class="form-horizontal form-material"  id="loginform" >
       
        <a href="http://btgwallet.io" class="text-center db"><img src="./img/logo.png" alt="Home" style="width: 50%;"><br></a> 
        <h3 class="box-title m-t-40 m-b-0">Register Now</h3><small>Create your account and enjoy</small> 
        
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" id="txtEmailID" name="txtEmailID" placeholder="Email" value="<?php echo $email_id;?>">
            <?php if(isset($error['emailError'])) { echo "<br/><small class=\"messageClass text-danger\">".$error['emailError']."</small>";  }?>  
            <?php if(isset($error['emailError2'])) { echo "<br/><small class=\"messageClass2 text-success\">".$error['emailError2']."</small>";  }?>   
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="password" id="signuppassword" name="signuppassword" placeholder="Password" value="<?php echo $password;?>" >
            <?php if(isset($error['passwordError'])) { echo "<br/><small class=\"messageClass text-danger\">".$error['passwordError']."</small>";  }?>    
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $confirmpassword;?>" >
            <?php if(isset($error['confirmpasswordError'])) { echo "<br/><small class=\"messageClass text-danger\">".$error['confirmpasswordError']."</small>";  }?>  
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" id="spendingpassword" name="spendingpassword" placeholder="Spending Password" value="<?php echo $spendingpassword;?>">
            <?php if(isset($error['spendingpasswordError'])) { echo "<br/><small class=\"messageClass text-danger\">".$error['spendingpasswordError']."</small>";  }?>    
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" id="confirmspendingpassword" name="confirmspendingpassword" placeholder="Spending Confirm Password" value="<?php echo $confirmspendingpassword;?>">
            <?php if(isset($error['confirmspendingpasswordError'])) { echo "<br/><small class=\"messageClass text-danger\">".$error['confirmspendingpasswordError']."</small>";  }?>  
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" class="button Lockerblue ladda-button" id="btnsignup" name="btnsignup" value="Sign Up" type="submit">Sign Up</button>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Already have an account? <a href="login.php" class="text-info m-l-5"><b>Sign In</b></a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
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
</html>l
