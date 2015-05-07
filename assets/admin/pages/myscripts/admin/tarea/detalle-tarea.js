var DetalleTarea = function() {

	var verCotizacion = function() {
		$("#btn-ver-cotizacion").on('click', function() {
			var url = $(this).attr('url');
			window.open(url,'','height=800, width=800');
		});
	};

	var guardarAvances = function() {
		$('#btn-guardar').on('click', function() {
			var avance = $("#slider-snap-inc").slider( "value" );
			var estatus = $("select[name='estatus']").val();
			var id_tarea = $("input[name='id_tarea']").val();
			var id_caso = $("input[name='id_caso']").val();

			var data = {
				avance:avance,
				estatus:estatus,
				id_tarea:id_tarea,
				id_caso:id_caso
			};
			$.post('/tarea/avances', data, function(data, textStatus, xhr) {
				if (data.exito) {
					bootbox.alert('Actualizado con éxito', function() {
						location.reload(true);
					});
				} else {
					bootbox.alert(data.msg, function() {
						location.reload(true);
					});
				}
			}, 'json');
		});
	};

	var guardarNota = function() {
		$('#nueva_nota').on('submit', function(e) {
			e.preventDefault();
			var data 		= new FormData();
			var id_tarea 	= $("input[name='id_tarea']").val();
			var privacidad 	= $("input[name='privacidad']").is(':checked');
			var privacidad 	= (privacidad) ? 'privada' : 'publica';
			var nota 		= $("textarea[name='nota']").val();
			var archivo 		= $('input[name="archivo"]')[0].files[0];

			data.append('id_tarea', id_tarea);
			data.append('privacidad', privacidad);
			data.append('nota', nota);
			data.append('archivo', archivo);

			$.ajax({
				url: '/nota/nueva',
				type: 'post',
				dataType: 'json',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){
					if (data.exito) {
						bootbox.alert('Nueva nota agregada con éxito', function() {
							location.reload(true);
						});
					} else {
						bootbox.alert(data.errores);
					}
				}
			});
		});
	};

	var progresoTarea = function() {
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
				var id_tarea 	= $("input[name='id_tarea']").val();
				var id_nota 		= $("input[name='id_nota']").val();
				var privacidad 	= $("input[name='privacidad']").is(':checked');
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

	return {
		init: function() {
			verCotizacion();
			guardarAvances();
			guardarNota();
			progresoTarea();
			eliminaNota();
			fancyBox();
			modalEditarNota();
		}
	}
}();