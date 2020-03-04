
    <?php

        //Importamos los archivos necesarios para el tratamiento de los datos
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../config-import.php');

        //Obtenemos los datos relevantes para los procesos
        $id_user = Security::GetSessionUserId();

        //Obtenemos los datos enviados por el Ajax
        $quarto_name = filter_input(INPUT_POST, 'quarto_name', FILTER_SANITIZE_STRING);
        $quarto_description = filter_input(INPUT_POST, 'quarto_description', FILTER_SANITIZE_STRING);
        $quarto_adultos = filter_input(INPUT_POST, "quarto_adultos", FILTER_SANITIZE_STRING);
        $quarto_price = filter_input(INPUT_POST, "quarto_price", FILTER_SANITIZE_STRING);
        $quarto_file = $_FILES['quarto_file'];
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        //Validamos el tipo de 'acción'
        if ($action == 'INSERT'){

            //Realizamos la inserción de los campos de la plantilla en la BD
            $id_room = Rooms::insertRoom($quarto_name, $quarto_description, $quarto_file['name'],$quarto_price,$quarto_adultos,'disponivel');

            //Validamos si la inserción tuvo éxito o no
            if ($id_room != null && is_numeric($id_room))
                $response = array(
                    'status' => '200',
                    'message' => 'Quarto Registrado',
                    'id_room' => $id_room
                );
            elseif ($id_room == 'existing_quarto')
                $response = array(
                    'status' => '500',
                    'message' => 'O nome do quarto já existe',
                    'id_room' => $id_room
                );
            else
                $response = array(
                    'status' => '500',
                    'message' => 'Error ao registrar',
                    'id_room' => null
                );
        }
        elseif ($action == 'UPDATE'){

            //Realizamos la actualización de los campos de la plantilla en la BD
            $update_template = Template::updateTemplate($id_company, $template_id, $template_name,$array_data);

            //Validamos si la actualización tuvo éxito o no
            if ($update_template != null)
                $response = array(
                    'status' => '200',
                    'message' => 'Quarto Atualizado',
                    'update_template' => $update_template
                );
            else
                $response = array(
                    'status' => '500',
                    'message' => 'Error ao atualizar',
                    'update_template' => null
                );
        }
        elseif ($action == 'DELETE'){

            //Eliminamos la plantilla junto a sus respectivos 'plantilla_detalle'
            $delete_template = Template::deleteTemplate($template_id,$id_company);

            //Validamos éxito de la operación
            if ($delete_template)
                $response = array(
                    'status' => '200',
                    'message' => 'Quarto Deletado'
                );
            else
                $response = array(
                    'status' => '500',
                    'message' => 'Error ao Deletar'
                );
        }

        //Retornamos la respuesta en formato Json
        echo json_encode($response);