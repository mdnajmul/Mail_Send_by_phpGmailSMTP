<?php
    
    include 'database.inc.php';

    $msg="";
    
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['comment'])){
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
        $comment=mysqli_real_escape_string($con,$_POST['comment']);
        
        mysqli_query($con,"INSERT INTO contact_us(name,email,mobile,comment) VALUES('$name','$email','$mobile','$comment')");
        $msg="Successfully Submitted!";
        
        $html="<table><tr><td>Name: </td><td>$name</td></tr> <tr><td>Email: </td><td>$email</td></tr> <tr><td>Mobile: </td><td>$mobile</td></tr> <tr><td>Message: </td><td>$comment</td></tr></table>";
        
        // message send to email from admin email start from here //
            
            //include smtp autoload phpemail file
            include 'smtp/PHPMailerAutoload.php';
            //create a object of 'PHPMailer' class
            $mail=new PHPMailer(true);
        
            //integrate all setting of 'PHPMailer' class
            $mail->isSMTP();
            //$mail->SMTPDebug = 4; 
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure="tls";
            $mail->Host="smtp.gmail.com";
            $mail->Port=587;
            $mail->Mailer = "smtp";
            $mail->Username="neberhossain7@gmail.com";
            $mail->Password="01823260474";
            $mail->setFrom("neberhossain7@gmail.com");
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject="New Comment From Contact Form";
            $mail->Body=$html;
            $mail->SMTPOptions=array('ssl'=>array(
                'verify_peer'=>false,
                'verify_peer_name'=>false,
                'allow_self_signed'=>false
            ));
            $mail->send();
            echo $msg;
        // message send to user email from admin email End here //
        
    }

?>
