var Portfolio = function () {

	// Muestra visualizacvion previa del pdf de la
	// cotizacion al cliente
	var previaPDF = function() {
		$('.cotizacion-previa').on('click', function() {
			// Datos cotizacion
			var folio = $(this).attr('id');
			var idcliente = $(this).attr('id-cliente');

			$.post('/cotizaciones/previapdf', {folio:folio, idcliente:idcliente}, function(data) {
				if (data.existe) {
					window.open(data.ruta,'','height=800,width=800');
				}
			}, 'json');
		});
	}


	var muestraPDFCliente = function() {
		$('.muestra-pdf').on('click', function(event) {
			/* Act on the event */
			var file = $(this).attr('file');
			var ruta = $(this).attr('ruta');
			var cxc =  $(this).attr('cxc');
			window.open(ruta+file,'','height=600,width=500');
		});
	}

	var validacion = function() {
		$('#validar').on('click', function() {
			var folio		= $('#folio').val();
			var tipo 		= $('#tipo').val();
			var cuentaporcobrar	= $('#cuentaporcobrar').val();
			var valoracion	= $('input[name="valoracion"]:checked').val();

			if(valoracion==undefined){
				bootbox.alert('<h4>Selecciona una valoración.</h4>');
			}else{

				$.post('/cotizaciones/apertura', {folio:folio, tipo:tipo, valoracion:valoracion, cuentaporcobrar:cuentaporcobrar}, function(data, textStatus, xhr) {
					if (data.exito) {
						bootbox.alert(data.msg, function() {
							window.location = '/';
						});
					} else {
						bootbox.alert('<h3>Error, revisa la consola para mas información.</h3>');
					}
				}, 'json');

			}
		});
	};

	return {
		//main function to initiate the module
		init: function () {
			$('.mix-grid').mixitup();
			muestraPDFCliente();
			validacion();
			previaPDF();
		}
	};
}();