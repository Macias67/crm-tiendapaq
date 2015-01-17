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

	var validacion = function() {
		$('#validar').on('click', function() {
			var folio = $('#folio').val();
			var valoracion = $('input[name="valoracion"]:checked').val();

			if(valoracion==undefined){
				bootbox.alert('<h4>Selecciona una valoración.</h4>');
			}else{

				// $.post('/cotizaciones/apertura', {folio:folio, valoracion:valoracion, comentarios:comentarios}, function(data, textStatus, xhr) {
				// 	if (data.exito) {
				// 		bootbox.alert(data.msg, function() {
				// 			window.location = '/';
				// 		});
				// 	} else {
				// 		bootbox.alert('<h3>Error, revisa la consola para mas informacíon.</h3>', function() {
				// 			window.location = '/';
				// 		});
				// 	}
				// }, 'json');


        $.ajax({
            url: '/cotizaciones/apertura',
            type: 'post',
            cache: false,
            dataType: 'json',
            data: "folio="+folio+"&valoracion="+valoracion,
            beforeSend: function () {
                //Metronic.showLoader();
            },
            error: function(jqXHR, status, error) {
                console.log("ERROR: "+error);
                alert('ERROR: revisa la consola del navegador para más detalles.');
            },
            success: function(data) {
              if (data.exito) {
								bootbox.alert(data.msg, function() {
									window.location = '/';
								});
							} else {
								bootbox.alert('<h3>Error, revisa la consola para mas informacíon.</h3>', function() {
									window.location = '/';
								});
							}
            }
        });
			}
		});
	};

	return {
		//main function to initiate the module
		init: function () {
			$('.mix-grid').mixitup();
			validacion();
			previaPDF();
		}
	};
}();