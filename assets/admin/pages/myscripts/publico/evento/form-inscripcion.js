var FormInscripcion = function() {

	var autocompletar = function() {
		$("input[name='rfc']").focusout(function() {
			var rfc = $(this).val();
			$.post('/cursos/existe_cliente', {rfc:rfc}, function(data, textStatus, xhr) {
				if (data.existe) {
					alert('Existe');
				};
				console.log(data.cliente);
			},'json');
		});
	};

	return {
		init: function() {
			autocompletar();
		}
	}
}();