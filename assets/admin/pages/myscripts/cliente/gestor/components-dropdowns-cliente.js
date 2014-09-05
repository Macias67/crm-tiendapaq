var ComponentsDropdowns = function () {

    var handleVersionesSistema = function () {

        var id_sistema;

        //funcion change detecta cambios en el objeto
        //seleccionado es este caso un select
        $("#select_sistemas").change(function(){
            id_sistema = $('#select_sistemas').val();
            //filtro para verificar que hay un sistema seleccionado
            if(id_sistema!=undefined && id_sistema!="")
            {
                $.ajax({
                    url: "/actualizar/sistemas/versiones",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: "id_sistema="+id_sistema,
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
                            var opciones_select="<option value=''></option>";
                            for ( var i = 0; i < data.num_versiones; i++ ) {
                                opciones_select+='<option value='+'"'+$.trim(data.versiones[i])+'"'+'>'+$.trim(data.versiones[i])+'</option>';
                            }
                            $('#select_versiones').html(opciones_select);
                        } else {
                            alert('Error :');
                            //$('body').modalmanager('removeLoading');
                        }
                    }
                });
            }else{
                 $('#select_versiones').html("");
            }
        });
    }

    //METODO PARA GUARDAR UN NUEVO SISTEMA A UN CLIENTE
     var handleGuardarSistema = function () {

        var sistema = $("#select_sistemas").val();
        var version = $("#select_versiones").val();
        var no_serie = $("#no_serie").val();

        $("#btn_guardar_sistema").click(function () {

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

    return {
        //main function to initiate the module
        init: function () {
            handleVersionesSistema();
            handleGuardarSistema();
        }
    };

}();