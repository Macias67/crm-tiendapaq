var FormValidationEjecutivo = function () {

    // Validacion para formulario de cliente nuevo completo en la vista del sidebar
    var formularioEjecutivo = function() {
        // for more info visit the official plugin documentation:
        // http://docs.jquery.com/Plugins/Validation

        var form1 = $('#form-ejecutivo');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                primer_nombre: {
                    maxlength: 20,
                    required: true
                },
                segundo_nombre: {
                    maxlength: 20
                },
                apellido_paterno: {
                    maxlength: 20,
                    required: true
                },
                apellido_materno: {
                    maxlength: 20,
                    required: true
                },
                email: {
                    email: true,
                    maxlength: 50
                },
                telefono: {
                    maxlength: 14
                },
                oficina: {
                },
                privilegios: {
                },
                departamento: {
                },
                usuario: {
                    maxlength: 20,
                    required: true
                },
                password: {
                    maxlength: 20,
                    required: true
                }
            },
            messages: {
                primer_nombre: {
                    maxlength: "El primer nombre debe tener menos de 20 caracteres",
                    required: "Escribe el primer nombre"
                },
                segundo_nombre: {
                    maxlength: "El segundo ombre debe tener menos de 20 caracteres"
                },
                apellido_paterno: {
                    maxlength: "El apellido paterno debe tener menos de 20 caracteres",
                    required: "Escribe el apellido paterno"
                },
                apellido_materno: {
                    maxlength: "El apellido materno debe tener menos de 20 caracteres",
                    required: "Escribe el apellido materno"
                },
                email: {
                    maxlength: "El email debe tener menos de 50 caracteres",
                    email: "Escribe un email valido"
                },
                telefono: {
                },
                oficina: {
                },
                privilegios: {
                },
                departamento: {
                },
                usuario: {
                    maxlength: "El usuario debe tener menos de 20 caracteres",
                    required: "Escribe un usuario"
                },
                password: {
                    maxlength: "La contraseña debe tener menos de 20 caracteres",
                    required: "Escribe una contraseña"
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.html("Tienes Errores en tu formulario");
                error1.show();
            //Metronic.scrollTo(error1, -200);
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label
                .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                // general settings
                $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
                '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                    '<div class="progress progress-striped active">' +
                        '<div class="progress-bar" style="width: 100%;"></div>' +
                    '</div>' +
                '</div>';

                $.fn.modalmanager.defaults.resize = true;

                $.ajax({
                    url: $('#form-ejecutivo').attr('action'),
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    data: $('#form-ejecutivo').serialize(),
                    beforeSend: function () {
                        $('body').modalmanager('loading');
                    },
                    error: function(jqXHR, status, error) {
                        console.log("ERROR: "+error);
                        alert('ERROR: revisa la consola del navegador para más detalles.');
                        $('body').modalmanager('removeLoading');
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.exito) {
                            alert(""+data.ejecutivo.primer_nombre+" "+data.ejecutivo.apellido_paterno+" con usuario "+data.ejecutivo.usuario+" añadido con éxito.");
                            parent.location.reload();
                        } else {
                            console.log("ERROR: "+data.msg);
                            error1.html(data.msg);
                            error1.show();
                            $('body').modalmanager('removeLoading');
                        }
                    }
                });
            }
        });
    }


    return {
        //main function to initiate the module
        init: function () {
            formularioEjecutivo();
        }
    };
}();