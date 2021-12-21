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
<title>Facturar | Paquetería</title>
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
<script src="./../js/facturar.js"></script>
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
						<li><a href='./cotizarEnvio.php'>Cotizar un envío</a></li>
						<li><a href='./rastrear.php'>Rastrear paquete</a></li>
						<li><a href='./logout.php'>Cerrar sesión</a></li>";
						echo $opciones;
					}else{
						//No hay sesion de usuario
						$opciones = "<li><a href='./rastrear.php'>Rastrear paquete</a></li>
						<li><a href='./../index.html'>Cerrar sesión</a></li>";
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
					<li><a href='./realizarEnvio.php'>Realizar envío</a></li>
					<li><a href='./gestionarEnvio.php'>Gestionar envío</a></li>
					<li><a href='./cotizarEnvio.php'>Cotizar un envío</a></li>
					<li><a href='./rastrear.php'>Rastrear paquete</a></li>
					<li><a href='./logout.php'>Cerrar sesión</a></li>
					<li><a href='./../index.php'> Pagina inicial </a></li>";
					echo $opciones;
				}else{
					//No hay sesion de usuario
					$opciones = "<li><a href='./../index.html'>Cerrar sesión</a></li>";
					echo $opciones;
				}
			?>
		</ul> <!-- /menu celular-->
	</header>

	<main>
        <div class="container">
            <div class="card">
                <div class="card-stacked">
                    <div class="card-content">
                        <center><h3><i class="fas fa-file-invoice-dollar"></i> Generar Factura</h3></center>
                        <div class="row">
                            <form id="formFacturar" autocomplete="off">
                                <div class="col s12 m6 input-field">
									<label for="rfc">RFC</label>
									<input type="text" id="rfc" name="rfc" data-validetta="required,minLength[13]">
								</div>
                                <div class="col s12 m6 input-field">
									<label for="razonSocial">Razon Social</label>
									<input type="text" id="razonSocial" name="razonSocial" data-validetta="required">
								</div>
                                <div class="col s12 m6 input-field">
									<label for="direccionFacturacion">Dirección de facturación</label>
									<input type="text" id="direccionFacturacion" name="direccionFacturacion" data-validetta="required">
								</div>
                                <div class="col s12 m6 input-field">
									<select data-validetta="minSelected[1]">
                                        <option value="" disabled selected >Selecciona</option>
                                        <option value="1">Adquisición de mercancias</option>
                                        <option value="2">Devoluciones, descuentos o bonificaciones</option>
                                        <option value="3">Gastos en general</option>
                                        <option value="4">Construcciones</option>
                                        <option value="5">Mobiliario y equipo de oficina por inversiones</option>
                                        <option value="6">Equipo de transporte</option>
                                        <option value="7">Equipo de computo y accesorios</option>
                                        <option value="8">Dados, troqueles, moldes, matrices y herramental</option>
                                        <option value="9">Comunicaciones telefónicas</option>
                                        <option value="10">Comunicaciones satelitales</option>
                                        <option value="11">Otra maquinaria y equipo</option>
                                        <option value="12">Honorarios medicos, dentales y gastos hospitalarios</option>
                                        <option value="13">Gastos médicos por incapacidad o discapacidad</option>
                                        <option value="14">Gastos funerales</option>
                                        <option value="15">Donativos</option>
                                        <option value="16">Intereses reales efectivamente pagados por créditos hipotecarios</option>
                                        <option value="17">Aportaciones voluntarias al SAR</option>
                                        <option value="18">Primas de seguros de gastos médicos</option>
                                        <option value="19">Gastos de transportación escolar obligatoria</option>
                                        <option value="20">Depósitos en cuentas para el ahorro</option>
                                        <option value="21">Pagos por servicios educativos (colegiaturas)</option>
                                        <option value="22">Por definir</option> 
                                    </select>
                                    <label>Uso de la factura *</label>
								</div>
                                <div class="col s12 m12 input-field">
									<label for="correoFactura">Correo electronico</label>
									<input type="email" id="correoFactura" name="correoFactura" data-validetta="required,email,minLength[8]" >
								</div>
                                <div class="col s12 m12 input-field">
									<?php
										if($sesion){
											$opciones2 = "<div class='col s12 m6'>
											<a href='gestionarEnvio.php'>
												<button type='button' class='btn green darken-2 center-align facturar1' style='width:100%';>Enviar</button>
											</a> 	 
											</div>
											<div class='col s12 m6'>
												<a href='gestionarEnvio.php'>
													<button type='button' class='btn red darken-2 center-align' style='width:100%;'>Cancelar</button>
												</a>     
											</div>";
											echo $opciones2;
										}
										else{
											$opciones2 = "<div class='col s12 m6'>
											<a href='indexEncargadoCentro.html'>
												<button type='button' class='btn green darken-2 center-align facturar2' style='width:100%';>Enviar</button>
												</a> 	  
											</div>
											<div class='col s12 m6'>
												<a href='indexEncargadoCentro.html'>
													<button type='button' class='btn red darken-2 center-align' style='width:100%;'>Cancelar</button>
												</a>     
											</div>";
											echo $opciones2;	
										}
									?>                                    
                                </div>
                            </form>
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