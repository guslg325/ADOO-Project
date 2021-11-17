/*
msj content:
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-info"></i> ID de repartidor:
	</div>
	<div class='col s12 m6 l8'>0</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-mail-bulk"></i> Correo electrónico:
	</div>
	<div class='col s12 m6 l8'>friveram@squiddelivery.com.mx</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-user-circle"></i> Nombre:
	</div>
	<div class='col s12 m6 l8'>Francisco</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		
	</div>
	<div class='col s12 m6 l8'>Rivera</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		
	</div>
	<div class='col s12 m6 l8'> Márquez</div>
</div>
*/
$(document).ready(function(){
	$(".verRepartidor").click(function(){
		let msj="<div class='row'><div class='col s12 m6 l4'><i class='fas fa-info'></i> ID de repartidor:</div><div class='col s12 m6 l8'>0</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-mail-bulk'></i> Correo electrónico:</div><div class='col s12 m6 l8'>friveram@squiddelivery.com.mx</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-user-circle'></i> Nombre:</div><div class='col s12 m6 l8'>Francisco</div></div><div class='row'><div class='col s12 m6 l4'></div><div class='col s12 m6 l8'>Rivera</div></div><div class='row'><div class='col s12 m6 l4'></div><div class='col s12 m6 l8'> Márquez</div></div>";
		$.dialog({
			title:'<h5>Consultar repartidor</h5>',
			content:msj,
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			onDestroy: function(){
				window.location.href="./gestionarRepartidores.html";
			}
		});
	});

	$(".eliminarRepartidor").click(function(){
		$.confirm({
			title: "<h5>Eliminar repartidor</h5>",
			content: "<p>¿Está seguro que desea eliminar al siguiente repartidor?</p><p>Email de repartidor: friveram@squiddelivery.com.mx</p>",
			type: "red",
			useBootstrap: false,
			buttons: {
				Eliminar: function(){
					$.alert({
						title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
						content:"El repartidor fue eliminado exitosamente",
						useBootstrap: false,
						boxWidth: "50%",
						type:"orange",
						buttons: {
							Aceptar: function(){
								window.location.href="./gestionarRepartidores.html";
							}
						}
					});
				},
				Cancelar: function(){window.location.href="./gestionarRepartidores.html";}
			}
		});
	});
});