/**
 * Script para la tabla de gestion de los clientes
 */
var TableManagedCliente = function() {

	//Tabla de gestion sistemas contpaqi del cliente
	var handleTableClientes= function () {

		var table = $('#tabla_gestionar_cliente');

		var oTable = table.dataTable({
			"pageLength": 20,
			"lengthMenu": [
				[5, 15, 20, 50, 100],
				[5, 15, 20, 50, 100] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "table",
				"type": "POST"
			},
			"columns": [
				{ "data": "activo" },
				{ "data": "codigo" },
				{ "data": "rfc" },
				{ "data": "razon_social" },
				{ "data": "email" },
				{ "data": "tipo" },
				{
					"data": null,
					"defaultContent": ''
				},
				{
					"data": null,
					"defaultContent": '<button type="button" class="btn btn-circle red btn-xs eliminar"><i class="fa fa-trash-o"></i> Eliminar</button>'
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				// Desactivado
				if (!aData.activo) {
					$(nRow).addClass('danger');
				}
				// Checkbox
				var checkbox = (aData.activo) ? 'checked' : '';
				$(nRow).addClass('odd gradeX');
				$('td:eq(0)', nRow).html('<input type="checkbox" class="checkboxes" '+checkbox+'/>');
				// Tipo de Cliente
				if (aData.tipo == "Normal") {
					$('td:eq(5)', nRow).html('<span class="badge badge-info badge-roundless"><b>'+aData.tipo+'</b></span>');
				} else if (aData.tipo == "Prospecto") {
					$('td:eq(5)', nRow).html('<span class="badge badge-success badge-roundless"><b>'+aData.tipo+'</b></span>');
				}
				// Enlace a la edicion
				var id  = $(nRow).attr('id');
				$('td:eq(6)', nRow).html('<a type="button" href="/cliente/gestionar/editar/'+id+'" class="btn btn-circle green btn-xs"><i class="fa fa-search-plus"></i> Ver/Editar</a>');
			},
			"drawCallback": function(settings) {
				Metronic.initUniform($('input[type="checkbox"]', table)); // reinitialize uniform checkboxes on each table reload
			},
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
				{ // set default column settings
					'orderable': false,
					'targets': [0,6,7]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [3, 'asc' ] // Ordenados por Razón Social
		});

		// Checkbox de la tabla
		// table.find('.group-checkable').change(function () {
		// 	var set = jQuery(this).attr("data-set");
		// 	var checked = jQuery(this).is(":checked");
		// 	jQuery(set).each(function () {
		// 		if (checked) {
		// 			$(this).attr("checked", true);
		// 		} else {
		// 			$(this).attr("checked", false);
		// 		}
		// 	});
		// 	jQuery.uniform.update(set);
		// });

		var tableWrapper = $("#tabla_gestionar_cliente_wrapper")
		tableWrapper.find(".dataTables_length select").addClass("form-control input-xsmall input-inline");

		//funcion para cambiar estatus de activacion
		table.on('change', '.checkboxes', function (e) {
			e.preventDefault();
			//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
			var nRow 		= $(this).parents('tr')[0];
			var aData 		= oTable.fnGetData(nRow);
			var id 			= $(nRow).attr('id');
			var selected 	= $(this).is(':checked'); // False o True
			var accion		= (selected) ? 'activar' : 'desactivar'
			bootbox.confirm("<h5>¿Seguro que quieres <b>"+accion+"</b> al cliente <b>"+ aData.razon_social+"</b>?</h5>", function(result) {
				if (result) {
					$.post('./gestionar/activar', {id:id, selected:selected}, function(data, textStatus, xhr) {
						bootbox.alert(data.mensaje);
						if (data.exito) {
							table.dataTable().api().ajax.reload();
						}
					});
				} else {
					table.dataTable().api().ajax.reload();
				}
			});
		});

		//funcion para eliminar
		table.on('click', '.eliminar', function (e) {
			e.preventDefault();
			//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
			var nRow 	= $(this).parents('tr')[0];
			var aData 	= oTable.fnGetData(nRow);
			var id 		= $(nRow).attr('id');
			bootbox.confirm("<h5>¿Seguro que quieres eliminar a <b>"+ aData.razon_social+"</b>?</h5>", function(result) {
				if (result) {
					$.post('./gestionar/eliminar', {id:id}, function(data, textStatus, xhr) {
						if (data.exito) {
							oTable.fnDeleteRow(nRow);
						}
						bootbox.alert(data.mensaje);
					});
				};
			});
		});
	}
	return {
		init: function() {
			handleTableClientes();
		}
	};
}();