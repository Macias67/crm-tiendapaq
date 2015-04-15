var FormInscripcion = function() {

	var autocompletar = function() {
		$("input[name='rfc']").focusout(function() {
			var rfc = $(this).val();
			$.post('/cursos/existe_cliente', {rfc:rfc}, function(data, textStatus, xhr) {
				if (data.existe) {
					bootbox.alert('<h4>El RFC '+rfc+' ya se encuentra registrado, cargaremos la informacion automáticamente. </h4>', function() {
						cargaInfo(data.cliente);
					});
				};
				console.log(data.cliente);
			},'json');
		});
	};

	function cargaInfo (cliente) {
		$('input[name="razon_social"]').val(cliente.razon_social);
		$('input[name="rfc"]').val(cliente.rfc);
		$('input[name="email"]').val(cliente.email);
		$('input[name="calle"]').val(cliente.calle);
	}

	return {
		init: function() {
			autocompletar();
		}
	}
}();