<?php
session_start();
$sesion = isset($_SESSION["login"]);

$conec = mysqli_connect("localhost","root","","login");
mysqli_set_charset($conec,"utf8");

if($sesion == 1){
	//Hay sesion de usuario
	$correo = $_SESSION["login"];
	$query = "SELECT * FROM login WHERE correo = '$correo'";
	$respuesta = mysqli_query($conec,$query);
	$usuario = mysqli_fetch_row($respuesta);

	$nombre = $usuario[1];
}else{
	//No hay sesión de usuario
	header("location: ./login.html");
}
?>

<!--***************
	Inicia HTML
****************-->
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Centros de distribución</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="./../materialize/css/materialize.min.css" rel="stylesheet">
<link href="./../js/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css" rel="stylesheet">
<link href="./../css/general.css" rel="stylesheet">
<script src="./../js/jquery-3.6.0.min.js"></script>
<script src="./../js/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js"></script>
<script src="./../materialize/js/materialize.min.js"></script>
<script src="./../js/index.js"></script>
<script src="./../js/gestionarEnvio.js"></script>
</head>

<body>
	<header>
		<nav class="yellow darken-2">
			<div class="nav-wrapper">
			<a href="./../index.php" class="brand-logo"><img src="./../img/boxLogo50.png"></a>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
			<ul class="right hide-on-med-and-down">
				<?php
					if($sesion){
						//Hay sesion de usuario, muestra menú personalizado
						$opciones = "<li><a href='./ingresarNuevaContrasena.php'><i class='fas fa-user-circle'></i> $nombre</li></a>
						<li><a href='./realizarEnvio.php'>Realizar envío</a></li>
						<li><a href='./gestionarEnvio.php'>Gestionar envío</a></li>
						<li><a href='./cotizarEnvio.php'>Cotizar un envío</a></li>";
						echo $opciones;
					}else{
						//No hay sesion de usuario
					}
				?>
				<li><a href='./rastrear.php'>Rastrear paquete</a></li>
					<li><a href='<?php if($sesion) echo "./logout.php"; else echo "./login.html";?>'><?php if($sesion) echo "Cerrar sesión"; else echo "Iniciar sesión";?></a></li>
			</ul>
			</div>
		</nav> <!-- /menu -->
		<ul class="sidenav" id="mobile-demo">
			<?php
				if($sesion){
					//Hay sesion de usuario, muestra menú personalizado
					$opciones = "<li><a href='./ingresarNuevaContrasena.php'><i class='fas fa-user-circle'></i> $nombre</li></a>
					<li><a href='./realizarEnvio.php'>Realizar envío</a></li>
					<li><a href='./gestionarEnvio.php'>Gestionar envío</a></li>
					<li><a href='./cotizarEnvio.php'>Cotizar un envío</a></li>";
					echo $opciones;
				}else{
					//No hay sesion de usuario
				}
			?>
			<li><a href='<?php if($sesion) echo "./logout.php"; else echo "./login.html";?>'><?php if($sesion) echo "Cerrar sesión"; else echo "Iniciar sesión";?></a></li>
			<li><a href='./rastrear.php'>Rastrear paquete</a></li>
			<li><a href="./../index.php"> Pagina inicial </a></li>
		</ul> <!-- /menu celular-->
	</header>

	<main>
        <div class="container">
			<div class="card">
                <div class="card-stacked">
					<div class="card-content">
                        <div class="row">
                            <div class="col s12 m6">
                                 <a href="./../index.php"><i class="fas fa-arrow-left"></i> Regresar</a>  
                            </div>
							<div class="input-field col s12 m6">
                                    <i class="material-icons prefix fas fa-search"></i>
                                    <input type="text" id="buscarCentros" class="autocomplete">
                                    <label for="buscarCentros">Ingresa tu ubicación</label>
                            </div>    
                        </div>

                        <h3>&nbspCentros de Distribución</h3>

                        <div class="row">
							<div class="col s12 m12">
								<table class="responsive-table">
									<thead>
										<tr>
											<th>Id</th>
											<th>Dirección</th>
											<th>Telefono de contacto</th>
                                            <th>Horario</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Via Morelos Núm. 178-G Ecatepec, Ciudad de México 55080</td>
											<td>55 1115 5030</td>
                                            <td>De Lunes a Sabado de 11:00 am a 7:00 pm</td>
                                        </tr>
										<tr>
											<td>2</td>
											<td>Av. Central Fracc. VI Lt. 5. Sta Cruz Venta Carpio Ecatepec de Morelos, Estado de México 55065</td>
											<td>55 8912 9502</td>
                                            <td>De Lunes a Sabado de 9:30 am a 6:00 pm</td>
                                        </tr>
                                        <tr>
											<td>3</td>
											<td>Av. José López Portillo, Local L-04 55010 Ecatepec, Ciudad de México MX</td>
											<td>55 2622 4932</td>
                                            <td>De Martes a Domingo de 9:00 am a 7:00 pm</td>
                                        </tr>
									</tbody>
								</table>   
							</div>
						</div>
					</div>	
				</div>
			</div>	
        </div>

	</main>	

	<footer class="page-footer yellow darken-2">
		<div class="container">
		  <div class="row">
		  <div class="col s12 m4 l2"><p></p></div>
			<div class="col s12 m12 l8 center-align">
			  <h5 class="white-text">Agradecemos tu preferencia</h5>
			</div>
			<div class="col s12 m4 l2"><p></p></div>
		</div>
		</div>
		<div class="footer-copyright">
		  	<div class="container">
				© 2021 Copyright
				<a class="grey-text text-lighten-4 right" href="./../index.php">TeamSquid</a>
		  	</div>
		</div>
	</footer>

</body>
</html> 