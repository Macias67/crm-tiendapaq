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
      "lengthChange": false,
      "columns": [
        { "orderable": true },
        { "orderable": true },
        { "orderable": true },
        { "orderable": true },
        { "orderable": false }
      ],
      "language": {
        "emptyTable":     "No hay casos por asignar",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ casos",
        "infoEmpty":      "Mostrando 0 a 0 de 0 casos",
        "infoFiltered":   "(de un total de _MAX_ casos)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Show _MENU_ entries",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar: ",
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
      "order": [ 0, 'asc' ] // set first column as a default sort by asc
  	});

    //funcion para asignar caso
    $('.btn_asignar_caso').on('click', function () {
      var id_caso = $('#').val();
      var id_ejecutivo = $('#').val();

      bootbox.confirm('<h4>¿Seguro que quieres asignarle el caso a este ejecutivo?</h4>', function(response) {
        if (response) {
           alert('enviar peticion a controlador');
      //     //Metronic.showLoader();
      //     // $.post('/cliente/contactos/eliminar', {id_cliente:id_cliente, id:id}, function(data, textStatus, xhr) {
      //     //   if (data.exito) {
      //     //     table.DataTable().row(Row).remove().draw();
      //     //   }
      //     //   bootbox.alert(data.msg, function () {
      //     //     Metronic.removeLoader();
      //     //   });
      //     // }, 'json');
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
			CasosAsignar();
		}
	};
}();