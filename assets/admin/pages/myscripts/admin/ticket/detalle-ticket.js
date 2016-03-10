/**
 * Created by Luis on 12/02/2016.
 */
var DetalleTicket = function() {

	var asiganarLider = function() {
		var modal = $('#ajax-asignar-ejecutivo');
		$(document).on('click', ".btn_asignar_ticket", function(event) {
				var id_ticket      = $('#id_ticket').val();
				var id_ejecutivo   = $('#select_ejecutivo').val();
				var ejecutivo_text = $("#select_ejecutivo option:selected").html();

				bootbox.confirm('<h4>¿Seguro que quieres asignarle el caso a este ejecutivo?</h4>', function (response) {
					if (response) {
						Metronic.showLoader();
						$.post('/tickets/asignar/asignar/', {id_ticket: id_ticket, id_ejecutivo: id_ejecutivo}, function (data, textStatus, xhr) {
							if (data.exito) {
								bootbox.alert('<h4>Caso asignado a <b>' + ejecutivo_text + '</b> con éxito</h4>', function () {
									parent.location.reload();
								});
							}
							bootbox.alert(data.msg, function () {
								Metronic.removeLoader();
							});
						}, 'json');
					}
				});
		});
	}

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

	return {
		init : function() {
			$('.mix-grid').mixitup();
			asiganarLider();
			previaPDF();
			muestraPDFCliente();
		}
	}
}();
