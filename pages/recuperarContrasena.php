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
mysqli_set_charset($conec,"utf8");
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}
$correo = $_POST['email'];//RECUPERAMOS LA VARABLE DEL FORMULARIO

$respAX = array();//arreglo que contendra la respuesta ajax
$query = mysqli_query($conec,"SELECT * FROM cliente WHERE correo_cliente = '$correo'");//QUERY
$vali = mysqli_num_rows($query);//CONTAMOS LAS COLUMNAS QUE ARROJA EL QUERY
if($vali==1)//SI DETECTA UNA COLUMNA, ES QUE SI EXISTE EL USUARIO CON LA CONTRASENA
{
    $rowUsuario = mysqli_fetch_row($query);
    $nombreUsuario = $rowUsuario[4];
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
        $mail->Subject = 'Paquetería SQUID - Recuperar Contraseña.';
        $mail->Body    = "<h1>Paquetería SQUID - Manejo de cuentas de usuario</h1><h3>Estimado(a) $nombreUsuario</h3><h5>Usted ha solicitado el restablecimiento de su contraseña.<br>
        Por favor ingrese al siguiente link <a href=localhost/ADOO-Project/pages/ingresarNuevaContrasena.html>RECUPERAR CONTRASEÑA.</a></h5>";
    
        $mail->send();//Se envia el mail
    } catch (Exception $e) {
        $respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	    $respAX["msj"] = "Error al enviar correo: {$mail->ErrorInfo}";//Mensaje que se desplegara en el alert
    }
	$_SESSION["reestablecer"] = $correo;//Crea una sesion con un campo 'login' que contendra el valor del correo
    $respAX["codigo"] = 1; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	$respAX["msj"] = "Correo de recuperación enviado. No olvide revisar SPAM.";//Mensaje que se desplegara en el alert
}
else//SI NO EXISTE COLUMNA, ES QUE NO EXISTE EL USUARIO EN LA BASE
{
	$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	$respAX["msj"] = "El correo ingresado no existe.";//Mensaje que se desplegara en el alert
}
echo json_encode($respAX);//Resultado que se regresara al js para mostrar el mensaje pertinente
?>
