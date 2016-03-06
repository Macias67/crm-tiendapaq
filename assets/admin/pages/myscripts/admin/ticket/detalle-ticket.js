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

	return {
		init : function() {
			asiganarLider();
		}
	}
}();
