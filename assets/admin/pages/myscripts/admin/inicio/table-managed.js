/**
 * Manejo de tablas de pendientes individuales y generales
 */
var TableManaged = function () {

	var misPendientes = function () {

		var table = $('#mis_pendientes');

		table.dataTable({
			"scrollY": "300px",
        		"scrollCollapse": true,
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"language": {
				"emptyTable":     "No hay pendientes registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ pendientes",
				"infoEmpty":      "Mostrando 0 a 0 de 0 pendientes",
				"infoFiltered":   "(de un total de _MAX_ pendientes registrados)",
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
				'targets': [4]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[0, "asc"]
			] // set first column as a default sort by asc
		});
	}

	var pendientesGrales = function () {

		var table = $('#pendientes_grales');

		table.dataTable({
			"scrollY": "300px",
        		"scrollCollapse": true,
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"language": {
				"emptyTable":     "No hay pendientes registrados",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ pendientes",
				"infoEmpty":      "Mostrando 0 a 0 de 0 pendientes",
				"infoFiltered":   "(de un total de _MAX_ pendientes registrados)",
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
				'targets': [0]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[0, "asc"]
			] // set first column as a default sort by asc
		});
	}

	var busquedaRapidaClientes = function() {
		var table = $('#tabla_busqueda_cliente');

		var oTable = table.dataTable({
			"scrollY": "400px",
        		"scrollCollapse": true,
			"pageLength": 5,
			"lengthMenu": [
				[5, 15, 20],
				[5, 15, 20] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "./cliente/table",
				"type": "POST"
			},
			"columns": [
				{ "data": "activo" },
				{ "data": "rfc" },
				{ "data": "razon_social" },
				{ "data": "tipo" },
				{
					"data": null,
					"defaultContent": ''
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
					$('td:eq(3)', nRow).html('<span class="badge badge-success"><b>'+aData.tipo+'</b></span>');
				} else if (aData.tipo == "Prospecto") {
					$('td:eq(3)', nRow).html('<span class="badge badge-warning"><b>'+aData.tipo+'</b></span>');
				} else if(aData.tipo == "Distribuidor"){
					$('td:eq(3)', nRow).html('<span class="badge badge-danger"><b>'+aData.tipo+'</b></span>');
				}
				// Enlace a la edicion
				var id  = $(nRow).attr('id');
				$('td:eq(4)', nRow).html('<a type="button" href="/cliente/gestionar/editar/'+id+'" class="btn btn-circle blue btn-xs"><i class="fa fa-search"></i> Ver </a>');
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
					'targets': [0,4]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [2, 'asc' ] // Ordenados por Razón Social
		});

		var tableWrapper = $("#tabla_busqueda_cliente_wrapper")
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
			bootbox.confirm("<h4>¿Seguro que quieres <b>"+accion+"</b> al cliente <b>"+ aData.razon_social+"</b>?</h4>", function(result) {
				if (result) {
					Metronic.showLoader();
					$.post('./cliente/gestionar/activar', {id:id, selected:selected}, function(data, textStatus, xhr) {
						bootbox.alert(data.mensaje);
						if (data.exito) {
							Metronic.removeLoader();
							table.dataTable().api().ajax.reload();
						}
					}, 'json');
				} else {
					Metronic.removeLoader();
					table.dataTable().api().ajax.reload();
				}
			});
		});
	};

	// Tabla de los casos
	var tablaCasosPrincipal = function () {
		var table = $('#mis_casos');
		table.dataTable({
			"scrollY": "300px",
			"scrollCollapse": true,
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"columns": [
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": true },
				{ "orderable": false }
			],
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
			"order": [
				[4, "desc"]
			] // set first column as a default sort by asc
		});
	}

	// Agregué este evento del que ya tenía en Perfil>Casos
	$('#ajax-detalles-caso').on('click', '.ver-cotizacion', function(){
		var url     = '/cotizaciones/previapdf';
		var folio = $('#folio_cotizacion').val();
		var idcliente = $('#id_cliente').val();

		$.post(url, {folio:folio,idcliente:idcliente}, function(data, textStatus, xhr) {
			if (data.existe) {
				window.open(data.ruta,'','height=800,width=800');
			}else{
				bootbox.alert('<h4>Este caso no tiene una cotización ligada.</h4>');
			}
		}, 'json');
	});

	// Agregué este evento del que ya tenía en Perfil>Casos
	$('#ajax-detalles-caso').on('click', '.cerrar-caso', function(){
		bootbox.confirm('<h4>¿Seguro que quieres cerrar este caso?</h4>', function (response) {
			if(response){
				var url     = '/caso/cerrar';
				var id_caso = $('#id_caso').val();

				$.post(url, {id_caso:id_caso}, function(data, textStatus, xhr) {
					if (data.exito) {
						bootbox.alert(data.msg);
						parent.location.reload();
					}else{
						bootbox.alert(data.msg);
					}
			    	}, 'json');
			}
		});
   	 });

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			misPendientes();
			pendientesGrales();
			busquedaRapidaClientes();
			tablaCasosPrincipal();
		}
	};
}();