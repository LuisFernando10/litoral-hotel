
    <?php

        #Importación
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../config-import.php');

        #Generales
        $id_user = Security::GetSessionUserId();

        #Ajax
        $promotion_id = filter_input(INPUT_POST, 'promotion_id', FILTER_SANITIZE_NUMBER_INT);
        $promotion_name = filter_input(INPUT_POST, 'promotion_name', FILTER_SANITIZE_STRING);
        $promotion_room = filter_input(INPUT_POST, 'promotion_room', FILTER_SANITIZE_NUMBER_INT);
        $promotion_price = filter_input(INPUT_POST, "promotion_price", FILTER_SANITIZE_STRING);
        $promotion_initial_date = filter_input(INPUT_POST, "promotion_initial_date", FILTER_SANITIZE_STRING);
        $promotion_final_date = filter_input(INPUT_POST, "promotion_final_date", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        #Acciones
        if ($action == 'INSERT'){

            $insert_promotion = Promotions::insertPromotion($promotion_room, $promotion_name, $promotion_initial_date,$promotion_final_date,$promotion_price);

            if ($insert_promotion != null && is_numeric($insert_promotion)) $response = [
                'status' => '200',
                'message' => 'Promoção Registrada.',
                'result' => $insert_promotion
            ];
            elseif ($insert_promotion == 'existing-promotion') $response = [
                'status' => '500',
                'message' => 'O nome da promoção já existe.',
                'result' => $insert_promotion
            ];
            else $response = [
                'status' => '500',
                'message' => 'Error ao registrar',
                'result' => null
            ];
        }
        elseif ($action == 'UPDATE'){

            $update_promotion = Promotions::updatePromotion($promotion_id, $promotion_room, $promotion_name, $promotion_initial_date, $promotion_final_date, $promotion_price);

            if ($update_promotion == true && $update_promotion !== 'existing-promotion') $response = [
                'status' => '200',
                'message' => 'Promoção Atualizada.',
                'result' => $update_promotion
            ];
            elseif ($update_promotion === 'existing-promotion') $response = [
                'status' => '500',
                'message' => 'O nome da promoção já existe.',
                'result' => $update_promotion
            ];
            else $response = [
                'status' => '500',
                'message' => 'Error ao Atualizar.',
                'result' => null
            ];
        }
        elseif ($action == 'DELETE'){

            $delete_promotion = Promotions::deletePromotion($promotion_id);

            if ($delete_promotion) $response = [
                    'status' => '200',
                    'message' => 'Promoção Deletada.'
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