
    <?php

        #Importación
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../config-import.php');

        #Generales
        $id_user = Security::GetSessionUserId();

        #Ajax
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        $holiday_id = filter_input(INPUT_POST, 'holiday_id', FILTER_SANITIZE_NUMBER_INT);
        $holiday_name = filter_input(INPUT_POST, 'holiday_name', FILTER_SANITIZE_STRING);
        $holiday_initial_date = filter_input(INPUT_POST, "holiday_initial_date", FILTER_SANITIZE_STRING);
        $holiday_final_date = filter_input(INPUT_POST, "holiday_final_date", FILTER_SANITIZE_STRING);
        $array_data = $_POST['array_data'];

        #Acciones
        if ($action == 'INSERT'){

            $insert_holiday = Holidays::insertHoliday($holiday_initial_date, $holiday_final_date, $holiday_name, $array_data);

            if ($insert_holiday == 'existing-holiday') $response = [
                'status' => '500',
                'message' => 'O nome do feriado já existe.',
                'result' => $insert_holiday
            ];
            elseif (is_numeric($insert_holiday)) $response = [
                'status' => '200',
                'message' => 'Feriado Registrado.',
                'result' => $insert_holiday
            ];
            else $response = [
                'status' => '500',
                'message' => 'Error ao registrar',
                'result' => null
            ];
        }
        elseif ($action == 'UPDATE'){

            $update_holiday = Holidays::updateHoliday($holiday_id, $holiday_room, $holiday_name, $holiday_initial_date, $holiday_final_date, $holiday_price);

            if ($update_holiday == true && $update_holiday !== 'existing-holiday') $response = [
                'status' => '200',
                'message' => 'Feriado Atualizada.',
                'result' => $update_holiday
            ];
            elseif ($update_holiday === 'existing-holiday') $response = [
                'status' => '500',
                'message' => 'O nome do feriado já existe.',
                'result' => $update_holiday
            ];
            else $response = [
                'status' => '500',
                'message' => 'Error ao Atualizar.',
                'result' => null
            ];
        }
        elseif ($action == 'DELETE'){

            $delete_holiday = Holidays::deleteHoliday($holiday_id);

            if ($delete_holiday) $response = [
                    'status' => '200',
                    'message' => 'Feriado Deletado.'
                ];
            else $response = [
                    'status' => '500',
                    'message' => 'Error ao Deletar.'
                ];
        }
        else $response = [
            'status' => '500',
            'message' => 'Error na Solicitude.'
        ];

        #Respuesta
        echo json_encode($response);