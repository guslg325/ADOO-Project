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
<title>Generar factura</title>
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
<script src="./../js/realizarReclamo.js"></script>
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
                        <center><h3><i class="fas fa-exclamation-circle"></i> Formulario de Reclamación</h3></center>
                        <form id="formReclamo" autocomplete="off">
                            <div class="row">
                                <div class="col s12 m12 imput-field">
                                    <div class="col s12 m12">
                                        <h5>Concepto de reclamación *</h5>    
                                    </div>
                                </div>
                                <div class="col s12 m6 imput-field">
                                    <div class="col s12 m12">
                                        <h6>Perdida</h6>    
                                    </div>
                                    <div class="col s6">                                
                                        <p>
                                            <label>
                                                <input name="group1" type="radio" name="perdidaCompleta" id="perdidaCompleta" class="validate" required/>
                                                <span>Completa</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input name="group1" type="radio" name="perdidaParcial" id="perdidaParcial" class="validate" required/>
                                                <span>Parcial</span>
                                            </label>
                                        </p>
                                    </div>
                                </div>
                                <div class="col s12 m6 imput-field">
                                    <div class="col s12 m12">
                                        <h6>No entregado</h6>    
                                    </div>
                                    <div class="col s6">                                
                                        <label>
                                            <input name="group1" type="radio" name="noEntregado" id="noEntregado"/>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 m12 imput-field">
                                    <div class="col s12">
                                        <h5>Descripción del daño del paquete *</h5>
                                    </div>
                                    <div class="col s12 input-field">                                
                                        <textarea name="embalajeExterior" id="embalajeExterior" class="materialize-textarea validate" required></textarea>
                                        <label for="embalajeExterior">Describa el daño del embalaje exterior</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <textarea name="embalajeInterior" id="embalajeInterior" class="materialize-textarea validate" required></textarea>
                                        <label for="embalajeInterior">Describa el daño del embalaje interior</label>
                                    </div>                                   
                                    <div class="col s12 input-field">
                                        <textarea name="danioPaquete" id="danioPaquete" class="materialize-textarea validate" required></textarea>
                                        <label for="danioPaquete">Describa el daño del paquete</label>
                                    </div> 
                                </div>

                                <div class="col s12 m12 imput-field">
                                    <div class="col s12 m12 file-field input-field">
                                        <div class="btn yellow darken-2">
                                          <span><i class="fas fa-paperclip"></i></span>
                                          <input type="file" multiple>
                                        </div>
                                        <div class="file-path-wrapper">
                                          <input class="file-path validate" type="text" placeholder="Adjunte alguna prueba de compra *" required>
                                        </div>
                                      </div>
                                </div>


                                <div class="col s12 m12 input-field">
                                    <div class="col s12 m6">
                                        <button type="button" class="btn green darken-2 center-align realizarReclamo" style="width:100%;">Enviar reclamación</button>
                                    </div>
                                    <div class="col s12 m6">
                                        <a href="gestionarEnvio.php"><!--Remover etiqueta <a> y cambiar el 'type' cuando se agregue funcionalidad-->
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