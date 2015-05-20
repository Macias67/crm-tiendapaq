var DetalleCaso = function() {

	var verCotizacion = function() {
		$("#btn-ver-cotizacion").on('click', function() {
			var url = $(this).attr('url');
			window.open(url,'','height=800, width=800');
		});
	};

	var reasignarCaso = function() {
		$('#modal-reasignar').on('shown.bs.modal', function() {
			$('#reasignar-caso').on('submit', function(e) {
				e.preventDefault();
				var data = $(this).serialize();
				console.log(data);
				$.post('/caso/reasignar', {data}, function(data, textStatus, xhr) {
					if (data.exito) {
						bootbox.alert(data.msj , function() {
							location.reload(true);
						});
					}else{
						bootbox.alert(data.msj);
					}
				}, 'json');
			});
		});
	};

	var progresoTarea = function() {
		$('.easy-pie-chart .number.transactions').easyPieChart({
			animate: 1000,
			size: 78,
			lineWidth: 5,
			scaleColor: '#27d9f4',
			barColor: '#27d9f4'
		});
	};

	var modalEditarTarea = function() {
		$('#ajax_edita_tarea').on('shown.bs.modal', function() {
			// Form validation
			var form 	= $("#tarea_editar");
			var error 	= $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					// INFORMACION BASICA
					ejecutivo: {
						required: true
					},
					tarea: {
						required: true
					},
					descripcion: {
					},
					estatus: {
						required: true
					}
				},
				messages: {
					ejecutivo: {
						required: "Selecciona un ejecutivo"
					},
					tarea: {
						required: "Escriba el nombre de la tarea"
					},
					descripcion: {
					},
					estatus: {
						required: "Escriba el estatus de la tarea"
					}
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					success.hide();
					error.html("Tienes errores en tu formulario");
					error.show();
					Metronic.scrollTo(error, -600);
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
					var avance = $("#slider-snap-inc").slider( "value" );
					$.ajax({
						url: $(form).attr('action'),
						type: 'post',
						cache: false,
						dataType: 'json',
						data: $(form).serialize() + '&avance=' + avance,
						beforeSend: function () {
							Metronic.showLoader();
						},
						error: function(jqXHR, status, error) {
							bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
								Metronic.removeLoader();
							});
						},
						success: function(data) {
							if (data.exito) {
								Metronic.removeLoader();
								bootbox.alert("<h4>Tarea editada correctamente.<h4>", function() {
									location.reload(true);
								});
							} else {
								error.html(data.msg);
								error.show();
								$('body').animate({ scrollTop: 0 }, 600);
								Metronic.removeLoader();
							}
						}
					});
				}
			});

			// Slider avance
			$("#slider-snap-inc").slider({
				isRTL: Metronic.isRTL(),
				value: parseInt($("#slider-snap-inc").attr('avance')),
				min: 0,
				max: 100,
				step: 1,
				slide: function (event, ui) {
					$("#slider-snap-inc-amount").text(ui.value + "%");
				}
			});
		});
	};

	var FormValidacionTarea = function() {
		$('#tarea').on('shown.bs.modal', function() {
			var form 	= $("#tarea_nueva");
			var error 	= $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				ignore: "",  // validate all fields including form hidden input
				rules: {
					// INFORMACION BASICA
					ejecutivo: {
						required: true
					},
					tarea: {
						required: true
					},
					descripcion: {
					}
				},
				messages: {
					ejecutivo: {
						required: "Selecciona un ejecutivo"
					},
					tarea: {
						required: "Escriba el nombre de la tarea"
					},
					descripcion: {
					},
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					success.hide();
					error.html("Tienes errores en tu formulario");
					error.show();
					Metronic.scrollTo(error, -600);
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
					$.ajax({
						url: $(form).attr('action'),
						type: 'post',
						cache: false,
						dataType: 'json',
						data: $(form).serialize(),
						beforeSend: function () {
							Metronic.showLoader();
						},
						error: function(jqXHR, status, error) {
							bootbox.alert('ERROR: revisa la consola del navegador para más detalles.', function() {
								Metronic.removeLoader();
							});
						},
						success: function(data) {
							if (data.exito) {
								Metronic.removeLoader();
								bootbox.alert("<h4>Nueva tarea asignada.<h4>", function() {
									location.reload(true);
								});
							} else {
								error.html(data.msg);
								error.show();
								$('body').animate({ scrollTop: 0 }, 600);
								Metronic.removeLoader();
							}
						}
					});
				}
			});
		});
	};

	var eliminaNota = function() {
		$('.eliminar').on('click', function() {
			var id = $(this).attr('id');
			bootbox.confirm('<h4>¿Seguro de eliminar esta nota?</h4>', function(result) {
				if (result) {
					$.post('/nota/elimina', {id:id}, function(data, textStatus, xhr) {
						if (data.exito) {
							bootbox.alert('<h4>Se eliminó nota</h4>', function() {
								location.reload(true);
							});
						};
					});
				};
			});
		});
	};

	var fancyBox = function() {
		$(".fancybox").fancybox();
	};

	var modalEditarNota = function() {
		$('#ajax_edita_nota').on('shown.bs.modal', function() {
			console.log("hola");
			Metronic.initComponents();

			$('form#edita_nota .borrar').on('click', function() {
				var url = $('input[name="url-imagen"]').val();
				$.post('/nota/dropimagen', {url:url}, function(data, textStatus, xhr) {
					if (data.exito) {
						bootbox.alert('Se eliminó la imagen ligada a la nota.', function() {
							location.reload(true);
						});
					};
				}, 'json');
			});

			$('#edita_nota').on('submit', function(e) {
				e.preventDefault();
				var data 		= new FormData();
				var id_tarea 	= $("input[name='edita_id_tarea']").val();
				var id_nota 		= $("input[name='edita_id_nota']").val();
				var privacidad 	= $("input[name='edita_privacidad']").is(':checked');
				var privacidad 	= (privacidad) ? 'privada' : 'publica';
				var nota 		= $("textarea[name='edita_nota']").val();
				var archivo 		= $('input[name="edita_archivo"]')[0].files[0];

				data.append('id_tarea', id_tarea);
				data.append('id_nota', id_nota);
				data.append('privacidad', privacidad);
				data.append('nota', nota);
				data.append('archivo', archivo);

				$.ajax({
					url: '/nota/edita',
					type: 'post',
					dataType: 'json',
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data){
						if (data.exito) {
							bootbox.alert('La nota ha sido editada con éxito', function() {
								location.reload(true);
							});
						} else {
							bootbox.alert(data.errores);
						}
					}
				});
			});
		});
	};

	// Tabla de las notas de las tareas
	var tablaNotasTareas = function () {
		var table = $('#notas-tarea');
		table.dataTable({
			"scrollY": "100px",
			"scrollCollapse": false,
			"lengthChange": false,
			"searching": false,
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"columns": [
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false },
				{ "orderable": false }
			],
			"language": {
				"emptyTable":     "No hay notas registradas",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ notas",
				"infoEmpty":      "Mostrando 0 a 0 de 0 notas",
				"infoFiltered":   "(de un total de _MAX_ notas registradas)",
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
				[0, "desc"]
			] // set first column as a default sort by asc
		});
	}

	return {
		init : function() {
			FormValidacionTarea();
			verCotizacion();
			reasignarCaso();
			progresoTarea();
			modalEditarTarea();
			eliminaNota();
			fancyBox();
			modalEditarNota();
			tablaNotasTareas();
		}
	}
}();