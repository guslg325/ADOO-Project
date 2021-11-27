<?php
$conec = mysqli_connect("localhost","root","","login");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
mysqli_set_charset($conec,"utf8");//Permite el uso de acentos en las vocales

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
	$verificar_correo = mysqli_query($conec,"SELECT * FROM login WHERE correo='$correo'");
	if(mysqli_num_rows($verificar_correo) > 0){
		echo '
			<script>
				alert("Ya existe una cuenta asociada a este correo");
				window.location = "./registrar.html";
			</script>
		';
	}
	else{
		$query = mysqli_query($conec,"INSERT INTO login VALUES('$correo','$user','$pass')");//QUERY
	}
}


if(!$query){
	echo"Hubo algun error";
	}
else
{
	header("Location: login.html");
	//echo "Error".$nombre;
}

?>