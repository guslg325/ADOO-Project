/*
msj content:
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-info"></i> ID de centro:
	</div>
	<div class='col s12 m6 l8'>C0</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-map"></i> Ubicación:
	</div>
	<div class='col s12 m6 l8'>Tlalpan, Ciudad de México</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-car"></i> Calle y número:
	</div>
	<div class='col s12 m6 l8'>Calzada de Tlalpan 106</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-user"></i> Encargado asignado:
	</div>
	<div class='col s12 m6 l8'>Enrique García López</div>
</div>
*/
$(document).ready(function(){
	$(".verCentro").click(function(){
		let msj="<div class='row'><div class='col s12 m6 l4'><i class='fas fa-info'></i> ID de centro:</div><div class='col s12 m6 l8'>C0</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-map'></i> Ubicación:</div><div class='col s12 m6 l8'>Tlalpan, Ciudad de México</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-car'></i> Calle y número:</div><div class='col s12 m6 l8'>Calzada de Tlalpan #106</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-user'></i> Encargado asignado:</div><div class='col s12 m6 l8'>Enrique García López</div></div>";
		$.dialog({
			title:'<h5>Consultar centro de envío</h5>',
			content:msj,
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			onDestroy: function(){
				window.location.href="./gestionarCentros.html";
			}
		});
	});

	$(".eliminarCentro").click(function(){
		$.confirm({
			title: "<h5>Eliminar centro</h5>",
			content: "<p>¿Está seguro que desea eliminar el centro?</p><p>ID: C0</p>",
			type: "red",
			useBootstrap: false,
			buttons: {
				Eliminar: function(){alert("Eliminado");},
				Cancelar: function(){window.location.href="./gestionarCentros.html";}
			}
		});
	});
});