<?php
    $guia = $_POST['numRastreo'];
?>
<!--***************
	Inicia HTML
****************-->
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Detalles del envío | Paquetería</title>
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
				<a href="./indexRepartidor.html" class="brand-logo"><img src="./../img/boxLogo50.png"></a>
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
            <div class="card">
                <div class="card-stacked">
                    <div class="card-content">
                        <a href="verPaquetes.php"><i class="fas fa-arrow-left"></i> Regresar</a>
                        <?php
						// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
						$link = new PDO('mysql:host=localhost;dbname=squid', 'root', ''); // el campo vaciío es para la password. 
                        foreach ($link->query("SELECT * from envios WHERE guia='$guia'") as $row)
						?>
                        <div class="row">
                            <center><h3><b>Detalles del envío</b></h3></center>
                        </div>
                        <div class="row">
                            <h5> <b>Numero de rastreo:</b>  <?php echo $row['guia'] ?></h5>
                            <h5> <b>Fecha de envío:</b>  <?php echo $row['fechaEnvio'] ?></h5>
                            <h5>
                                <b>Tipo de paquete:</b>  <?php 	if($row['tipoPaquete'] == 1)
														echo "Sobre para documentos";
													else if($row['tipoPaquete'] == 2)
														echo "Caja pequeña";	
													else if($row['tipoPaquete'] == 3)
														echo "Caja mediana";
													else if($row['tipoPaquete'] == 4)
														echo "Caja grande";
													else
														echo "Error al obtener el tipo de paquete";
											?>
                            </h5>
                            <h5>
                                <b>Dimensiones:</b>  <?php 	if($row['tipoPaquete'] == 1)
														echo "32 x 24 x 1 cm";
													else if($row['tipoPaquete'] == 2)
														echo "15 x 15 x 15 cm";	
													else if($row['tipoPaquete'] == 3)
														echo "25 x 25 x 25 cm";
													else if($row['tipoPaquete'] == 4)
														echo "40 x 40 x 40 cm";
													else
														echo "Error al obtener las dimensiones del paquete";
											?>
                            </h5>
                            <h5>
                                <b>Estatus:</b>  <?php 	if($row['status'] == 0)
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
                            </h5>           
                        </div>
                        <div class="row">
                            <h5>Datos del remitente</h5>
                        </div>
                        <div class="row">
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Calle</th>
                                        <th>Municipio</th>
                                        <th>Estado</th>
                                        <th>CP</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($link->query("SELECT * from envios WHERE guia='$guia'") as $row){ // aca puedes hacer la consulta e iterarla con each. ?> 
										<tr>
                                            <td><?php echo $row['nombreO'] ?></td>
                                            <td><?php echo $row['calleO'] ?></td>
                                            <td><?php echo $row['municipioO'] ?></td>
                                            <td><?php echo $row['estadoO'] ?></td>
                                            <td><?php echo $row['cpO'] ?></td>
                                            <td><?php echo $row['correoO'] ?></td>
                                            <td><?php echo $row['telefonoO'] ?></td>
										</tr>
										<?php
										}
										?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <h5>Datos del destinatario</h5>
                        </div>
                        <div class="row">
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Calle</th>
                                        <th>Municipio</th>
                                        <th>Estado</th>
                                        <th>CP</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($link->query("SELECT * from envios WHERE guia='$guia'") as $row){ // aca puedes hacer la consulta e iterarla con each. ?> 
										<tr>
                                            <td><?php echo $row['nombreD'] ?></td>
                                            <td><?php echo $row['calleD'] ?></td>
                                            <td><?php echo $row['municipioD'] ?></td>
                                            <td><?php echo $row['estadoD'] ?></td>
                                            <td><?php echo $row['cpD'] ?></td>
                                            <td><?php echo $row['correoD'] ?></td>
                                            <td><?php echo $row['telefonoD'] ?></td>
										</tr>
										<?php
										}
										?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <h5>Datos del centro de envio</h5>
                        </div>
                        <div class="row">
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th>Centro de origen</th>
                                        <th>Centro de destino</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($link->query("SELECT * from envios WHERE guia='$guia'") as $row){
                                        $idCentroO = $row['centroO'];
                                        $idCentroD = $row['centroD'];
                                        ?> 
										<tr>
                                            <td>
                                                <?php 
                                                    $link2 = new PDO('mysql:host=localhost;dbname=squid', 'root', ''); // el campo vaciío es para la password. 
                                                    foreach ($link2->query("SELECT * from centros WHERE id='$idCentroO'") as $row2)
                                                    echo $row2['calle']."&nbsp&nbsp&nbspCP. ".$row2['CP']
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $link2 = new PDO('mysql:host=localhost;dbname=squid', 'root', ''); // el campo vaciío es para la password. 
                                                    foreach ($link2->query("SELECT * from centros WHERE id='$idCentroD'") as $row2)
                                                    echo $row2['calle']."&nbsp&nbsp&nbspCP. ".$row2['CP']
                                                ?>
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