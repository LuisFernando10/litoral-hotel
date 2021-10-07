
    <?php

        # Importación
        require_once (dirname(__FILE__).'/../../vendor/autoload.php');

        # Twig
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__).'/../../views/user/');
        $twig = new \Twig\Environment($loader, [
            //'cache' => dirname(__FILE__).'/../../views/user/',
            'auto_reload' => true,
            'debug' => true
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        # URL
        $class = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING, array("options" => array("default" => "home")));
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));

        # DB Data
        $data_offerings_have = Offerings::getAll(NULL, NULL, NULL, NULL, NULL, 'possui', NULL);
        $data_offerings_dont_have = Offerings::getAll(NULL, NULL, NULL, NULL, NULL, 'nao_possui', NULL);
        $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
        $data_configurations = Configurations::getAll(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        //$data_promotions = Promotions::getAll(NULL, NULL, NULL, NULL, NULL, NULL, date('Y-m-d'), date('Y-m-d'), NULL, true);
        $data_ = Promotions::getAll(NULL, NULL, NULL, NULL, NULL, NULL, date('Y-m-d'), date('Y-m-d'), NULL, true);

        # General Data
        $data_phones = json_decode($data_configurations[0]['telefones'], TRUE);

        # General Process
        /*if ($data_promotions !== NULL){
            foreach ($data_promotions as $promotion){
                Rooms::updatePromotionPrice($promotion['id_quarto'], $promotion['preco'], $promotion['data_inicial'], $promotion['data_final']);
            }
        }*/

        if ($data_rooms !== NULL){
            foreach ($data_rooms as $room){
                $date_now = date('Y-m-d');
                $date_start = $room['data_inicio_promocao'];
                $date_end = $room['data_vencimento_promocao'];
                $check_range_date = GeneralMethods::checkInRangeDate($date_start, $date_end, $date_now);

                if ($check_range_date !== true)
                    Rooms::updatePromotionPrice($room['id_quarto'], NULL, NULL, NULL);
            }
        }

        # General Twig
        $general_param = [
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
        ];

        # Views
        switch ($class){

            case 'home':

                # BD
                $data_opinions = Opinions::getAll(null, null, null, null, null, null, null, null);
                $data_site_gallery = Galery::getAll(null, null, null, null, null, 'galery');
                $data_home_gallery = Galery::getAll(null, null, null, null, null, 'home');
                $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
                $data_room_holiday = Holidays::getAllDetail(NULL,NULL,NULL,NULL,date('Y-m-d'),date('Y-m-d'),NULL);

                $twig->display('home.twig', [
                    'general' => $general_param,
                    'data_opinions' => $data_opinions,
                    'data_site_galery' => $data_site_gallery,
                    'data_home_galery' => $data_home_gallery,
                    'data_room_holiday' => $data_room_holiday,
                    'data_rooms' => $data_rooms
                ]);
                break;

            case 'about':
                $twig->display('about-us.twig', [
                    'general' => $general_param
                ]);
                break;

            case 'contact':

                # BD
                $data_configurations = Configurations::getAll(null, null, null, null, null, null, null, null, null, null);

                if ($data_configurations != NULL){

                    # Phones
                    $data_phones = json_decode($data_configurations[0]['telefones'], TRUE);
                    $data_types = json_decode($data_configurations[0]['tipo'], TRUE);

                    # Emails
                    $data_emails = json_decode($data_configurations[0]['email'], TRUE);
                }
                else{
                    $data_phones = NULL;
                    $data_types = NULL;
                    $data_emails = NULL;
                }

                $twig->display('contact.twig', [
                    'general' => $general_param,
                    'data_configuration' => $data_configurations[0],
                    'data_phones' => $data_phones,
                    'data_types' => $data_types,
                    'data_emails' => $data_emails
                ]);
                break;

            case 'rooms':

                # DB
                $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
                $data_room_holiday = Holidays::getAllDetail(NULL,NULL,NULL,NULL,date('Y-m-d'),date('Y-m-d'),NULL);

                $twig->display('rooms.twig', [
                    'general' => $general_param,
                    'data_rooms' => $data_rooms,
                    'data_room_holiday' => $data_room_holiday
                ]);
                break;

            case 'bookings':

                # BD
                $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
                $data_room_holiday = Holidays::getAllDetail(NULL,NULL,NULL,NULL,date('Y-m-d'),date('Y-m-d'),NULL);

                # Actions
                if ($action == 'reserve'){
                    if (is_numeric($id) && $id != ''){

                        # General Data
                        $data_reserve_room = Rooms::getAll(NULL,NULL,NULL,$id,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
                        $check_in = date("Y-m-d");
                        $check_out = date("Y-m-d", strtotime('+1 day', strtotime($check_in)));
                        $diff_days = GeneralMethods::calculateDaysDiff($check_in, $check_out);
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

                        # POST params
                        $check_in = filter_input(INPUT_POST, 'reserve_check_in', FILTER_SANITIZE_STRING);
                        $check_out = filter_input(INPUT_POST, 'reserve_check_out', FILTER_SANITIZE_STRING);
                        $children = filter_input(INPUT_POST, 'reserve_children', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));
                        $room = filter_input(INPUT_POST, 'reserve_room', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "1")));
                        $type_room = filter_input(INPUT_POST, 'reserve_type_room', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));

                        # Data general
                        $data_rooms = Rooms::getAll(NULL,NULL,NULL,$type_room,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
                        $diff_days = GeneralMethods::calculateDaysDiff($check_in, $check_out);
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

                        # GET params
                        $summary_booking_check_in = filter_input(INPUT_GET, 'check_in', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
                        $summary_booking_check_out = filter_input(INPUT_GET, 'check_out', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
                        $summary_booking_children = filter_input(INPUT_GET, 'children', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => NULL)));
                        $summary_booking_room = filter_input(INPUT_GET, 'rooms', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "1")));
                        $summary_booking_price = filter_input(INPUT_GET, 'price', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
                        $summary_booking_type_room = filter_input(INPUT_GET, 'type_room', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => NULL)));

                        # Data general
                        $data_rooms = Rooms::getAll(NULL,NULL,NULL,$summary_booking_type_room,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);
                        $diff_days = GeneralMethods::calculateDaysDiff($summary_booking_check_in, $summary_booking_check_out);

                        $twig->display('bookings-make.twig', [
                            'general' => $general_param,
                            'summary_booking_check_in' => $summary_booking_check_in,
                            'summary_booking_check_out' => $summary_booking_check_out,
                            'summary_booking_children' => $children = empty($summary_booking_children) ? '0' : $summary_booking_children,
                            'summary_booking_diff_days' => $diff_days,
                            'summary_booking_room' => $summary_booking_room,
                            'summary_booking_price' => $summary_booking_price,
                            'summary_booking_type_room' => $data_rooms[0]
                        ]);
                    }
                    else $twig->display('bookings.twig', [
                        'general' => $general_param,
                        'data_rooms' => $data_rooms
                    ]);
                }
                else $twig->display('bookings.twig', [
                    'general' => $general_param,
                    'data_rooms' => $data_rooms
                ]);

                break;

            case 'admin':
                $twig->display('log-in.twig', [
                    'general' => $general_param
                ]);
                break;

            default:
                $twig->display('home.twig', [
                    'general' => $general_param
                ]);
                break;
        }