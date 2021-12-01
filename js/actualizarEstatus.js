$(document).ready(function(){
	$('.actualizarEstatus').click(function(){
		$.alert({
			title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
			content:'Estatus actualizado',
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			buttons: {
				Continuar: function(){window.location.href="./verPaquetes.html";}
			}
		});
	});
	$('.comprobante').click(function(){
		$.alert({
			title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
			content:'Comprabante subido correctamente',
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			buttons: {
				Continuar: function(){window.location.href="./actualizarEstatus.html";}
			}
		});
	});
});