$(document).ready(function(){
	$(".gestionarEnvio").click(function(){
		$.alert({
			title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
			content:'Factura enviada con exito al correo electronico',
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			buttons: {
				Continuar: function(){window.location.href="./gestionarEnvio.php";}
			}
		});
	});
});