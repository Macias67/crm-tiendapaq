var TableManaged = function () {

	var tablaClientes = function () {

		var table = $('#mis_pendientes');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"language": {
				"lengthMenu": "_MENU_ registros",
				"search": "Buscar:",
				"paginate": {
					"previous": "Prev",
					"next": "Sig"
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"zeroRecords": "No se encontró ningún resultado",
				"infoFiltered": "(filtrado de  un total de _MAX_  entradas)",
			},
			"columnDefs": [{  // set default column settings
				'orderable': false,
				'targets': [0]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[1, "asc"]
			] // set first column as a default sort by asc
		});
	}

	var ajaxModal = function() {
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

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			tablaClientes();
			ajaxModal();
		}
	};
}();