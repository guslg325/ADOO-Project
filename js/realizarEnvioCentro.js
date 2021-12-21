$(document).ready(function(){
	$("#selectTipoDestino").change(function(){//Activa los campos necesarios segun tipo de destino
		let selection = $("select#selectTipoDestino").val();
		if(selection == 1){//Si el destino es domicilio particular
			$(".destinoCentro").attr("hidden","true");
			$(".centroDestinoC").removeAttr("data-validetta");
			$(".nameDestinoC").removeAttr("data-validetta");
			$(".correDestinoC").removeAttr("data-validetta");
			$(".telDestinoC").removeAttr("data-validetta");
			$(".destinoDomicilio").removeAttr("hidden");
			$(".nameDestino").attr("data-validetta","required");
			$(".calleDestino").attr("data-validetta","required");
			$(".muniDestino").attr("data-validetta","required");
			$(".estadDestino").attr("data-validetta","minSelected[1]");
			$(".cpDestinoD").attr("data-validetta","required");
			$(".correDestino").attr("data-validetta","required");
			$(".telDestino").attr("data-validetta","required");
			
		}
		else if (selection == 2){//Si el destino es centro de envio
			$(".destinoDomicilio").attr("hidden","true");
			$(".cpDestinoD").removeAttr("data-validetta");
			$(".calleDestino").removeAttr("data-validetta");
			$(".muniDestino").removeAttr("data-validetta");
			$(".estadDestino").removeAttr("data-validetta");
			$(".nameDestino").removeAttr("data-validetta");
			$(".correDestino").removeAttr("data-validetta");
			$(".telDestino").removeAttr("data-validetta");
			$(".destinoCentro").removeAttr("hidden");
			$(".centroDestinoC").attr("data-validetta","minSelected[1]");
			$(".nameDestinoC").attr("data-validetta","required");
			$(".correDestinoC").attr("data-validetta","required");
			$(".telDestinoC").attr("data-validetta","required");
		}	
	});

	$(".limpiar").click(function(){
		$(".destinoCentro").attr("hidden","true");
		$(".destinoDomicilio").attr("hidden","true");
	});

	$("form#formRealizarEnvio").validetta({
        bubblePosition:"bottom",//Posicion del mensaje de error
        bubbleGapTop: 10,//opciones del mensaje de error
        bubbleGapLeft: -5,
		onValid:function(e){
			e.preventDefault();//Evita el envio del formulario con 'action' (funciona para usar ajax)
			$.ajax({
				url:"./calcularEnvioCentro.php",//Ajax se usara en este php
                method:"post",//POST xD
                data:$("form#formRealizarEnvio").serialize(),//Obtiene los datos del formulario y los serializa [name tag del elemento,valor]
                cache:false,//Evita almacenar en cache (evita almacenar informacion basura)
                success:function(respAX){//El argumento contendra la respuesta del php (un echo cuenta como respuesta)
					//Si el php respondio entrara aqui
					let AX;
					try {
						AX = JSON.parse(respAX);//Convierte la respuesta del php en JSON que se guarda en la variable AX
						if(AX.codigo){
							$.confirm({//Muestra un alert con los
								title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
								content:AX.msj,//Mensaje personalizado dependiendo de la respuesta del php
								type:"orange",
								boxWidth: "50%",
								useBootstrap: false,
								buttons: {
									enviar:{
										text: "Generar número de rastreo",
										action: function(){
											window.location.href = "./generarNumRastreo.html";
										}
									},
                                    enviar2:{
										text: "Generar factura",
										action: function(){
											window.location.href = "./facturar.php";
										}
									},
									desccartar:{
										text: "Descartar"
									}
								}
							});
						}else{
							$.alert({
								title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
								content:AX.msj,//Mensaje personalizado dependiendo de la respuesta del php
								type:"orange",
								boxWidth: "50%",
								useBootstrap: false,
							});
						}
					} catch (error) {
						$.alert({
							title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
							content:"El código postal no existe.",//Mensaje personalizado dependiendo de la respuesta del php
							type:"orange",
							boxWidth: "50%",
							useBootstrap: false,
						});
					}
                }
			});
		}
	});
});