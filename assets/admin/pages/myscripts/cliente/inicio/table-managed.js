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
				"lengthMenu": "_MENU_ registros",
				"search": "Buscar:",
				"paging": {
					"previous": "Prev",
					"next": "Sig"
				},
				"paginate": {
					"previous": "Prev",
					"next": "Sig"
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"zeroRecords": "No se encontró ningún resultado",
				"infoFiltered": "(filtrado de  un total de _MAX_  entradas)"
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [5]
			}, {
				"searchable": false,
				"targets": [5]
			}],
			"order": [
				[0, "asc"]
			] // set first column as a default sort by asc
		});
	}

	var ajaxModal = function() {

		// general settings
		$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
			'<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
				'<div class="progress progress-striped active">' +
					'<div class="progress-bar" style="width: 100%;"></div>' +
				'</div>' +
			'</div>';

		$.fn.modalmanager.defaults.resize = true;

		//ajax demo:
		var $modal = $('#ajax-modal');
		$('.ajax-detalles').on('click', function(){
			var folio = $(this).attr('id');
			// create the backdrop and wait for next modal to be triggered
			$('body').modalmanager('loading');
			setTimeout(function(){
				$modal.load('./cotizacion/detalles/'+folio, '', function(){
					$modal.modal();
				});
			}, 1000);
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


	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			tablaCotizacion();
			ajaxModal();
			previaPDF();
		}
	};
}();