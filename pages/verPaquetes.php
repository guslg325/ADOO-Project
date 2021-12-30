<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Mis paquetes | Paquetería</title>
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

</head>
<body style="background-color: lightgray;">
	<header>
		<nav class="yellow darken-2">
			<div class="nav-wrapper">
				<a href="indexRepartidor.html" class="brand-logo"><img src="./../img/boxLogo50.png"></a>
				<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
				<ul class="right hide-on-med-and-down">
					<li><a href='./../index.php'>Cerrar sesión</a></li>
				</ul>
			</div>
		</nav> <!-- /menu -->
		<ul class="sidenav" id="mobile-demo">
			<li>Repartidor</li>
			<li><a href='./../index.php'>Cerrar sesión</a></li>
			<li><a href="./indexRepartidor.html"> Pagina inicial </a></li>
		</ul> <!-- /menu celular-->
	</header>
	<main>
		<div class="container">
			<div class="card horizontal">
				<div class="card-stacked">
					<div class="card-content">
						<a href="./indexRepartidor.html"><i class="fas fa-arrow-left"></i> Regresar</a>
						<div class="row">
							<h4>Mis paquetes</h4>
						</div>
					
						<div class="row">
                            <?php
							// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
							$link = new PDO('mysql:host=localhost;dbname=squid', 'root', ''); // el campo vaciío es para la password. 
							?>
							<div class="col s12">
								<table class="striped">
									<thead>
										<tr>
											<th>Número de rastreo</th>
											<th>Fecha del envío</th>
											<th>Estatus&nbsp;&nbsp;</th>
											<th>Opciones de paquete</th>
										</tr>
									</thead>
									<tbody>
                                        <?php foreach ($link->query('SELECT * from envios') as $row){ // aca puedes hacer la consulta e iterarla con each. ?> 
										<tr>
										<td>
                                            <?php echo $row['guia'] ?>
                                        </td>
										<td><?php echo $row['fechaEnvio'] ?></td>
										<td>
											<?php 	if($row['status'] == 0)
														echo "En espera de pago";
													else if($row['status'] == 1)
														echo "Envío esperando recolección";	
													else if($row['status'] == 2)
														echo "Envío en tránsito";
													else if($row['status'] == 3)
														echo "Entregado";
													else if($row['status'] == 4)
														echo "Destinatario Ausente";
													else if($row['status'] == 5)
														echo "En fase de devolución";
													else
														echo "Error al obtener el estatus";
											?>
										</td>
                                        <td>
                                            <form id="formgestionarEnvioRepartidor" autocomplete="off" action="consultarEnvioRepartidor.php" method="post" style="display:inline;">
                                                <input id="numRastreo" name="numRastreo" type="number" value='<?php echo $row['guia']?>' hidden></input>
                                                <button type="submit" class="btn yellow darken-2 verPaquete"><i class="fas fa-eye"></i></button>
                                            </form>
                                            
                                            <form id="formgestionarEnvioRepartidor" autocomplete="off" action="actualizarEstatus.php" method="post" style="display:inline;">
                                                <input id="numRastreo" name="numRastreo" type="number" value='<?php echo $row['guia']?>' hidden></input>
                                                <button type="submit" class="btn yellow darken-2"><i class="fas fa-pencil-alt"></i></button>
                                            </form>
                                        </td>
										</tr>
										<?php
										}
										?>
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
		<div class="footer-copyright yellow darken-2">
			© 2021 Copyright
			<a class="grey-text text-lighten-4 right" href="indexCliente.html">TeamSquid</a>	
		</div>
	</footer>
</body>
</html>