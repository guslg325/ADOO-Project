<?php
	$respAX = array();
	//Create an instance; passing `true` enables exceptions
	$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
	mysqli_set_charset($conec,"utf8");//Permite el uso de acentos en las vocales

	if(!$conec){
		die("Error en la base".mysqli_connect_error());
	}
	$guia = $_POST['guia'];
	$query = mysqli_query($conec,"UPDATE envios SET status = 1 WHERE guia = $guia");
	$respAX['codigo'] = 1;
	$respAX['msj'] = "Pago realizado con éxito.";

	echo json_encode($respAX);
?>