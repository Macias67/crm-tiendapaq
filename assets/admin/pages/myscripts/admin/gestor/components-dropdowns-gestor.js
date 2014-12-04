var ComponentsDropdowns = function () {

    var handleTagsVersiones = function () {

        var id_sistema;

        //funcion change detecta cambios en el objeto
        //seleccionado es este caso un select
        $("#select_sistemas").change(function(){
            id_sistema = $('#select_sistemas').val();
            //filtro para verificar que hay un sistema seleccionado
            if(id_sistema!=undefined && id_sistema!="")
            {
                $.ajax({
                    url: "/gestor/versiones/mostrar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: "id_sistema="+id_sistema,
                    beforeSend: function () {
                       Metronic.showLoader();
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        Metronic.removeLoader();
                    },
                    success: function(data) {
                        if (data.exito) {
                            Metronic.removeLoader();
                            $('#input_versiones').val(data.versiones);
                            $("#input_versiones").select2({
                                tags: data.versiones.split(', ')
                            });
                        } else {
                            Metronic.removeLoader();
                            bootbox.alert('<h4><p>Error :</p><p>Esto no debería estar pasando, contacta a soporte técnico</p></h4>');
                        }
                    }
                });
            }else{
                $('#input_versiones').val("");
                $("#input_versiones").select2({
                    tags: []
                });
            }
        });
    }

    var guardarVersiones = function () {
        $('#guardar_versiones').click(function() {
            var id_sistema=$('#select_sistemas').val();
            var nuevas_versiones=$('#input_versiones').val();
            if(nuevas_versiones!=""){
                $.ajax({
                    url: "/gestor/versiones/actualizar",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: 'id_sistema='+id_sistema+'&nuevas_versiones='+nuevas_versiones,
                    beforeSend: function () {
                       Metronic.showLoader();
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        Metronic.removeLoader();
                    },
                    success: function(data) {
                        if (data.exito) {
                            Metronic.removeLoader();
                            bootbox.alert('<h4>Versiones actualizadas con éxito<h4>');
                        } else {
                            bootbox.alert('<h4><p>Error : </p>'+data.msg+'</h4>');
                            Metronic.removeLoader();
                        }
                    }
                });
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleTagsVersiones();
            guardarVersiones();
        }
    };

}();