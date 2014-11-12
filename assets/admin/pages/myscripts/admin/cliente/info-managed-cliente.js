/**
 * Script para el manejo y edicion
 * de informacion de cliente:
 * Contactos, sistemas, equipos de computo
 */
var InfoManagedCliente = function() {

	var handleContactos = function() {
		var table = $('#tabla_contactos');

		table.dataTable({
			"pageLength": 5,
			"lengthChange": false,
			"columns": [
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
				"emptyTable" : 		"No hay contactos registrados",
				"info" : 				"Mostrando _START_ a _END_ de _TOTAL_ contactos",
				"infoEmpty" : 		"Mostrando 0 a 0 de 0 contactos",
				"infoFiltered" : 		"(de un total de _MAX_ contactos registrados)",
				"infoPostFix" : 		"",
				"thousands" : 		",",
				"lengthMenu" : 	"Show _MENU_ entries",
				"loadingRecords" : 	"Cargando...",
				"processing" : 		"Procesando...",
				"search" : 			"Buscar: ",
				"zeroRecords" : 	"No se encontraron coincidencias",
				"lengthMenu" : 	"_MENU_ registros"
			},
			"columnDefs": [
				{ // set default column settings
					'orderable': true,
					'targets': [0]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [0, 'asc' ] // set first column as a default sort by asc
		});

		//funcion para eliminar
		$('.eliminar').on('click', function (e) {
			//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
			var id_cliente 	= $('#tabla_contactos').attr('id-cliente');
			var Row 		= $(this).parents('tr');
			var id 			= $(Row[0]).attr('id');
			bootbox.confirm('¿Seguro que quieres eliminar este contacto?', function(response) {
				if (response) {
					$.post('/cliente/contactos/eliminar', {id_cliente:id_cliente, id:id}, function(data, textStatus, xhr) {
						if (data.exito) {
							table.DataTable().row(Row).remove().draw();
						}
						bootbox.alert(data.msg);
					}, 'json');
				}
			});
		});
	}

	return {
		init: function() {
			handleContactos();
		}
	}
}();