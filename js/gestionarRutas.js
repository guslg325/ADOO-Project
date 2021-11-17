/*
msj content:
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-info"></i> ID de ruta:
	</div>
	<div class='col s12 m6 l8'>R0</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-building"></i> Centro de distribución origen:
	</div>
	<div class='col s12 m6 l8'>C1</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-building"></i> Centro de distribución destino:
	</div>
	<div class='col s12 m6 l8'>C2</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-user"></i> Repartidor asignado:
	</div>
	<div class='col s12 m6 l8'>Francisco Rivera Márquez</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-car"></i> Calles que cubre:
	</div>
	<div class='col s12 m6 l8'>Insurgentes, Reforma</div>
</div>
*/
$(document).ready(function(){
	$(".verRuta").click(function(){
		let msj="<div class='row'><div class='col s12 m6 l4'><i class='fas fa-info'></i> ID de ruta:</div><div class='col s12 m6 l8'>R0</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-building'></i> Centro de distribución origen:</div><div class='col s12 m6 l8'>C1</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-building'></i> Centro de distribución destino:</div><div class='col s12 m6 l8'>C2</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-user'></i> Repartidor asignado:</div><div class='col s12 m6 l8'>Francisco Rivera Márquez</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-car'></i> Calles que cubre:</div><div class='col s12 m6 l8'>Insurgentes, Reforma</div></div>";
		$.dialog({
			title:'<h5>Consultar ruta</h5>',
			content:msj,
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			onDestroy: function(){
				window.location.href="./gestionarRutas.html";
			}
		});
	});

	$(".eliminarRuta").click(function(){
		$.confirm({
			title: "<h5>Eliminar ruta</h5>",
			content: "<p>¿Está seguro que desea eliminar la siguiente ruta?</p><p>ID de ruta: R0</p>",
			type: "red",
			useBootstrap: false,
			buttons: {
				Eliminar: function(){alert("Eliminado");},
				Cancelar: function(){window.location.href="./gestionarRutas.html";}
			}
		});
	});
});