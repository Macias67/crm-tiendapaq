var TableEditable = function () {

    //Tabla de gestion de contactos en modo cliente
    var handleTableContactos= function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }
        //funcion que abre los inputs para poder ser editados y pinta sus valores correspondientes
        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            //en el priumer campo (id) deshabilitamos que lo puedan editar, los demas quedan como editables
            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
            jqTds[5].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[5] + '">';
            jqTds[6].innerHTML = '<a class="edit" href="">Guardar</a>';
            jqTds[7].innerHTML = '<a class="cancel" href="">Cancelar</a>';
        }
        //funcion para obtener los valores de los inputs y guardarlos en la bd
        //ya sea creando nueva oficina o editando una existente
        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);

            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 6, false);
            oTable.fnUpdate('<a class="delete" href="">Eliminar</a>', nRow, 7, false);
            oTable.fnDraw();

            //extraemos el id del tr para saber que objeto manipulamos
            var id_oficina = $(nRow).attr('id');
            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor/oficinas
            var oficina='id_oficina='+id_oficina+'&'+
                        'ciudad='+jqInputs[0].value+'&'+
                        'estado='+jqInputs[1].value+'&'+
                        'colonia='+jqInputs[2].value+'&'+
                        'calle='+jqInputs[3].value+'&'+
                        'numero='+jqInputs[4].value+'&'+
                        'email='+jqInputs[5].value+'&'+
                        'telefono='+jqInputs[6].value;

            //if para saber si se trata de una oficina editada o de una nueva
            //si no tiene id es nueva, si tiene un id existente es editada
            if(id_oficina!=undefined)
            {
                $.ajax({
                    url: "/gestor/oficinas/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: oficina,
                    beforeSend: function () {
                       //('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        //$('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        if (data.exito) {
                            bootbox.alert("<h4>Oficina de : <b>"+data.oficina+"</b>, actualizada con éxito</h4>",function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else
            {
                $.ajax({
                    url: "/gestor/oficinas/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: oficina,
                    beforeSend: function () {
                       //('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        //$('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        if (data.exito) {
                            bootbox.alert("<h4>Oficina de : <b>"+data.oficina+"</b>, añadida con éxito</h4>", function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><p>Error :</p>'+data.msg+'</h4>');
                            editRow(oTable, nRow);
                            nEditing = nRow;
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);

            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
            oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
            oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 7, false);
            oTable.fnDraw();
        }

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
            "order": [] // set first column as a default sort by asc
        });

        var tableWrapper = $("#tabla_contactos_cliente_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        //funcion para crear nueva oficina
        $('#tabla_contactos_cliente_new').click(function (e) {
            e.preventDefault();
            //si hay una nueva en edicion o esta editando otra no podemos crear otra nueva
            if (nNew || nEditing)
            {
                bootbox.alert("<h4>Aun no terminass de editar!</h4>");
            } else
            {
                //valores por default en ls inputs al crear nueva oficina
                var aiNew = oTable.fnAddData(['', '', '', '', '#', '','(999) 999-9999','','']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            }
        });

        //funcion para eliminar oficina
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            //valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
            var id_oficina = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres eliminar la oficina de <b>"+aData[0]+", "+aData[1]+"</b>?</h4>", function (result){
                //result guarda el booleano respondido en el comfirm
                if(result){
                    //ajax para borrar la oficina
                    $.ajax({
                        url: "/gestor/oficinas/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id_oficina="+id_oficina+"&ciudad="+aData[0]+"&estado="+aData[1],
                        beforeSend: function () {
                           //('body').modalmanager('loading');
                        },
                        error: function(jqXHR, status, error) {
                            console.log("ERROR: "+error);
                            alert('ERROR: revisa la consola del navegador para más detalles.');
                            //$('body').modalmanager('removeLoading');
                        },
                        success: function(data) {
                            if (data.exito) {
                                bootbox.alert("<h4>Oficina de : <b>"+data.oficina+"</b>, eliminada con éxito<h4>");
                                //parent.location.reload();
                                oTable.fnDeleteRow(nRow);
                            } else {
                                bootbox.alert('<h4><p>Error :</p>'+data.msg+'<h4>');
                                //$('body').modalmanager('removeLoading');
                                //parent.location.reload();
                            }
                        }
                    });
                }else{
                    return;
                }
            });
        });

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
                } else if (nEditing == nRow && this.innerHTML == "Guardar") {
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
            handleTableContactos();
        }
    };

}();