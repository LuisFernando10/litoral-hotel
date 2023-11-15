
	<?php

	    #Zona horaria
        header('Content-Type: text/html; charset=utf-8');
		date_default_timezone_set('America/Bogota');

        #Generales
        define('SITE_PROTOCOL', isset($_SERVER['HTTPS']) === true ? 'htts' : 'http');
        define("PAGINATION", 15);
        define('DEBUG', true);
        define('EMAIL', 'your.email@email.com');

	    #Rutas
	    define('FULL_WEB_URL', constant('SITE_PROTOCOL').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/');
	    define('ASSETS_WEB_URL', constant('FULL_WEB_URL').'assets/');
	    define('IMAGES_WEB_URL', constant('ASSETS_WEB_URL').'img/');

        #BD
        define('DB_SERVER','localhost');
        define('DB_USER','your-user');
        define('DB_PASSWORD','your-pass');
        define('DB_DATABASE','your_database');