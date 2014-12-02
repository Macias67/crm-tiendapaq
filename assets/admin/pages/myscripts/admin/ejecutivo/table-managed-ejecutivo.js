/**
 * Script para la gestion de ejecutivos
 */
var TableManaged = function () {

	var tablaPendientes = function () {
		var table = $('#pendientes-ejecutivo');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 15,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false }
			],
			"language": {
				"emptyTable":     "No hay pendientes registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ pendientes",
				"infoEmpty":      "Mostrando 0 a 0 de 0 pendientes",
				"infoFiltered":   "(de un total de _MAX_ pendientes registrados)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Show _MENU_ registros",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"zeroRecords": "No se encontraron coincidencias",
				"lengthMenu": "_MENU_  Registros",
				"search": "Buscar: ",
				"paginate": {
					"previous": "Anterior",
					"next": "Siguiente"
				}
			},
			"order": [
				[4, "desc"]
			] // set first column as a default sort by asc
		});
	}

	var handleTableEjecutivo = function() {
		var table = $('#tabla_gestionar_ejecutivos');

		var oTable = table.dataTable({
			//"bFilter" : false,
			"bLengthChange": false,
			"pageLength": 20,
			"columns": [
				{ "orderable": false },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false },
				{ "orderable": false }
			],
			"language": {
				"emptyTable": 		"No hay clientes registrados",
				"info": 				"Mostrando _START_ a _END_ de _TOTAL_ clientes",
				"infoEmpty": 		"No se ha registrado ningún cliente",
				"infoFiltered": 		"(de un total de _MAX_ clientes registrados)",
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
				// {
				// 	"searchable": true,
				// 	"targets": [0]
				// }
			],
			"order": [1, 'asc' ] // Ordenados por Razón Social
		});

		table.on('click', '.delete', function() {
			/* Act on the event */
			var nRow 	= $(this).parents('tr')[0];
			var aData 	= oTable.fnGetData(nRow);
			var id 		= $(nRow).attr('id');
			var mensaje = '<h4>¿Seguro que deseas eliminar este ejecutivo del sistema?</h4><br><br><b>Nota: </b> No podrá eliminar los ejecutivos que tengan un caso/pendiente asignado.';
			bootbox.confirm(mensaje, function(result) {
				if (result) {
					$.post('./gestionar/eliminar', {id:id}, function(data, textStatus, xhr) {
						bootbox.alert(data.msg, function() {
							window.location.reload();
						});
					}, 'json');
				}
			});
		});
	}

	//funcion para cambiar de asignador de casos basado en los radiobuttons
	var asignador = function() {
		$('.radios').on('change', function () {

			//se obtiene el id del ejecutivo seleccionado
			var id = $(this).attr('id-radio');
			//ajax para el cambio de asignador de casos
			$.ajax({
				url: '/ejecutivo/asignador/',
				type: 'post',
				cache: false,
				dataType: 'json',
				data: 'id='+id,
				beforeSend: function () {
					Metronic.showLoader();
				},
				error: function(jqXHR, status, error) {
						console.log("ERROR: "+error);
						alert('ERROR: revisa la consola del navegador para más detalles.');
						Metronic.unblockUI();
				},
				success: function(data) {
					if (data.exito) {
						bootbox.alert(data.msg, function() {
							Metronic.removeLoader();
						});
					} else {
						console.log("ERROR: "+data.msg);
						error1.html(data.msg);
						error1.show();
						Metronic.removeLoader();
					}
				}
			});
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			handleTableEjecutivo();
			asignador();
		}
	};
}();