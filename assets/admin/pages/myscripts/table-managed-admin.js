var TableManaged = function () {

    var initTable1 = function () {

        var table = $('#pendientes-admin');

        // begin first table
        table.dataTable({
            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
            }],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "language": {
                "emptyTable":     "No existen pendientes registrados",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                "infoFiltered":   "(Buscado en _MAX_ registros)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "_MENU_ registros por página",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search":         "Buscar: ",
                "zeroRecords":    "No se encontraron registros",
                "paginate": {
                    "previous":"Anterior",
                    "next": "Siguiente",
                    "last": "Ultimo",
                    "first": "Primero"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }]
            //"order": [
              //  [1, "asc"]
            //] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#pendientes-admin_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    }

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
        }

    };

}();