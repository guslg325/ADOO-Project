<?php
session_start();

$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}

$correo = $_POST['correo'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
$pass = $_POST['contrasena'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
$respAX = array();//arreglo que contendra la respuesta ajax

if(empty($_POST['g-recaptcha-response'])){
	$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	$respAX["msj"] = "CAPTCHA no verificado.";//Mensaje que se desplegara en el alert
}else{
	$claveCaptcha = "6Lc3iHMdAAAAAK8JSR1KP-EaRjpVHNXKR2_kQdHw";//Clave del servidor
	//Validacion del captcha con el API de google
	$respuestaGoogle = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$claveCaptcha&response=".$_POST['g-recaptcha-response']);
	$datosRespuesta = json_decode($respuestaGoogle);//Convertir la respuesta del API de JSON a array()

	if(!$datosRespuesta->success){
		$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
		$respAX["msj"] = "CAPTCHA no verificado.";//Mensaje que se desplegara en el alert
	}else{
		$query = mysqli_query($conec,"SELECT * FROM cliente WHERE correo_cliente = '$correo' and contrasena_cliente = '$pass'");//QUERY
		$vali = mysqli_num_rows($query);//CONTAMOS LAS COLUMNAS QUE ARROJA EL QUERY
		if($vali==1)//SI DETECTA UNA COLUMNA, ES QUE SI EXISTE EL USUARIO CON LA CONTRASENA
		{
			$respAX["codigo"] = 1; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
			$respAX["msj"] = "Inicio de sesión exitoso.";//Mensaje que se desplegara en el alert
			$_SESSION["login"] = $correo;//Crea una sesion con un campo 'login' que contendra el valor del correo
		}
		else//SI NO EXISTE COLUMNA, ES QUE NO EXISTE EL USUARIO EN LA BASE
		{
			$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
			$respAX["msj"] = "Correo o contraseña incorrecto.";//Mensaje que se desplegara en el alert
			//echo "Error".$nombre;
		}
	}
}

echo json_encode($respAX);//Resultado que se regresara al js para mostrar el mensaje pertinente
?>
