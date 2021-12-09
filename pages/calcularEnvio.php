<?php
session_start();
$conec = mysqli_connect("localhost","root","","squid");//("localhost","USUARIO","CONTRASENA","AQUI ES EL NOMBRE DE LA BASE")
mysqli_set_charset($conec,"utf8");
if(!$conec)
{
	die("Error en la base".mysqli_connect_error());
}
//DECLARACION DE VARIABLES
$selectTipoOrigen = $_POST['selectTipoOrigen'];
$selectTipoDestino = $_POST['selectTipoDestino'];
$tipoPaquete = $_POST['tipoPaquete'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
$peso = $_POST['peso'];

if($selectTipoOrigen == '1'){// PARA DOMICILIO
  $cpOrigenD = $_POST['cpOrigenD'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
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
  $cpDestinoD = $_POST['cpDestinoD'];//RECUPERAMOS LA CONTRASENA DEL FORMULARIO
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
      $cota=50+(5*$peso);
    }
    if($tipoPaquete == '2'){ //sobre
      $cota=400+(10*$peso);
    }
    if($tipoPaquete == '3'){ //sobre
      $cota=650+(15*$peso);
    }
    if($tipoPaquete == '4'){ //sobre
      $cota=800+(20*$peso);
    }
    if($distance>=100){
      $pkm=($distance/100)*3; // PRECIO EXTRA A PARTIR DE 100 KM
      $cota=$cota+$pkm;
    }
    
    $redon=round($cota,2); //PRECIO DE LA COTIZACION FINAL
    
?>
