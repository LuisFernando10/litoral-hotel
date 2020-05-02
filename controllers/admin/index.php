
    <?php

        /**
         * @Description: Documento que procesa los controladores y las acciones para renderizar las vistas con 'Twig' para el rol 'administrador'
         * @User: luis.chamorro
         * @Date: 14/feb/2020
         */

        //Importamos os arquivos que sao indispensaveis pra funcionaiodade do sistema
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../vendor/autoload.php');

        //Indicamos en qué parte del proyecto se encontrarán las plantillas a reenderizar
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__).'/../../views/admin/');

        //Indicamos las carpetas que almacenarán el caché de Twig
        //$path_cache_twig = dirname(__FILE__).'/../../temp/cache/';

        //Twig load enviroment
        $twig = new \Twig\Environment($loader, array(
            //'cache' =>  $path_cache_twig,
            'auto_reload' => true,
            'debug' => true
        ));

        //Adicionamos as extensões necessárias
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        //Obtenemos el Id del 'usuario' y el Id de la 'empresa'
        $user_id = $_SESSION['user_id'];

        //Obtenemos los datos desde la BD correspondiente al rol 'administrador'
        $data_user = Users::getAll(NULL, NULL, NULL, $user_id, NULL, NULL, NULL, '1','ativo');

        //Obtenemos los datos GET que corresponden a la estructura general de la plataforma (Class-Method-Id) y paginaciones
        $class = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING, array("options" => array("default" => "usuarios")));
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING, array("options" => array("default" => 1)));
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING, array("options" => array("default" => NULL)));

        //Definimos los parámetros generales a utilizar en las plantillas 'twig'
        $general_param = array(
            'full_web_url' => constant('FULL_WEB_URL'),
            'full_assets_url' => constant('ASSETS_WEB_URL'),
            'full_images_url' => constant('IMAGES_WEB_URL'),
            'user_id' => $user_id,
            'data_user' => $data_user[0],
            'class_url' => $class
        );

        //Evaluamos cada uno de los controladores para permitir el acceso a las respectivas vistas
        switch ($class){

            //Cargamos y renderizamos las plantillas (Vistas), junto con los parámetros (Variables) a utilizar

            #DASHBOARD
            case 'dashboard':

                $twig->display('dashboard.twig',array(
                    'general' => $general_param
                ));
                break;

            #QUARTOS
            case 'quartos':

                //Nos obtemos os dados que precisaremos renderizar nas vistas
                $data_room = Rooms::getAll(NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL);
                $data_room_edit = Rooms::getAll(NULL, NULL, NULL, $id, NULL, NULL,NULL, NULL, NULL, NULL, NULL);

                //Nos validamos cada uma das clases
                if ($action == 'create')
                    $twig->display('rooms-create.twig',array(
                        'general' => $general_param
                    ));
                elseif ($action == 'edit'){

                    //Nos validamos se ha um $id
                    if (is_numeric($id) && $id != ''){
                        $twig->display('rooms-edit.twig',array(
                            'general' => $general_param,
                            'data_room_edit' => $data_room_edit[0]
                        ));
                    }
                    else
                        $twig->display('rooms-list.twig',array(
                            'general' => $general_param,
                            'data_room' => $data_room
                        ));
                }
                else
                    $twig->display('rooms-list.twig',array(
                        'general' => $general_param,
                        'data_room' => $data_room
                    ));

                break;

            #OFERECIMENTOS
            case 'oferecimentos':

                //Obtemos os dados relacionados às ofertas
                $data_offering = Offerings::getAll(NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                //Renderizamos la vista
                $twig->display('offerings.twig',array(
                    'general' => $general_param,
                    'data_offering' => $data_offering
                ));

                break;

            #CONFIGURAÇÕES
            case 'configuracoes':

                //Obtemos os dados das configuracoes que precisemos
                $data_configurations = Configurations::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

                //Validamos se realmente tem dados pra evitar o error de 'NOTICE do PHP'
                if ($data_configurations != NULL){
                    $data_phones = json_decode($data_configurations[0]['telefones'], TRUE);
                    $data_types = json_decode($data_configurations[0]['tipo'], TRUE);
                }
                else{
                    $data_phones = NULL;
                    $data_types = NULL;
                }


                $twig->display('configurations.twig',array(
                    'general' => $general_param,
                    'data_configuration' => $data_configurations,
                    'data_phones' => $data_phones,
                    'data_types' => $data_types
                ));
                break;

            #SAIR
            case 'salir':

                //Importamos el controlador del LogIn
                Security::sessionClose();

                //Guardamos la ruta general de la plataforma
                $ruta_redireccion = constant('FULL_WEB_URL');

                //Realizamos el direccionamiento a la ruta general, la cual cargará el 'index.php'
                header("Location: $ruta_redireccion");

                break;

            #DEFAULT
            default:

                //Cargamos y renderizamos la plantilla (Vista), junto con los parámetros (Variables) a utilizar
                $twig->display('dashboard.twig',array(
                    'general' => $general_param
                ));
                break;
        }