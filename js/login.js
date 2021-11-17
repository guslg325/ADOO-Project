$(document).ready(function(){
	$(".login").click(function(){
		$.alert({
			title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
			content:'Inicio de sesión exitoso',
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			buttons: {
				Continuar: function(){window.location.href="./indexCliente.html";}
			}
		});
	});
});