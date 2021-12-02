<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
mysqli_set_charset($conec,"utf8");//Permite el uso de acentos en las vocales

if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}

$correo = $_POST['correo'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
$user = $_POST['usuario'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
$pass = $_POST['contrasena'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO

$respAX = array();//arreglo que contendra la respuesta ajax

if($correo=='' OR $user=='' OR $pass==''){
	$respAX["codigo"] = 0;
	$respAX["msj"] = "Dato requerido faltante.";
}
else
{
	$verificar_correo = mysqli_query($conec,"SELECT * FROM cliente WHERE correo_cliente='$correo'");
	if(mysqli_num_rows($verificar_correo) > 0){//Ya esta registrado ese correo
		$respAX["codigo"] = 0; //Codigo de error para el frontend 1=exito, 0=error
		$respAX["msj"] = "El correo electrónico coincide con una cuenta existente.";//Mensaje a mostrar en el frontend
	}else{
		$query = mysqli_query($conec,"INSERT INTO cliente VALUES('','0','$correo','$pass','$user',' ',' ',' ',' ')");//QUERY
		if(!$query){
			$respAX["codigo"] = 0;
			$respAX["msj"] = "Error al ejecutar la query.";
		}else{
			try {
				//Server settings
				$mail->SMTPDebug  = SMTP::DEBUG_SERVER;             //Send using SMTP
				$mail->isSMTP();                                    //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';               //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                           //Enable SMTP authentication
				$mail->Username   = 'maildelproyectoescolar@gmail.com';         //SMTP username
				$mail->Password   = 'L4C0ntr4s3naM4sD1f1c1lD3lMund0';             //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
				$mail->Port       = 587;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
			
				//Recipients
				$mail->setFrom('maildelproyectoescolar@gmail.com', 'Paqueteria SQUID');
				$mail->addAddress($correo);     //Add a recipient
			
				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Paquetería SQUID - Registro Exitoso.';
				$mail->Body    = "<h1>Paquetería SQUID - Manejo de cuentas de usuario</h1><h3>Estimado(a) Usuario(a)</h3><h5>Usted se ha registrado exitosamente.<br>
				Puede ingresar con el siguiente link <a href=localhost/ADOO-Project/pages/login.html>INICIAR SESIÓN.</a></h5>";
			
				$mail->send();//Se envia el mail
				
			} catch (Exception $e) {
				$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
				$respAX["msj"] = "Error al enviar correo: {$mail->ErrorInfo}";//Mensaje que se desplegara en el alert
			}
			$respAX["codigo"] = 1;
			$respAX["msj"] = "Correo de bienvenida enviado. No olvide revisar SPAM.";
		}
	}
}

echo json_encode($respAX);//Se le regresa al frontend el arreglo de respuesta

?>
