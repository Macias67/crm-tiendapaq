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
        //ya sea creando un nuevo contacto o editando uno existente
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
            var id = $(nRow).attr('id');
            //variable creada a manera de sintaxis post para mandar los valores al controlador gestor/clientes en modo cliente
            var contacto='id='+id+'&'+
                        'nombre_contacto='+jqInputs[0].value+'&'+
                        'apellido_paterno='+jqInputs[1].value+'&'+
                        'apellido_materno='+jqInputs[2].value+'&'+
                        'email_contacto='+jqInputs[3].value+'&'+
                        'telefono_contacto='+jqInputs[4].value+'&'+
                        'puesto_contacto='+jqInputs[5].value;

            //if para saber si se trata de una una edicion o un insercion
            //si no tiene id es insercion, si tiene un id existente es edicion
            if(id!=undefined)
            {
                $.ajax({
                    url: "/actualizar/contactos/editar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: contacto,
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
                            bootbox.alert("<h4>Contacto : <b>"+data.contacto+"</b>, actualizado con éxito</h4>",function () {
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
                    url: "/actualizar/contactos/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: contacto,
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
                            bootbox.alert("<h4>Contacto : <b>"+data.contacto+"</b>, añadido con éxito</h4>", function () {
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
            oTable.fnUpdate('<a class="edit" href="">Editar</a>', nRow, 6, false);
            oTable.fnDraw();
        }

        var table = $('#tabla_contactos_cliente');

        var oTable = table.dataTable({
            "pageLength": 25,
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
                "emptyTable":     "No hay contactos registrados",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ contactos",
                "infoEmpty":      "Mostrando 0 a 0 de 0 contactos",
                "infoFiltered":   "(de un total de _MAX_ contactos registrados)",
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
                var aiNew = oTable.fnAddData(['', '', '', '', '(999) 999-9999','','','']);
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
            var id = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres eliminar el contacto <b>"+aData[0]+" "+aData[1]+" "+aData[2]+"</b>?</h4>", function (result){
                //result guarda el booleano respondido en el comfirm
                if(result){
                    //ajax para borrar la oficina
                    $.ajax({
                        url: "/actualizar/contactos/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id="+id+"&nombre_contacto="+aData[0]+"&apellido_paterno="+aData[1]+"&apellido_materno="+aData[2],
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
                                bootbox.alert("<h4>Contacto : <b>"+data.contacto+"</b>, eliminado con éxito<h4>");
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

    //Tabla de gestion sistemas contpaqi del cliente
    var handleTableSistemas= function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }

        var table = $('#tabla_sistemas_cliente');

        var oTable = table.dataTable({
            "pageLength": 20,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
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

        var tableWrapper = $("#tabla_sistemas_cliente_wrapper");

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

            bootbox.confirm("<h4>¿Seguro que quieres eliminar el sistema <b>"+aData[0]+"</b> Versión <b>"+aData[1]+"</b>?</h4>", function (result){
                //result guarda el booleano respondido en el comfirm
                if(result){
                    //ajax para borrar
                    $.ajax({
                        url: "/actualizar/sistemas/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id="+id+"&sistema="+aData[0]+"&version="+aData[1],
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
                                bootbox.alert("<h4>Sistema : <b>"+data.sistema+"</b>, eliminado con éxito<h4>");
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

        //METODO PARA GUARDAR UN NUEVO SISTEMA A UN CLIENTE
        $("#btn_guardar_sistema").click(function () {
            var sistema = $("#select_sistemas").val();
            var version = $("#select_versiones").val();
            var no_serie = $("#no_serie").val();

            if(sistema!="" && version!="" && no_serie!="")
            {
                $.ajax({
                    url: "/actualizar/sistemas/nuevo",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: "sistema="+sistema+"&version="+version+"&no_serie="+no_serie,
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
                            bootbox.alert("<h4>Sistema : <b>"+data.sistema+"</b>, agregado con éxito<h4>",function () {
                                parent.location.reload();
                            });
                        } else {
                            bootbox.alert('<h4><b>Error :</b>'+data.msg+'</h4>');
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else{
                bootbox.alert("Debes completar el formulario");
            }
        });
    }

    //Tabla de gestion de Equipos de computo en modo cliente
    var handleTableEquipos= function () {

        $('#memoria-ram').spinner();

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }
            oTable.fnDraw();
        }

        var table = $('#tabla_equipos_cliente');

        var oTable = table.dataTable({
            "pageLength": 25,
            "lengthChange": false,
            "columns": [
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": true },
                { "orderable": false }
            ],
            "language": {
                "emptyTable":     "No hay equipos registrados",
                "info":           "Mostrando _START_ a _END_ de _TOTAL_ equipos",
                "infoEmpty":      "Mostrando 0 a 0 de 0 equipos",
                "infoFiltered":   "(de un total de _MAX_ equipos registrados)",
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

        var tableWrapper = $("#tabla_equipos_cliente_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        //funcion para eliminar oficina
        table.on('click', '.delete', function (e) {
            e.preventDefault();

            //valores de la fila a eliminar guardados en aData y el id para saber cual objeto eliminar
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
            var id = $(nRow).attr('id');

            bootbox.confirm("<h4>¿Seguro que quieres eliminar el equipo <b>"+aData[0]+" con "+aData[1]+"</b>?</h4>", function (result){
                //result guarda el booleano respondido en el comfirm
                if(result){
                    //ajax para borrar la oficina
                    $.ajax({
                        url: "/actualizar/equipos/eliminar",
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: "id="+id+"&nombre_equipo="+aData[0],
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
                                bootbox.alert("<h4>Equipo : <b>"+data.equipo+"</b>, eliminado con éxito<h4>");
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

        //METODO PARA GUARDAR UN NUEVO SISTEMA A UN CLIENTE
        $("#btn_guardar_equipo").click(function () {
            $.ajax({
                url: "/actualizar/equipos/nuevo",
                type: 'post',
                cache: false,
                dataType: 'json',
                data: $("#form-nuevo-equipo").serialize(),
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
                        bootbox.alert("<h4>Equipo : <b>"+data.equipo+"</b>, agregado con éxito<h4>",function () {
                            parent.location.reload();
                        });
                    } else {
                        bootbox.alert('<h4><b>Error :</b>'+data.msg+'</h4>');
                        //$('body').modalmanager('removeLoading');
                    }
                }
            });
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            bootbox.setDefaults({locale: "es"});
            handleTableContactos();
            handleTableSistemas();
            handleTableEquipos();
        }
    };

}();