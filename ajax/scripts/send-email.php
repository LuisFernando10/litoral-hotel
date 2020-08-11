
    <?php

        /**
         * @Description: Documento que procesa y gestiona la informacion para enviar correos electrónicos
         * @User: luis.chamorro
         * @Date: 31-may-2020
         */

        //Importamos los archivos necesarios para el tratamiento de los datos
        require_once(dirname(__FILE__).'/../../config-import.php');

        //Obtenemos los datos del Ajax
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING, array('options'=>array('default'=>NULL)));
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, array('options'=>array('default'=>NULL)));
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT, array('options'=>array('default'=>NULL)));
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING, array('options'=>array('default'=>NULL)));
        $check_in = filter_input(INPUT_POST, 'check_in', FILTER_SANITIZE_STRING, array('options'=>array('default'=>NULL)));
        $check_out = filter_input(INPUT_POST, 'check_out', FILTER_SANITIZE_STRING, array('options'=>array('default'=>NULL)));
        $diff_days = filter_input(INPUT_POST, 'diff_days', FILTER_SANITIZE_NUMBER_INT, array('options'=>array('default'=>NULL)));
        $type_room = filter_input(INPUT_POST, 'type_room', FILTER_SANITIZE_NUMBER_INT, array('options'=>array('default'=>NULL)));
        $room = filter_input(INPUT_POST, 'room', FILTER_SANITIZE_NUMBER_INT, array('options'=>array('default'=>NULL)));
        $adult = filter_input(INPUT_POST, 'adult', FILTER_SANITIZE_NUMBER_INT, array('options'=>array('default'=>NULL)));
        $children = filter_input(INPUT_POST, 'children', FILTER_SANITIZE_NUMBER_INT, array('options'=>array('default'=>NULL)));
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING, array('options'=>array('default'=>NULL)));
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING, array('options'=>array('default'=>'CONTACT')));

        //Evaluamos el tipo de acción
        if ($action === 'CONTACT'){

            //Enviamos el 'email'
            $send_email = GeneralMethods::sendPhpMailerEmail(
                constant('EMAIL'),
                'Contato (Hotel Litoral)',
                $text
            );

            //Insertamos los datos en la BD
            $insert_email = HotelContact::insertEmail(
                $name,
                $email,
                $phone,
                $text,
                'contato'
            );

            //Validamos si se envió el correo
            if ($send_email === '200' && $insert_email != NULL){
                $response = [
                    'status' => '200',
                    'message' => 'Email enviado!!'
                ];
            }
            else
                $response = [
                    'status' => '500',
                    'message' => 'Ocorreu um erro. Por favor, tente novamente !!'
                ];
        }
        elseif ($action === 'RESERVE'){

            //Enviamos el 'email'
            $send_email = GeneralMethods::sendPhpMailerEmail(
                constant('EMAIL'),
                'Reserva (Hotel Litoral)',
                $text
            );

            //Insertamos los datos en la BD
            $insert_email = HotelContact::insertEmail(
                $name,
                $email,
                $phone,
                $text,
                'contato'
            );

            //Validamos si se envió el correo
            if ($send_email === '200' && $insert_email != NULL){
                $response = [
                    'status' => '200',
                    'message' => 'Email enviado!!'
                ];
            }
            else
                $response = [
                    'status' => '500',
                    'message' => 'Ocorreu um erro. Por favor, tente novamente !!'
                ];
        }

        //Retornamos la respuesta en formato JSON
        echo json_encode($response);
