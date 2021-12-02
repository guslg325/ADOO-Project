$(document).ready(function(){
	$('.mensaje').click(function(){
		$.alert({
			title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
			content:'Dirección copiada correctamente',
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			buttons: {
				Continuar: function(){window.location.href="./revisarRuta.html";}
			}
		});
	});
});