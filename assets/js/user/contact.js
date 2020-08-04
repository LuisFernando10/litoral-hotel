
    $(document).ready(function () {
        //Chamamos método que valida um telefone válido (inicializacao)
        phone_validatios();
    });

    $('.js-contact-btn-send-email').on('click', function () {

        //Obtenemos los elementos del DOM
        let element_frm = $('.js-contact-form');
        let element_name = element_frm.find('.js-contact-name');
        let element_email = element_frm.find('.js-contact-email');
        let element_phone = element_frm.find('.js-contact-phone');
        let element_text = element_frm.find('.js-contact-text');
        let element_btn = $(this);

        //Obtenemos los valores
        let value_name = element_name.val();
        let value_email = element_email.val();
        let value_phone = element_phone.val();
        let value_text = element_text.val();

        //** Proceso para validar los datos **

        //Variable de control
        var control_validation = true;

        if (value_name === '' || value_name.length === 0){
            notify_error_notification('O <b>Nome</b> é obrigatório.', 2000);
            control_validation = false;
            return false;
        }
        else if (value_email === '' || value_email.length === 0){
            notify_error_notification('O <b>Email</b> é obrigatório.', 2000);
            control_validation = false;
            return false;
        }
        else if ((value_email !== '' || value_email.length > 0) && validateEmail(value_email) === false){
            notify_error_notification('O <b>Email</b> é inválido.', 2000);
            control_validation = false;
            return false;
        }
        else if (value_phone.length > 0 && value_phone.length <= 5){
            notify_error_notification('O <b>Telefone</b> deve ter mais de 5 dígitos.', 2000);
            control_validation = false;
            return false;
        }
        else if ((value_phone.length > 5 && value_phone.length < 32) && validateNumber(value_phone) === false){
            notify_error_notification('O <b>Telefone</b> deve conter apenas números.', 2000);
            control_validation = false;
            return false;
        }
        else if (value_text === '' || value_text.length === 0){
            notify_error_notification('A <b>Mensagem</b> é obrigatória.', 2000);
            control_validation = false;
            return false;
        }

        //Validamos si t0do etá Ok
        if (control_validation === true)
            $.ajax({
                type : 'POST',
                url : FULL_WEB_URL+'ajax/scripts/send-email.php',
                data : {
                    name : value_name,
                    email : value_email,
                    phone : value_phone,
                    text : value_text,
                    action: 'CONTACT'
                },
                beforeSend: function(){
                    //element_btn
                    //    .prop('disabled', true)
                    //    .addClass('css-cursor-not-allowed');
                },
                success : function (response) {

                    //Parseamos la respuesta a formato JSON
                    let json_object = $.parseJSON(response);

                    //Validamos si hubo o no éxito
                    if (json_object.status === '200')
                        notify_success_notification(json_object.message);
                    else{

                        notify_error_notification(json_object.message);
                        return false;
                    }
                },
                complete: function () {
                    //element_btn
                    //    .prop('disabled', false)
                    //    .removeClass('css-cursor-not-allowed');

                    //Limpiamos los valores
                    element_name.val('');
                    element_email.val('');
                    element_phone.val('');
                    element_text.val('');
                }
            });
    });

    $('.js-btn-reserve').on('click', function () {

        validateReserveFields();
    });