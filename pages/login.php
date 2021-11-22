<?php
$conec = mysqli_connect("localhost","root","","login");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}

$correo = $_POST['correo'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
$pass = $_POST['contrasena'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO

if($correo=='' OR $pass==''){
	header("Location: login.html");//MANDAMOS A LA MISMA PAGINA DE LOGIN
	//echo "Error".$nombre;
}
else
{
	$query = mysqli_query($conec,"SELECT * FROM login WHERE correo = '".$correo."' and password = '".$pass."'");//QUERY
	$vali = mysqli_num_rows($query);//CONTAMOS LAS COLUMNAS QUE ARROJA EL QUERY
	if($vali==1)//SI DETECTA UNA COLUMNA, ES QUE SI EXISTE EL USUARIO CON LA CONTRASENA
	{
		header("Location: indexCliente.html");//MANDAMOS AL INDEX DEL CLIENTE
		//echo "Bienvenido".$nombre;
	}
	else if ($vali == 0)//SI NO EXISTE COLUMNA, ES QUE NO EXISTE EL USUARIO EN LA BASE
	{
		header("Location: login.html");//MANDAMOS A LA MISMA PAGINA DEL LOGIN
		//echo "Error".$nombre;
	}
}
?>
