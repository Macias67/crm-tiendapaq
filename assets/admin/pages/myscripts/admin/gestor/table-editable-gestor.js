var TableEditable = function () {

		// Mascara para el campo telefeno
		var maskTelefono = function() {
			$(".telefono").inputmask('mask', {
				"mask": "(999) 999-9999"
			});

			//mascara de sucursal 4 digitos
			$(".sucursal").inputmask('mask', {
				"mask": "9999"
			});

			//mascara de cuenta 4 digitos
			$(".cta").inputmask('mask', {
				"mask": "9999"
			});
			//mascara de clave interbancaria 18 digitos
			$(".cib").inputmask('mask', {
				"mask": "999999999999999999"
			});

		}

		//Tabla de gestion de oficinas
		var handleTableOficinas = function () {

			var table = $('#tabla_oficinas_editable');

			var oTable = table.dataTable({
					"pageLength": 25,
					searching: false,
					"lengthChange": false,
					"columns": [
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": true },
							{ "orderable": false },
							{ "orderable": false },
							{ "orderable": false }
					],
					"language": {
							"emptyTable":     "No hay oficinas registradas",
							"info":           "Mostrando _START_ a _END_ de _TOTAL_ oficinas",
							"infoEmpty":      "Mostrando 0 a 0 de 0 oficinas",
							"infoFiltered":   "(de un total de _MAX_ oficinas registradas)",
							"infoPostFix":    "",
							"thousands":      ",",
							"lengthMenu":     "Show _MENU_ registros",
							"loadingRecords": "Cargando...",
							"processing":     "Procesando...",
							"zeroRecords":    "No se encontraron coincidencias",
							"lengthMenu": "_MENU_ registros"
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
					"order": [] // set first column as a default sort by asc
			});

			// Validaciones para editar oficina
			var modal = $('#ajax_editar_oficina');
			modal.on('shown.bs.modal', function (e) {
				maskTelefono();
				var form = $('#form-editar-oficina');
				var error = $('.alert-danger', form);
				var success = $('.alert-success', form);

				form.validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block help-block-error', // default input error message class
					focusInvalid: true, // do not focus the last invalid input
					ignore: "",  // validate all fields including form hidden input
					rules: {
						ciudad: {
							maxlength: 40,
							required: true
						},
						estado: {
							//select
						},
						colonia: {
							maxlength: 30,
							required: true
						},
						calle: {
							maxlength: 50,
							required: true
						},
						numero: {
							maxlength: 5
						},
						email: {
							maxlength: 50,
							email: true
						},
						telefono: {
							maxlength: 14
						}
					},
					messages: {
						ciudad: {
							maxlength: "La ciudad debe tener menos de 40 caracteres",
							required: "Escribe la ciudad"
						},
						estado: {
							//select
						},
						colonia: {
							maxlength: "La colonia debe tener menos de 30 caracteres",
							required: "Escribe la colonia"
						},
						calle: {
							maxlength: "La calle debe tener menos de 50 caracteres",
							required: "Escribe la calle"
						},
						numero: {
							maxlength: "El numero debe tener menos de 5 digitos"
						},
						email: {
							maxlength: "El email debe tener menos de 50 caracteres",
							email: "Escribe un email valido"
						},
						telefono: {
						//mascara
						}
					},
					invalidHandler: function (event, validator) { //display error alert on form submit0
						error.fadeIn('slow');
						Metronic.removeLoader();
					},
					highlight: function (element) { // hightlight error inputs
						$(element)
						.closest('.form-group').addClass('has-error'); // set error class to the control group
					},
					unhighlight: function (element) { // revert the change done by hightlight
						$(element)
						.closest('.form-group').removeClass('has-error'); // set error class to the control group
					},
					success: function (label) {
						label
						.closest('.form-group').removeClass('has-error'); // set success class to the control group
					},
					submitHandler: function (form) {
						var url 		= '/gestor/oficinas/editar';
						var param 	= $('#form-editar-oficina').serialize();

						Metronic.showLoader();
						$.post(url, param, function(data, textStatus, xhr) {
							if (data.exito) {
								Metronic.removeLoader();
								modal.modal('hide');
								bootbox.alert(data.msg, function() {
									location.reload();
								});
							} else {
								Metronic.unblockUI();
								bootbox.alert(data.msg, function() {
									modal.modal('show');
									Metronic.removeLoader();
								});
							}
						});
					}
				});
			});

			// Validaciones para nueva oficina
			var modal_nuevo = $('#modal_nueva_oficina');
			modal_nuevo.on('shown.bs.modal', function (e) {
				maskTelefono();
				var form = $('#form-nueva-oficina');
				var error = $('.alert-danger', form);
				var success = $('.alert-success', form);

				form.validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block help-block-error', // default input error message class
					focusInvalid: true, // do not focus the last invalid input
					ignore: "",  // validate all fields including form hidden input
					rules: {
						ciudad: {
							maxlength: 40,
							required: true
						},
						estado: {
							//select
						},
						colonia: {
							maxlength: 30,
							required: true
						},
						calle: {
							maxlength: 50,
							required: true
						},
						numero: {
							maxlength: 5
						},
						email: {
							maxlength: 50,
							email: true
						},
						telefono: {
							maxlength: 14
						}
					},
					messages: {
						ciudad: {
							maxlength: "La ciudad debe tener menos de 40 caracteres",
							required: "Escribe la ciudad"
						},
						estado: {
							//select
						},
						colonia: {
							maxlength: "La colonia debe tener menos de 30 caracteres",
							required: "Escribe la colonia"
						},
						calle: {
							maxlength: "La calle debe tener menos de 50 caracteres",
							required: "Escribe la calle"
						},
						numero: {
							maxlength: "El numero debe tener menos de 5 digitos"
						},
						email: {
							maxlength: "El email debe tener menos de 50 caracteres",
							email: "Escribe un email valido"
						},
						telefono: {
						//mascara
						}
					},
					invalidHandler: function (event, validator) { //display error alert on form submit
						error.fadeIn('slow');
					},
					highlight: function (element) { // hightlight error inputs
						$(element)
						.closest('.form-group').addClass('has-error'); // set error class to the control group
					},
					unhighlight: function (element) { // revert the change done by hightlight
						$(element)
						.closest('.form-group').removeClass('has-error'); // set error class to the control group
					},
					success: function (label) {
						label
						.closest('.form-group').removeClass('has-error'); // set success class to the control group
					},
					submitHandler: function (form) {
						var url 		= '/gestor/oficinas/nuevo';
						var param 	= $('#form-nueva-oficina').serialize();

						 Metronic.showLoader();
						$.post(url, param, function(data, textStatus, xhr) {
							if (data.exito) {
								Metronic.removeLoader();
								modal_nuevo.modal('hide');
								bootbox.alert(data.msg, function() {
									location.reload();
								});
							} else {
								Metronic.removeLoader();
								bootbox.alert(data.msg, function() {
									modal_nuevo.modal('show');
								});
							}
						});
					}
				});
			});

			//funcion para eliminar
			$('.eliminar-oficina').on('click', function (e) {
				//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
				var Row 		    = $(this).parents('tr');
				var id_oficina 	= $(Row[0]).attr('id');
				var ciudad 	=  $(Row[0]).attr('ciudad');
				var estado 	=  $(Row[0]).attr('estado');
				bootbox.confirm('<h4>¿Seguro que quieres esta oficina?</h4>', function(response) {
					if (response) {
						Metronic.showLoader();
						$.post('/gestor/oficinas/eliminar', {id_oficina:id_oficina,ciudad:ciudad,estado:estado}, function(data, textStatus, xhr) {
							if (data.exito) {
								table.DataTable().row(Row).remove().draw();
							}
							bootbox.alert(data.msg, function () {
								Metronic.removeLoader();
							});
						}, 'json');
					}
				});
			});
		}

		//Tabla de gestion de departamentos
		var handleTableDepartamentos = function () {

				function restoreRow(oTable, nRow) {
						var aData = oTable.fnGetData(nRow);
						var jqTds = $('>td', nRow);

						for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
								oTable.fnUpdate(aData[i], nRow, i, false);
						}
						oTable.fnDraw();
				}
				//funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
				function editRow(oTable, nRow) {
						var aData = oTable.fnGetData(nRow);
						var jqTds = $('>td', nRow);
						jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
						jqTds[1].innerHTML = '<a class="btn edit green btn-circle btn-xs" href=""><i class="fa fa-save"></i> Guardar</a>';
						jqTds[2].innerHTML = '<a class="btn cancel red btn-circle btn-xs" href=""><i class="fa fa-ban"></i> Cancelar</a>';
				}

				//funcion para obtener los valores de los inputs y guardarlos en la bd
				//ya sea creando nuevo o editando existente
				function saveRow(oTable, nRow) {
						var jqInputs = $('input', nRow);

						oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
						oTable.fnUpdate('<a class="btn edit blue btn-circle btn-xs" href=""><i class="fa fa-edit"></i> Editar</a>', nRow, 1, false);
						oTable.fnUpdate('<a class="btn delete red btn-circle btn-xs" href=""><i class="fa fa-trash"></i> Eliminar</a>', nRow, 2, false);
						oTable.fnDraw();

						var id_departamento = $(nRow).attr('id');
						//variable creada a manera de sintaxis post para mandar los valores al controlador gestor
						var departamento='id_departamento='+id_departamento+'&'+
															'area='+jqInputs[0].value;
						//if para saber si se trata editar o nuevo
						//si no tiene id es nuevo, si tiene un id existente es editar
						if(id_departamento!=undefined)
						{
								$.ajax({
										url: "/gestor/departamentos/editar",
										type: 'post',
										cache: false,
										dataType: 'json',
										data: departamento,
										beforeSend: function () {
											 Metronic.showLoader();
										},
										error: function(jqXHR, status, error) {
												console.log("ERROR: "+error);
												alert('ERROR: revisa la consola del navegador para más detalles.');
												Metronic.removeLoader();
										},
										success: function(data) {
												if (data.exito) {
														bootbox.alert("<h4>Departamento: <b>"+data.departamento+"</b> actualizado con éxito</h4>", function () {
																Metronic.removeLoader();
																parent.location.reload();
														});
												} else {
														bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
														editRow(oTable, nRow);
														nEditing = nRow;
														Metronic.removeLoader();
												}
										}
								});
						}else
						{
								$.ajax({
										url: "/gestor/departamentos/nuevo",
										type: 'post',
										cache: false,
										dataType: 'json',
										data: departamento,
										beforeSend: function () {
											 Metronic.showLoader();
										},
										error: function(jqXHR, status, error) {
												console.log("ERROR: "+error);
												alert('ERROR: revisa la consola del navegador para más detalles.');
												Metronic.removeLoader();
										},
										success: function(data) {
												if (data.exito) {
														bootbox.alert("<h4>Departamento: <b>"+data.departamento+"</b> añadido con éxito<h4>", function () {
																Metronic.removeLoader();
																parent.location.reload();
														});
												} else {
														bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
														editRow(oTable, nRow);
														nEditing = nRow;
														Metronic.removeLoader();
												}
										}
								});
						}
				}

				function cancelEditRow(oTable, nRow) {
						var jqInputs = $('input', nRow);
						oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
						oTable.fnUpdate('<a class="btn edit blue btn-circle btn-xs" href=""><i class="fa fa-edit"></i> Editar</a>', nRow, 1, false);
						oTable.fnDraw();
				}

				var table = $('#tabla_departamentos_editable');

				//mensajes y caracteristicas de la tabla
				var oTable = table.dataTable({
						"pageLength": 25,
						searching: false,
						"lengthChange": false,
						"columns": [
								{ "orderable": true },
								{ "orderable": false },
								{ "orderable": false }
						],
						"language": {
								"emptyTable":     "No hay departamentos registrados",
								"info":           "Mostrando _START_ a _END_ de _TOTAL_ departamentos",
								"infoEmpty":      "Mostrando 0 a 0 de 0 departamentos",
								"infoFiltered":   "(de un total de _MAX_ departamentos registrados)",
								"infoPostFix":    "",
								"thousands":      ",",
								"lengthMenu":     "Show _MENU_ entries",
								"loadingRecords": "Cargando...",
								"processing":     "Procesando...",
								"zeroRecords":    "No se encontraron coincidencias",
								"lengthMenu": "_MENU_ registros"
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
						 "order": []
				});

				var tableWrapper = $("#tabla_departamentos_editable_wrapper");

				tableWrapper.find(".dataTables_length select").select2({
						showSearchInput: false //hide search box with special css class
				}); // initialize select2 dropdown

				var nEditing = null;
				var nNew = false;

				//funcion para crear nuevo
				$('#tabla_departamentos_editable_new').click(function (e) {
						e.preventDefault();
						//verificacion de que no este editando una fila antes de crear otra
						if (nNew || nEditing) {
								bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
						}else{
								//valores por default en los inputs al crear nuevo
								var aiNew = oTable.fnAddData(['','','']);
								var nRow = oTable.fnGetNodes(aiNew[0]);
								editRow(oTable, nRow);
								nEditing = nRow;
								nNew = true;
						}
				});

				//funcion para eliminar
				table.on('click', '.delete', function (e) {
						e.preventDefault();

						var nRow = $(this).parents('tr')[0];
						//valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
						var aData = oTable.fnGetData(nRow);
						var id_departamento = $(nRow).attr('id');

						bootbox.confirm("<h4>¿Seguro que quieres borrar el departamento <b>"+aData[0]+"</b>?</h4>",function (result) {
								if(result){
										//ajax para borrar
										$.ajax({
												url: "/gestor/departamentos/eliminar",
												type: 'post',
												cache: false,
												dataType: 'json',
												data: "id_departamento="+id_departamento+"&area="+aData[0],
												beforeSend: function () {
													 Metronic.showLoader();
												},
												error: function(jqXHR, status, error) {
														console.log("ERROR: "+error);
														alert('ERROR: revisa la consola del navegador para más detalles.');
														Metronic.removeLoader();
												},
												success: function(data) {
														if (data.exito) {
																Metronic.removeLoader();
																bootbox.alert("<h4>Departamento: <b>"+data.departamento+"</b> eliminado con éxito</h4>");
																//parent.location.reload();
																oTable.fnDeleteRow(nRow);
														} else {
																bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
																Metronic.removeLoader();
																//parent.location.reload();
														}
												}
										});
								}else{
										return;
								}
						});
				});

				//funcion cancelar
				table.on('click', '.cancel', function (e) {
						e.preventDefault();

						if (nNew) {
								oTable.fnDeleteRow(nEditing);
								nEditing = null;
								nNew = false;
						} else {
								restoreRow(oTable, nEditing);
								nEditing = null;
						}
				});

				//funcion para editar una oficina
				table.on('click', '.edit', function (e) {
						e.preventDefault();
						if(nNew)
						{
								saveRow(oTable, nEditing);
								nEditing = nRow;
								nNew = true;
						}else
						{
								/* Get the row as a parent of the link that was clicked on */
								var nRow = $(this).parents('tr')[0];

								if (nEditing !== null && nEditing != nRow) {
										/* Currently editing - but not this row - restore the old before continuing to edit mode */
										restoreRow(oTable, nEditing);
										editRow(oTable, nRow);
										nEditing = nRow;
								} else if (nEditing == nRow && this.innerHTML == '<i class="fa fa-save"></i> Guardar') {
										/* Editing this row and want to save it */
										saveRow(oTable, nEditing);
										nEditing = null;
								} else {
										/* No edit in progress - let's start one */
										editRow(oTable, nRow);
										nEditing = nRow;
								}
						}
				});
		}

		//Tabla de gestion de Sistemas contpaqi
		var handleTableSistemas = function () {

				function restoreRow(oTable, nRow) {
						var aData = oTable.fnGetData(nRow);
						var jqTds = $('>td', nRow);

						for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
								oTable.fnUpdate(aData[i], nRow, i, false);
						}
						oTable.fnDraw();
				}
				//funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
				function editRow(oTable, nRow) {
						var aData = oTable.fnGetData(nRow);
						var jqTds = $('>td', nRow);
						jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
						jqTds[1].innerHTML = '<a class="btn edit green btn-circle btn-xs" href=""><i class="fa fa-save"></i> Guardar</a>';
						jqTds[2].innerHTML = '<a class="btn cancel red btn-circle btn-xs" href=""><i class="fa fa-ban"></i> Cancelar</a>';
				}

				//funcion para obtener los valores de los inputs y guardarlos en la bd
				//ya sea creando nuevo o editando existente
				function saveRow(oTable, nRow) {
						var jqInputs = $('input', nRow);

						oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
						oTable.fnUpdate('<a class="btn edit blue btn-circle btn-xs" href=""><i class="fa fa-edit"></i> Editar</a>', nRow, 1, false);
						oTable.fnUpdate('<a class="btn delete red btn-circle btn-xs" href=""><i class="fa fa-trash"></i> Eliminar</a>', nRow, 2, false);
						oTable.fnDraw();

						//id del tr pasa saber que linea estamos usando
						var id_sistema = $(nRow).attr('id');
						//variable creada a manera de sintaxis post para mandar los valores al controlador gestor
						var sistema='id_sistema='+id_sistema+'&'+
												'sistema='+jqInputs[0].value;
						//if para saber si se trata editar o nuevo
						//si no tiene id es nuevo, si tiene un id existente es editar
						if(id_sistema!=undefined)
						{
								id_sistema="undefined";
								$.ajax({
										url: "/gestor/sistemas/editar",
										type: 'post',
										cache: false,
										dataType: 'json',
										data: sistema,
										beforeSend: function () {
											 Metronic.showLoader();
										},
										error: function(jqXHR, status, error) {
												console.log("ERROR: "+error);
												alert('ERROR: revisa la consola del navegador para más detalles.');
												Metronic.removeLoader();
										},
										success: function(data) {
												if (data.exito) {
														bootbox.alert("<h4>Sistema: <b>"+data.sistema+"</b> actualizado con éxito</h4>", function () {
																Metronic.removeLoader();
																parent.location.reload();
														});
												} else {
														bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
														editRow(oTable, nRow);
														nEditing = nRow;
														Metronic.removeLoader();
												}
										}
								});
						}else
						{
								$.ajax({
										url: "/gestor/sistemas/nuevo",
										type: 'post',
										cache: false,
										dataType: 'json',
										data: sistema,
										beforeSend: function () {
											 Metronic.showLoader();
										},
										error: function(jqXHR, status, error) {
												console.log("ERROR: "+error);
												alert('ERROR: revisa la consola del navegador para más detalles.');
												Metronic.removeLoader();
										},
										success: function(data) {
												if (data.exito) {
														bootbox.alert("<h4>Sistema: <b>"+data.sistema+"</b> añadido con éxito<h4>", function () {
																parent.location.reload();
														});
												} else {
														bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
														editRow(oTable, nRow);
														nEditing = nRow;
														Metronic.removeLoader();
												}
										}
								});
						}
				}

				function cancelEditRow(oTable, nRow) {
						var jqInputs = $('input', nRow);
						oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
						oTable.fnUpdate('<a class="btn edit blue btn-circle btn-xs" href=""><i class="fa fa-edit"></i> Editar</a>', nRow, 1, false);
						oTable.fnDraw();
				}

				var table = $('#tabla_sistemas_editable');

				//mensajes y caracteristicas de la tabla
				var oTable = table.dataTable({
						"pageLength": 20,
						searching: false,
						"lengthChange": false,
						"columns": [
								{ "orderable": true },
								{ "orderable": false },
								{ "orderable": false }
						],
						"language": {
								"emptyTable":     "No hay sistemas registrados",
								"info":           "Mostrando _START_ a _END_ de _TOTAL_ sistemas",
								"infoEmpty":      "Mostrando 0 a 0 de 0 sistemas",
								"infoFiltered":   "(de un total de _MAX_ sistemas registrados)",
								"infoPostFix":    "",
								"thousands":      ",",
								"lengthMenu":     "Show _MENU_ entries",
								"loadingRecords": "Cargando...",
								"processing":     "Procesando...",
								"zeroRecords":    "No se encontraron coincidencias",
								"lengthMenu": "_MENU_ registros"
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
						 "order": [ 0, 'asc' ]
				});

				var tableWrapper = $("#tabla_sistemas_editable_wrapper");

				tableWrapper.find(".dataTables_length select").select2({
						showSearchInput: false //hide search box with special css class
				}); // initialize select2 dropdown

				var nEditing = null;
				var nNew = false;

				//funcion para crear nuevo
				$('#tabla_sistemas_editable_new').click(function (e) {
						e.preventDefault();
						//verificacion de que no este editando una fila antes de crear otra
						if (nNew || nEditing) {
								bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
						}else{
								//valores por default en los inputs al crear nuevo
								var aiNew = oTable.fnAddData(['CONTPAQI®','','']);
								var nRow = oTable.fnGetNodes(aiNew[0]);
								editRow(oTable, nRow);
								nEditing = nRow;
								nNew = true;
						}
				});

				//funcion para eliminar
				table.on('click', '.delete', function (e) {
						e.preventDefault();

						var nRow = $(this).parents('tr')[0];
						//valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
						var aData = oTable.fnGetData(nRow);
						var id_sistema = $(nRow).attr('id');

						bootbox.confirm("<h4>¿Seguro que quieres borrar el sistema <b>"+aData[0]+"</b>?<h4>",function (result) {
								if(result){
										//ajax para borrar
										$.ajax({
												url: "/gestor/sistemas/eliminar",
												type: 'post',
												cache: false,
												dataType: 'json',
												data: "id_sistema="+id_sistema+"&sistema="+aData[0],
												beforeSend: function () {
													 Metronic.showLoader();
												},
												error: function(jqXHR, status, error) {
														console.log("ERROR: "+error);
														alert('ERROR: revisa la consola del navegador para más detalles.');
														Metronic.removeLoader();
												},
												success: function(data) {
														if (data.exito) {
																Metronic.removeLoader();
																bootbox.alert("<h4>Sistema: <b>"+data.sistema+"</b> eliminado con éxito</h4>", function () {
																		parent.location.reload();
																});
																oTable.fnDeleteRow(nRow);
														} else {
																bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
																Metronic.removeLoader();
														}
												}
										});
								}else{
										return;
								}
						});
				});

				//funcion cancelar
				table.on('click', '.cancel', function (e) {
						e.preventDefault();

						if (nNew) {
								oTable.fnDeleteRow(nEditing);
								nEditing = null;
								nNew = false;
						} else {
								restoreRow(oTable, nEditing);
								nEditing = null;
						}
				});

				//funcion para editar una oficina
				table.on('click', '.edit', function (e) {
						e.preventDefault();
						if(nNew)
						{
								saveRow(oTable, nEditing);
								nEditing = nRow;
								nNew = true;
						}else
						{
								/* Get the row as a parent of the link that was clicked on */
								var nRow = $(this).parents('tr')[0];

								if (nEditing !== null && nEditing != nRow) {
										/* Currently editing - but not this row - restore the old before continuing to edit mode */
										restoreRow(oTable, nEditing);
										editRow(oTable, nRow);
										nEditing = nRow;
								} else if (nEditing == nRow && this.innerHTML == '<i class="fa fa-save"></i> Guardar') {
										/* Editing this row and want to save it */
										saveRow(oTable, nEditing);
										nEditing = null;
								} else {
										/* No edit in progress - let's start one */
										editRow(oTable, nRow);
										nEditing = nRow;
								}
						}
				});
		}

		//Tabla de gestion de sistemas operativos
		var handleTableSistemasOperativos = function () {

				function restoreRow(oTable, nRow) {
						var aData = oTable.fnGetData(nRow);
						var jqTds = $('>td', nRow);

						for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
								oTable.fnUpdate(aData[i], nRow, i, false);
						}
						oTable.fnDraw();
				}
				//funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
				function editRow(oTable, nRow) {
						var aData = oTable.fnGetData(nRow);
						var jqTds = $('>td', nRow);
						jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
						jqTds[1].innerHTML = '<a class="btn edit green btn-circle btn-xs" href=""><i class="fa fa-save"></i> Guardar</a>';
						jqTds[2].innerHTML = '<a class="btn cancel red btn-circle btn-xs" href=""><i class="fa fa-ban"></i> Cancelar</a>';
				}

				//funcion para obtener los valores de los inputs y guardarlos en la bd
				//ya sea creando nuevo o editando existente
				function saveRow(oTable, nRow) {
						var jqInputs = $('input', nRow);
						oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
						oTable.fnUpdate('<a class="btn edit blue btn-circle btn-xs" href=""><i class="fa fa-edit"></i> Editar</a>', nRow, 1, false);
						oTable.fnUpdate('<a class="btn delete red btn-circle btn-xs" href=""><i class="fa fa-trash"></i> Eliminar</a>', nRow, 2, false);
						oTable.fnDraw();

						var id_so = $(nRow).attr('id');
						//variable creada a manera de sintaxis post para mandar los valores al controlador gestor
						var so='id_so='+id_so+'&'+
										'sistema_operativo='+jqInputs[0].value;
						//if para saber si se trata editar o nuevo
						//si no tiene id es nuevo, si tiene un id existente es editar
						if(id_so!=undefined)
						{
								id_so="undefined";
								$.ajax({
										url: "/gestor/operativos/editar",
										type: 'post',
										cache: false,
										dataType: 'json',
										data: so,
										beforeSend: function () {
											 Metronic.showLoader();
										},
										error: function(jqXHR, status, error) {
												console.log("ERROR: "+error);
												alert('ERROR: revisa la consola del navegador para más detalles.');
												Metronic.removeLoader();
										},
										success: function(data) {
												if (data.exito) {
														bootbox.alert("<h4>Sistema operativo: <b>"+data.so+"</b> actualizado con éxito</h4>", function () {
																parent.location.reload();
														});
												} else {
														bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
														editRow(oTable, nRow);
														nEditing = nRow;
														Metronic.removeLoader();
												}
										}
								});
						}else
						{
								$.ajax({
										url: "/gestor/operativos/nuevo",
										type: 'post',
										cache: false,
										dataType: 'json',
										data: so,
										beforeSend: function () {
											 Metronic.showLoader();
										},
										error: function(jqXHR, status, error) {
												console.log("ERROR: "+error);
												alert('ERROR: revisa la consola del navegador para más detalles.');
												Metronic.removeLoader();
										},
										success: function(data) {
												if (data.exito) {
														bootbox.alert("<h4>Sistema operativo: <b>"+data.so+"</b> añadido con éxito</h4>",function () {
																parent.location.reload();
														});
												} else {
														bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
														editRow(oTable, nRow);
														nEditing = nRow;
														Metronic.removeLoader();
												}
										}
								});
						}
				}

				function cancelEditRow(oTable, nRow) {
						var jqInputs = $('input', nRow);
						oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
						oTable.fnUpdate('<a class="btn edit blue btn-circle btn-xs" href=""><i class="fa fa-edit"></i> Editar</a>', nRow, 1, false);
						oTable.fnDraw();
				}

				var table = $('#tabla_operativos_editable');

				//mensajes y caracteristicas de la tabla
				var oTable = table.dataTable({
						"pageLength": 30,
						searching: false,
						"lengthChange": false,
						"columns": [
								{ "orderable": true },
								{ "orderable": false },
								{ "orderable": false }
						],
						"language": {
								"emptyTable":     "No hay sistemas operativos registrados",
								"info":           "Mostrando _START_ a _END_ de _TOTAL_ sistemas",
								"infoEmpty":      "Mostrando 0 a 0 de 0 sistemas",
								"infoFiltered":   "(de un total de _MAX_ sistemas registrados)",
								"infoPostFix":    "",
								"thousands":      ",",
								"lengthMenu":     "Show _MENU_ entries",
								"loadingRecords": "Cargando...",
								"processing":     "Procesando...",
								"zeroRecords":    "No se encontraron coincidencias",
								"lengthMenu": "_MENU_ registros"
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
						 "order": []
				});

				var tableWrapper = $("#tabla_operativos_editable_wrapper");

				tableWrapper.find(".dataTables_length select").select2({
						showSearchInput: false //hide search box with special css class
				}); // initialize select2 dropdown

				var nEditing = null;
				var nNew = false;

				//funcion para crear nuevo
				$('#tabla_operativos_editable_new').click(function (e) {
						e.preventDefault();
						//verificacion de que no este editando una fila antes de crear otra
						if (nNew || nEditing) {
								bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
						}else{
								//valores por default en los inputs al crear nuevo
								var aiNew = oTable.fnAddData(['','','']);
								var nRow = oTable.fnGetNodes(aiNew[0]);
								editRow(oTable, nRow);
								nEditing = nRow;
								nNew = true;
						}
				});

				//funcion para eliminar
				table.on('click', '.delete', function (e) {
						e.preventDefault();

						var nRow = $(this).parents('tr')[0];
						//valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
						var aData = oTable.fnGetData(nRow);
						var id_so = $(nRow).attr('id');

						bootbox.confirm("<h4>¿Seguro que quieres borrar el sistema operativo <b>"+aData[0]+"</b>?</h4>",function (result) {
								if(result){
										//ajax para borrar
										$.ajax({
												url: "/gestor/operativos/eliminar",
												type: 'post',
												cache: false,
												dataType: 'json',
												data: "id_so="+id_so+"&sistema_operativo="+aData[0],
												beforeSend: function () {
													 Metronic.showLoader();
												},
												error: function(jqXHR, status, error) {
														console.log("ERROR: "+error);
														alert('ERROR: revisa la consola del navegador para más detalles.');
														Metronic.removeLoader();
												},
												success: function(data) {
														if (data.exito) {
																Metronic.removeLoader();
																bootbox.alert("<h4>Sistema operativo: <b>"+data.so+"</b> eliminado con éxito<h4>");
																//parent.location.reload();
																oTable.fnDeleteRow(nRow);
														} else {
																bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
																Metronic.removeLoader();
																//parent.location.reload();
														}
												}
										});
								}else{
										return;
								}
						});
				});

				//funcion cancelar
				table.on('click', '.cancel', function (e) {
						e.preventDefault();

						if (nNew) {
								oTable.fnDeleteRow(nEditing);
								nEditing = null;
								nNew = false;
						} else {
								restoreRow(oTable, nEditing);
								nEditing = null;
						}
				});

				//funcion para editar una oficina
				table.on('click', '.edit', function (e) {
						e.preventDefault();
						if(nNew)
						{
								saveRow(oTable, nEditing);
								nEditing = nRow;
								nNew = true;
						}else
						{
								/* Get the row as a parent of the link that was clicked on */
								var nRow = $(this).parents('tr')[0];

								if (nEditing !== null && nEditing != nRow) {
										/* Currently editing - but not this row - restore the old before continuing to edit mode */
										restoreRow(oTable, nEditing);
										editRow(oTable, nRow);
										nEditing = nRow;
								} else if (nEditing == nRow && this.innerHTML == '<i class="fa fa-save"></i> Guardar') {
										/* Editing this row and want to save it */
										saveRow(oTable, nEditing);
										nEditing = null;
								} else {
										/* No edit in progress - let's start one */
										editRow(oTable, nRow);
										nEditing = nRow;
								}
						}
				});
		}

		//Tabla de gestion de bancos
		var handleTableBancos = function () {

				var table = $('#tabla_bancos_editable');

				//mensajes y caracteristicas de la tabla
				var oTable = table.dataTable({
						"pageLength": 25,
						searching: false,
						"lengthChange": false,
						"columns": [
								{ "orderable": true },
								{ "orderable": true },
								{ "orderable": true },
								{ "orderable": true },
								{ "orderable": true },
								{ "orderable": false },
								{ "orderable": false }
						],
						"language": {
								"emptyTable":     "No hay bancos registrados",
								"info":           "Mostrando _START_ a _END_ de _TOTAL_ bancos",
								"infoEmpty":      "Mostrando 0 a 0 de 0 bancos",
								"infoFiltered":   "(de un total de _MAX_ bancos registrados)",
								"infoPostFix":    "",
								"thousands":      ",",
								"lengthMenu":     "Show _MENU_ entries",
								"loadingRecords": "Cargando...",
								"processing":     "Procesando...",
								"zeroRecords":    "No se encontraron coincidencias",
								"lengthMenu": "_MENU_ registros"
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
						 "order": []
				});

			// Validaciones para editar banco
			var modal = $('#ajax_editar_banco');
			modal.on('shown.bs.modal', function (e) {
				maskTelefono();
				var form = $('#form-editar-banco');
				var error = $('.alert-danger', form);
				var success = $('.alert-success', form);

				form.validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block help-block-error', // default input error message class
					focusInvalid: true, // do not focus the last invalid input
					ignore: "",  // validate all fields including form hidden input
					rules: {
						banco: {
							//select
						},
						sucursal: {
							//mascara
						},
						cta: {
							//mascara
						},
						titular: {
							maxlength: 50,
							required: true
						},
						cib: {
							//mascara
						}
					},
					messages: {
						banco: {
							//select
						},
						sucursal: {
							//mascara
						},
						cta: {
							//mascara
						},
						titular: {
							maxlength: "El titular debe tener menos de 50 caracteres",
							required: "Escribe el titular"
						},
						cib: {
							//mascara
						}
					},
					invalidHandler: function (event, validator) { //display error alert on form submit0
						error.fadeIn('slow');
						Metronic.removeLoader();
					},
					highlight: function (element) { // hightlight error inputs
						$(element)
						.closest('.form-group').addClass('has-error'); // set error class to the control group
					},
					unhighlight: function (element) { // revert the change done by hightlight
						$(element)
						.closest('.form-group').removeClass('has-error'); // set error class to the control group
					},
					success: function (label) {
						label
						.closest('.form-group').removeClass('has-error'); // set success class to the control group
					},
					submitHandler: function (form) {
						var url 		= '/gestor/bancos/editar';
						var param 	= $('#form-editar-banco').serialize();

						Metronic.showLoader();
						$.post(url, param, function(data, textStatus, xhr) {
							if (data.exito) {
								Metronic.removeLoader();
								modal.modal('hide');
								bootbox.alert(data.msg, function() {
									location.reload();
								});
							} else {
								Metronic.unblockUI();
								bootbox.alert(data.msg, function() {
									modal.modal('show');
									Metronic.removeLoader();
								});
							}
						});
					}
				});
			});

			// Validaciones para nuevo banco
			var modal_nuevo = $('#modal_nuevo_banco');
			modal_nuevo.on('shown.bs.modal', function (e) {
				maskTelefono();
				var form = $('#form-nuevo-banco');
				var error = $('.alert-danger', form);
				var success = $('.alert-success', form);

				form.validate({
					errorElement: 'span', //default input error message container
					errorClass: 'help-block help-block-error', // default input error message class
					focusInvalid: true, // do not focus the last invalid input
					ignore: "",  // validate all fields including form hidden input
					rules: {
						banco: {
							//select
						},
						sucursal: {
							//mascara
						},
						cta: {
							//mascara
						},
						titular: {
							maxlength: 50,
							required: true
						},
						cib: {
							//mascara
						}
					},
					messages: {
						banco: {
							//select
						},
						sucursal: {
							//mascara
						},
						cta: {
							//mascara
						},
						titular: {
							maxlength: "El titular debe tener menos de 50 caracteres",
							required: "Escribe el titular"
						},
						cib: {
							//mascara
						}
					},
					invalidHandler: function (event, validator) { //display error alert on form submit
						error.fadeIn('slow');
						Metronic.removeLoader();
					},
					highlight: function (element) { // hightlight error inputs
						$(element)
						.closest('.form-group').addClass('has-error'); // set error class to the control group
					},
					unhighlight: function (element) { // revert the change done by hightlight
						$(element)
						.closest('.form-group').removeClass('has-error'); // set error class to the control group
					},
					success: function (label) {
						label
						.closest('.form-group').removeClass('has-error'); // set success class to the control group
					},
					submitHandler: function (form) {
						var url 		= '/gestor/bancos/nuevo';
						var param 	= $('#form-nuevo-banco').serialize();

						Metronic.showLoader();
						$.post(url, param, function(data, textStatus, xhr) {
							if (data.exito) {
								Metronic.removeLoader();
								modal_nuevo.modal('hide');
								bootbox.alert(data.msg, function() {
									location.reload();
								});
							} else {
								Metronic.removeLoader();
								bootbox.alert(data.msg, function() {
									modal_nuevo.modal('show');
								});
							}
						});
					}
				});
			});

			//funcion para eliminar
			$('.eliminar-banco').on('click', function (e) {
				//valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
				var Row 		    = $(this).parents('tr');
				var id_banco 	= $(Row[0]).attr('id');
				bootbox.confirm('<h4>¿Seguro que quieres eliminar este banco?</h4>', function(response) {
					if (response) {
						Metronic.showLoader();
						$.post('/gestor/bancos/eliminar', {id_banco:id_banco}, function(data, textStatus, xhr) {
							if (data.exito) {
								table.DataTable().row(Row).remove().draw();
							}
							bootbox.alert(data.msg, function () {
								Metronic.removeLoader();
							});
						}, 'json');
					}
				});
			});
		}

		//Tabla de gestion de sistemas operativos
		var handleTableObservaciones = function () {

				function restoreRow(oTable, nRow) {
						var aData = oTable.fnGetData(nRow);
						var jqTds = $('>td', nRow);

						for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
								oTable.fnUpdate(aData[i], nRow, i, false);
						}
						oTable.fnDraw();
				}
				//funcion que abre los inputs para poder ser editados e imprime sus valores correspondientes
				function editRow(oTable, nRow) {
						var aData = oTable.fnGetData(nRow);
						var jqTds = $('>td', nRow);
						jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
						jqTds[1].innerHTML = '<a class="btn edit green btn-circle btn-xs" href=""><i class="fa fa-save"></i> Guardar</a>';
						jqTds[2].innerHTML = '<a class="btn cancel red btn-circle btn-xs" href=""><i class="fa fa-ban"></i> Cancelar</a>';
				}

				//funcion para obtener los valores de los inputs y guardarlos en la bd
				//ya sea creando nuevo o editando existente
				function saveRow(oTable, nRow) {
						var jqInputs = $('input', nRow);
						oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
						oTable.fnUpdate('<a class="btn edit blue btn-circle btn-xs" href=""><i class="fa fa-edit"></i> Editar</a>', nRow, 1, false);
						oTable.fnUpdate('<a class="btn delete red btn-circle btn-xs" href=""><i class="fa fa-trash"></i> Eliminar</a>', nRow, 2, false);
						oTable.fnDraw();

						var id_observacion = $(nRow).attr('id');
						//variable creada a manera de sintaxis post para mandar los valores al controlador gestor
						var observacion='id_observacion='+id_observacion+'&'+
														'descripcion='+jqInputs[0].value;
						//if para saber si se trata editar o nuevo
						//si no tiene id es nuevo, si tiene un id existente es editar
						if(id_observacion!=undefined)
						{
								$.ajax({
										url: "/gestor/observaciones/editar",
										type: 'post',
										cache: false,
										dataType: 'json',
										data: observacion,
										beforeSend: function () {
											 Metronic.showLoader();
										},
										error: function(jqXHR, status, error) {
												console.log("ERROR: "+error);
												alert('ERROR: revisa la consola del navegador para más detalles.');
												Metronic.removeLoader();
										},
										success: function(data) {
												if (data.exito) {
														bootbox.alert("<h4>Observación: <b>"+data.observacion+"</b> actualizada con éxito</h4>", function () {
																parent.location.reload();
														});
												} else {
														bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
														editRow(oTable, nRow);
														nEditing = nRow;
														Metronic.removeLoader();
												}
										}
								});
						}else
						{
								$.ajax({
										url: "/gestor/observaciones/nuevo",
										type: 'post',
										cache: false,
										dataType: 'json',
										data: observacion,
										beforeSend: function () {
											 Metronic.showLoader();
										},
										error: function(jqXHR, status, error) {
												console.log("ERROR: "+error);
												alert('ERROR: revisa la consola del navegador para más detalles.');
												Metronic.removeLoader();
										},
										success: function(data) {
												if (data.exito) {
														bootbox.alert("<h4>Observación: <b>"+data.observacion+"</b> añadida con éxito</h4>",function () {
																parent.location.reload();
														});
												} else {
														bootbox.alert('<h4><p>Error: </p>'+data.msg+'</h4>');
														editRow(oTable, nRow);
														nEditing = nRow;
														Metronic.removeLoader();
												}
										}
								});
						}
				}

				function cancelEditRow(oTable, nRow) {
						var jqInputs = $('input', nRow);
						oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
						oTable.fnUpdate('<a class="btn edit blue btn-circle btn-xs" href=""><i class="fa fa-edit"></i> Editar</a>', nRow, 1, false);
						oTable.fnDraw();
				}

				var table = $('#tabla_observaciones_editable');

				//mensajes y caracteristicas de la tabla
				var oTable = table.dataTable({
						"pageLength": 30,
						searching: false,
						"lengthChange": false,
						"columns": [
								{ "orderable": true },
								{ "orderable": false },
								{ "orderable": false }
						],
						"language": {
								"emptyTable":     "No hay sistemas observaciones registradas",
								"info":           "Mostrando _START_ a _END_ de _TOTAL_ observaciones",
								"infoEmpty":      "Mostrando 0 a 0 de 0 observaciones",
								"infoFiltered":   "(de un total de _MAX_ observaciones registradas)",
								"infoPostFix":    "",
								"thousands":      ",",
								"lengthMenu":     "Show _MENU_ entries",
								"loadingRecords": "Cargando...",
								"processing":     "Procesando...",
								"zeroRecords":    "No se encontraron coincidencias",
								"lengthMenu": "_MENU_ registros"
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
						 "order": []
				});

				var tableWrapper = $("#tabla_observaciones_editable_wrapper");

				tableWrapper.find(".dataTables_length select").select2({
						showSearchInput: false //hide search box with special css class
				}); // initialize select2 dropdown

				var nEditing = null;
				var nNew = false;

				//funcion para crear nuevo
				$('#tabla_observaciones_editable_new').click(function (e) {
						e.preventDefault();
						//verificacion de que no este editando una fila antes de crear otra
						if (nNew || nEditing) {
								bootbox.alert("<h4>Aun no ternimas de editar!</h4>");
						}else{
								//valores por default en los inputs al crear nuevo
								var aiNew = oTable.fnAddData(['','','']);
								var nRow = oTable.fnGetNodes(aiNew[0]);
								editRow(oTable, nRow);
								nEditing = nRow;
								nNew = true;
						}
				});

				//funcion para eliminar
				table.on('click', '.delete', function (e) {
						e.preventDefault();

						var nRow = $(this).parents('tr')[0];
						//valores de la fila a eliminar guardados en aData ademas el id para guiarnos en la bd
						var aData = oTable.fnGetData(nRow);
						var id_observacion = $(nRow).attr('id');

						bootbox.confirm("<h4>¿Seguro que quieres borrar la observación <b>"+aData[0]+"</b>?</h4>", function (result) {
								if(result){
										//ajax para borrar
										$.ajax({
												url: "/gestor/observaciones/eliminar",
												type: 'post',
												cache: false,
												dataType: 'json',
												data: "id_observacion="+id_observacion+"&descripcion="+aData[0],
												beforeSend: function () {
													 Metronic.showLoader();
												},
												error: function(jqXHR, status, error) {
														console.log("ERROR: "+error);
														alert('ERROR: revisa la consola del navegador para más detalles.');
														Metronic.removeLoader();
												},
												success: function(data) {
														if (data.exito) {
																Metronic.removeLoader();
																bootbox.alert("<h4>Observación: <b>"+data.observacion+"</b> eliminada con éxito</h4>");
																//parent.location.reload();
																oTable.fnDeleteRow(nRow);
														} else {
																bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
																Metronic.removeLoader();
														}
												}
										});
								}else{
										return;
								}
						});
				});

				//funcion cancelar
				table.on('click', '.cancel', function (e) {
						e.preventDefault();

						if (nNew) {
								oTable.fnDeleteRow(nEditing);
								nEditing = null;
								nNew = false;
						} else {
								restoreRow(oTable, nEditing);
								nEditing = null;
						}
				});

				//funcion para editar una oficina
				table.on('click', '.edit', function (e) {
						e.preventDefault();
						if(nNew)
						{
								saveRow(oTable, nEditing);
								nEditing = nRow;
								nNew = true;
						}else
						{
								/* Get the row as a parent of the link that was clicked on */
								var nRow = $(this).parents('tr')[0];

								if (nEditing !== null && nEditing != nRow) {
										/* Currently editing - but not this row - restore the old before continuing to edit mode */
										restoreRow(oTable, nEditing);
										editRow(oTable, nRow);
										nEditing = nRow;
								} else if (nEditing == nRow && this.innerHTML == '<i class="fa fa-save"></i> Guardar') {
										/* Editing this row and want to save it */
										saveRow(oTable, nEditing);
										nEditing = null;
								} else {
										/* No edit in progress - let's start one */
										editRow(oTable, nRow);
										nEditing = nRow;
								}
						}
				});
		}

		return {
				//main function to initiate the module
				init: function () {
						bootbox.setDefaults({locale: "es"});
						handleTableOficinas();
						handleTableDepartamentos();
						handleTableSistemas();
						handleTableSistemasOperativos();
						handleTableBancos();
						handleTableObservaciones();
				}
		};
}();