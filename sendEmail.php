<?php
	require_once "db.php";
    require_once "controller.php";
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	if(isset($_POST['action']) && $_POST['action'] === "send_invoice"){
		
		// print_r($_POST);
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$email1 = htmlspecialchars($_POST['email1']);
		$email2 = htmlspecialchars($_POST['email2']);
		$phone = htmlspecialchars($_POST['phone']);
		$package = htmlspecialchars($_POST['package']);
		$price = htmlspecialchars($_POST['price']);
		$approve = htmlspecialchars($_POST['approved_by']);
		

		$to = 'info@adeyinkaesther.com.ng';
		$subject = 'E-Receipt';
		$address = array($email,$email1,$email2);
		$msg = "Note: This Payment is NOT for VISA. It is refundable if the company does not deliver within 10-Month from date therein.";
		$msg2 = "Any misrepresentation (Documents) to the company will have negative effects on T&C.";
		
	
		
		try{
			$mail->isSMTP();
			$mail->Host = 'mail.adeyinkaesther.com.ng';
			$mail->SMTPAuth = true;
			$mail->SMTPDebug  = 0; 
			$mail->Username   = 'info@adeyinkaesther.com.ng';                    
			$mail->Password   = 'chairman@2020!!';                              
			$mail->SMTPSecure = 'tls';         
			$mail->Port       = 26;

			$mail->setFrom($to,'Adeyinka Esther Nig. LTD');
			foreach($address as $receipient){
				$mail->ClearAllRecipients();
				$mail->AddAddress($receipient);
				$headers = "From: " . $receipient. "\r\n";
				$headers .= "Reply-To: ". $receipient . "\r\n";
				$headers .= "CC: test@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				$message = '<html><body>';
				$message .= '<img src="https://res.cloudinary.com/yhomi1996/image/upload/v1617817765/logo_zxj6dm.png" alt="Logo">';
				$message .= '<h1>Hello From Adeyinka Esther Nig. LTD!</h1>';
				
				$message .= '<div>';
				$message .= '<h2>Your E–Receipt From A.D.E.N.L</h2>';
				$message .= '<h2>Name: '. $name.'</h2>';
				$message .= '<h2>Email:  '.$email.' </h2>';
				$message .= '<h2>Phone: '.$phone.' </h2>';
				$message .= '<h2>Package: '.$package.' </h2>';
				$message .= '<h2>Price: '.$price.' </h2>';
				$message .= '<h4>You can contact us on: <a href="mailto:info@adeyinkaesther.com.ng">info@adeyinkaesther.com.ng</a> </h4>';
				$message .= '<br>';
				$message .= '<br>';
				$message .= '<h4 style="color:rgb(225,173,1);">Disclaimer: <h4></p>'.$msg.' </p>';
				$message .= '<p>'.$msg2.' </p>';
				
				$message .= '</div>';
				$message .= "</body></html>";
				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $message;
				$mail->send();
				
			}
			saveInvoice($conn,$name,$email,$phone,$package,$price,$approve);
			echo "success";
			
		}catch(Exception $e){
			echo 'Unable to send email. Please try again.';
		}
		
	}

	

?>