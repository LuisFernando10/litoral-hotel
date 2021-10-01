
	<?php

    #Generales
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('America/Sao_Paulo');
    define('SITE_PROTOCOL', isset($_SERVER['HTTPS']) === true ? 'https' : 'http');
    define("PAGINATION", 15);
    define('DEBUG', true);
    define('EMAIL', '');

    #Rutas
    define('FULL_WEB_URL', constant('SITE_PROTOCOL').'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/');
    define('ASSETS_WEB_URL', constant('FULL_WEB_URL').'assets/');
    define('IMAGES_WEB_URL', constant('ASSETS_WEB_URL').'img/');

    #BD
    define('DB_SERVER','');
    define('DB_USER','');
    define('DB_PASSWORD','');
    define('DB_DATABASE','');