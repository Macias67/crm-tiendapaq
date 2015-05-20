/**
 * Manejo de tablas de pendientes individuales y generales
 */
var TableManaged = function () {

	var CasosAsignar = function () {
		var table = $('#tabla-casos-asignar');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"pageLength": 10,
			"lengthChange": true,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false }
			],
			"language": {
				"emptyTable": 		"No hay casos por asignar",
				"info": 				"Mostrando _START_ a _END_ de _TOTAL_ casos",
				"infoEmpty": 		"Mostrando 0 a 0 de 0 casos",
				"infoFiltered": 		"(de un total de _MAX_ casos)",
				"infoPostFix": 		"",
				"thousands": 		",",
				"lengthMenu": 		"Show _MENU_ entries",
				"loadingRecords": 	"Cargando...",
				"processing": 		"Procesando...",
				"search": 			"Buscar: ",
				"zeroRecords": 	"No se encontraron coincidencias",
				"lengthMenu": 		"_MENU_ registros"
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
			"order": [ 0, 'asc' ] // set first column as a default sort by asc
		});

		var modal = $('#ajax-asignar-ejecutivo');
		modal.on('shown.bs.modal', function (e) {
			$('.btn_asignar_caso').on('click', function () {
				var id_caso 			= $('#id_caso').val();
				var id_ejecutivo 	= $('#select_ejecutivo').val();
				var ejecutivo_text 	= $("#select_ejecutivo option:selected").html()

				bootbox.confirm('<h4>¿Seguro que quieres asignarle el caso a este ejecutivo?</h4>', function(response) {
					if (response) {
						Metronic.showLoader();
						$.post('/caso/asignar/asignar/', {id_caso:id_caso, id_ejecutivo:id_ejecutivo}, function(data, textStatus, xhr) {
							if (data.exito) {
								bootbox.alert('<h4>Caso asignado a <b>'+ejecutivo_text+'</b> con éxito</h4>',function () {
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
		});
	}

	var DetallesCaso = function () {
		$('#ajax-detalles-caso').on('click', '.ver-cotizacion', function(){
			var url			= '/cotizaciones/previapdf';
			var folio 		= $('#folio_cotizacion').val();
			var idcliente 	= $('#id_cliente').val();

			$.post(url, {folio:folio,idcliente:idcliente}, function(data, textStatus, xhr) {
				if (data.existe) {
					window.open(data.ruta,'','height=800,width=800');
				} else {
					bootbox.alert('<h4>Error, el pdf de la cotización no existe o ha sido eliminado.</h4>');
				}
			}, 'json');
		});
	}

	// Vista casos personales de cada quien
	var tablaMisCasos = function () {
		var table 		= $('.casos-ejecutivo');
		var id_ejecutivo = table.attr('id');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/caso/json_casos/"+id_ejecutivo,
				"type": "POST"
			},
			// set the initial value
			"pageLength": 15,
			"columns": [
				{ "data": "folio_cotizacion" },
				{ "data": "razon_social" },
				{ "data": "fecha_inicio" },
				{ "data": "fecha_final" },
				{
					"data": "id_estatus_general",
					"defaultContent": ''
				}, // estatus
				{
					"data": null,
					"defaultContent": ''
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				var label = '';
				var status = parseInt(aData.id_estatus_general);
				switch (status) {
					case 1:
						label = '<p class="btn btn-circle btn-circle btn-xs red"> Cancelado </p>';
					break;
					case 2:
						label = '<p class="btn btn-circle btn-xs default"> Cerrado </p>';
					break;
					case 3:
						label = '<p class="btn btn-circle btn-xs green"> Pendiente </p>';
					break;
					case 5:
						label = '<p class="btn btn-circle btn-xs yellow"> En Proceso</p>';
					break;
					case 7:
						label = '<p class="btn btn-circle btn-xs green"> Reasignado </p>';
					break;
				}
				$('td:eq(4)', nRow).html(label);
				// Tipo de Cliente
				$('td:eq(5)', nRow).html('<a class="btn blue btn-circle btn-xs" href="'+aData.url+'"><i class="fa fa-search"></i> Detalles</a>');
			},
			"language": {
				"emptyTable":     "No hay casos registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ casos",
				"infoEmpty":      "Mostrando 0 a 0 de 0 casos",
				"infoFiltered":   "(de un total de _MAX_ casos registrados)",
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
			"columnDefs": [
				{ // set default column settings
					'orderable': false,
					'targets': [5]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [
				[4, 'desc']
			] // set first column as a default sort by asc
		});
	}

	// Vista casos personales de cada quien
	var tablaCasos = function () {
		var table = $('.casos-generales');
		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "/caso/json_casos/",
				"type": "POST"
			},
			// set the initial value
			"pageLength": 15,
			"columns": [
				{ "data": "folio_cotizacion" },
				{ "data": "razon_social" },
				{ "data": "id_lider" },
				{
					"data": "id_estatus_general",
					"defaultContent": ''
				}, // estatus
				{
					"data": null,
					"defaultContent": ''
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				var label = '';
				var status = parseInt(aData.id_estatus_general);
				switch (status) {
					case 1:
						label = '<p class="btn btn-circle btn-circle btn-xs red"> Cancelado </p>';
					break;
					case 2:
						label = '<p class="btn btn-circle btn-xs default"> Cerrado </p>';
					break;
					case 3:
						label = '<p class="btn btn-circle btn-xs green"> Pendiente </p>';
					break;
					case 5:
						label = '<p class="btn btn-circle btn-xs yellow"> En Proceso</p>';
					break;
					case 7:
						label = '<p class="btn btn-circle btn-xs green"> Reasignado </p>';
					break;
					case 8:
						label = '<p class="btn btn-circle btn-xs bg-yellow-casablanca"> Por Asignar </p>';
					break;
				}
				$('td:eq(3)', nRow).html(label);
				// Tipo de Cliente
				$('td:eq(4)', nRow).html('<a class="btn blue btn-circle btn-xs" href="'+aData.url+'"><i class="fa fa-search"></i> Detalles</a>');
			},
			"language": {
				"emptyTable":     "No hay casos registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ casos",
				"infoEmpty":      "Mostrando 0 a 0 de 0 casos",
				"infoFiltered":   "(de un total de _MAX_ casos registrados)",
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
			"columnDefs": [
				{ // set default column settings
					'orderable': false,
					'targets': [4]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [
				[3, 'desc']
			] // set first column as a default sort by asc
		});
	}

	var cerrarCaso = function() {
		$('#ajax-detalles-caso').on('shown.bs.modal', function() {
			$('.cerrar-caso').on('click', function() {
				var id_caso = $('input#id_caso').val();
				$.post('/caso/cerrar', {id_caso:id_caso},function(data, textStatus, xhr) {
					bootbox.alert(data.msg, function() {
						location.reload(true);
					});
				}, 'json');
			});
		});
	};

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			bootbox.setDefaults({locale: "es"});
			CasosAsignar();
			DetallesCaso();
			tablaMisCasos();
			tablaCasos();
			cerrarCaso();
		}
	};
}();