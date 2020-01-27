	
	<?php 
		/**
		* @Description: Documento que carregara as vistas iniciais do projeto
		* @User: luis.chamorro
		* @Date: 26-ene-2020
		*/

        //Cofiguraciòn de seguridad para el acceso a la plataforma
//		if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
//            $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//            header('HTTP/1.1 301 Moved Permanently');
//            header('Location: ' . $location);
//            exit;
//        }

		//Importamos el archivo de configuración global
		require_once (dirname(__FILE__).'/config-import.php');

		//Incluimos los controladores (Futuramente direccionará al controlador dependiendo el rol)
		include_once (dirname(__FILE__).'/controllers/user/index.php');