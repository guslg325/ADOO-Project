<?php
session_start();
$conec = mysqli_connect("localhost:33066","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
mysqli_set_charset($conec,"utf8");
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}
//DECLARACION DE VARIABLES
$selectTipoOrigen = $_POST['selectTipoOrigen'];
$selectTipoDestino = $_POST['selectTipoDestino'];
$tipoPaquete = $_POST['tipoPaquete'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
$error = 0;
$respAX = array();

if($selectTipoOrigen == $selectTipoDestino){
  if($selectTipoOrigen == '2'){
    if($_POST['centroOrigenC'] == $_POST['centroDestinoC']){
      $respAX["codigo"]=0;
      $respAX["msj"]="Destino no válido.";
      $error = 1;
    }
  }
}

if($selectTipoOrigen == '1'){// PARA DOMICILIO
  $cpOrigenD = $_POST['cpOrigenD'];
  $resultado = mysqli_query($conec,"SELECT * FROM estados WHERE CP = '$cpOrigenD'");//QUERY
  //Valida que la consulta esté bien hecha
  if($resultado){
    //Ahora valida que la consuta haya traido registros
    if( mysqli_num_rows( $resultado ) > 0){
      //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
      while($fila = mysqli_fetch_array( $resultado ) ){
        //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
        //un campo en tu DB llamado NOMBRE, así accederías
        $lat1=$fila['Latitud'];
        $lon1=$fila['Longitud'];
      }
    }
  }
}
if($selectTipoOrigen == '2'){ //para el centro
  $centroOrigenC = $_POST['centroOrigenC'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
  $r1 = mysqli_query($conec,"SELECT * FROM centros WHERE id = '$centroOrigenC'");//QUERY
  //Valida que la consulta esté bien hecha
  if( $r1 ){
    //Ahora valida que la consuta haya traido registros
    if( mysqli_num_rows( $r1 ) > 0){
      //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
      while($fila = mysqli_fetch_array( $r1 ) ){
        //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
        //un campo en tu DB llamado NOMBRE, así accederías
        $cpOrigenD=$fila['CP'];
      }
    }
  }
  $resultado = mysqli_query($conec,"SELECT * FROM estados WHERE CP = '$cpOrigenD'");//QUERY
  //Valida que la consulta esté bien hecha
  if( $resultado ){
    //Ahora valida que la consuta haya traido registros
    if( mysqli_num_rows( $resultado ) > 0){
      //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
      while($fila = mysqli_fetch_array( $resultado ) ){
        //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
        //un campo en tu DB llamado NOMBRE, así accederías
        $lat1=$fila['Latitud'];
        $lon1=$fila['Longitud'];
      }
    }
  }
}

if($selectTipoDestino=='1'){ //DOMICILIO
  $cpDestinoD = $_POST['cpDestinoD'];
  $resultado2 = mysqli_query($conec,"SELECT * FROM estados WHERE CP = '$cpDestinoD'");//QUERY
  //Valida que la consulta esté bien hecha
  if( $resultado2 ){
      //Ahora valida que la consuta haya traido registros
      if( mysqli_num_rows( $resultado2 ) > 0){
        //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
        while($fila2 = mysqli_fetch_array( $resultado2 ) ){
          //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
          //un campo en tu DB llamado NOMBRE, así accederías
          $lat2=$fila2['Latitud'];
          $lon2=$fila2['Longitud'];
        }
      }
    }
}
if($selectTipoDestino=='2'){//para el centro
  $centroDestinoC = $_POST['centroDestinoC'];//RECUPERAMOS LA VARABLE DEL FORMULARIO
  $r2 = mysqli_query($conec,"SELECT * FROM centros WHERE id = '$centroDestinoC'");//QUERY
 //Valida que la consulta esté bien hecha
 if( $r2 ){
     //Ahora valida que la consuta haya traido registros
     if( mysqli_num_rows( $r2 ) > 0){
        //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
        while($fila = mysqli_fetch_array( $r2 ) ){
    
          //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
          //un campo en tu DB llamado NOMBRE, así accederías
          $cpDestinoD=$fila['CP'];
        }
      }
  }
  $resultado = mysqli_query($conec,"SELECT * FROM estados WHERE CP = '$cpDestinoD'");//QUERY
  //Valida que la consulta esté bien hecha
  if( $resultado ){
      //Ahora valida que la consuta haya traido registros
      if( mysqli_num_rows( $resultado ) > 0){
        //Mientras mysqli_fetch_array traiga algo, lo agregamos a una variable temporal
        while($fila = mysqli_fetch_array( $resultado ) ){
          //Ahora $fila tiene la primera fila de la consulta, pongamos que tienes
          //un campo en tu DB llamado NOMBRE, así accederías
          $lat2=$fila['Latitud'];
          $lon2=$fila['Longitud'];
        }
      }
  }
}
    //fuera
    $radius = 6371;      // Earth's radius (miles)
    $deg_per_rad = 57.29578;  // Number of degrees/radian (for conversion)

    $distance = ($radius * pi() * sqrt(
                ($lat1 - $lat2)
                * ($lat1 - $lat2)
                + cos($lat1 / $deg_per_rad)  // Convert these to
                * cos($lat2 / $deg_per_rad)  // radians for cos()
                * ($lon1 - $lon2)
                * ($lon1 - $lon2)
        ) / 180); // DISTANCIA ENTRE DOS CODIGOS POSTALES

    
    if($tipoPaquete == '1'){ //sobre
      $pesoVolumetrico=(32*24*1)/5000;
    }
    if($tipoPaquete == '2'){ //sobre
      $pesoVolumetrico=(15*15*15)/5000;
    }
    if($tipoPaquete == '3'){ //sobre
      $pesoVolumetrico=(25*25*25)/5000;
    }
    if($tipoPaquete == '4'){ //sobre
      $pesoVolumetrico=(40*40*40)/5000;
    }

    $pkm = ($distance/10);
    $aumentos = intval($pkm);
    $cotizacion = (100*$aumentos)*($pesoVolumetrico/100);

    if($error==0){
      $respAX["codigo"] = 1; //Codigo de estado que se devuevle para determinar el estado del login 1=exito, 0=error
	    $respAX["msj"] = "Con los datos ingresados, su envío tendría un costo de $".$cotizacion."<br>
       con un peso volumétrico de ".$pesoVolumetrico."<br> y una distancia entre origen y destino de ".round($distance,2)." km";//Mensaje que se desplegara en el alert
    }    
    echo json_encode($respAX);
?>
