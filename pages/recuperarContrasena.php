<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}
$correo = $_POST['email'];//RECUPERAMOS LA VARABLE DEL FORMULARIO

//$respAX = array();//arreglo que contendra la respuesta ajax
$query = mysqli_query($conec,"SELECT * FROM cliente WHERE correo_cliente = '$correo'");//QUERY
$vali = mysqli_num_rows($query);//CONTAMOS LAS COLUMNAS QUE ARROJA EL QUERY
if($vali==1)//SI DETECTA UNA COLUMNA, ES QUE SI EXISTE EL USUARIO CON LA CONTRASENA
{
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'multides27@gmail.com';                     //SMTP username
        $mail->Password   = '5517006601Qwerty';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('multides27@gmail.com', 'Paqueteria SQUID');
        $mail->addAddress($correo);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Paqueteria SQUID. Recuperar Contraseña.';
        $mail->Body    = 'Usted ha solicitado el restablecimiento de su contraseña.<br>
        por favor ingrese al siguiente link <a href=localhost/adoo5/pages/ingresarNuevaContrasena.html>RECUPERAR CONTRASENA.</a>';
    
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

	//$respAX["codigo"] = 1; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	//$respAX["msj"] = "Inicio de sesión exitoso.";//Mensaje que se desplegara en el alert
	$_SESSION["reestablecer"] = $correo;//Crea una sesion con un campo 'login' que contendra el valor del correo
    // Enviamos el email
    //mail($correo, 'Paqueteria. Recuperar Contraseña:', 'Usted ha solicitado el restablecimiento de su contraseña,
    //por favor ingrese al siguiente link localhost/adoo5/pages/ingresarNuevaContrasena.html');
    //echo "Error".$correo;
    header('Location: recuperarContrasena.html');
}
else//SI NO EXISTE COLUMNA, ES QUE NO EXISTE EL USUARIO EN LA BASE
{
	//$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	//$respAX["msj"] = "Correo o contraseña incorrecto.";//Mensaje que se desplegara en el alert
	//echo "Error".$nombre;
    header('Location: recuperarContrasena2.html');
}

//echo json_encode($respAX);//Resultado que se regresara al js para mostrar el mensaje pertinente

?>
