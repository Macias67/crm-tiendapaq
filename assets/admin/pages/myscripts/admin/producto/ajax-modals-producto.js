/**
 * Ventanas modales para los pendientes
 * de cada ejecutivo
 */
var UIExtendedModals = function () {

	var tablaProductos = function () {
		var table = $('#tabla_productos');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "producto/table",
				"type": "POST"
			},
			"columns": [
				{ "data": "codigo" },
				{ "data": "descripcion" },
				{ "data": "precio" },
				{ "data": "unidad" },
				{ "data": "impuesto1" },
				{ "data": "impuesto2" },
				{ "data": "retencion1" },
				{ "data": "retencion2" },
				{
					"data": null
				},
				{
					"data": null
				}
			],
			"rowCallback" : function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				$('td:eq(8)', nRow).html('<a href="/producto/detalles/'+aData.codigo+'" class="btn btn-circle blue btn-xs ajax-editar" data-target="#ajax_form_producto" data-toggle="modal"><i class="fa fa-search"></i> Detalles</a>');
				$('td:eq(9)', nRow).html('<button type="button" class="btn btn-circle red btn-xs eliminar" codigo="P001"><i class="fa fa-trash"></i> Eliminar</button>');
			},
			// set the initial value
			"pageLength": 15,
			"language": {
				"lengthMenu": "_MENU_ registros",
				"search": "Buscar:",
				"loadingRecords": "Cargando...",
				"processing" : "Procesando...",
				"paginate": {
					"previous": "Prev",
					"next": "Sig"
				},
				"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"infoEmpty": "No se ha registrado ningún producto",
				"emptyTable": "No hay informacion disponible",
				"zeroRecords": "No se encontró ningún resultado",
				"infoFiltered": "(filtrado de  un total de _MAX_  entradas)",
			},
			"columnDefs": [
				{  // set default column settings
					'orderable': false,
					'targets': [8, 9]
				},
				{
					"searchable": false,
					"targets": [8, 9]
				}
			],
			"order": [
				[0, "asc"]
			] // set first column as a default sort by asc
		});
	}

	var modalProducto = function() {
		// general settings

		//Ventana editar producto:
		var modal = $("#ajax_form_producto");
		modal.on('shown.bs.modal', function (e) {
			var config = {
				mask: "9{1,7}[.{0,1}9{2}]",
				greedy: false
			};
			$("#form-editar-producto input[name='precio']").inputmask(config);
			$("#form-editar-producto  input[name='impuesto1']").inputmask(config);
			$("#form-editar-producto  input[name='impuesto2']").inputmask(config);
			$("#form-editar-producto  input[name='retencion1']").inputmask(config);
			$("#form-editar-producto  input[name='retencion2']").inputmask(config);
		});
		modal.on('click', '#editar_producto', function() {
			var producto = $('#form-editar-producto').serialize();
			$.ajax({
				url: $('#form-editar-producto').attr('action'),
				type: 'post',
				cache: false,
				dataType: 'json',
				data: producto,
				beforeSend: function () {
					Metronic.showLoader();
				},
				error: function(jqXHR, status, error) {
					console.log("ERROR: "+error);
					bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
						Metronic.removeLoader();
						modal.modal('hide');
					});
				},
				success: function(data) {
					if (data.exito) {
						modal.modal('hide');
						bootbox.alert("<h4>Producto actualizado con éxito.</h4>", function() {
							Metronic.removeLoader(function() {
								location.reload();
							});
						});
					} else {
						bootbox.alert(data.msg, function() {
							modal.modal('hide');
							Metronic.removeLoader();
						});
					}
				}
			});
		});

		//Ventana nuevo producto:
		var modal_nuevo = $('#nuevo_producto_form');
		modal_nuevo.on('shown.bs.modal', function (e) {
			var config = {
				mask: "9{1,7}[.{0,1}9{2}]",
				greedy: false
			};
			$("#form-producto-nuevo input[name='precio']").inputmask(config);
			$("#form-producto-nuevo  input[name='impuesto1']").inputmask(config);
			$("#form-producto-nuevo  input[name='impuesto2']").inputmask(config);
			$("#form-producto-nuevo  input[name='retencion1']").inputmask(config);
			$("#form-producto-nuevo  input[name='retencion2']").inputmask(config);
		});
		modal_nuevo.on('click', '#btn_nuevo_producto', function() {

			var producto = $("#form-producto-nuevo").serialize();

			$.ajax({
				url: $('#form-producto-nuevo').attr('action'),
				type: 'post',
				cache: false,
				dataType: 'json',
				data: producto,
				beforeSend: function () {
					Metronic.showLoader();
				},
				error: function(jqXHR, status, error) {
					console.log("ERROR: "+error);
					bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
						Metronic.removeLoader();
						modal.modal('hide');
					});
				},
				success: function(data) {
					if (data.exito) {
						modal_nuevo.modal('hide');
						bootbox.alert("Nuevo producto añadido con éxito.", function() {
							Metronic.removeLoader(function() {
								location.reload();
							});
						});
					} else {
						bootbox.alert(data.msg, function() {
							modal.modal('hide');
							Metronic.removeLoader();
						});
					}
				}
			});;
		});

		// Eliminar
		$('#tabla_productos tbody').on('click', '.eliminar',function() {
			var data = $('#tabla_productos').dataTable().api().row($(this).parents('tr')).data();
			var codigo = data.codigo;
			bootbox.confirm('<h3>¿Deseas eleminar este producto?</h3>', function(result) {
				if (result) {
					$.ajax({
						url: './producto/gestor/eliminar',
						type: 'post',
						cache: false,
						dataType: 'json',
						data: {codigo: codigo},
						beforeSend: function () {
							Metronic.showLoader();
						},
						error: function(jqXHR, status, error) {
							console.log("ERROR: "+jqXHR);
							bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
								Metronic.removeLoader();
								modal.modal('hide');
							});
						},
						success: function(data) {
							if (data.exito) {
								bootbox.alert("<h4>Producto eliminado.</h4>", function() {
									Metronic.removeLoader(function() {
										location.reload();
									});
								});
							} else {
								bootbox.alert(data.msg);
								Metronic.removeLoader();
							}
						}
					});
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
			bootbox.setDefaults({locale: "es"});
			tablaProductos();
			modalProducto();
		}
	};
}();