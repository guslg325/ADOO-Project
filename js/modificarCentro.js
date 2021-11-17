$(document).ready(function(){
	$('.modificarCentro').click(function(){
		$.alert({
			title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
			content:'Centro modificado con éxito',
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			buttons: {
				Continuar: function(){window.location.href="./gestionarCentros.html";}
			}
		});
	});
});