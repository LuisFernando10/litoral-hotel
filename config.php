
	<?php

		/**
		* @Description: Documento que almacena las constantes de configuración del sitio
		* @User: luis.chamorro
		* @Date: 06-10-2019
		*/

	    //Definimos zona horaria de la página
		date_default_timezone_set('America/Bogota');

		//Evaluamos si el protocolo es 'https' o 'http'
	    if (isset($_SERVER['HTTPS']) === true) 
	    	$protocol = 'https';
	    else 
	    	$protocol = 'http';

	    //Definimos constante para el protocolo de la plataforma, puede ser (https-http)
	    define('SITE_PROTOCOL', $protocol);

        //Definimos constante para el Debug (errores)
	    define('DEBUG', true);

	    //Definimos las 'RUTAS' generales del proyecto
	    define('FULL_WEB_URL', constant('SITE_PROTOCOL').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/');
	    define('ASSETS_WEB_URL', constant('FULL_WEB_URL').'assets/');
	    define('IMAGES_WEB_URL', constant('ASSETS_WEB_URL').'img/');

        //Pagination
        define("PAGINATION", 15);

        //Datos de conexión a la BD
        define('DB_SERVER','litora-hotel.mysql.uhserver.com'); //litora-hotel.mysql.uhserver.com - localhost
        define('DB_USER','hlitorallira');//phpmyadmin - root - hlitorallira
        define('DB_PASSWORD','HlLitoHote10f*');//lfchamorro10f - root - HlLitoHote10f*
        define('DB_DATABASE','litora_hotel');//litoral_hotel - litora_hotel