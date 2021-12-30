<?php
    $guia = $_POST['numRastreo']; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Actualizar Estatus | Paquetería</title>
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

<script src="./../js/actualizarEstatus.js"></script>
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
						<a href="./verPaquetes.php"><i class="fas fa-arrow-left"></i> Regresar</a>
                        <form id="formActualizarEstatus" autocomplete="off">
                            <?php
                            // Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
                            $link = new PDO('mysql:host=localhost;dbname=squid', 'root', ''); // el campo vaciío es para la password. 
                            foreach ($link->query("SELECT * from envios WHERE guia='$guia'") as $row)
                            ?>
                            <div class="row">
                                <h4>Actualizar estatus:</h4>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l4">
                                    <h6>
                                        <i class="fas fa-box"></i> Número de rastreo del paquete:
                                        <input id="numRastreo" name="numRastreo" type="number" value='<?php echo $row['guia']?>' hidden></input>
                                    </h6>
                                </div>
                                <div class="col s12 m6 l8 input-field">
                                    <h6> <?php echo $row['guia'] ?></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l4">
                                    <h6><i class="fas fa-box"></i> Estatus actual:</h6>
                                </div>
                                <div class="col s12 m6 l8 input-field">
                                    <h6>
                                        <?php 	
                                            if($row['status'] == 0)
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
                                        <input id="estatus" name="estatus" type="number" value='<?php echo $row['status']?>' hidden></input>
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6 l4">
                                    <h6><i class="fas fa-box-open"></i> Nuevo estatus:</h6>
                                </div>
                                <div class="col s12 m6 l8 input-field">
                                    <select id="nuevoEstatus" name="nuevoEstatus" data-validetta="minSelected[1]">  
                                        <option value="" disabled selected>Selecciona</option>
                                        <option value="1">Envío esperando recolección</option>
                                        <option value="2">Envío en tránsito</option>
                                        <option value="3">Entregado</option>
                                        <option value="4">Destinatario Ausente</option>
                                        <option value="5">En fase de devolución</option>
                                    </select>
                                </div>
                            </div>
                    
                            
                            <div class="row">	
                                <div class="col s12 m4 input-field">
                                    <button type="submit" class="btn green darken-2 center-align" style="width:100%;">Actualizar</button>
                                </div>
                                <div class="col s12 m4 input-field">
                                    <button type="button" class="btn yellow darken-2 comprobante" style="width:100%;">Comprobante</button>
                                </div>
                                <div class="col s12 m4 input-field">
                                    <a href="./verPaquetes.php"><button type="button" class="btn red" style="width:100%;">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
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