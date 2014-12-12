var FormValidation = function () {

    //mascaras para el registro de cliente prospecto
    var handleInputMasks = function () {
        $.extend($.inputmask.defaults, {
            'autounmask': true
        });

        $("#telefono1").inputmask("mask", {
            "mask": "(999) 999-9999"
        });

        $("#codigo_postal").inputmask("mask", {
            "mask": "99999"
        });

    }


    var handleInfo = function() {
        // Validaciones para nuevo cliente
        var verificarInfo = $('#verificar-info');
        verificarInfo.on('shown.bs.modal', function (e) {
            handleInputMasks();
            var form = $('#form-verificar-datos');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: true, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    razon_social: {
                        maxlength: 80,
                        required: true
                    },
                    rfc: {
                        maxlength: 13,
                        required: true,
                    },
                    email: {
                        maxlength: 50,
                        required: true,
                        email: true
                    },
                    calle: {
                        maxlength: 50,
                        required: true
                    },
                    no_exterior: {
                        maxlength: 5,
                        required: true
                    },
                    colonia: {
                        maxlength: 20,
                        required: true
                    },
                    codigo_postal: {
                        required: true
                    },
                    ciudad: {
                        required: true,
                        maxlength: 50
                    },
                    estado: {
                        //select
                    },
                    telefono1: {
                        required: true
                    }
                },
                messages: {
                    razon_social: {
                        maxlength: "Razón social debe tener menos de 80 caracteres",
                        required: "Escribe la razón social"
                    },
                    rfc: {
                        maxlength: "El RFC debe tener menos de 13 caracteres",
                        required: "Escribe el RFC"
                    },
                    email: {
                        maxlength: "El email debe tener menos de 30 caracteres",
                        required: "El Email es obligatorio",
                        email: "Escribe un email valido"
                    },
                    calle: {
                        required: "Escribe la calle",
                        maxlength: "La calle debe tener menos de 50 caracteres"
                    },
                    no_exterior: {
                        maxlength: "Menos de 5 digitos",
                        required: "Escribe el No. exterior"
                    },
                    colonia: {
                        required: "Escribe la colonia",
                        maxlength: "La colonia debe tener menos de 20 caracteres"
                    },
                    codigo_postal: {
                        required: "Escribe el código postal"
                    },
                    ciudad: {
                        required: "Escribe la ciudad",
                        maxlength: "La ciudad debe tener menos de 50 caracteres"
                    },
                    estado: {
                    },
                    telefono1: {
                        required: "Escribe el telefono"
                    }
                },
                invalidHandler: function (event, validator) { //display error alert on form submit
                    error.fadeIn('slow');
                    $('#div-scroll-verificar-datos').animate({ scrollTop: 0 }, 600);
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
                     var url     = '/gestionar/verificarinfo';
                     var param   = $('#form-verificar-datos').serialize();

                    Metronic.showLoader();
                    $.post(url, param, function(data, textStatus, xhr) {
                        if (data.exito) {
                            Metronic.removeLoader();
                            verificarInfo.modal('hide');
                            bootbox.alert(data.msg, function() {
                                //location.reload();
                                //redireccionar a formulario para subir comprobantes de pago
                            });
                        } else {
                            Metronic.removeLoader();
                            error.html(data.msg);
                            error.show();
                            $('#div-scroll-verificar-datos').animate({ scrollTop: 0 }, 600);
                            Metronic.removeLoader();
                            verificarInfo.modal('show');
                        }
                    });
                }
            });
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            bootbox.setDefaults({locale: "es"});
            handleInputMasks();
            handleInfo();
        }
    };

}();