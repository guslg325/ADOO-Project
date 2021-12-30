<?php

//session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';

include("generarPDF.php");

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$correo1=$_SESSION["correo"];
echo $correo1;


		try {
				
				
				//Server settings
				//$mail->SMTPDebug  = SMTP::DEBUG_SERVER;             //Send using SMTP
				$mail->isSMTP();                                    //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';               //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                           //Enable SMTP authentication
				$mail->Username   = 'maildelproyectoescolar@gmail.com';         //SMTP username
				$mail->Password   = 'L4C0ntr4s3naM4sD1f1c1lD3lMund0';             //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
				$mail->Port       = 587;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
			
				//Recipients
				$mail->setFrom('maildelproyectoescolar@gmail.com', 'Paqueteria SQUID');
				$mail->addAddress($correo1);     //Add a recipient
				//PDF
				$file = basename("comprobante");
				$file .= '.pdf';
    			$pdf->Output($file, 'F');
    			$mail->addAttachment('comprobante.pdf');
				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Paquetería SQUID - Comprobante de Envío.';
				$mail->Body    = "<h1>Muchas gracias por su preferencia. </h1><br><h3>A continuación podrá consultar un PDF con los detalles de su envió.  
				</h3>";
			
				$mail->send();//Se envia el mail
				
			} catch (Exception $e) {
				echo ("Hubo un error");
			}
			
		
?>
