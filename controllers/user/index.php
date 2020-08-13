
    <?php

        /**
         * @Description: Documento que gestionarà las respectivas vistas de la plataforma
         * @User: luis.chamorro
         * @Date: 26-ene-2020
         */

        //Incluimos la configuraciòn del gestor de paquetes del 'Composer'
        require_once (dirname(__FILE__).'/../../vendor/autoload.php');

        //Cargamos configuraciòn e indicamos en què parte se deben renderizar las vistas del 'Twig'
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__).'/../../views/user/');

        //Cargamos las configuraciones para el ambiente de las plantillas
        $twig = new \Twig\Environment($loader, [
            //'cache' => dirname(__FILE__).'/../../views/user/',
            'auto_reload' => true,
            'debug' => true
        ]);

        //Adicionamos as extensões necessárias
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        //Obtenemos los paràmetros URL configurados desde el .htaccess (Clase-Acciòn-Id)
        $class = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING, array("options" => array("default" => "home")));
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));

        //Obtemos os dados do BD necessários nas visualizações gerais pra tratamento
        $data_offerings_have = Offerings::getAll(NULL, NULL, NULL, NULL, NULL, 'possui', NULL);
        $data_offerings_dont_have = Offerings::getAll(NULL, NULL, NULL, NULL, NULL, 'nao_possui', NULL);
        $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
        $data_configurations = Configurations::getAll(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $data_phones = json_decode($data_configurations[0]['telefones'], TRUE);

        //Definimos las variables generales a utilizar en las vistas 'Twig'
        $general_param = array(
            "full_web_url" => constant('FULL_WEB_URL'),
            "full_assets_url" => constant('ASSETS_WEB_URL'),
            "full_images_url" => constant('IMAGES_WEB_URL'),
            "class_param" => $class,
            "action_param" => $action,
            "id_param" => $id,
            "data_offerings" => ['have' => $data_offerings_have, 'dont_have' => $data_offerings_dont_have],
            "data_configuration" => $data_configurations[0],
            "data_rooms_general" => $data_rooms,
            "data_phones" => $data_phones
        );

        //Evaluamos cada uno de los controladores para permitir el acceso a las respectivas vistas
        switch ($class){

            case 'home':

                //Obtenemos los diferentes datos de la BD
                $data_opinions = Opinions::getAll(null, null, null, null, null, null, null, null);
                $data_site_galery = Galery::getAll(null, null, null, null, null, 'galery');
                $data_home_galery = Galery::getAll(null, null, null, null, null, 'home');
                $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);

                //Renderizamos la vista
                $twig->display('home.twig', array(
                    'general' => $general_param,
                    'data_opinions' => $data_opinions,
                    'data_site_galery' => $data_site_galery,
                    'data_home_galery' => $data_home_galery,
                    'data_rooms' => $data_rooms
                ));
                break;

            case 'about':

                //Renderizamos la vista
                $twig->display('about-us.twig', array(
                    'general' => $general_param
                ));
                break;

            case 'contact':

                //Obtenemos los diferentes datos de la BD
                $data_configurations = Configurations::getAll(null, null, null, null, null, null, null, null, null, null);

                //Validamos se realmente tem dados pra evitar o error de 'NOTICE do PHP'
                if ($data_configurations != NULL){

                    //Obtemos os telefones
                    $data_phones = json_decode($data_configurations[0]['telefones'], TRUE);
                    $data_types = json_decode($data_configurations[0]['tipo'], TRUE);

                    //Obtemos os emails
                    $data_emails = json_decode($data_configurations[0]['email'], TRUE);
                }
                else{
                    $data_phones = NULL;
                    $data_types = NULL;
                    $data_emails = NULL;
                }

                //Renderizamos la vista
                $twig->display('contact.twig', array(
                    'general' => $general_param,
                    'data_configuration' => $data_configurations[0],
                    'data_phones' => $data_phones,
                    'data_types' => $data_types,
                    'data_emails' => $data_emails
                ));
                break;

            case 'rooms':

                //Nós obtemos os dados relacionados aos quartos
                $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);

                //Renderizamos la vista
                $twig->display('rooms.twig', array(
                    'general' => $general_param,
                    'data_rooms' => $data_rooms
                ));
                break;

            case 'bookings':

                //Nós obtemos os dados relacionados aos quartos
                $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);

                //Nos validamos cada uma das clases
                if ($action == 'reserve'){

                    if (is_numeric($id) && $id != ''){

                        //Nós obtemos os dados relacionados aos quartos
                        $data_reserve_room = Rooms::getAll(NULL,NULL,NULL,$id,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
                        $check_in = date("Y-m-d");
                        $check_out = date("Y-m-d", strtotime('+1 day', strtotime($check_in)));

                        //Obtemos a diferencia de dias dasa datas
                        $diff_days = GeneralMethods::calculateDaysDiff($check_in, $check_out);

                        //Obtemos o preco
                        $price = (($data_reserve_room[0]['preco'] * $diff_days) * 1);

                        $twig->display('bookings-make.twig',array(
                            'general' => $general_param,
                            'summary_booking_check_in' => $check_in,
                            'summary_booking_check_out' => $check_out,
                            'summary_booking_children' => '0',
                            'summary_booking_diff_days' => $diff_days,
                            'summary_booking_room' => '1',
                            'summary_booking_price' => $price,
                            'summary_booking_type_room' => $data_reserve_room[0]
                        ));
                    }
                    elseif (is_string($id) && $id == 'form'){

                        //Obtenemos los datos de las reservas pasados por POST
                        $check_in = filter_input(INPUT_POST, 'reserve_check_in', FILTER_SANITIZE_STRING);
                        $check_out = filter_input(INPUT_POST, 'reserve_check_out', FILTER_SANITIZE_STRING);
                        $children = filter_input(INPUT_POST, 'reserve_children', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));
                        $room = filter_input(INPUT_POST, 'reserve_room', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));
                        $type_room = filter_input(INPUT_POST, 'reserve_type_room', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));

                        //Obtemos os dados do quarto
                        $data_rooms = Rooms::getAll(NULL,NULL,NULL,$type_room,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);

                        //Obtemos a diferencia de dias dasa datas
                        $diff_days = GeneralMethods::calculateDaysDiff($check_in, $check_out);

                        //Obtemos o preco
                        $price = (($data_rooms[0]['preco'] * $diff_days) * $room);

                        $twig->display('bookings-make.twig',array(
                            'general' => $general_param,
                            'summary_booking_check_in' => $check_in,
                            'summary_booking_check_out' => $check_out,
                            'summary_booking_children' => $children = empty($children) ? '0' : $children,
                            'summary_booking_diff_days' => $diff_days,
                            'summary_booking_room' => $room,
                            'summary_booking_price' => $price,
                            'summary_booking_type_room' => $data_rooms[0]
                        ));
                    }
                    elseif (isset($id) && empty($id)){

                        //Obtenemos los parámetros GET
                        $summary_booking_check_in = filter_input(INPUT_GET, 'check_in', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
                        $summary_booking_check_out = filter_input(INPUT_GET, 'check_out', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
                        $summary_booking_children = filter_input(INPUT_GET, 'children', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => NULL)));
                        $summary_booking_room = filter_input(INPUT_GET, 'rooms', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "1")));
                        $summary_booking_price = filter_input(INPUT_GET, 'price', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
                        $summary_booking_type_room = filter_input(INPUT_GET, 'type_room', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => NULL)));

                        //Obtemos os dados do quarto
                        $data_rooms = Rooms::getAll(NULL,NULL,NULL,$summary_booking_type_room,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);

                        //Obtemos a diferencia de dias dasa datas
                        $diff_days = GeneralMethods::calculateDaysDiff($summary_booking_check_in, $summary_booking_check_out);

                        $twig->display('bookings-make.twig',array(
                            'general' => $general_param,
                            'summary_booking_check_in' => $summary_booking_check_in,
                            'summary_booking_check_out' => $summary_booking_check_out,
                            'summary_booking_children' => $children = empty($summary_booking_children) ? '0' : $summary_booking_children,
                            'summary_booking_diff_days' => $diff_days,
                            'summary_booking_room' => $summary_booking_room,
                            'summary_booking_price' => $summary_booking_price,
                            'summary_booking_type_room' => $data_rooms[0]
                        ));
                    }
                    else
                        $twig->display('bookings.twig', array(
                            'general' => $general_param,
                            'data_rooms' => $data_rooms
                        ));
                }
                else
                    $twig->display('bookings.twig', array(
                        'general' => $general_param,
                        'data_rooms' => $data_rooms
                    ));

                break;

            case 'admin':

                //Renderizamos la vista
                $twig->display('log-in.twig',array(
                    'general' => $general_param
                ));
                break;

            default:

                //Renderizamos la vista
                $twig->display('home.twig', array(
                    'general' => $general_param
                ));
                break;
        }