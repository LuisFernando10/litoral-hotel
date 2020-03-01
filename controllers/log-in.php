
    <?php
        /**
         * @Description: Documento que procesa los datos para renderizar la vista del 'log-in'
         * @User: luis.chamorro
         * @Date: 29/feb/2020
         */

        //Definimos las variables generales a utilizar con 'twig'
        $generalParam = array(
            "full_web_url" => constant('FULL_WEB_URL'),
            "full_assets_url" => constant('ASSETS_WEB_URL'),
            "full_images_url" => constant('IMAGES_WEB_URL')
        );

        //Registramos el cargador automático de Twig
        require_once(dirname(__FILE__).'/../vendor/autoload.php');
        $loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/../views/');

        //Twig load enviroment
        $twig = new Twig_Environment($loader, array(
            //    'cache' => '/path/to/compilation_cache',
        ));

        //Cargamos y renderizamos la plantilla (Vista), junto con los parámetros (Variables) a utilizar
        $twig->display('log-in.twig',array(
            'general' => $generalParam
        ));