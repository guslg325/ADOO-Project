<?php
session_start();

$conec = mysqli_connect("localhost","root","","login");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}

$correo = $_POST['correo'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
$pass = $_POST['contrasena'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO

$respAX = array();
$query = mysqli_query($conec,"SELECT * FROM login WHERE correo = '$correo' and password = '$pass'");//QUERY
$vali = mysqli_num_rows($query);//CONTAMOS LAS COLUMNAS QUE ARROJA EL QUERY
if($vali==1)//SI DETECTA UNA COLUMNA, ES QUE SI EXISTE EL USUARIO CON LA CONTRASENA
{
	$respAX["codigo"] = 1; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	$respAX["msj"] = "Inicio de sesión exitoso.";//Mensaje que se desplegara en el alert
	$_SESSION["login"] = $correo;//Crea una sesion con un campo 'login' que contendra el valor del correo
	//echo "Bienvenido".$nombre;
}
else//SI NO EXISTE COLUMNA, ES QUE NO EXISTE EL USUARIO EN LA BASE
{
	$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	$respAX["msj"] = "Correo o contraseña incorrecto.";//Mensaje que se desplegara en el alert
	//echo "Error".$nombre;
}

echo json_encode($respAX);//Resultado que se regresara al js para mostrar el mensaje pertinente
?>