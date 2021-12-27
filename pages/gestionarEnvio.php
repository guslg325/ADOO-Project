<?php
session_start();
$sesion = isset($_SESSION["login"]);

$conec = mysqli_connect("localhost","root","","squid");
mysqli_set_charset($conec,"utf8");

if($sesion == 1){
	$correo = $_SESSION["login"];
	$query = "SELECT * FROM cliente WHERE correo_cliente = '$correo'";
	$respuesta = mysqli_query($conec,$query);
	$usuario = mysqli_fetch_row($respuesta);

	$tipoUsuario = $usuario[1];
	switch($tipoUsuario){
		case 0://Index de cliente
			$nombre = $usuario[4];
			$query = "SELECT * FROM envio WHERE usuarioAsociado = $usuario[0]";
		break;
		case 1://Redirigir al panel del admin
			echo "<script> window.location.href = './pages/indexAdmin.html'; </script>";
		break;
		case 2://Redirigir al panel del repartidor

		break;
		case 3://Redirigir al panel del encargado de centro

		break;
	}
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
<title>Envios | Paquetería</title>
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
						$opciones = "<li><i class='fas fa-user-circle'></i> $nombre</li>
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
					$opciones = "<li><i class='fas fa-user-circle'></i> $nombre</li>
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
						<a href="./../index.php"><i class="fas fa-arrow-left"></i> Regresar</a>
						<div class="row">
							<h3>Gestión de Envios</h3>
						</div>
						<div class="row">
							<div class="col s12 m12">
								<table class="responsive-table">
									<thead>
										<tr>
											<th>#</th>
											<th>Numero de rastreo</th>
											<th>Fecha del envío</th>
											<th>Total</th>
											<th>Estatus</th>
											<th>Acción</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>9082320026</td>
											<td>25/11/2021</td>
											<td>$250</td>
											<td>En espera de recoleccion</td>
											<td>
												<a href="consultarEnvio.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
													<button type="button" class="btn yellow darken-2 center-align" style="width:26%;">Consultar envío</button>
												</a>
												<a href="modificarDatosEnvio.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
													<button type="button" class="btn yellow darken-2 center-align" style="width:25%;">Modificar datos</button>
												</a>
												<button type="button" class="btn yellow darken-2 center-align disabled" style="width:30%;">Realizar reclamo</button>
												<a href="facturar.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
													<button type="button" class="btn yellow darken-2 center-align" style="width:16%;">Facturar</button>
												</a>
												<br>
												<br>
												<button type="button" class="gestionarEnvio btn yellow darken-2 center-align" style="width:30%;">Consultar Factura</button>
											</td>
										<tr>
											<td>2</td>
											<td>8374027491</td>
											<td>17/12/2021</td>
											<td>$100</td>
											<td>Entregado</td>
											<td>
												<a href="consultarEnvio.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
													<button type="button" class="btn yellow darken-2 center-align" style="width:26%;">Consultar envío</button>
												</a>
												<a href="modificarDatosEnvio.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
													<button type="button" class="btn yellow darken-2 center-align" style="width:25%;">Modificar datos</button>
												</a>
												<a href="realizarReclamo.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
													<button type="button" class="btn yellow darken-2 center-align" style="width:30%;">Realizar reclamo</button>
												</a>
												<a href="facturar.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
													<button type="button" class="btn yellow darken-2 center-align" style="width:16%;">Facturar</button>
												</a>
												<br>
												<br>
												<button type="button" class="btn yellow darken-2 center-align gestionarEnvio" style="width:30%;">Consultar Factura</button>
											</td>
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