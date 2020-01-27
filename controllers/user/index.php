
    <?php

        /**
         * @Description: Documento que gestionarà las respectivas vistas de la plataforma
         * @User: luis.chamorro
         * @Date: 26-ene-2020
         */

//        //Incluimos la configuraciòn del gestor de paquetes del 'Composer'
//        require_once (dirname(__FILE__).'/../../vendor/autoload.php');
//
//        //Cargamos configuraciòn e indicamos en què parte se deben renderizar las vistas del 'Twig'
//        $loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__).'/../../views/user/');
//
//        //Cargamos las configuraciones para el ambiente de las plantillas
//        $twig = new \Twig\Environment($loader, [
//            'cache' => dirname(__FILE__).'/../../views/user/'
//        ]);
//
//        //Obtenemos los paràmetros URL configurados desde el .htaccess (Clase-Acciòn-Id)
//        $class = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING, array("options" => array("default" => "home")));
//        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING, array("options" => array("default" => "")));
//        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => "")));

        echo $class;
