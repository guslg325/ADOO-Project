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
<title>Centros de Envío</title>
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
						<li><a href='./pages/realizarEnvio.php'>Realizar envío</a></li>
						<li><a href='./pages/gestionarEnvio.php'>Gestionar envío</a></li>
						<li><a href='./pages/cotizarEnvio.php'>Cotizar un envío</a></li>
						<li><a href='./pages/rastrear.php'>Rastrear paquete</a></li>
						<li><a href='./pages/logout.php'>Cerrar sesión</a></li>";
						echo $opciones;
					}else{
						//No hay sesion de usuario
						$opciones = "<li><a href='./pages/login.html'>Iniciar sesión</a></li>
						<li><a href='./pages/registrar.html'>Crear cuenta</a></li>
						<li><a href='./pages/rastrear.php'>Rastrear paquete</a></li>";
						echo $opciones;
					}
				?>	
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
					<li><a href='./pages/cotizarEnvio.php'>Cotizar un envío</a></li>
					<li><a href='./pages/rastrear.php'>Rastrear paquete</a></li>
					<li><a href='./pages/logout.php'>Cerrar sesión</a></li>";
					echo $opciones;
				}else{
					//No hay sesion de usuario
					$opciones = "<li><a href='./pages/login.html'>Iniciar sesión</a></li>
					<li><a href='./pages/registrar.html'>Crear cuenta</a></li>
					<li><a href='./pages/rastrear.php'>Rastrear paquete</a></li>";
					echo $opciones;
				}
			?>
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

                        <h3>&nbspCentros de Envío</h3>

                        <div class="row">
							<div class="col s12 m12">
								<table class="responsive-table">
									<thead>
										<tr>
											<th>ID de centro</th>
											<th>Ubicación de centro</th>
											<th>Calle y número</th>
                                            <th>Encargado asignado</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>C0</td>
											<td>Tlalpan, Ciudad de México</td>
											<td>Calzada de Tlalpan #106</td>
                                            <td>Enrique García López</td>
                                        </tr>
										<tr>
											<td>C1</td>
											<td>Atizapán, Estado de México</td>
											<td>Adolfo López Mateos #133</td>
                                            <td>Alondra Garcia Cruz</td>
                                        </tr>
                                        <tr>
											<td>C2</td>
											<td>Cuernavaca, Morelos</td>
											<td>Calle de los 50 metro #27</td>
                                            <td>Fabian Cano Cortes</td>
                                        </tr>
										<tr>
											<td>C3</td>
											<td>Ecatepec, Estado de México</td>
											<td>Centenario #2033</td>
                                            <td>Clara Miranda Lopez</td>
                                        </tr>
										<tr>
											<td>C4</td>
											<td>Benito Juárez, Ciudad de México</td>
											<td>Av Independencia #111</td>
                                            <td>Jaime Aguilar Cruz</td>
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
