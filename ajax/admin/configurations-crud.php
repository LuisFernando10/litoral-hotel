
    <?php

        //Importamos los archivos necesarios para el tratamiento de los datos
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../config-import.php');

        //Obtenemos los datos enviados por el Ajax
        $array_data = filter_input(INPUT_POST, "array_data", FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
        $neighborhood = filter_input(INPUT_POST, 'neighborhood', FILTER_SANITIZE_STRING, array("options" => array("default" => NULL)));
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING, array("options" => array("default" => NULL)));
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING, array("options" => array("default" => NULL)));
        $id_configuration = filter_input(INPUT_POST, 'id_configuration', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => NULL)));
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        //Validamos el tipo de 'acción'
        if ($action == 'INSERT'){

            //Realizamos la inserción de los campos de la plantilla en la BD
            $insert_configuracao = Configurations::insertConfiguration(
                $neighborhood,
                $state,
                $country,
                $array_data
            );

            //Validamos si la inserción tuvo éxito o no
            if ($insert_configuracao != null)
                $response = array(
                    'status' => '200',
                    'message' => 'Configuração Salva',
                    'id_configuracao' => $insert_configuracao
                );
            else
                $response = array(
                    'status' => '500',
                    'message' => 'Falha ao Registrar',
                    'id_configuracao' => null
                );
        }
        else{

            //Realizamos a atualizacao
            $uptade_configuracao = Configurations::updateConfiguration(
                $id_configuration,
                $neighborhood,
                $state,
                $country,
                $array_data
            );

            //Validamos si la inserción tuvo éxito o no
            if ($uptade_configuracao != null)
                $response = array(
                    'status' => '200',
                    'message' => 'Configuração Alterada',
                    'id_configuracao' => $uptade_configuracao
                );
            else
                $response = array(
                    'status' => '500',
                    'message' => 'Falha ao Alterar',
                    'id_configuracao' => null
                );
        }

        //Mostramos a resposta em formato JSON
        echo json_encode($response);