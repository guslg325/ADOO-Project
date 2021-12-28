<?php

$respAX = array();
//Create an instance; passing `true` enables exceptions
$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
mysqli_set_charset($conec,"utf8");//Permite el uso de acentos en las vocales

if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}
$datosOrigen=$_POST['selectTipoOrigen'];
$datosDestino=$_POST['selectTipoDestino'];
if($datosOrigen=='1'){
    $nombreO = $_POST['nameOrigen'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $calleO = $_POST['calleOrigen'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $municipioO = $_POST['muniOrigen'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
    $estadoO = $_POST['estadOrigen'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $cpO = $_POST['cpOrigenD'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $correoO = $_POST['correOrigen'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
    $telefonoO = $_POST['telOrigen'];//RECUPERAMOS LA VARABLE DEL FORMULARIO

}
if($datosOrigen=='2'){
    $centroO = $_POST['centroOrigenC'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $nombreO = $_POST['nameOrigenC'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $correoO = $_POST['correOrigenC'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
    $telefonoO = $_POST['telOrigenC'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
}
if($datosDestino=='1'){
    $nombreD = $_POST['nameDestino'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $calleD = $_POST['calleDestino'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $municipioD = $_POST['muniDestino'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
    $estadoD = $_POST['estadDestino'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $cpD = $_POST['cpDestinoD'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $correoD = $_POST['correDestino'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
    $telefonoD = $_POST['telDestino'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
}
if($datosDestino=='2'){
    $centroD = $_POST['centroDestinoC'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $nombreD = $_POST['nameDestinoC'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    $correoD = $_POST['correDestinoC'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
    $telefonoD = $_POST['telDestinoC'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
    //$query = mysqli_query($conec,"INSERT INTO envios VALUES(nombreO,calleO,municipioO,estadoO,cpO,correoO,telefonoO,nombreD,calleD,municipioD,estadoD,cpD,correoD,telefonoD,centroO,centroD,tipoPaquete)");//QUERY
}
$fecha = date("j/n/Y",$timestamp = time());
$tipoPaquete = $_POST['tipoPaquete'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
$idUsuario = $_POST['idUsuario'];
if($datosOrigen=='1' && $datosDestino=='1'){
    $query = mysqli_query($conec,"INSERT INTO envios VALUES('$nombreO','$calleO','$municipioO','$estadoO','$cpO','$correoO','$telefonoO','$nombreD','$calleD','$municipioD','$estadoD','$cpD','$correoD','$telefonoD',' ',' ','$tipoPaquete','','$idUsuario','0','$fecha')");//QUERY
}
if($datosOrigen=='1' && $datosDestino=='2'){
    $query = mysqli_query($conec,"INSERT INTO envios VALUES('$nombreO','$calleO','$municipioO','$estadoO','$cpO','$correoO','$telefonoO','$nombreD',' ',' ',' ',' ','$correoD','$telefonoD',' ','$centroD','$tipoPaquete','','$idUsuario','0','$fecha')");//QUERY 
}
if($datosOrigen=='2' && $datosDestino=='1'){
    $query = mysqli_query($conec,"INSERT INTO envios VALUES('$nombreO',' ',' ',' ',' ','$correoO','$telefonoO','$nombreD','$calleD','$municipioD','$estadoD','$cpD','$correoD','$telefonoD','$centroO',' ','$tipoPaquete','','$idUsuario','0','$fecha')");//QUERY 
}
if($datosOrigen=='2' && $datosDestino=='2'){
    $query = mysqli_query($conec,"INSERT INTO envios VALUES('$nombreO',' ',' ',' ',' ','$correoO','$telefonoO','$nombreD',' ',' ',' ',' ','$correoD','$telefonoD','$centroO','$centroD','$tipoPaquete','','$idUsuario','0','$fecha')");//QUERY 
}

$query2 = mysqli_query($conec, "SELECT * FROM envios WHERE usuarioAsociado = $idUsuario AND status = 0");
$respuesta = mysqli_fetch_row($query2);
$guia = $respuesta[17];

$respAX["codigo"]="1";
$respAX["msj"]="Envío validado con éxito.";
$respAX["guia"]=$guia;
echo json_encode($respAX);
?>
