
	<?php

    #Generales
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('America/Sao_Paulo');
    define('SITE_PROTOCOL', isset($_SERVER['HTTPS']) === true ? 'https' : 'http');
    define("PAGINATION", 15);
    define('DEBUG', true);
    define('EMAIL', 'reservas@hotellitoral.com.br');

    #Rutas
    define('FULL_WEB_URL', constant('SITE_PROTOCOL').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/');
    define('ASSETS_WEB_URL', constant('FULL_WEB_URL').'assets/');
    define('IMAGES_WEB_URL', constant('ASSETS_WEB_URL').'img/');

    #BD
    define('DB_SERVER','litora-hotel.mysql.uhserver.com'); //litora-hotel.mysql.uhserver.com - localhost
    define('DB_USER','hlitorallira');//phpmyadmin - root - hlitorallira
    define('DB_PASSWORD','HlLitoHote10f*');//lfchamorro10f - root - HlLitoHote10f*
    define('DB_DATABASE','litora_hotel');//litoral_hotel - litora_hotel