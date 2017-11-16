<?php

require_once 'dbconfig.php';
session_start();
if($_POST)
{
    
    $user_email     = $_POST['user_email'];
    $user_password  = $_POST['password'];
   
    
    //password_hash see : http://www.php.net/manual/en/function.password-hash.php
    $password   = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 11));
    
    try
    {
        $stmt = $db_con->prepare("SELECT * FROM users WHERE username=:email");
        $stmt->execute(array(":email"=>$user_email));
        $dataRows = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        
        if($count==1){
        $stmt = $db_con->prepare("SELECT * FROM users WHERE username=:email and password=:pass");
        
           
            $stmt->bindParam(":email",$user_email);
            $stmt->bindParam(":pass",$password);

            if($stmt->execute() && $count>0)
            {

                $_SESSION["user_id"] = $dataRows['username'];
                $_SESSION['user_session'] = $dataRows['username'];
                $_SESSION['user_admin'] = $dataRows['admin'];
                $_SESSION['is_email_verify'] = $dataRows['is_email_verify'];
                echo "login";

            }
            else
            {
                echo "Query could not execute !";
            }
     }
        else{

            echo "Email & Password Incorrect"; //  not available
        }


            
        }
        

    
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>