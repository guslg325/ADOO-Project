/*
msj content:
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-info"></i> Número de rastreo::
	</div>
	<div class='col s12 m6 l8'>9082320026</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-building"></i> Entregar en:
	</div>
	<div class='col s12 m6 l8'>Via Morelos Núm. 178-G Ecatepec, Ciudad de México 55080</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-box"></i> Dimensiones:
	</div>
	<div class='col s12 m6 l8'>30cm x 20cm x 10cm</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-box"></i> Peso:
	</div>
	<div class='col s12 m6 l8'>1kg</div>
</div>
<div class='row'>
	<div class='col s12 m6 l4'>
		<i class="fas fa-car"></i> Recibe:
	</div>
	<div class='col s12 m6 l8'>Santiago Ruiz Javier Guadalupe</div>
</div>
*/
$(document).ready(function(){
	$(".verPaquete").click(function(){
		let msj="<div class='row'><div class='col s12 m6 l4'><i class='fas fa-info'></i> Número de rastreo:</div><div class='col s12 m6 l8'>9082320026</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-building'></i> Entregar en:</div><div class='col s12 m6 l8'>Via Morelos Núm. 178-G Ecatepec, Ciudad de México 55080</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-user'></i> Recibe:</div><div class='col s12 m6 l8'>Santiago Ruiz Javier Guadalupe</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-box'></i> Dimensiones:</div><div class='col s12 m6 l8'>30cm x 20cm x 10cm</div></div><div class='row'><div class='col s12 m6 l4'><i class='fas fa-box'></i> Peso:</div><div class='col s12 m6 l8'>1kg</div></div>";
		$.dialog({
			title:'<h5>Datos</h5>',
			content:msj,
			type: "orange",
			useBootstrap: false,
			boxWidth: "50%",
			onDestroy: function(){
				window.location.href="./verPaquetes.html";
			}
		});
	});

});