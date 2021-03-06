var DataTableEventos = function() {

	var handleDatePickers = function () {
		if (jQuery().datepicker) {
			$('.date-picker').datepicker({
				rtl: Metronic.isRTL(),
				orientation: "left",
				autoclose: true
			});
			//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		}
	/* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
	}

	var dataTable = function() {
		var table 	= $('#tabla-catalogo-eventos');
		var oTable 	= table.dataTable({
			"pageLength": 15,
			"lengthMenu": [
				[5, 15, 20, 50, 100],
				[5, 15, 20, 50, 100] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "evento/json_eventos",
				"type": "POST"
			},
			"columns": [
				{ "data": "id_event" },
				{ "data": "ejecutivo" },
				{ "data": "modalidad" },
				{ "data": "titulo" },
				{ "data": "fecha_inicio" },
				{ "data": "url" },
				{ "data": "estatus" },
				{
					"data": null,
					"defaultContent": ''
				}, // estatus
				{
					"data": null,
					"defaultContent": ''
				},
				{
					"data": null,
					"defaultContent": ''
					// "defaultContent": '<button type="button" class="btn btn-circle red btn-xs eliminar"><i class="fa fa-trash-o"></i> Eliminar</button>'
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				//Desactivado
				// if (aData.row_estatus == 3) {
				// 	$(nRow).addClass('success');
				// }
				$('td:eq(5)', nRow).html('<a href="'+aData.url+'" target="_blank">'+aData.url+'</a>');
				$('td:eq(6)', nRow).html('<span class="badge '+aData.estatus['class']+'"><b>'+aData.estatus['estatus']+'</b></span>');
				// Modal
				$('td:eq(7)', nRow).html('<a href="'+aData.url_modal_participantes+'" class="btn btn-circle blue btn-xs modal-participantes" data-target="#ajax_participantes" data-toggle="modal"><i class="fa fa-users"></i></a>');
				// Editar
				$('td:eq(8)', nRow).html('<a href="'+aData.url_editar+'" class="btn btn-circle blue btn-xs"><i class="fa  fa-edit"></i></a>');
				$('td:eq(9)', nRow).html('<button type="button" class="btn btn-circle red btn-xs eliminar"><i class="fa fa-trash-o"></i></button>');
			},
			"language": {
				"emptyTable": 		"No hay eventos registrados",
				"info": 				"Mostrando _START_ a _END_ de _TOTAL_ eventos",
				"infoEmpty": 		"No se ha registrado ningún cliente",
				"infoFiltered": 		"(de un total de _MAX_ eventos registrados)",
				"infoPostFix": 		"",
				"thousands": 		",",
				"lengthMenu": 		"_MENU_ entradas",
				"loadingRecords": 	"Cargando...",
				"processing": 		"Procesando...",
				"search": 			"Buscar: ",
				"zeroRecords": 	"No se encontraron coincidencias",
				"lengthMenu": 		"_MENU_ registros"
			},
			"columnDefs": [
				{ // set default column settings
					'orderable': false,
					'targets': [7,8]
				},
				{
					// "searchable": true,
					// "targets": [0]
				}
			],
			"order": [6, 'desc' ] // Ordenados por fecha
		});
	};

	var handleRecordar = function () {
	// Botón recordar evento a participantes
	var modal = $('#ajax_participantes');
	modal.on('shown.bs.modal', function(e) {
		$('#btn_recordar').on('click', function() {
			var id_evento = $('#id_evento').val();

			$.ajax({
				url: '/evento/modal_recordar/'+id_evento,
				type: 'post',
				cache: false,
				beforeSend: function () {
					Metronic.showLoader();
				},
				error: function(jqXHR, status, error) {
					Metronic.removeLoader();
					console.log("ERROR: "+error);
					alert('ERROR: revisa la consola del navegador para más detalles.');
				},
				success: function(data) {
					if (data.exito) {
						bootbox.alert(data.msg, function() {
							parent.location.reload();
						});
					};
				}
			});
		});
	});

	}
	return {
		init: function() {
			dataTable();
			handleRecordar();
		}
	}
}();