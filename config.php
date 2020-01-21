
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
	    define('DEBUG', true);

	    //Ruta general del proyecto
	    define('FULL_WEB_URL', constant('SITE_PROTOCOL').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/');

	    //Ruta directorio 'assets'
	    define('ASSETS_WEB_URL', constant('FULL_WEB_URL').'assets/');

	    //Ruta imágenes de la página
	    define('IMAGES_WEB_URL', constant('ASSETS_WEB_URL').'img/');