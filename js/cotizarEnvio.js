$(document).ready(function(){
	$("#selectTipoOrigen").change(function(){//Activa los campos necesarios segun tipo de origen
		let selection = $("select#selectTipoOrigen").val();
		if(selection == 1){//Si el origen es centro de envio
			$(".origenCentro").attr("hidden","true");
			$(".origenDomicilio").removeAttr("hidden");
		}
		else if (selection == 2){//Si el origen es domicilio particular
			$(".origenDomicilio").attr("hidden","true");
			$(".origenCentro").removeAttr("hidden");
		}	
	});

	$("#selectTipoDestino").change(function(){//Activa los campos necesarios segun tipo de destino
		let selection = $("select#selectTipoDestino").val();
		if(selection == 1){//Si el destino es centro de envio
			$(".destinoCentro").attr("hidden","true");
			$(".destinoDomicilio").removeAttr("hidden");
		}
		else if (selection == 2){//Si el destino es domicilio particular
			$(".destinoDomicilio").attr("hidden","true");
			$(".destinoCentro").removeAttr("hidden");
		}	
	});

	$(".limpiar").click(function(){
		$(".origenDomicilio").attr("hidden","true");
		$(".origenCentro").attr("hidden","true");
		$(".destinoCentro").attr("hidden","true");
		$(".destinoDomicilio").attr("hidden","true");
	});
});