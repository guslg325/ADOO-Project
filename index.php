<?php
session_start();
$sesion = isset($_SESSION["login"]);

$conec = mysqli_connect("localhost","root","","squid");
mysqli_set_charset($conec,"utf8");

if($sesion == 1){
	//Hay sesion de usuario
	$correo = $_SESSION["login"];
	$query = "SELECT * FROM cliente WHERE correo_cliente = '$correo'";
	$respuesta = mysqli_query($conec,$query);
	$usuario = mysqli_fetch_row($respuesta);

	$tipoUsuario = $usuario[1];
	switch($tipoUsuario){
		case 0://Index de cliente
			$nombre = $usuario[4];
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
<title>Inicio | Paquetería</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="./materialize/css/materialize.min.css" rel="stylesheet">
<link href="./css/general.css" rel="stylesheet">
<script src="./js/jquery-3.6.0.min.js"></script>
<script src="./materialize/js/materialize.min.js"></script>
<script src="./js/index.js"></script>
</head>
<body>
	<header>
		<nav class="yellow darken-2">
			<div class="nav-wrapper">
			<a href="index.php" class="brand-logo"><img src="./img/boxLogo50.png"></a>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
			<ul class="right hide-on-med-and-down">
				<?php
					if($sesion){
						//Hay sesion de usuario, muestra menú personalizado
						$opciones = "<li><i class='fas fa-user-circle'></i> $nombre</li>
						<li><a href='./pages/realizarEnvio.php'>Realizar envío</a></li>
						<li><a href='./pages/gestionarEnvio.php'>Gestionar envío</a></li>
						<li><a href='./pages/cotizarEnvio.php'>Cotizar un envío</a></li>";
						echo $opciones;
					}else{
						//No hay sesion de usuario
					}
				?>
					<?php if(!$sesion) echo "<li><a href='./pages/registrar.html'>Crear cuenta</a></li>";?>
					<li><a href='./pages/rastrear.php'>Rastrear paquete</a></li>
					<li><a href='<?php if($sesion) echo "./pages/logout.php"; else echo "./pages/login.html";?>'><?php if($sesion) echo "Cerrar sesión"; else echo "Iniciar sesión";?></a></li>
			</ul>
			</div>
		</nav> <!-- /menu -->
		<ul class="sidenav" id="mobile-demo">
			<?php
				if($sesion){
					//Hay sesion de usuario, muestra menú personalizado
					$opciones = "<li><i class='fas fa-user-circle'></i> $nombre</li>
					<li><a href='./pages/realizarEnvio.php'>Realizar envío</a></li>
					<li><a href='./pages/gestionarEnvio.php'>Gestionar envío</a></li>
					<li><a href='./pages/cotizarEnvio.php'>Cotizar un envío</a></li>";
					echo $opciones;
				}else{
					//No hay sesion de usuario
				}
			?>
			<?php if(!$sesion) echo "<li><a href='./pages/registrar.html'>Crear cuenta</a></li>";?>
			<li><a href='./pages/rastrear.php'>Rastrear paquete</a></li>
			<li><a href='<?php if($sesion) echo "./pages/logout.php"; else echo "./pages/login.html";?>'><?php if($sesion) echo "Cerrar sesión"; else echo "Iniciar sesión";?></a></li>
			<li><a href="index.php"> Pagina inicial </a></li>
		</ul> <!-- /menu celular-->
	</header>
	<main>
		<div class="containter">
			<div class="slider">
				<ul class="slides">
					<li>
						<img src="./img/deliveryMan.jpg">
						<div class="caption center-align">
							<h3><strong>Paquetería Squid</strong></h3>
							<h5 class="light grey-text text-lighten-3">¡Estamos a tu servicio!</h5>
						</div>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col s12 m6">
					<h4 class="header">Siempre cerca de ti</h4>
					<div class="card horizontal">
					<div class="card-image">
						<!--https://www.freepik.com/vectors/travel Travel vector created by freepik - www.freepik.com-->
						<img src="./img/map300.jpg">
					</div>
					<div class="card-stacked">
						<div class="card-content">
							<p>Tenemos más de 15 000 centros de distribución en todo el país.</p>
							<p>A donde sea que necesites enviar un paquete, ¡Seguro tenemos cobertura!</p>
							<br><br>
						</div>
						<div class="card-action">
							<a href="./pages/listadoCentros.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
								<b>Consulta nuestros centros de envío</b>
							</a>
						</div>
					</div>
					</div>
				</div>
				<div class="col s12 m6">
					<h4 class="header">Entregas sin retrasos</h4>
					<div class="card horizontal">
					<div class="card-image">
						<img src="./img/delivery300.jpg">
					</div>
					<div class="card-stacked">
						<div class="card-content">
							<p>Recibe tu paquete el día que esperas, sin contratiempos.</p>
							<p>Nuestra extensa red de repartidores asegura entregas de calidad para todos los envíos.</p>
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
				<a class="grey-text text-lighten-4 right" href="index.html">TeamSquid</a>
			</div>
		</div>
	</footer>
</body>
</html>
