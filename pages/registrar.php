<?php
$conec = mysqli_connect("localhost","root","","login");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}

$correo = $_POST['correo'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
$user = $_POST['usuario'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
$pass = $_POST['contrasena'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO

if($correo=='' OR $user=='' OR $pass==''){
	header("Location: registrar.html");//MANDAMOS A LA MISMA PAGINA DE REGISTRAR
	//echo "Error".$nombre;
}
else
{
	$query = mysqli_query($conec,"INSERT INTO login VALUES('$correo','$user','$pass')");//QUERY
	header("Location: login.html");
}


if(!$query){
	echo"Hubo algun error";
	}
else
{
	header("Location: registrar.html");
	//echo "Error".$nombre;
}
?>