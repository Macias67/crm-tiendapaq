var EditarEvento = function() {

	var handleDatePickersEditar = function () {
		moment.locale("es");
		if (jQuery().datetimepicker) {
			$('.daterange_editar').daterangepicker({
				timePicker: true,
				format: 'DD/MM/YYYY h:mm A',
				timePickerIncrement: 10,
				timePicker12Hour: true,
				timePickerSeconds: false,
				locale: 'es'
			});
			//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		}
		// Calcular horas de duracion
		$('.daterange_editar').on('apply.daterangepicker', function(ev, picker) {
			//do something, like clearing an input
			var rango 	= $(this).val();
			var div 		= $(this).attr('name');

			// Duracion de cada sesion
			$.post('/evento/duracion', {rango:rango}, function(data, textStatus, xhr) {
				$('b#'+div).html(data.duracion);
				$("input[name='d"+div+"']").val(data.valor);
			}, 'json');

			// Si es la primera sesion calculo limite
			if (div == 'sesion1') {
				$.post('/evento/limite', {rango:rango}, function(data, textStatus, xhr) {
					$('b#limite').html(data.limite);
				}, 'json');
			}
		});
	}

	var defineLugarEditar = function() {
		 var tipo = $("input[name=lugar]").filter(":checked").val();
				if (tipo == 'online') {
				$('#sucursal').fadeOut(500, function() {
					$("select[name='sucursal']").prop('selectedIndex',0);
				});
				$('#otro').fadeOut(500, function() {
					$("textarea[name='otro']").val();
				});
				$('#online').fadeIn(500, function() {
					$("input[name='link']").val();
				});
			} else if(tipo == 'sucursal') {
				$('#online').fadeOut(500, function() {
					$("input[name='link']").val();
				});
				$('#otro').fadeOut(500, function() {
					$("textarea[name='otro']").val();
				});
				$('#sucursal').fadeIn(500, function() {
					$(this).prop('selectedIndex',0);
				});
			} else if(tipo == 'otro') {
				$('#sucursal').fadeOut(500, function() {
					$("select[name='sucursal']").prop('selectedIndex',0);
				});
				$('#online').fadeOut(500, function() {
					$("input[name='link']").val();
				});
				$('#otro').fadeIn(500, function() {
					$("textarea[name='otro']").val();
				});
			}

		$("input[name='lugar']").on('change', function() {
			var tipo = $(this).filter(":checked").val();
			if (tipo == 'online') {
				$('#sucursal').fadeOut(500, function() {
					$("select[name='sucursal']").prop('selectedIndex',0);
				});
				$('#otro').fadeOut(500, function() {
					$("textarea[name='otro']").val();
				});
				$('#online').fadeIn(500, function() {
					$("input[name='link']").val();
				});
			} else if(tipo == 'sucursal') {
				$('#online').fadeOut(500, function() {
					$("input[name='link']").val();
				});
				$('#otro').fadeOut(500, function() {
					$("textarea[name='otro']").val();
				});
				$('#sucursal').fadeIn(500, function() {
					$("select[name='sucursal']").prop('selectedIndex',0);
				});
			} else if(tipo == 'otro') {
				$('#sucursal').fadeOut(500, function() {
					$("select[name='sucursal']").prop('selectedIndex',0);
				});
				$('#online').fadeOut(500, function() {
					$("input[name='link']").val();
				});
				$('#otro').fadeIn(500, function() {
					$("textarea[name='otro']").val(); 
				});
			}
		});
	};

	var handleBootstrapTouchSpinEditar = function() {

		$("#costo_editar").TouchSpin({
			buttondown_class: 'btn green',
			buttonup_class: 'btn green',
			min: 0,
			max: 1000000,
			step: 0.1,
			decimals: 2,
			boostat: 5,
			maxboostedstep: 10,
			prefix: '$'
		});

		$("#cupo_editar").TouchSpin({
			buttondown_class: 'btn green',
			buttonup_class: 'btn green',
			min: 0,
			max: 1000,
			step: 1,
			boostat: 5,
			maxboostedstep: 10
		});
	}

	var EliminarSesion = function() {
		$('.eliminar-sesion').on('click', function (e) {
			// Valor del id de la sesión para poder eliminar
			var id_sesion = $(this).attr('idsesion');
				bootbox.confirm('<h4>¿Seguro que deseas eliminar la sesión?</h4>', function(response) {
					console.log(response);
					if (response) {
						Metronic.showLoader();
						$.post('/evento/eliminaSesion', {id_sesion:id_sesion}, function(data, textStatus, xhr) {
							if(data.exito){
								bootbox.alert(data.msg, function () {
									parent.location.reload();
								});
							}else{
									bootbox.alert(data.msg);
							}
						}, 'json');
					}
				});
		});
	};

	return {
		init: function() {
			handleDatePickersEditar();
			defineLugarEditar();
			handleBootstrapTouchSpinEditar();
			EliminarSesion();
		}
	}
}();