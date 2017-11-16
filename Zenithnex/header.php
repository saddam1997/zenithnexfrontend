<?php
include_once('common.php');

/*page_protect();
if(!isset($_SESSION['user_id']))
{
    header("location:logout.php");
}*/

@$user_email = $_SESSION['user_session'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="BTG wallet">
    <meta name="author" content="Bitcoin cash Foundation">
    <meta name="keyword" content="BTG Wallet, bitcoin cash, bitcoin, wallet, bcc, bch, btc bch">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>ZenithNEX
    </title>

    <!-- Icons -->
    
    <link href="css/simple-line-icons.css" rel="stylesheet">
    <!-- MDL LIB --> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
     <!-- <script type="text/javascript" src="js/sails.io.js"></script> -->
    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script type="text/javascript">
        // io.sails.url = 'http://192.168.1.18:1338';
        url_api='http://192.168.1.18:1338';
    </script>
</head>


<body >
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">&#9776;</button>
        <a class="navbar-brand" href="#"></a>
        <!-- <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">&#9776;</button> -->

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown d-md-down-none">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i>
                    <span class="d-md-down-none"><?php echo $user_email;?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <a class="dropdown-item" href="securitycenter.php"><i class="fa fa-lock"></i> Security</a>
                    <a class="dropdown-item" href="contactus.php"><i class="fa fa-lock"></i> Contact</a>
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-lock"></i> Logout</a>
                    <!-- admin access -->
                    <?php 
                    if($_SESSION['user_admin'] == 1)
                    {
                        ?>
                        <a  class="dropdown-item" href="admin_user.php"><i class="fa fa-lock"></i>User list</a>
                        <?php
                    }
                    ?>  
                </div>
            </li>
        </ul>

    </header>

    <!-- <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><img src="img/target.png"> Dashboard </a>
                    </li>

                    
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link " href="myaddress.php"><img src="img/qr-code.png"> Myaddress</a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link" href="transactions.php"><img src="img/retweet.png"> Transactions</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="buybtg.php"><img src="img/bitcoin.png"> Buy BTG</a>
                    </li>
                    
                    <li class="divider"></li>
                    
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link" href="contactus.php"><img src="img/contract.png"> Contact US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="securitycenter.php"><img src="img/tools.png"> Security Center</a>
                    </li>
                    <?php 
                    if($_SESSION['user_admin'] == 1)
                    {
                        ?>
                        <li  class="nav-item" id="ms6">
                            <a class="nav-link" href="admin_user.php" class="collapsible-header">
                                <img src="img/retweet.png"> User list</a></li>
                                <?php
                            }
                            ?>  
                        </ul>
                    </nav>
                </div>

                <!-- Main content -->
                <main class="main">
                 <div class="row balance-div">
                    <div class="col-md-12">

                        <ul class="nav">

                            <li class="nav-item">
                                <a class="nav-link" href="index.php"><img src="img/target.png"> Dashboard </a>
                            </li>

                            <!-- <li class="nav-item nav-dropdown">
                                <a class="nav-link " href="myaddress.php"><img src="img/qr-code.png"> Myaddress</a>
                            </li> -->
                            <li class="nav-item nav-dropdown">
                                <a class="nav-link" href="transactionsbtc.php"><img src="img/retweet.png"> Funds</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="trade.php"><img src="img/bitcoin.png"> Trade </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="markettrade.php"><img src="img/bitcoin.png"> Market</a>
                            </li>

                            <li class="nav-item nav-dropdown">
                                <a class="nav-link" href="contactus.php"><img src="img/contract.png"> Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="securitycenter.php"><img src="img/tools.png"> Security Center</a>
                            </li>

                            <?php 
                            if(@$_SESSION['user_admin'] == 1)
                            {
                                ?>
                                <li  class="nav-item" id="ms6">
                                    <a class="nav-link" href="admin_user.php" class="collapsible-header">
                                        <img src="img/user.png"> User list</a></li>
                                        <?php
                                    }
                                    ?> 
                                    <!-- <span class="nav-link" style="padding: 12px;padding-left: 280px; font-size: medium;"> <?php echo $user_current_balance_BTC ?> BTC &nbsp;&nbsp;&nbsp;&nbsp;|</span>
                                    <span class="nav-link" style="padding: 12px;font-size: medium;"><?php echo $user_current_balance ?> BTG</span>  -->
                        </ul>

                    </div>
                </div>

