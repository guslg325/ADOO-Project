<?php
$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
mysqli_set_charset($conec,"utf8");
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}

$guia = $_POST['numRastreo'];
$estatus = $_POST['estatus'];
$nuevoEstatus = $_POST['nuevoEstatus'];

$respAX = array();//arreglo que contendra la respuesta ajax

if($estatus!=$nuevoEstatus){
    $query = mysqli_query($conec,"UPDATE envios SET status='$nuevoEstatus' WHERE guia='$guia'");//QUERY
    $query2 = mysqli_query($conec,"SELECT * FROM envios WHERE guia = '$guia' and status='$nuevoEstatus'");//QUERY
    $vali = mysqli_num_rows($query2);//CONTAMOS LAS COLUMNAS QUE ARROJA EL QUERY
    if($vali==1)//SI DETECTA UNA COLUMNA, ES QUE SI EXISTE EL USUARIO CON LA CONTRASENA
    {
	    $respAX["codigo"] = 1; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
    	$respAX["msj"] = "Estatus actualizado con éxito.";//Mensaje que se desplegara en el alert
    }
    else//SI NO EXISTE COLUMNA, ES QUE NO EXISTE EL USUARIO EN LA BASE
    {
    	$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
    	$respAX["msj"] = "Error al actualizar la base de datos.";//Mensaje que se desplegara en el alert
    }
}
else//Los estatus son iguales
{
	$respAX["codigo"] = 0; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	$respAX["msj"] = "El nuevo estatus debe ser diferente al actual.";//Mensaje que se desplegara en el alert
}

echo json_encode($respAX);//Resultado que se regresara al js para mostrar el mensaje pertinente
?>