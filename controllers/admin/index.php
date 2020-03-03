
    <?php

        /**
         * @Description: Documento que procesa los controladores y las acciones para renderizar las vistas con 'Twig' para el rol 'administrador'
         * @User: luis.chamorro
         * @Date: 14/feb/2020
         */

        //Se incluye el archivo de seguridad que no permite hacer nada si no estan las sesiones habilitadas y correctamente iniciadas
        require_once(dirname(__FILE__).'/../../security/secure-session.php');

        //Registramos el cargador automático de Twig
        require_once(dirname(__FILE__).'/../../vendor/autoload.php');

        //Indicamos en qué parte del proyecto se encontrarán las plantillas a reenderizar
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__).'/../../views/admin/');

        //Indicamos las carpetas que almacenarán el caché de Twig
        //        $path_cache_twig = dirname(__FILE__).'/../../temp/cache/';

        //Twig load enviroment
        $twig = new \Twig\Environment($loader, array(
        //            'cache' =>  $path_cache_twig,
            'auto_reload' => true
        ));

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
            case 'dashboard':

                echo $twig->render('dashboard.twig',array(
                    'general' => $general_param
                ));
                break;

            case 'quartos':

                echo $twig->render('rooms.twig',array(
                    'general' => $general_param
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

            default:

                //Cargamos y renderizamos la plantilla (Vista), junto con los parámetros (Variables) a utilizar
                echo $twig->render('dashboard.twig',array(
                    'general' => $general_param
                ));
                break;
        }