
    <?php

        //Importamos los archivos necesarios para el tratamiento de los datos
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../config-import.php');

        //Obtenemos los datos relevantes para los procesos
        $id_user = Security::GetSessionUserId();

        //Obtenemos los datos enviados por el Ajax
        $quarto_id = filter_input(INPUT_POST, 'quarto_id', FILTER_SANITIZE_NUMBER_INT);
        $quarto_name = filter_input(INPUT_POST, 'quarto_name', FILTER_SANITIZE_STRING);
        $quarto_description = filter_input(INPUT_POST, 'quarto_description', FILTER_SANITIZE_STRING);
        $quarto_adultos = filter_input(INPUT_POST, "quarto_adultos", FILTER_SANITIZE_STRING);
        $quarto_price = filter_input(INPUT_POST, "quarto_price", FILTER_SANITIZE_STRING);
        $quarto_file_current_name = filter_input(INPUT_POST, "quarto_file_current_name", FILTER_SANITIZE_STRING);
        $quarto_estado = filter_input(INPUT_POST, "quarto_estado", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        //Validamos el tipo de 'acción'
        if ($action == 'INSERT'){

            //Nós obtemos as propiedades do file
            $quarto_file = $_FILES['quarto_file'];

            //Validamos si existen archivos para insertar
            if (!empty($quarto_file)){

                //Creamos variable para guardar el array con información del archivo ó la vaciamos
                $file_document = empty($quarto_file) ? '' : $quarto_file;

                //Porcessamos o arquivo para mover ele ao caminho estebelecida
                $file_proccess = Files::uploadFile($file_document);

                //Validamos successo ou error no proceso do 'upload'
                if ($file_proccess != false){

                    //Realizamos la inserción de los campos de la plantilla en la BD
                    $id_room = Rooms::insertRoom($quarto_name, $quarto_description, $file_proccess,$quarto_price,$quarto_adultos,'disponivel');

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
                else
                    $response = array(
                        'status' => '500',
                        'message' => 'Error ao registrar',
                        'id_room' => null
                    );
            }
        }
        elseif ($action == 'UPDATE'){

            //Nós validamos se o array ($_FILES) está vacío para nao ter problemas con o (Notice do PHP)
            if (empty($_FILES))
                $quarto_file = NULL;
            else
                //Nós obtemos as propiedades do file
                $quarto_file = $_FILES['quarto_file'];

            //Validamos si existen archivos para insertar
            if (isset($quarto_file) && (!empty($quarto_file) || $quarto_file != NULL)){

                //Creamos variable para guardar el array con información del archivo ó la vaciamos
                $file_document = empty($quarto_file) ? '' : $quarto_file;

                //Deletamos o arquivo no servidor antes de atualizar pelo novo arquivo
                $delete_file = Files::deleteFileServer($quarto_file_current_name);

                //Nos validamos se realmente se deleteu o arquivo
                if ($delete_file == true){

                    //Porcessamos o arquivo para mover ele ao caminho estebelecida
                    $file_proccess = Files::uploadFile($file_document);

                    //Validamos successo ou error no proceso do 'upload'
                    if ($file_proccess != false){

                        //Realizamos la inserción de los campos de la plantilla en la BD
                        $update_room = Rooms::updateRoom($quarto_id,$quarto_name, $quarto_description, $file_proccess,$quarto_price,$quarto_adultos,$quarto_estado);

                        //Validamos si la inserción tuvo éxito o no
                        if ($update_room != false)
                            $response = array(
                                'status' => '200',
                                'message' => 'Quarto Atualizado',
                                'id_room' => $update_room
                            );
                        elseif ($update_room == 'existing_quarto')
                            $response = array(
                                'status' => '500',
                                'message' => 'O nome do quarto já existe',
                                'id_room' => $update_room
                            );
                        else
                            $response = array(
                                'status' => '500',
                                'message' => 'Error ao Atualizar',
                                'id_room' => null
                            );
                    }
                    else
                        $response = array(
                            'status' => '500',
                            'message' => 'Error ao Atualizary',
                            'id_room' => null
                        );
                }
                else
                    $response = array(
                        'status' => '500',
                        'message' => 'Error ao Atualizar',
                        'id_room' => null
                    );
            }
            else{

                //Realizamos la inserción de los campos de la plantilla en la BD
                $update_room = Rooms::updateRoom($quarto_id,$quarto_name, $quarto_description, NULL,$quarto_price,$quarto_adultos,$quarto_estado);

                //Validamos si la inserción tuvo éxito o no
                if ($update_room != false)
                    $response = array(
                        'status' => '200',
                        'message' => 'Quarto Atualizado',
                        'id_room' => $update_room
                    );
                elseif ($update_room == 'existing_quarto')
                    $response = array(
                        'status' => '500',
                        'message' => 'O nome do quarto já existe',
                        'id_room' => $update_room
                    );
                else
                    $response = array(
                        'status' => '500',
                        'message' => 'Error ao Atualizar',
                        'id_room' => null
                    );
            }
        }
        elseif ($action == 'DELETE'){

            //Obtemos os dados do quarto
            $data_room = Rooms::getAll(NULL,NULL,NULL,$quarto_id,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

            //Obtemos o nome do arquivo
            $image_name = $data_room[0]['image'];

            //Nos executamos o método que deleta o quarto e o arquivo do servidor
            $delete_quarto = Rooms::deleteRoom($quarto_id);

            //Nón validamos o sucesso da operacao
            if ($delete_quarto){

                //Deletamos o arquivo no servidor antes de atualizar pelo novo arquivo
                $delete_file = Files::deleteFileServer($image_name);

                $response = array(
                    'status' => '200',
                    'message' => 'Quarto Deletado'
                );
            }
            else
                $response = array(
                    'status' => '500',
                    'message' => 'Error ao Deletar'
                );
        }

        //Retornamos la respuesta en formato Json
        echo json_encode($response);