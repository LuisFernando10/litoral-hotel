
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
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));

        //Obtemos os dados do BD necessários nas visualizações gerais pra tratamento
        $data_configurations = Configurations::getAll(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $data_phones = json_decode($data_configurations[0]['telefones'], TRUE);

        //Definimos las variables generales a utilizar en las vistas 'Twig'
        $generalParam = array(
            "full_web_url" => constant('FULL_WEB_URL'),
            "full_assets_url" => constant('ASSETS_WEB_URL'),
            "full_images_url" => constant('IMAGES_WEB_URL'),
            "class_param" => $class,
            "data_configuration" => $data_configurations[0],
            "data_phones" => $data_phones
        );

        //Evaluamos cada uno de los controladores para permitir el acceso a las respectivas vistas
        switch ($class){

            case 'home':

                //Obtenemos los diferentes datos de la BD
                $data_opinions = Opinions::getAll(null, null, null, null, null, null, null, null);

                //Renderizamos la vista
                $twig->display('home.twig', array(
                    'general' => $generalParam,
                    'data_opinions' => $data_opinions
                ));
                break;

            case 'about':

                //Renderizamos la vista
                $twig->display('about-us.twig', array(
                    'general' => $generalParam
                ));
                break;

            case 'contact':

                //Renderizamos la vista
                $twig->display('contact.twig', array(
                    'general' => $generalParam
                ));
                break;

            case 'rooms':

                //Nós obtemos os dados relacionados aos quartos
                $data_rooms = Rooms::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'disponivel',NULL);

                //Renderizamos la vista
                $twig->display('rooms.twig', array(
                    'general' => $generalParam,
                    'data_rooms' => $data_rooms
                ));
                break;

            case 'bookings':

                //Renderizamos la vista
                $twig->display('bookings.twig', array(
                    'general' => $generalParam
                ));
                break;

            case 'admin':

                //Renderizamos la vista
                $twig->display('log-in.twig',array(
                    'general' => $generalParam
                ));
                break;

            default:

                //Renderizamos la vista
                $twig->display('home.twig', array(
                    'general' => $generalParam
                ));
                break;
        }