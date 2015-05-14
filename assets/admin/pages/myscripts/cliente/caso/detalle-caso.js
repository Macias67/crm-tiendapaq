var DetalleCaso = function() {

	var verCotizacion = function() {
		$("#btn-ver-cotizacion").on('click', function() {
			var url = $(this).attr('url');
			window.open(url,'','height=800, width=800');
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

	var fancyBox = function() {
		$('#ajax_ver_notas').on('shown.bs.modal', function() {
			$(".fancybox").fancybox();
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
		});
	}

	var fancyBox = function() {
		$(".fancybox").fancybox();
	};

	return {
		init : function() {
			fancyBox();
			verCotizacion();
			progresoTarea();
			tablaNotasTareas();
		}
	}
}();