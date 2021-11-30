$(document).ready(function(){
	$("form#nuevaContrasena").validetta({
		bubblePosition:"bottom",//Posicion del mensaje de error
        bubbleGapTop: 10,//opciones del mensaje de error
        bubbleGapLeft: -5,
        validators:{
            regExp:{
                passRegEx:{
                    pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
                    errorMessage: 'El formato de la contraseña es erróneo.'
                }
            }
        },
		onValid:function(e){//Todos los datos cumplen con la validacion
            e.preventDefault();//Evita el envio del formulario con 'action' (funciona para usar ajax)
            $.ajax({
                url:"./ingresarNuevaContrasena.php",//Ajax se usara en este php
                method:"post",//POST xD
                data:$("form#nuevaContrasena").serialize(),//Obtiene los datos del formulario y los serializa [name tag del elemento,valor]
                cache:false,//Evita almacenar en cache (evita almacenar informacion basura)
                success:function(respAX){//El argumento contendra la respuesta del php (un echo cuenta como respuesta)
					//Si el php respondio entrara aqui
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
									window.location.href = "./login.html";//Codigo de estado del php 1=exito, 0=error
							}
						});
					} catch (error) {
						$.alert({
							title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
							content:'El link ha expirado.',//Mensaje personalizado dependiendo de la respuesta del php
							type:"orange",
							boxWidth: "50%",
							useBootstrap: false,
							onDestroy:function(){
								window.location.href = "./recuperarContrasena.html";//Codigo de estado del php 1=exito, 0=error
							}
						});
					}
                }
            });
        }
	});
});