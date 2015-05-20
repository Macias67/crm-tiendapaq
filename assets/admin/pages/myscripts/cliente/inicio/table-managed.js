 /**
 * Script para la tabla en vista principal en la seccion
 * de cliente
 */
var TableManaged = function() {

	var tablaCotizacion = function () {

		var table = $('#sample_2');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"language": {
				"emptyTable":     "No hay cotizaciones registradas",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ cotizaciones",
				"infoEmpty":      "Mostrando 0 a 0 de 0 cotizaciones",
				"infoFiltered":   "(de un total de _MAX_ cotizaciones registradas)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Show _MENU_ entries",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search":         "Buscar : ",
				"zeroRecords":    "No se encontraron coincidencias",
				"lengthMenu": "_MENU_ registros"
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [7]
			}, {
				"searchable": false,
				"targets": [5]
			}],
			"order": [
				[0, "asc"]
			] // set first column as a default sort by asc
		});
	}

	// Muestra visualizacvion previa del pdf de la
	// cotizacion al cliente
	var previaPDF = function() {
		$('.cotizacion-previa').on('click', function() {
			// Datos cotizacion
			var folio = $(this).attr('id');

			$.post('/cotizacion/previapdf', {folio:folio}, function(data) {
				if (data.existe) {
					window.open(data.ruta,'','height=800,width=800');
				}
			}, 'json');
		});
	}

	var cacelarCotizacion = function () {
		$('.cancelar-cotizacion').on('click', function() {
			var folio = $(this).attr('folio');
			bootbox.confirm("<h4>¿Seguro que quieres cancelar la cotizacion?</h4>", function (result) {
				if(result){
					$.post('/cotizacion/cancelar', {folio:folio}, function(data, textStatus, xhr) {
						if(data.exito){
							bootbox.alert(data.msg, function () {
								parent.location.reload();
							});
						}else{
							bootbox.alert(data.msg);
						}
					}, 'json');
				}else{
					return;
				}
			});
		});
	}


	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			tablaCotizacion();
			previaPDF();
			cacelarCotizacion();
		}
	};
}();