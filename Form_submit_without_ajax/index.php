<?php
    
    include 'database.inc.php';

    $msg="";
    
    if(isset($_POST['submit'])){
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
        // message send to user email from admin email End here //
        
    }

?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Contact Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	  <link href="style.css" rel="stylesheet">
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container contact">
         <div class="row">
            <div class="col-md-3">
               <div class="contact-info">
                  <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
                  <h2>Contact Us</h2>
                  <h4>We are waiting for your feedback !</h4>
                  <h4>Admin: Md. Najmul Ovi</h4>
               </div>
            </div>
            <div class="col-md-9">
               <form method="post" id="frmContactus">
					<div class="contact-form">
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="name">Name:</label>
						 <div class="col-sm-10">          
							<input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="email">Email:</label>
						 <div class="col-sm-10">
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="mobile">Mobile:</label>
						 <div class="col-sm-10">
							<input type="text" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile" required>
						 </div>
					  </div>
					  
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="comment">Comment:</label>
						 <div class="col-sm-10">
							<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
						 </div>
					  </div>
					  <div class="form-group">
						 <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" name="submit" id="submit">Submit</button>
							<span style="color:green;"><?php echo $msg;?></span>
						 </div>
					  </div>
				   </div>
			   </form>
            </div>
         </div>
      </div>
   </body>
</html>