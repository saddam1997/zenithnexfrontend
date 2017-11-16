<?php

require_once 'dbconfig.php';

if($_POST)
{

    $user_email = $_POST['user_email'];
    $new_password = "s!w@".rand(0,100000);
    $password   = hash('sha256', $new_password);


    try
    {
        $stmt = $db_con->prepare("SELECT * FROM users WHERE username=:email");
        $stmt->execute(array(":email"=>$user_email));
        $count = $stmt->rowCount();

        if($count==1){

            $sub =" Password Recovery Mail";
            $to = $user_email;
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= "From: Test <testmail1@mail.com>" . "\r\n";
            $message_body =" Dear User \n";
            $message_body .= " Your recovery password is $new_password \n\n";
            $message_body .= " Please login and change it immediately\n\n";
            $message_body .= " Thanks \n";
            $message_body .= " Administrator";
            $stmt = $db_con->prepare("UPDATE users SET password = :pass WHERE 
                username=:email");
            $stmt->bindParam(":email",$user_email);
            $stmt->bindParam(":pass",$password);
            $result = $stmt->execute();
            @mail($header,$to,$sub,$message_body);

            if($stmt->execute())
            {
                echo "send";
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