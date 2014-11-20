
var TableManaged = function () {

	var tablaPendientes = function () {
		var table = $('#pendientes-ejecutivo');

		table.dataTable({
			"lengthMenu": [
				[5, 15, 20, -1],
				[5, 15, 20, "Todos"] // change per page values here
			],
			// set the initial value
			"pageLength": 15,
			"columns": [
          { "orderable": true },
          { "orderable": true },
          { "orderable": true },
          { "orderable": true },
          { "orderable": true },
          { "orderable": false }
      ],
			"language": {
				"emptyTable":     "No hay pendientes registrados",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ pendientes",
        "infoEmpty":      "Mostrando 0 a 0 de 0 pendientes",
        "infoFiltered":   "(de un total de _MAX_ pendientes registrados)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Show _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "zeroRecords":    "No se encontraron coincidencias",
        "lengthMenu": 		"_MENU_  Registros",
        "search": 				"Buscar: ",
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

	// $(document).ready(function() {
 //    $('input[type=checkbox]').live('click', function(){
 //        var parent = $(this).parent().attr('id');
 //        $('#'+parent+' input[type=checkbox]').removeAttr('checked');
 //        $(this).attr('checked', 'checked');
 //    });
	// });

	$('.checkboxes').change(function () {
		//alert('cambio');
		var parent = $(this).parent().attr('id');
		$('.checkboxes').removeAttr('checked');
 		$(this).attr('checked', 'checked');
 		
		//codigo de cambio de asignador de casos
  //  $.ajax({
	 //    url: '',
	 //    type: 'post',
	 //    cache: false,
	 //    dataType: 'json',
	 //    data: '',
	 //    beforeSend: function () {
	 //        //$('body').modalmanager('loading');
	 //    },
	 //    error: function(jqXHR, status, error) {
	 //        console.log("ERROR: "+error);
	 //        alert('ERROR: revisa la consola del navegador para más detalles.');
	 //        //$('body').modalmanager('removeLoading');
	 //    },
	 //    success: function(data) {
  //       console.log(data);
  //       if (data.exito) {
  //           bootbox.alert("<h4><b>"+data.ejecutivo.primer_nombre+" "+data.ejecutivo.apellido_paterno+"</b> con usuario <b>"+data.ejecutivo.usuario+"</b> añadido con éxito.</h4>", function () {
  //               parent.location.reload();
  //           });
  //       } else {
  //           console.log("ERROR: "+data.msg);
  //           error1.html(data.msg);
  //           error1.show();
  //           //$('body').modalmanager('removeLoading');
  //       }
	 //    }
		// });
	})

	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}
			tablaPendientes();
		}
	};
}();