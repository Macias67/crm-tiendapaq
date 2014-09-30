var TableEditable = function () {

    //Tabla de gestion sistemas contpaqi del cliente
    var handleTableClientes= function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }

        var table = $('#tabla_gestionar_cliente');

        var oTable = table.dataTable({
            "pageLength": 20,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
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

        var tableWrapper = $("#tabla_gestionar_cliente_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        //funcion para eliminar
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            //valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
            var id = $(nRow).attr('id');

            if (confirm("¿Seguro que quieres eliminar el cliete "+aData[2]+" ?") == false){
                return;
            }else{
                //aqui va el ajax para eliminar el cliente, su informacion y archivos
                oTable.fnDeleteRow(nRow);
                alert("Cliente "+aData[2]+" elminado con exito.");
            }


            // var nRow = $(this).parents('tr')[0];
            // oTable.fnDeleteRow(nRow);
            // alert("Deleted! Do not forget to do some ajax to sync with backend :)");

            // bootbox.confirm("<h4>¿Seguro que quieres eliminar el sistema <b>"+aData[0]+"</b> Versión <b>"+aData[1]+"</b>?</h4>", function (result){
            //     //result guarda el booleano respondido en el comfirm
            //     if(result){
            //         //ajax para borrar
            //         $.ajax({
            //             url: "/actualizar/sistemas/eliminar",
            //             type: 'post',
            //             cache: false,
            //             dataType: 'json',
            //             data: "id="+id+"&sistema="+aData[0]+"&version="+aData[1],
            //             beforeSend: function () {
            //                //('body').modalmanager('loading');
            //             },
            //             error: function(jqXHR, status, error) {
            //                 console.log("ERROR: "+error);
            //                 alert('ERROR: revisa la consola del navegador para más detalles.');
            //                 //$('body').modalmanager('removeLoading');
            //             },
            //             success: function(data) {
            //                 if (data.exito) {
            //                     bootbox.alert("<h4>Sistema : <b>"+data.sistema+"</b>, eliminado con éxito<h4>");
            //                     //parent.location.reload();
            //                     oTable.fnDeleteRow(nRow);
            //                 } else {
            //                     bootbox.alert('<h4><p>Error :</p>'+data.msg+'<h4>');
            //                     //$('body').modalmanager('removeLoading');
            //                     //parent.location.reload();
            //                 }
            //             }
            //         });
            //     }else{
            //         return;
            //     }
            // });
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleTableClientes();
        }
    };

}();