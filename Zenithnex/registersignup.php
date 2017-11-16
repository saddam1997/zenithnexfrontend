<?php

require_once 'dbconfig.php';

if($_POST)
{
    
    $user_email 	= $_POST['user_email'];
    $user_password 	= $_POST['mpassword'];
    $user_spendingpassword = $_POST['spassword'];
    
	
	//password_hash see : http://www.php.net/manual/en/function.password-hash.php
	$password 	= hash('sha256', $user_password);
    $spassword = hash('sha256',$user_spendingpassword);
    $enemail = hash('sha256',$user_email);
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('Y-m-d H:i:s');
	
    try
    {
        $stmt = $db_con->prepare("SELECT * FROM users WHERE username=:email");
        $stmt->execute(array(":email"=>$user_email));
        $count = $stmt->rowCount();
		
        if($count==0){
            $stmt = $db_con->prepare("INSERT INTO users(date, ip, username, encrypt_username,password, transcation_password,email) values (:date, :ip, :email, :enemail,:pass,:spass,:email)");

            $stmt->bindParam(":date",$date);
            $stmt->bindParam(":ip",$ip);
            $stmt->bindParam(":email",$user_email);
            $stmt->bindParam(":enemail",$enemail);
            $stmt->bindParam(":pass",$password);
            $stmt->bindParam(":spass",$spassword);
            $stmt->bindParam(":email",$user_email);
           
            if($stmt->execute())
            {
                echo "registered";
            }
            else
            {
                echo "Query could not execute !";
            }

        }
        else{

            echo "1"; //  not available
        }

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>