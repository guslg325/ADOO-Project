$(document).ready(function(){ 
	$("form#formActualizarEstatus").validetta({
		bubblePosition:"bottom",//Posicion del mensaje de error
		bubbleGapTop: 10,//opciones del mensaje de error
		bubbleGapLeft: -5,
		onValid:function(e){
			e.preventDefault();
			$.ajax({
				url:"./cambiarEstatus.php",
				method:"post",
				data:$("form#formActualizarEstatus").serialize(),
				cache:false,
				success:function(respAX){
					let AX;
					try {
					AX = JSON.parse(respAX);//Convierte la respuesta del php en JSON que se guarda en la variable AX
					$.alert({
						title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
						content:AX.msj,//Mensaje personalizado dependiendo de la respuesta del php
						type:"orange",
						boxWidth: "50%",
						useBootstrap: false,
						onDestroy:function(){
							if(AX.codigo == 1)
								window.location.href = "./verPaquetes.php";//Codigo de estado del php 1=exito, 0=error
						}
					});
					} catch (error) {
						$.alert({
							title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
							content:'Error al actualizar el estatus.',//Mensaje personalizado dependiendo de la respuesta del php
							type:"orange",
							boxWidth: "50%",
							useBootstrap: false,
							onDestroy:function(){
								window.location.href = "./verPaquetes.php";//Codigo de estado del php 1=exito, 0=error
							}
						});
					}
				}
			});
		}
	});
});