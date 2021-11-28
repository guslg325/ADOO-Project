<?php
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
			$respAX["codigo"] = 1;
			$respAX["msj"] = "Registro exitoso.";
		}
	}
}

echo json_encode($respAX);//Se le regresa al frontend el arreglo de respuesta

?>