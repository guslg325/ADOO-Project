$(document).ready(function(){
	$('.crearCentro').click(function(){
		$.alert({
			title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
			content:'Centro creado con éxito',
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			buttons: {
				Continuar: function(){window.location.href="./gestionarCentros.html";}
			}
		});
	});
});