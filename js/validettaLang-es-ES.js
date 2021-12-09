(function($){
	$.fn.validettaLanguage = {};
	$.validettaLanguage = {
		init : function(){
			$.validettaLanguage.messages = {
				required	: 'Rellena este campo.',
				email		: 'Incluye un @ en la dirección de correo electrónico. Escribe una parte después del simbolo "@".',
				number		: 'Este campo sólo acepta valores numéricos.',
				maxLength	: 'Este campo acepta como máximo {count} caracteres.',
				minLength	: 'Este campo requiere como mínimo {count} caracteres.',
				maxChecked	: 'Sólo se puede marcar {count} opciones como máximo.',
				minChecked	: 'Es necesario marcar como mínimo {count} opciones.',
				maxSelected	: 'Sólo se puede marcar {count} opciones como máximo.',
				//minSelected	: 'Es necesario marcar como mínimo {count} opciones.',
				minSelected	: 'Rellena este campo.',
				notEqual	: 'Los campos no coinciden.',
				different   : 'Fields cannot be the same as each other',
				creditCard	: 'Tarjeta de crédito no válida.'
			};
		}
	};
	$.validettaLanguage.init();
})(jQuery);