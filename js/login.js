$(document).ready(function(){
    $("form#formLogin").validetta({//Utiliza el plugin "validetta" para validar campos
        bubblePosition:"bottom",//Posicion del mensaje de error
        bubbleGapTop: 10,//opciones del mensaje de error
        bubbleGapLeft: -5,
        onValid:function(e){//Todos los datos cumplen con la validacion
            e.preventDefault();//Evita el envio del formulario con 'action' (funciona para usar ajax)
            $.ajax({
                url:"./login.php",//Ajax se usara en este php
                method:"post",//POST xD
                data:$("form#formLogin").serialize(),//Obtiene los datos del formulario y los serializa [name tag del elemento,valor]
                cache:false,//Evita almacenar en cache (evita almacenar informacion basura)
                success:function(respAX){//El argumento contendra la respuesta del php (un echo cuenta como respuesta)
					//Si el php respondio entrara aqui
                    let AX = JSON.parse(respAX);//Convierte la respuesta del php en JSON que se guarda en la variable AX
                    $.alert({//Muestra un alert con los
                        title:'<h5><i class="fas fa-info"></i> Aviso</h5>',
                        content:AX.msj,//Mensaje personalizado dependiendo de la respuesta del php
                        type:"orange",
                        boxWidth: "50%",
                        useBootstrap: false,
                        onDestroy:function(){
                        if(AX.codigo == 1)
                            window.location.href = "./../index.php";//Codigo de estado del php 1=exito, 0=error
                        }
                    });
                }
            });
        }
    });
});