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
<title>Reclamaciones | Paquetería</title>
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
                        <center><h3><i class="fas fa-box"></i> Realizar Envío</h3></center>
                        <form id="formRealizarEnvio" autocomplete="off">
                            <!--Fila 1-->
                            <div class="row">
                                <div class="col s12 m6 input-field">
                                    <div class="col s12">
                                        <h5>Datos del remitente</h5>
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="nombreRemitente">Nombre</label>
                                        <input type="text" id="nombreRemitente" name="nombreRemitente" data-validetta="required">
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="companiaRemitente">Compañia</label>
                                        <input type="text" id="companiaRemitente" name="companiaRemitente" data-validetta="required">
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="direccionRemitente">Dirección</label>
                                        <input type="text" id="direccionRemitente" name="direccionRemitente" data-validetta="required">
                                    </div> 
                                    <div class="col s6 input-field">
                                        <label for="ciudadRemitente">Municipio/Alcaldía</label>
                                        <input type="text" id="ciudadRemitente" name="ciudadRemitente" data-validetta="required">
                                    </div>   
                                    <div class="col s6 input-field">
                                        <select>
                                            <option value="" disabled selected>Selecciona</option>
                                            <option value="1">Ciudad de México</option>
                                            <option value="2">Estado de México</option>
                                            <option value="3">Morelos</option>
                                        </select>
                                        <label>Estado</label>
                                    </div>  
                                    <div class="col s6 input-field">
                                            <label for="cpRemitente">Codigo Postal</label>
                                            <input type="text" id="cpRemitente" name="cpRemitente" data-validetta="required">
                                    </div>
                                    <div class="col s6 input-field">
                                        <label for="tel1Remitente">Telefono 1</label>
                                        <input type="text" id="tel1Remitente" name="tel1Remitente" data-validetta="required">
                                    </div>  
                                    <div class="col s6 input-field">
                                        <label for="tel2Remitente">Telefono 2</label>
                                        <input type="text" id="tel2Remitente" name="tel2Remitente" data-validetta="required">
                                    </div> 
                                    <div class="col s6 input-field">
                                        <label for="correoRemitente">Correo electronico</label>
                                        <input type="email" id="correoRemitente" name="correoRemitente" data-validetta="required,email,minLength[8]">
                                    </div>                          
                                </div>

                                <div class="col s12 m6 input-field">
                                    <div class="col s12">
                                        <h5>Datos del destinatario</h5>
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="nombreDestinatario">Nombre</label>
                                        <input type="text" id="nombreDestinatario" name="nombreDestinatario" data-validetta="required">
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="companiaDestinatario">Compañia</label>
                                        <input type="text" id="companiaDestinatario" name="companiaDestinatario" data-validetta="required">
                                    </div>
                                    <div class="col s12 input-field">
                                        <label for="direccionDestinatario">Dirección</label>
                                        <input type="text" id="direccionDestinatario" name="direccionDestinatario" data-validetta="required">
                                    </div> 
                                    <div class="col s6 input-field">
                                            <label for="ciudadDestinatario">Municipio/Alcaldía</label>
                                            <input type="text" id="ciudadDestinatario" name="ciudadDestinatario" data-validetta="required">
                                    </div>  
                                    <div class="col s6 input-field">
                                        <select>
                                            <option value="" disabled selected>Selecciona</option>
                                            <option value="1">Ciudad de México</option>
                                            <option value="2">Estado de México</option>
                                            <option value="3">Morelos</option>
                                        </select>
                                        <label>Estado</label>
                                    </div>  
                                    <div class="col s6 input-field">
                                            <label for="cpDestinatario">Codigo Postal</label>
                                            <input type="text" id="cpDestinatario" name="cpDestinatario" data-validetta="required">
                                    </div>
                                    <div class="col s6 input-field">
                                        <label for="tel1Destinatario">Telefono 1</label>
                                        <input type="text" id="tel1Destinatario" name="tel1Destinatario" data-validetta="required">
                                    </div>  
                                    <div class="col s6 input-field">
                                        <label for="tel2Destinatario">Telefono 2</label>
                                        <input type="text" id="tel2Destinatario" name="tel2Destinatario" data-validetta="required">
                                    </div> 
                                    <div class="col s6 input-field">
                                        <label for="correoDestinatario">Correo electronico</label>
                                        <input type="email" id="correoDestinatario" name="correoDestinatario" data-validetta="required,email,minLength[8]">
                                    </div>       
                                </div>

                                <div class="col s12 l4">
									<h5>Datos del paquete</h5>
									<div class="col s12 input-field">
									<label for="longitud">Longitud</label>
									<input type="number" id="longitud" name="longitud" data-validetta="required">
								</div>
								<div class="col s12 input-field">
									<label for="ancho">Ancho</label>
									<input type="number" id="ancho" name="ancho" data-validetta="required">
								</div>
								<div class="col s12 input-field">
									<label for="altura">Altura</label>
									<input type="number" id="altura" name="altura" data-validetta="required">
								</div>
								<div class="col s12 input-field">
									<label for="peso">Peso</label>
									<input type="number" id="peso" name="peso" data-validetta="required">
								</div>
								</div>
                           

                                <div class="col s12 m12 input-field">
                                    <div class="col s12 m6">
                                        <a href="generarComprobante.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
                                            <button type="button" class="btn green darken-2 center-align" style="width:100%;">Generar Comprobante</button>
                                        </a>
                                    </div>
                                    <div class="col s12 m6">
                                        <a href="./../index.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
                                            <button type="button" class="btn red darken-2 center-align" style="width:100%;">Cancelar</button>
                                        </a>     
                                    </div>                                    
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