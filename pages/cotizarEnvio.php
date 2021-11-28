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
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Cotizar | Paquetería</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="./../materialize/css/materialize.min.css" rel="stylesheet">
<link href="./../css/general.css" rel="stylesheet">
<script src="./../js/jquery-3.6.0.min.js"></script>
<script src="./../materialize/js/materialize.min.js"></script>
<script src="./../js/index.js"></script>
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
						<div class="row">
							<h3>Cotizar envío</h3>
						</div>
						<form id="formCotizar" autocomplete="off">
							<div class="row">
								<div class="col s12 l4">
									<h6><i class="fas fa-map"></i> Datos de origen *</h6>
									<div class="input-field col s12">
										<select>
											<option value="" disabled selected>Selecciona</option>
											<option value="1">Ciudad de México</option>
											<option value="2">Estado de México</option>
											<option value="3">Morelos</option>
										</select>
										<label>Estado</label>
									</div>
									<div class="col s12 input-field">
										<label for="ciudadOrigen">Municipio/Alcaldía</label>
										<input type="text" id="ciudadOrigen" name="ciudadOrigen" class="validate" required>
									</div>
									<div class="input-field col s12">
										<select>
											<option value="" disabled selected>Selecciona</option>
											<option value="1">C1</option>
											<option value="2">C2</option>
											<option value="3">C3</option>
										</select>
										<label>Centro de distribución</label>
									</div>
								</div>
								<div class="col s12 l4">
									<h6><i class="fas fa-location-arrow"></i> Datos de destino *</h6>
									<div class="input-field col s12">
										<select>
											<option value="" disabled selected >Selecciona</option>
											<option value="1">Ciudad de México</option>
											<option value="2">Estado de México</option>
											<option value="3">Morelos</option>
										</select>
										<label>Estado</label>
									</div>
									<div class="col s12 input-field">
										<label for="ciudadDestino">Municipio/Alcaldía</label>
										<input type="text" id="ciudadDestino" name="ciudadDestino" class="validate" required>
									</div>
									<div class="col s12 input-field">
										<label for="cp">Código postal</label>
										<input type="text" id="cp" name="cp" class="validate" required>
									</div>
									<div class="col s12 input-field">
										<label for="calle">Calle y número</label>
										<input type="text" id="calle" name="calle" class="validate" required>
									</div>
								</div>
								<div class="col s12 l4">
									<h6><i class="fas fa-box"></i> Datos del paquete *</h6>
									<div class="col s12 input-field">
										<label for="longitud">Longitud</label>
										<input type="number" id="longitud" name="longitud" class="validate" required>
									</div>
									<div class="col s12 input-field">
										<label for="ancho">Ancho</label>
										<input type="number" id="ancho" name="ancho" class="validate" required>
									</div>
									<div class="col s12 input-field">
										<label for="altura">Altura</label>
										<input type="number" id="altura" name="altura" class="validate" required>
									</div>
									<div class="col s12 input-field">
										<label for="peso">Peso</label>
										<input type="number" id="peso" name="peso" class="validate" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 input-field">
									<a href="./../index.php">
										<button type="button" class="btn green darken-2 center-align" style="width:100%;">Cotizar</button>
									</a>
								</div>
								<div class="col s12 m4 input-field">
									<button type="reset" class="btn yellow darken-2 center-align" style="width:100%;">Limpiar</button>
								</div>
								<div class="col s12 m4 input-field">
									<a href="./../index.php">
										<button type="button" class="btn red darken-2 center-align" style="width:100%;">Cancelar</button>
									</a>
								</div>
							</div>
						</form>
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