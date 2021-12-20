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
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Realizar Envio | Paquetería</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="./../materialize/css/materialize.min.css" rel="stylesheet">
<link href="./../css/general.css" rel="stylesheet">
<link href="./../css/cotizarEnvio.css" rel="stylesheet">
	
<link href="./../css/validetta.min.css" rel="stylesheet" type="text/css" media="screen">
<link href="./../js/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css" rel="stylesheet">
<script src="./../js/jquery-3.6.0.min.js"></script>
<script src="./../js/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js"></script>
	
<script src="./../js/validetta.min.js"></script>
<script src="./../js/validettaLang-es-ES.js"></script>
<script src="./../materialize/js/materialize.min.js"></script>
<script src="./../js/index.js"></script>
	
<script src="./../js/realizarEnvio.js"></script>	
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
							<h3>Realizar envío</h3>
						</div>
					  <form id="formRealizarEnvio" autocomplete="off">
                            <!--Fila 1-->
						  <div class="row">
								<div class="col s12 m6">
									<h6><i class="fas fa-map"></i> Datos de origen *</h6>
									<div class="input-field">
										<select id="selectTipoOrigen" name="selectTipoOrigen" data-validetta="minSelected[1]">
											<option value="" disabled selected>Selecciona</option>
											<option value="1">Domicilio particular</option>
											<option value="2">Centro de envíos</option>
										</select>
										<label>Ubicación de origen</label>
									</div>
									<div class="origenCentro" hidden>
										<?php		
											// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
											$db = new PDO('mysql:host=localhost:3307;dbname=squid', 'root', ''); // el campo vaciío es para la password. 
										?>
										<div class="input-field">
											<select id="centroOrigenC" name="centroOrigenC" class="centroOrigenC">
												<option value="" disabled selected>Selecciona</option>
												<?php
													$query = $db->prepare("SELECT * FROM centros");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
														echo '<option value="'.$valores["id"].'">'.$valores["calle"].'&nbsp&nbsp&nbspCP. '.$valores["CP"].'</option>';
													endforeach;
												?>
											</select>
											<label>Centro de envío</label>
										</div>
										<div class="input-field">
											<label for="nameOrigenC">Nombre</label>
											<input type="text" id="nameOrigenC" name="nameOrigenC" class="nameOrigenC">
										</div>
										<div class="input-field">
											<label for="correOrigenC">Correo</label>
											<input class="correOrigenC" type="text" id="correOrigenC" name="correOrigenC" data-validetta="required,email,minLength[8]">
										</div>
										<div class="input-field">
											<label for="telOrigenC">Telefono</label>
											<input type="text" id="telOrigenC" name="telOrigenC" class="telOrigenC">
										</div>
									</div>
																
									<div class="origenDomicilio" hidden>
										<div class="input-field">
											<label for="nameOrigen">Nombre</label>
											<input type="text" id="nameOrigen" name="nameOrigen" class="nameOrigen">
										</div>
										<div class="input-field">
											<label for="calleOrigen">Calle</label>
											<input type="text" id="calleOrigen" name="calleOrigen" class="calleOrigen">
										</div>
										<div class="input-field">
											<label for="muniOrigen">Municipio/Alcaldía</label>
											<input type="text" id="muniOrigen" name="muniOrigen" class="muniOrigen">
										</div>
										<label>Estado</label>
										<select class="estadOrigen" id="estadOrigen" name="estadOrigen" data-validetta="minSelected[1]">
											<option value="" disabled selected>Selecciona</option>
											<option value="1">Aguascalientes</option>
											<option value="2">Baja California</option>
											<option value="3">Baja California Sur</option>
											<option value="4">Campeche</option>
											<option value="5">Chiapas</option>
											<option value="6">Chihuahua</option>
											<option value="7">Ciudad de México</option>
										</select>
										<div class="input-field">
											<label for="cpOrigenD">Código postal</label>
											<input type="text" id="cpOrigenD" name="cpOrigenD" class="cpOrigenD">
										</div>
										<div class="input-field">
											<label for="correOrigen">Correo</label>
											<input class="correOrigen" type="text" id="correOrigen" name="correOrigen" data-validetta="required,email,minLength[8]">
										</div>
										<div class="input-field">
											<label for="telOrigen">Telefono</label>
											<input type="text" id="telOrigen" name="telOrigen" class="telOrigen">
										</div>
									</div>
														
																					
							  </div>
							  
							  
								<div class="col s12 m6">
									<h6><i class="fas fa-location-arrow"></i> Datos de destino *</h6>
									<div class="input-field">
										<select id="selectTipoDestino" name="selectTipoDestino" data-validetta="minSelected[1]">
											<option value="" disabled selected>Selecciona</option>
											<option value="1">Domicilio particular</option>
											<option value="2">Centro de envíos</option>
										</select>
										<label>Ubicación de destino</label>
									</div>
									<div class="destinoCentro" hidden>	
										<?php		
											// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
											$db = new PDO('mysql:host=localhost:3307; dbname=squid', 'root', ''); // el campo vaciío es para la password. 
										?>
										<div class="input-field">
											<select id="centroDestinoC" name="centroDestinoC" class="centroDestinoC">
												<option value="" disabled selected>Selecciona</option>
												<?php
													$query = $db->prepare("SELECT * FROM centros");
													$query->execute();
													$data = $query->fetchAll();
													foreach ($data as $valores):
														echo '<option value="'.$valores["id"].'">'.$valores["calle"].'&nbsp&nbsp&nbspCP. '.$valores["CP"].'</option>';
													endforeach;
												?>
											</select>
											<label>Centro de envío</label>
										</div>
										
											<div class="input-field">
											<label for="nameDestinoC">Nombre</label>
											<input type="text" id="nameDestinoC" name="nameDestinoC" class="nameDestinoC">
										</div>
										<div class="input-field">
											<label for="correDestinoC">Correo</label>
											<input class="correDestinoC" type="text" id="correDestinoC" name="correDestinoC" data-validetta="required,email,minLength[8]">
										</div>
										<div class="input-field">
											<label for="telDestinoC">Telefono</label>
											<input type="text" id="telDestinoC" name="telDestinoC" class="telDestinoC">
										</div>
										
									</div>
									
									<div class="destinoDomicilio" hidden>
										<div class="input-field">
											<label for="nameDestino">Nombre</label>
											<input type="text" id="nameDestino" name="nameDestino" class="nameDestino">
										</div>
										<div class="input-field">
											<label for="calleDestino">Calle</label>
											<input type="text" id="calleDestino" name="calleDestino" class="calleDestino">
										</div>
										<div class="input-field">
											<label for="muniDestino">Municipio/Alcaldía</label>
											<input type="text" id="muniDestino" name="muniDestino" class="muniDestino">
										</div>
										<label>Estado</label>
										<select class="estadDestino" id="estadDestino" name="estadDestino" data-validetta="minSelected[1]">
											<option value="" disabled selected>Selecciona</option>
											<option value="1">Aguascalientes</option>
											<option value="2">Baja California</option>
											<option value="3">Baja California Sur</option>
											<option value="4">Campeche</option>
											<option value="5">Chiapas</option>
											<option value="6">Chihuahua</option>
											<option value="7">Ciudad de México</option>
										</select>
																				
										<div class="input-field">
											<label for="cpDestinoD">Código postal</label>
											<input type="text" id="cpDestinoD" name="cpDestinoD" class="cpDestinoD">
										</div>
											<div class="input-field">
											<label for="correDestino">Correo</label>
											<input class="correDestino" type="text" id="correDestino" name="correDestino" data-validetta="required,email,minLength[8]">
										</div>
										<div class="input-field">
											<label for="telDestino">Telefono</label>
											<input type="text" id="telDestino" name="telDestino" class="telDestino">
										</div>
									</div>
									
							  </div>
							</div>
						  	
						  	<div class="row">
								<div class="col s12 l8 infoBox">
									<h6><i class="fas fa-info"></i> Información sobre tipos de paquete</h6>
									<table class="responsive-table striped">
										<thead>
											<th>Tipo</th>
											<th>Dimensiones</th>
										</thead>
										<tbody>
											<tr>
												<td>Sobre para documentos</td>
												<td>32 x 24 x 1 cm</td>
											</tr>
											<tr>
												<td>Caja pequeña</td>
												<td>15 x 15 x 15 cm</td>
											</tr>
											<tr>
												<td>Caja mediana</td>
												<td>25 x 25 x 25 cm</td>
											</tr>
											<tr>
												<td>Caja grande</td>
												<td>40 x 40 x 40 cm</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col s12 l4">
									<h6><i class="fas fa-box"></i> Datos del paquete *</h6>
									<label>
										<p>
											<input class="with-gap" name="tipoPaquete" id="tipoPaquete" type="radio" value='1' data-validetta="required"/>
											<span>Sobre para documentos</span>
										</p>
									</label>
									<label>
										<p>
											<input class="with-gap" name="tipoPaquete" id="tipoPaquete" type="radio" value='2'/>
											<span>Caja pequeña</span>
										</p>
									</label>
									<label>
										<p>
											<input class="with-gap" name="tipoPaquete" id="tipoPaquete" type="radio" value='3'/>
											<span>Caja mediana</span>
										</p>
									</label>
									<label>
										<p>
											<input class="with-gap" name="tipoPaquete" id="tipoPaquete" type="radio" value='4'/>
											<span>Caja grande</span>
										</p>
									</label>
								</div>
							</div>
						  
						  		<div class="row">
								<div class="col s12 m4 input-field">
										<button type="submit" class="btn green darken-2 center-align" style="width:100%;">Siguiente</button>
								</div>
								<div class="col s12 m4 input-field limpiar">
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
