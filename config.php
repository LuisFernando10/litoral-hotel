
	<?php

        #Headers
        header('Content-Type: text/html; charset=utf-8');

	    #Zona horaria
		date_default_timezone_set('America/Bogota');

        #Generales
        define('SITE_PROTOCOL', isset($_SERVER['HTTPS']) === true ? 'https' : 'http');
        define("PAGINATION", 15);
        define('DEBUG', true);
        define('EMAIL', 'reservas@hotellitoral.com.br');

	    #Rutas
	    define('FULL_WEB_URL', constant('SITE_PROTOCOL').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/');
	    define('ASSETS_WEB_URL', constant('FULL_WEB_URL').'assets/');
	    define('IMAGES_WEB_URL', constant('ASSETS_WEB_URL').'img/');

        #BD
        define('DB_SERVER','localhost'); //litora-hotel.mysql.uhserver.com - localhost
        define('DB_USER','root');//phpmyadmin - root - hlitorallira
        define('DB_PASSWORD','');//lfchamorro10f - root - HlLitoHote10f*
        define('DB_DATABASE','litoral_hotel');//litoral_hotel - litora_hotel