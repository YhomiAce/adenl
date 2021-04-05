<?php

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	if(isset($_POST['action']) && $_POST['action'] === "send_invoice"){
		
		print_r($_POST);
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$email1 = htmlspecialchars($_POST['email1']);
		$email2 = htmlspecialchars($_POST['email2']);
		$phone = htmlspecialchars($_POST['phone']);
		$package = htmlspecialchars($_POST['package']);
		$price = htmlspecialchars($_POST['price']);
		

		$to = 'kareemyomi91@gmail.com';
		$subject = 'Invoice Reciept';
		$address = array($email,$email1,$email2);

		
		// if(mail($to,$subject,$message,$headers)){
		// 	echo "Email sent Successfully";
		// }else{
		// 	echo "Email Not Sent";
		// }
		
		try{
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->SMTPDebug  = 1; 
			$mail->Username   = 'kareemyomi91@gmail.com';                    
			$mail->Password   = '18081995';                              
			$mail->SMTPSecure = 'tls';         
			$mail->Port       = 587;

			$mail->setFrom($to,'Kreative');
			foreach($address as $receipient){
				$mail->ClearAllRecipients();
				$mail->AddAddress($receipient);
				$headers = "From: " . $receipient. "\r\n";
				$headers .= "Reply-To: ". $receipient . "\r\n";
				$headers .= "CC: test@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				$message = '<html><body>';
				$message .= '<h1>Hello From Kreative!</h1>';
				$message .= '<div>';
				$message .= '<h2>Your Invoice Reciept: Test Mode</h2>';
				$message .= '<h2>Name: '. $name.'</h2>';
				$message .= '<h2>Email:  '.$receipient.' </h2>';
				$message .= '<h2>Phone:'.$phone.' </h2>';
				$message .= '<h2>Package: '.$package.' </h2>';
				$message .= '<h2>Price: '.$price.' </h2>';
				
				$message .= '</div>';
				$message .= "</body></html>";
				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $message;
				$mail->send();
				echo 'Your mail has been sent successfully.';

			}
			// $mail->addAddress("mail@gmail.com");

			
		}catch(Exception $e){
			echo 'Unable to send email. Please try again.';
		}
		
	}

	

?>