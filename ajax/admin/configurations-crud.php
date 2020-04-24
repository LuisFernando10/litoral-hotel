
    <?php

        //Importamos los archivos necesarios para el tratamiento de los datos
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../config-import.php');

        //Obtenemos los datos enviados por el Ajax
        $array_data = filter_input(INPUT_POST, "array_data", FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
        $neighborhood = filter_input(INPUT_POST, 'neighborhood', FILTER_SANITIZE_STRING, array("options" => array("default" => NULL)));
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING, array("options" => array("default" => NULL)));
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING, array("options" => array("default" => NULL)));
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        //Validamos el tipo de 'acción'
        if ($action == 'INSERT'){

            var_dump($array_data);
            var_dump($neighborhood);
            var_dump($state);
            var_dump($country);

exit();

            //Realizamos la inserción de los campos de la plantilla en la BD
            $id_oferecimento = Offerings::insertOffering($array_data);

            // *** Fin proceso **

            //Validamos si la inserción tuvo éxito o no
            if ($id_oferecimento != null)
                $response = array(
                    'status' => '200',
                    'message' => 'Configuração Salva',
                    'id_template' => $id_oferecimento
                );
            else
                $response = array(
                    'status' => '500',
                    'message' => 'Falha ao Registrar',
                    'id_template' => null
                );
        }