<?php
session_start();
$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}

$pass1 = $_POST['contrasena'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
$pass2 = $_POST['confirmaContrasena'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
$correo = $_SESSION["reestablecer"];
//$respAX = array();//arreglo que contendra la respuesta ajax
if($pass1==$pass2){
    $query = mysqli_query($conec,"UPDATE cliente SET contrasena_cliente='$pass1' WHERE correo_cliente='$correo'");//QUERY
    $query2 = mysqli_query($conec,"SELECT * FROM cliente WHERE correo_cliente = '$correo' and contrasena_cliente='$pass1'");//QUERY
    $vali = mysqli_num_rows($query2);//CONTAMOS LAS COLUMNAS QUE ARROJA EL QUERY
    if($vali==1)//SI DETECTA UNA COLUMNA, ES QUE SI EXISTE EL USUARIO CON LA CONTRASENA
    {
	    //$respAX["codigo"] = 1; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
    	//$respAX["msj"] = "Inicio de sesión exitoso.";//Mensaje que se desplegara en el alert
    	//$_SESSION["login"] = $correo;//Crea una sesion con un campo 'login' que contendra el valor del correo
        header('Location: ingresarNuevaContrasena.html');
    }
    else//SI NO EXISTE COLUMNA, ES QUE NO EXISTE EL USUARIO EN LA BASE
    {
    	//$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
    	//$respAX["msj"] = "Correo o contraseña incorrecto.";//Mensaje que se desplegara en el alert
    	echo "Error en el segundo query ".$correo;
    }
}
else//SI NO EXISTE COLUMNA, ES QUE NO EXISTE EL USUARIO EN LA BASE
{
	//$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	//$respAX["msj"] = "Correo o contraseña incorrecto.";//Mensaje que se desplegara en el alert
	//echo "Error".$nombre;
    echo "Error no coinciden las contras".$correo;
}

//echo json_encode($respAX);//Resultado que se regresara al js para mostrar el mensaje pertinente
?>
