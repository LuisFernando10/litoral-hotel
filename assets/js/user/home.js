
    $('.js-btn-reservation').on('click', function () {

         $.ajax({
            type : 'POST',
            url : FULL_WEB_URL+'ajax/user/users.php',
            data : {
                dato : 'Holix'
            },
            success : function (response) {

                //Parseamos la respuesta a formato JSON
                let json_object = $.parseJSON(response);

                console.log(json_object);
            }
        });
    });