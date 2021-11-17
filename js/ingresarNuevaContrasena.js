$(document).ready(function(){
	$('.actualizarContrasena').click(function(){
		$.alert({
			title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
			content:'Operación exitosa',
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			buttons: {
				Continuar: function(){window.location.href="./../index.html";}
			}
		});
	});
});