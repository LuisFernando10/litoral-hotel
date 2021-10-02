
    <?php

        #Importaciones
        require_once(dirname(__FILE__).'/../../security/secure-session.php');
        require_once(dirname(__FILE__).'/../../vendor/autoload.php');

        # Twig
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__).'/../../views/admin/');
        //$path_cache_twig = dirname(__FILE__).'/../../temp/cache/';
        $twig = new \Twig\Environment($loader, array(
            //'cache' =>  $path_cache_twig,
            'auto_reload' => true,
            'debug' => true
        ));
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        # Generales
        $user_id = $_SESSION['user_id'];

        # Datos BD
        $data_user = Users::getAll(NULL, NULL, NULL, $user_id, NULL, NULL, NULL, '1','ativo');

        # URL
        $class = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING, array("options" => array("default" => "configuracoes")));
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => NULL)));
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING, array("options" => array("default" => 1)));
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING, array("options" => array("default" => NULL)));

        #Parámetros Generales
        $general_param = array(
            'full_web_url' => constant('FULL_WEB_URL'),
            'full_assets_url' => constant('ASSETS_WEB_URL'),
            'full_images_url' => constant('IMAGES_WEB_URL'),
            'user_id' => $user_id,
            'data_user' => $data_user[0],
            'class_url' => $class
        );

        #Vistas
        switch ($class){

            case 'dashboard':

                $twig->display('dashboard.twig',array(
                    'general' => $general_param
                ));
                break;

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

            case 'promocoes':

                #DB Data
                $data_promotion = Promotions::getAll(NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL);
                $data_room = Rooms::getAll(NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL,NULL,NULL);
                $data_promotion_edit = Promotions::getAll(NULL, NULL, NULL, $id, NULL, NULL,NULL, NULL, NULL);

                #Actions
                if ($action == 'create')
                    $twig->display('promotions-create.twig', [
                        'general' => $general_param,
                        'data_room' => $data_room
                    ]);
                elseif ($action == 'edit'){
                    if (is_numeric($id)) $twig->display('promotions-edit.twig', [
                        'general' => $general_param,
                        'data_promotion_edit' => $data_promotion_edit[0],
                        'data_room' => $data_room
                    ]);
                    else $twig->display('promotions-list.twig', [
                        'general' => $general_param,
                        'data_promotion' => $data_promotion
                    ]);
                }
                else $twig->display('promotions-list.twig', [
                    'general' => $general_param,
                    'data_promotion' => $data_promotion
                ]);
                break;

            case 'feriados':

                #DB Data
                $data_holiday = Holidays::getAll(NULL, NULL, NULL, $id, NULL, NULL,NULL);
                $data_room = Rooms::getAll(NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL,NULL);

                #Actions
                if ($action == 'create')
                    $twig->display('holidays-create.twig', [
                        'general' => $general_param,
                        'data_room' => $data_room
                    ]);
                elseif ($action == 'edit'){

                    if ( is_numeric($id) ){

                        $data_room_holiday = Holidays::getAllDetail(NULL,NULL,NULL,$id,NULL,NULL,NULL);

                        $twig->display('holidays-edit.twig', [
                            'general' => $general_param,
                            'data_holiday' => $data_holiday[0],
                            'data_room_holiday' => $data_room_holiday,
                            'data_room' => $data_room
                        ]);
                    }
                    else $twig->display('holidays-list.twig', [
                        'general' => $general_param,
                        'data_holiday' => $data_holiday
                    ]);
                }
                else $twig->display('holidays-list.twig', [
                    'general' => $general_param,
                    'data_holiday' => $data_holiday
                ]);
                break;

            case 'oferecimentos':

                //Obtemos os dados relacionados às ofertas
                $data_offering = Offerings::getAll(NULL, NULL, NULL, NULL, NULL, NULL, NULL);

                //Renderizamos la vista
                $twig->display('offerings.twig',array(
                    'general' => $general_param,
                    'data_offering' => $data_offering
                ));

                break;

            case 'reservas':

                //Nos obtemos os dados que precisaremos renderizar nas vistas
                $data_booking = Reserves::getAll(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
                $data_booking_view = Reserves::getAll(NULL, NULL, NULL, $id, NULL, NULL, NULL, NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

                //Nos validamos cada uma das clases
                if ($action == 'reply')
                    $twig->display('booking-reply.twig',array(
                        'general' => $general_param
                    ));
                elseif ($action == 'view'){
                    if (is_numeric($id) && $id != '')
                        $twig->display('booking-view.twig',array(
                            'general' => $general_param,
                            'data_booking_view' => $data_booking_view[0]
                        ));
                    else
                        $twig->display('booking-list.twig',array(
                            'general' => $general_param,
                            'data_booking' => $data_booking
                        ));
                }
                else
                    $twig->display('booking-list.twig',array(
                        'general' => $general_param,
                        'data_booking' => $data_booking
                    ));

                break;

            case 'galeria':

                //Nos obtemos os dados que precisaremos renderizar nas vistas
                $data_galery = Galery::getAll(NULL, NULL, NULL, NULL, NULL, NULL);
                $data_galery_edit = Galery::getAll(NULL, NULL, NULL, $id, NULL, NULL);

                //Nos validamos cada uma das clases
                if ($action == 'create')
                    $twig->display('galery-create.twig',array(
                        'general' => $general_param
                    ));
                elseif ($action == 'edit'){
                    //Nos validamos se tem um $id
                    if (is_numeric($id) && $id != ''){
                        $twig->display('galery-edit.twig',array(
                            'general' => $general_param,
                            'data_galery_edit' => $data_galery_edit[0]
                        ));
                    }
                    else
                        $twig->display('galery-list.twig',array(
                            'general' => $general_param,
                            'data_galery' => $data_galery
                        ));
                }
                else
                    $twig->display('galery-list.twig',array(
                        'general' => $general_param,
                        'data_galery' => $data_galery
                    ));

                break;

            case 'contato':

                //Obtenemos los datos que se procesarán en las vistas
                $data_hotel_contact = HotelContact::getAll(NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL, NULL, NULL, NULL);

                //Renderizamos la vista
                $twig->display('hotel-contact.twig',array(
                    'general' => $general_param,
                    'data_hotel_contact' => $data_hotel_contact
                ));
                break;

            case 'salir':

                //Importamos el controlador del LogIn
                Security::sessionClose();

                //Guardamos la ruta general de la plataforma
                $ruta_redireccion = constant('FULL_WEB_URL');

                //Realizamos el direccionamiento a la ruta general, la cual cargará el 'index.php'
                header("Location: $ruta_redireccion");

                break;

            case 'configuracoes':
            default:

                //Obtemos os dados das configuracoes que precisemos
                $data_configurations = Configurations::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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

                $twig->display('configurations.twig',array(
                    'general' => $general_param,
                    'data_configuration' => $data_configurations,
                    'data_phones' => $data_phones,
                    'data_types' => $data_types,
                    'data_emails' => $data_emails
                ));
                break;
        }