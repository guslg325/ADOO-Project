$(document).ready(function(){
	$("#selectTipoOrigen").change(function(){//Activa los campos necesarios segun tipo de origen
		let selection = $("select#selectTipoOrigen").val();
		if(selection == 1){//Si el origen es domicilio
			$(".origenCentro").attr("hidden","true");
			$(".centroOrigenC").removeAttr("data-validetta");
			$(".origenDomicilio").removeAttr("hidden");
			$(".cpOrigenD").attr("data-validetta","required");
		}
		else if (selection == 2){//Si el origen es centro
			$(".origenDomicilio").attr("hidden","true");
			$(".cpOrigenD").removeAttr("data-validetta");
			$(".origenCentro").removeAttr("hidden");
			$(".centroOrigenC").attr("data-validetta","minSelected[1]");
		}	
	});

	$("#selectTipoDestino").change(function(){//Activa los campos necesarios segun tipo de destino
		let selection = $("select#selectTipoDestino").val();
		if(selection == 1){//Si el destino es centro de envio
			$(".destinoCentro").attr("hidden","true");
			$(".centroDestinoC").removeAttr("data-validetta");
			$(".destinoDomicilio").removeAttr("hidden");
			$(".cpDestinoD").attr("data-validetta","required");
		}
		else if (selection == 2){//Si el destino es domicilio particular
			$(".destinoDomicilio").attr("hidden","true");
			$(".cpDestinoD").removeAttr("data-validetta");
			$(".destinoCentro").removeAttr("hidden");
			$(".centroDestinoC").attr("data-validetta","minSelected[1]");
		}	
	});

	$(".limpiar").click(function(){
		$(".origenDomicilio").attr("hidden","true");
		$(".origenCentro").attr("hidden","true");
		$(".destinoCentro").attr("hidden","true");
		$(".destinoDomicilio").attr("hidden","true");
	});

	$("form#formCotizar").validetta({
        bubblePosition:"bottom",//Posicion del mensaje de error
        bubbleGapTop: 10,//opciones del mensaje de error
        bubbleGapLeft: -5,
		onValid:function(e){
			e.preventDefault();//Evita el envio del formulario con 'action' (funciona para usar ajax)
			$.ajax({
				url:"./calcularEnvio.php",//Ajax se usara en este php
                method:"post",//POST xD
                data:$("form#formCotizar").serialize(),//Obtiene los datos del formulario y los serializa [name tag del elemento,valor]
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
										text: "Realizar envío",
										action: function(){
											window.location.href = "./realizarEnvio.php";
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