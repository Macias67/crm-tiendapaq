var ComponentsDropdowns = function () {

    var handleVersionesSistema = function () {

        var sistema;

        //funcion change detecta cambios en el objeto
        //seleccionado es este caso un select
        $("#select_sistemas").change(function(){
            sistema = $('#select_sistemas').val();
            //filtro para verificar que hay un sistema seleccionado
            if(sistema!="")
            {
                $.ajax({
                    url: "/actualizar/sistemas/versiones",
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: "sistema="+sistema,
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
                            var opciones_select="<option value=''></option>";
                            for ( var i = 0; i < data.num_versiones; i++ ) {
                                opciones_select+='<option value='+'"'+$.trim(data.versiones[i])+'"'+'>'+$.trim(data.versiones[i])+'</option>';
                            }
                            $('#select_versiones').html(opciones_select);
                        } else {
                            alert('Error :');
                           Metronic.removeLoader();
                        }
                    }
                });
            }else{
                 $('#select_versiones').html("<option value=''></option>");
            }
        });
    }


    return {
        //main function to initiate the module
        init: function () {
            handleVersionesSistema();
        }
    };

}();