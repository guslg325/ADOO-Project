$(document).ready(function(){
	$("form#formRecuContra").validetta({
		bubblePosition:"bottom",//Posicion del mensaje de error
        bubbleGapTop: 10,//opciones del mensaje de error
        bubbleGapLeft: -5,
		onValid:function(e){
			e.preventDefault();
			$.ajax({
				url:"recuperarContrasena.php",
				method:"post",
				data:$("form#formRecuContra").serialize(),
				cache:false,
				success:function(respAX){
					let AX = JSON.parse(respAX);
					$.alert({
						title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
                        content:AX.msj,//Mensaje personalizado dependiendo de la respuesta del php
                        type:"orange",
                        boxWidth: "50%",
                        useBootstrap: false,
						onDestroy:function(){
							if(AX.codigo)
								window.location.href = "./recuperarContrasena.html";
						}
					});
				}
			});
		}
	});
});