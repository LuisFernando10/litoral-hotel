
    $('.js-btn-login').on('click', function () {

        //We define the HTML elements for user and password
        let userName = $('.js-user');
        let userPassword = $('.js-pass');

        //Ejecutamos ajax que realizará las validaciones de autenticación
        $.ajax({
            type: 'POST',
            url : FULL_WEB_URL+'ajax/log-in.php',
            data: ({
                user_name : userName.val(),
                user_password: userPassword.val()
            }),
            success:function (response){

                //Parseamos a formato JSON la respuesta
                let json_obj = $.parseJSON(response);

                //Validamos si el estado de la sesión es '1', para saber si se inició alguna sesión
                if (json_obj.session_status === '1'){

                    //Validamos la existencia de un 'rol'
                    if (json_obj.session_role){

                        //Validamos cada rol devuelto por la sesión, para agregar los respectivos direccionamientos a las vistas
                        switch (json_obj.session_role) {

                            case 'admin':
                                location.reload();
                                break;

                            case 'user':
                                location.reload();
                                break;
                        }
                    }
                }
                else{

                    userName.addClass('border border-danger');
                    userPassword.addClass('border border-danger');
                    $('.js-login-message').text('Nome de usuário ou senha inválidos');
                    return false;
                }
            }
        });

        //Retornamos 'false' para evitar que recargue
        return false;
    });

    //Asociamos evento para el input-password
    $('.js-pass').on('keyup', function (event) {

        //Validamos si la tecla oprimida es 'Enter'
        if (event.keyCode === 13){

            //Seteamos el evento
            event.preventDefault();

            //Ejecutamos la acción del botón
            $('.js-btn-login').click();
        }
    });