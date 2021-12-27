$(document).ready(function(){
        $("form#formRealizarPago").validetta({
                bubblePosition:"bottom",//Posicion del mensaje de error
                bubbleGapTop: 10,//opciones del mensaje de error
                bubbleGapLeft: -5,
                onValid:function(e){
                        e.preventDefault();
                        $.ajax({
                                url:"./realizarPagoAX.php",
                                method:"post",
                                data:$("form#formRealizarPago").serialize(),
                                cache:false,
                                success:function(respAX){
                                        let AX;
                                        AX = JSON.parse(respAX);
                                        if(AX.codigo){
                                                //success
                                                $.alert({
							title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
							content:AX.msj,//Mensaje personalizado dependiendo de la respuesta del php
							type:"orange",
							boxWidth: "50%",
							useBootstrap: false,
                                                        onDestroy: function(){
                                                                window.location.href = "./gestionarEnvio.php";
                                                        }
						});
                                        }else{
                                                //error
                                                $.alert({
							title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
							content:AX.msj,//Mensaje personalizado dependiendo de la respuesta del php
							type:"orange",
							boxWidth: "50%",
							useBootstrap: false,
                                                        onDestroy: function(){
                                                                window.location.href = "./realizarEnvio.php";
                                                        }
						});
                                        }
                                }
                        });
                }
        });
});
