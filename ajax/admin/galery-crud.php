
    <?php

        //Importamos los archivos necesarios para el tratamiento de los datos
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../config-import.php');

        //Obtenemos los datos relevantes para los procesos
        $id_user = Security::GetSessionUserId();

        //Obtenemos los datos enviados por el Ajax
        $galery_id = filter_input(INPUT_POST, 'galery_id', FILTER_SANITIZE_NUMBER_INT);
        $galery_name = filter_input(INPUT_POST, 'galery_name', FILTER_SANITIZE_STRING);
        $galery_tipo = filter_input(INPUT_POST, "galery_tipo", FILTER_SANITIZE_STRING);
        $galery_description = filter_input(INPUT_POST, 'galery_description', FILTER_SANITIZE_STRING);
        $galery_file_current_name = filter_input(INPUT_POST, "galery_file_current_name", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        //Validamos el tipo de 'acción'
        if ($action == 'INSERT'){

            //Nós obtemos as propiedades do file
            $galery_file = $_FILES['galery_file'];

            //Validamos si existen archivos para insertar
            if (!empty($galery_file)){

                //Creamos variable para guardar el array con información del archivo ó la vaciamos
                $file_document = empty($galery_file) ? '' : $galery_file;

                //Porcessamos o arquivo para mover ele ao caminho estebelecida
                $file_proccess = Files::uploadFile($file_document);

                //Validamos successo ou error no proceso do 'upload'
                if ($file_proccess != false){

                    //Realizamos la inserción de los campos de la plantilla en la BD
                    $id_galery = Galery::insertGalery($galery_name, $file_proccess, $galery_description,$galery_tipo);

                    //Validamos si la inserción tuvo éxito o no
                    if ($id_galery != null && is_numeric($id_galery))
                        $response = array(
                            'status' => '200',
                            'message' => 'Galeria Registrada',
                            'id_galery' => $id_galery
                        );
                    elseif ($id_galery == 'existing_galery')
                        $response = array(
                            'status' => '500',
                            'message' => 'O nome da imagem já existe',
                            'id_galery' => $id_galery
                        );
                    else
                        $response = array(
                            'status' => '500',
                            'message' => 'Error ao registrar',
                            'id_galery' => null
                        );
                }
                else
                    $response = array(
                        'status' => '500',
                        'message' => 'Error ao registrar',
                        'id_galery' => null
                    );
            }
        }
        elseif ($action == 'UPDATE'){

            //Nós validamos se o array ($_FILES) está vacío para nao ter problemas con o (Notice do PHP)
            if (empty($_FILES))
                $galery_file = NULL;
            else
                //Nós obtemos as propiedades do file
                $galery_file = $_FILES['galery_file'];

            //Validamos si existen archivos para insertar
            if (isset($galery_file) && (!empty($galery_file) || $galery_file != NULL)){

                //Creamos variable para guardar el array con información del archivo ó la vaciamos
                $file_document = empty($galery_file) ? '' : $galery_file;

                //Deletamos o arquivo no servidor antes de atualizar pelo novo arquivo
                $delete_file = Files::deleteFileServer($galery_file_current_name);

                //Nos validamos se realmente se deleteu o arquivo
                if ($delete_file == true){

                    //Porcessamos o arquivo para mover ele ao caminho estebelecida
                    $file_proccess = Files::uploadFile($file_document);

                    //Validamos successo ou error no proceso do 'upload'
                    if ($file_proccess != false){

                        //Realizamos la inserción de los campos de la plantilla en la BD
                        $update_galery = Galery::updateGalery($galery_id,$galery_name, $file_proccess, $galery_description, $galery_tipo);

                        //Validamos si la inserción tuvo éxito o no
                        if ($update_galery != false)
                            $response = array(
                                'status' => '200',
                                'message' => 'Imagem Atualizada',
                                'id_galery' => $update_galery
                            );
                        elseif ($update_galery == 'existing_galery')
                            $response = array(
                                'status' => '500',
                                'message' => 'O nome da imagem já existe',
                                'id_galery' => $update_galery
                            );
                        else
                            $response = array(
                                'status' => '500',
                                'message' => 'Error ao Atualizar',
                                'id_galery' => null
                            );
                    }
                    else
                        $response = array(
                            'status' => '500',
                            'message' => 'Error ao Atualizar',
                            'id_galery' => null
                        );
                }
                else
                    $response = array(
                        'status' => '500',
                        'message' => 'Error ao Atualizar',
                        'id_galery' => null
                    );
            }
            else{

                //Realizamos la inserción de los campos de la plantilla en la BD
                $update_galery = Galery::updateGalery($galery_id,$galery_name, NULL, $galery_description, $galery_tipo);

                //Validamos si la inserción tuvo éxito o no
                if ($update_galery != false)
                    $response = array(
                        'status' => '200',
                        'message' => 'Imagem Atualizada',
                        'id_galery' => $update_galery
                    );
                elseif ($update_galery == 'existing_galery')
                    $response = array(
                        'status' => '500',
                        'message' => 'O nome da imagem já existe',
                        'id_galery' => $update_galery
                    );
                else
                    $response = array(
                        'status' => '500',
                        'message' => 'Error ao Atualizar',
                        'id_galery' => null
                    );
            }
        }
        elseif ($action == 'DELETE'){

            //Obtemos os dados do galery
            $data_galery = Galery::getAll(NULL,NULL,NULL,$galery_id,NULL,NULL);

            //Obtemos o nome do arquivo
            $image_name = $data_galery[0]['imagem'];

            //Nos executamos o método que deleta o galery e o arquivo do servidor
            $delete_galery =Galery::deleteGalery($galery_id);

            //Nón validamos o sucesso da operacao
            if ($delete_galery){

                //Deletamos o arquivo no servidor antes de atualizar pelo novo arquivo
                $delete_file = Files::deleteFileServer($image_name);

                $response = array(
                    'status' => '200',
                    'message' => 'Imagem Deletada'
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